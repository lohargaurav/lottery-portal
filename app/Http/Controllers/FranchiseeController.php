<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Users;
use App\User;
use App\User_Credits;
use App\User_Credits_Request;
use App\User_Credits_History;
use Session;
use Hash;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;
use Helper;
use DB;

class FranchiseeController extends Controller {
    private $loggedUser;
   
	public function __construct() {
        $this->middleware('auth');
		$this->loggedUser = Auth::user()->id;
    }
	
	//Display All Users
    public function index() { 
	
		$usersLists = Users::select('user.id', 'user.name', 'user.email', 'user.mobile', 'user.address','user.approved_by_admin', 'user.approved_by_franchisee', 'user.isDeleted', 'user_credits.points' )->join('user_credits','user_credits.user_id','=','user.id')->where('user.role_id','=',env('FRANCHISEE'))->where('user.isAdmin','!=', env('ISADMIN'))->where('user.isDeleted','=', env('NOTDELETED'))->orderBy('user.name', 'asc')->get();
		
		return view('admin.user.index',compact('usersLists'));
    }
	
	public function requestCredits(request $request){
		
		$objValidation = Validator::make($request->all(), [
				'credit_points' => 'required|numeric',
            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();
			return response()->json($errors, 422);
		} else {
			
			//Debit points from user balance
			$objSave = new User_Credits_Request;
			$objSave->user_id = $this->loggedUser;
			$objSave->requested_points = $request->credit_points;			
			$objSave->created_date =  Carbon::now();	
			$objSave->save();
			return Response::json(['message' => 'Credit points request submitted successfully']);		
		}
	}
	
	public function listRequests(){
		$objRequests = User_Credits_Request::select('user_credits_request.id', 'user.name', 'user_credits_request.requested_points','user_credits_request.isDelivered')->join('user', 'user.id','=','user_credits_request.user_id')->where('isRejected','=', env('NOTDELETED'))->orderBy('user_credits_request.created_date', 'desc')->get();
		
		return view('admin.request.index',compact('objRequests'));
	}

    public function approveCreditsRequest($id){
		$id = Helper::decode($id);
		
		User_Credits_Request::where('id',$id)
				  ->update(['isDelivered'=>env('ACTIVE')]);
				  
		$requestData = User_Credits_Request::find($id);
		
		$pointsReciever = User::find($requestData->user_id);
		$pointsTransferer = User::find($this->loggedUser);
		
		//Debit points from user balance
		$objSave = new User_Credits_History;
		$objSave->user_id = $this->loggedUser;
		$objSave->points_amt = $requestData->requested_points;
		$objSave->type = env('DEBIT');
		$objSave->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
		$objSave->transaction_desc = "Points transfered to ".$pointsReciever->name;
		$objSave->created_date =  Carbon::now();	
		$objSave->save();
		
		$objSaveCredits = User_Credits::find($this->loggedUser);
		$objSaveCredits->points = $objSaveCredits->points - $requestData->requested_points;
		$objSaveCredits->update_date =  Carbon::now();			
		$objSaveCredits->save();
		
		//Credit points to user
		$objSaveUser = new User_Credits_History;
		$objSaveUser->user_id = $requestData->user_id;
		$objSaveUser->points_amt = $requestData->requested_points;
		$objSaveUser->type = env('CREDIT');
		$objSaveUser->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
		$objSaveUser->transaction_desc = "Points transfered from ".$pointsTransferer->name;
		$objSaveUser->created_date =  Carbon::now();	
		$objSaveUser->save();
		
		$objSaveCreditsUser = User_Credits::find($requestData->user_id);
		$objSaveCreditsUser->points = $objSaveCreditsUser->points + $requestData->requested_points;
		$objSaveCreditsUser->update_date =  Carbon::now();			
		$objSaveCreditsUser->save();

		return Response::json(['message' => 'Credit points added successfully']);		
	}
	
	public function rejectCreditsRequest($id){
		
		User_Credits_Request::where('id',$id)
				  ->update(['isRejected'=>env('DELETED')]);
		
		return Response::json(['message' => 'Request removed successfully!']);
	}
	
	public function listRequestsToAdmin(){
		
		$objRequests = User_Credits_Request::where('user_id', $this->loggedUser )->where('isRejected','=', env('NOTDELETED'))->orderBy('created_date', 'desc')->get();
		
		return view('admin.request.view',compact('objRequests'));
	}
	
}

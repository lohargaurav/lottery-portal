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
use App\Http\Traits\UserTrait;
use App\User;
use App\Users;
use App\User_Credits;
use App\User_Credits_History;
use App\User_Credits_Request;
use DB;
use Helper;
use Carbon\Carbon;

class CommonController extends Controller {
	private $loggedUser;
    public function __construct() {
		
        $this->middleware('auth');
		$this->loggedUser = Auth::user()->id;
    }
    
	//User updateStatus 
	
	public function updateStatusUser($id,$status,$durl){
		$id = Helper::decode($id);
		
		if(is_numeric($id)){
			
			$objUsers = Users::find($id);
			if($durl=="franchisee"){
				$objUsers->approved_by_admin = $status;
			}
			else{
				$objUsers->approved_by_franchisee = $status;
			}
			$objUsers->save();
			
		}
		return Redirect::to($durl);
	}
    
	//Soft Delete User 
	public function getSoftDelete($id){
		
		DB::table('user')->where('id',$id)
				  ->update(['isDeleted'=>env('DELETED')]);
		
		return Response::json(['message' => 'User has been deleted successfully!']);	
	}
	
	public function view($id){
		$objUser = User::find(Helper::decode($id));
		return view('admin.user.view',compact('objUser'));
	}

	public function updateUserProfile(Request $request){
				$objValidation = Validator::make($request->all(), [
				'user_id' => 'required|numeric',
				'fullname' => 'required|alpha_dash',
				'address' => 'required', 
				'mobile' => 'required|numeric', 
				//'profile_image' => 'required',				

            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();
			return response()->json($errors, 422);
		} else {
			
			if ($request->hasFile('profile_image')) {
				
				$file = $request->file('profile_image');
				$fileName = date("Y-m-d-H-i-s").$file->getClientOriginalName();				
				$file->move( env('API_FOLDER_PATH') .env('API_FILE_UPLOAD_PATH_USER'), $fileName);
				$fileNameFullPath = env('API_URL').env('API_FILE_UPLOAD_PATH_USER')."/".$fileName;				 
			}
			
			$objSave = User::find($request->user_id);					
			$objSave->name = $request->fullname;
			$objSave->address = $request->address;
			$objSave->mobile = $request->mobile;
			
			if(isset($fileNameFullPath)){
				$objSave->profile_image = $fileNameFullPath;		
			}			
			
			$objSave->update_date =  Carbon::now();			
			$objSave->save();
			
			return Response::json(['message' => 'User profile updated Successfully!']);		
		}

	}
	
	
	public function updateUserBankDetails(Request $request){
		
		$objValidation = Validator::make($request->all(), [
				'user_id' => 'required',
				'accountName' => 'required',
				'accountNumber' => 'required|min:16', 
				'bankName' => 'required', 
				'bankIFSC' => 'required', 
				//'profile_image' => 'required',				

            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();
			return response()->json($errors, 422);
		} else {
			
			$objSave = User::find($request->user_id);					
			$objSave->account_name = $request->accountName;
			$objSave->account_number = $request->accountNumber;
			$objSave->bank_name = $request->bankName;
			$objSave->ifsc_code = $request->bankIFSC;			
			$objSave->update_date =  Carbon::now();			
			$objSave->save();
			
			return Response::json(['message' => 'User bank details are updated Successfully!']);		
		}

	}
	
	public function updateCredits($id){
		
		$id = Helper::decode($id);
		
		$objCreditsHistory = User_Credits_History::where("user_id", $id)->orderBy('created_date', 'desc')->get();
		
		$objCredits = User_Credits::where("user_id",$id)->first();
		$objUser = User::find($id);		
		return view('admin.credits.view', compact('objCreditsHistory', 'objCredits', 'objUser'));
	}
	
	public function doUpdateCredits(request $request){
		$objValidation = Validator::make($request->all(), [
				'user_id' => 'required|numeric',
				'credit_points' => 'required|numeric',
            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();
			return response()->json($errors, 422);
		} else {
			
			$pointsReciever = User::find($request->user_id);
			$pointsTransferer = User::find($this->loggedUser);
			
			//Debit points from user balance
			$objSave = new User_Credits_History;
			$objSave->user_id = $this->loggedUser;
			$objSave->points_amt = $request->credit_points;
			$objSave->type = env('DEBIT');
			$objSave->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
			$objSave->transaction_desc = "Points transfered to ".$pointsReciever->name;
			$objSave->created_date =  Carbon::now();	
			$objSave->save();
			
			$objSaveCredits = User_Credits::find($this->loggedUser);
			$objSaveCredits->points = $objSaveCredits->points - $request->credit_points;
			$objSaveCredits->update_date =  Carbon::now();			
			$objSaveCredits->save();
			
			//Credit points to user
			$objSaveUser = new User_Credits_History;
			$objSaveUser->user_id = $request->user_id;
			$objSaveUser->points_amt = $request->credit_points;
			$objSaveUser->type = env('CREDIT');
			$objSaveUser->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
			$objSaveUser->transaction_desc = "Points transfered from ".$pointsTransferer->name;
			$objSaveUser->created_date =  Carbon::now();	
			$objSaveUser->save();
			
			$objSaveCreditsUser = User_Credits::find($request->user_id);
			$objSaveCreditsUser->points = $objSaveCreditsUser->points + $request->credit_points;
			$objSaveCreditsUser->update_date =  Carbon::now();			
			$objSaveCreditsUser->save();
			return Response::json(['message' => 'Credit points added successfully']);		
		}
	}
	
	public function transactions(){
		$id = $this->loggedUser;
		$objCreditsHistory = User_Credits_History::where("user_id", $id)->orderBy('created_date', 'desc')->get();
		
		$objCredits = User_Credits::where("user_id",$id)->first();
		$objUser = User::find($id);		
		return view('admin.credits.view', compact('objCreditsHistory', 'objCredits', 'objUser'));
	}
	
	public function doUpdateCreditsOwn(request $request){
			$objValidation = Validator::make($request->all(), [
				'user_id' => 'required|numeric',
				'credit_points' => 'required|numeric',
            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();
			return response()->json($errors, 422);
		} else {
			
			$pointsReciever = User::find($request->user_id);
			
			//Credit points to user
			$objSaveUser = new User_Credits_History;
			$objSaveUser->user_id = $request->user_id;
			$objSaveUser->points_amt = $request->credit_points;
			$objSaveUser->type = env('CREDIT');
			$objSaveUser->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
			$objSaveUser->transaction_desc = "Points added by own";
			$objSaveUser->created_date =  Carbon::now();	
			$objSaveUser->save();
			
			$objSaveCreditsUser = User_Credits::find($request->user_id);
			$objSaveCreditsUser->points = $objSaveCreditsUser->points + $request->credit_points;
			$objSaveCreditsUser->update_date =  Carbon::now();			
			$objSaveCreditsUser->save();
			return Response::json(['message' => 'Credit points added successfully']);		
		}
	}
	
}

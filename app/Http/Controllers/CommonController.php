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
use DB;
use Helper;
use Carbon\Carbon;

class CommonController extends Controller {
	
    public function __construct() {
		
        $this->middleware('auth');
		//$obj = new Commodity_Master;
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
				'user_id' => 'required',
				'fullname' => 'required',
				'address' => 'required', 
				'mobile' => 'required', 
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
}

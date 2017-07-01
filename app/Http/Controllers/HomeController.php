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
use App\User;
use Session;
use Hash;
use DB;
use Mail;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;
use Helper;
class HomeController extends Controller {
	
	protected $username = 'username';
    
	public function __construct() {
        // $this->middleware('auth');
    }
    public function index() {
		$now = Carbon::now();
		$month = $now->month;
		$day = $now->day;
		return view('home');        
    }

    public function getUserLogin() {	 
	
        return view('login');
    }

	public function UserPostLogin(UserLoginRequest $request) {
	  
        $user = array(
            'username' => $request->username,
            'password' => $request->password
        );
		
        $ObjUserCheck = User::where('username', '=', $request->username)
							->first();
		
		if (count($ObjUserCheck) != 0) { 
			
			if (Auth::attempt($user)) {
				return Response::json(['msg_status' => 'valid']);
			} else {
				return Response::json(['modal_title' => 'Some thing went wrong', 'message' => 'Invalid Credential', 'msg_status' => 'invalid']);
			}
		} 
		else {
			return Response::json(['modal_title' => 'Some thing went wrong', 'message' => 'Invalid Credential or Your not authenticate user', 'msg_status' => 'invalid']);
        }
    }
    

    public function logout() {
        Session::flush(); //clears out all the exisiting sessions
        return redirect::to('/');
    }
	
	//getForgotPassword
	
	public function getForgotPassword(){
		return view('forgot-password');
	}
	
	//postForgotPassword
	public function postForgotPassword(Request $request){
		$objValidation = Validator::make($request->all(), [
                    'email' => 'required|email',
              ]);
            if ($objValidation->fails()) {
				$errors = $objValidation->errors();
                return response()->json($errors, 422);
                } else {
						 $user = User::where('email',$request->email)->first();
						
						 if(count($user)!=0){
							 $pass = $this->randomPassword();
							  $user->password = Hash::make($pass);
							  //echo Hash::make("123456");exit;
							  $user->save();
							 Mail::send('emails.password_reset', ['user' => $user,'pass'=>$pass], function ($message) use ($user) {
								//$message->from($user->email, 'TFS');

								$message->to($user->email, $user->username)->subject('Your Account Password!');
							});
							return Response::json(['message' => 'We have e-mailed your reset password ', 'msg_status' => 'valid','durl'=>URL::to('/login')]);
						 }
						 else{
							 return Response::json(['message' => 'Invalid Credential', 'msg_status' => 'invalid']);
						 }
				}
	}
	
	//postResetPassword
	public function postResetPassword(Request $request){
		$objValidation = Validator::make($request->all(), [
                    'npassword' => 'required|min:12',
                    'cpassword' => 'required|min:12|same:npassword',
              ]);
            if ($objValidation->fails()) {
				$errors = $objValidation->errors();
                return response()->json($errors, 422);
                } else {
					$user = User::find(1);
					$user->password = Hash::make($request->npassword);
							  //echo Hash::make("123456");exit;
					$user->save();
					return Response::json(['message' => 'your password is reset', 'msg_status' => 'valid']);
				}
	}
	
	/*public function registerFranchisee(){
		return view('admin.register.index');
	}*/
	
	public function registerFranchiseeSave(Request $request){
		
		$objValidation = Validator::make($request->all(), [
				'fullname' => 'required',
				'address' => 'required', 
				'mobile' => 'required', 
				'email' => 'required|unique:user,email|', 
				'username' => 'required|unique:user,username|max:25', 
				'password' => 'required', 
				'confirm_password' => 'required|same:password',
				'profile_image' => 'required',				
				'role' => 'required',			
				'accountName' => 'required',
				'accountNumber' => 'required|min:16', 
				'bankName' => 'required', 
				'bankIFSC' => 'required', 
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
			
			
			$objSave = new User;				
			$objSave->name = $request->fullname;
			$objSave->address = $request->address;
			$objSave->mobile = $request->mobile;
			$objSave->email = $request->email;
			$objSave->username = $request->username;
			$objSave->password = Hash::make($request->password) ;
			$objSave->role_id = $request->role;
			$objSave->franchisee_code = "FRN-". DB::table('user')->max('id');
			$objSave->account_name = $request->accountName;
			$objSave->account_number = $request->accountNumber;
			$objSave->bank_name = $request->bankName;
			$objSave->ifsc_code = $request->bankIFSC;
			
			if(isset($fileNameFullPath)){
				$objSave->profile_image = $fileNameFullPath;		
			}			
			
			$objSave->created_date =  Carbon::now();			
			$objSave->save();
			
			return Response::json(['message' => 'Franchisee registered Please contact admin for approval']);		
		}
	}
}

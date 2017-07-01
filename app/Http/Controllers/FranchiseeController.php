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
use Session;
use Hash;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;
class FranchiseeController extends Controller {
     
   
   public function __construct() {
        $this->middleware('auth');
    }
	
	//Display All Users
    public function index() { 
		$usersLists = Users::where('role_id','=',env('FRANCHISEE'))->where('isAdmin','!=', env('ISADMIN'))->where('isDeleted','=', env('NOTDELETED'))->get();
	
		return view('admin.user.index',compact('usersLists'));
    }
	
	
	

    
	
}

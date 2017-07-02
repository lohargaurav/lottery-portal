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

class CustomerController extends Controller {
    private $loggedUser;
   
	public function __construct() {
        $this->middleware('auth');
		$this->loggedUser = Auth::user()->id;
    }
	
	//Display All Users
    public function index() { 
		$usersLists = Users::select('user.id', 'user.name', 'user.email', 'user.mobile', 'user.address','user.approved_by_admin', 'user.approved_by_franchisee', 'user.isDeleted', 'user_credits.points' )->join('franchisee_customer_map','franchisee_customer_map.customer_id','=','user.id')
		->join('user_credits','user_credits.user_id','=','user.id')
		->where('franchisee_customer_map.franchisee_id', $this->loggedUser)->where('user.role_id','=',env('USER'))->where('user.isAdmin','!=', env('ISADMIN'))->where('user.isDeleted','=', env('NOTDELETED'))->orderBy('user.name', 'asc')->get();
	
		return view('admin.user.index',compact('usersLists'));
    }
	
	
	

    
	
}

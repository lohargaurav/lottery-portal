<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Session;
use Helper;
class HomeController extends Controller {

    function randomOtp() {
        $alphabet = "123456789";
        $otp = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 5; $i++) {
            $n = rand(0, $alphaLength);
            $otp[] = $alphabet[$n];
        }
        return $otp;
    }

    function smsportalbody($api_url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        $error = curl_error($ch);
        // $output contains the output string
        curl_close($ch);
        return true;
    }
    public function __construct() {
        // $this->middleware('auth');
    }    
    public function index() {
        return view('home');     
    }
   
    public function getUserLogin() {
        return view('login');
    } 
    public function UserPostLogin(UserLoginRequest $request) {
        $user = array(
            'username' => $request->username,
            'password' => Helper::encode($request->password)
        );
        if (Auth::attempt($user)) {
            return Response::json(['msg_status' => 'valid']);            
        } else {
            return Response::json(['modal_title' => 'Some thing went wrong', 'message' => 'Invalid Credential', 'msg_status' => 'invalid']);
        }
    }
    public function logout() {
        Session::flush(); //clears out all the exisiting sessions
            return redirect::to('/');        
    }

}

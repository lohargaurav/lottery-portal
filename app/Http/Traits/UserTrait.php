<?php
namespace App\Http\Traits;

use App\User;
use App\Users;
use App\User_Profile;
use DB;
use Helper;
trait UserTrait {
	//Get users role wise
    public function UserAll($role_id) {

        
      return  Users::Join('user_profile','user_profile.user_id','=','user.id')
								->where('user.role',$role_id)->where('user.isDeleted','<>',env('DELETED'))->get();

    }
	
	//delete user role and id wise
	public function UserDelete($role_id,$id) {

		return DB::table('user')->where('role',$role_id)->where('id',$id)
				  ->update(['isDeleted'=>env('DELETED')]);

	}
	
	//view user profile
	public function UserViewProfile($id) {
		
		return Users::Join('user_profile','user_profile.user_id','=','user.id')
								->Join('role_master','role_master.id','=','user.role')
								->where('user.id',Helper::decode($id))->where('user.isDeleted','<>',env('DELETED'))->first();
		
	}
}
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
use App\Franchisee_Customer_Map;
use App\Betting_Winner_Item;
use App\Master_Items;
use App\Betting_Current;
use App\Betting_History;
use App\Time_instance;
use Session;
use Hash;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;
use Helper;
use DB;

class UserController extends Controller {
    
	protected $username = 'username';
	
	public function __construct() {
        //$this->middleware('auth');	
    }
	
	public function getToken(){
		
		return Response::json(['status'=>200,'data' => csrf_token()]);
	}
	
	public function franchiseeList(){
		
		$usersLists = Users::select('id', 'name', 'franchisee_code')->where('role_id','=',env('FRANCHISEE'))->where('isAdmin','!=', env('ISADMIN'))->where('isDeleted','=', env('NOTDELETED'))->orderBy('name', 'asc')->get();
		
		if(isset($usersLists )){
			
			return response()->json(array("status"=>200, "message"=> "Records found", "data"=>$usersLists), 200);
		}else{
			return response()->json(array("status"=>400, "message"=> "NO records found"), 422);
		}
		
	}
	
	public function registerCustomer(Request $request){
		
		$objValidation = Validator::make($request->all(), [
				'fullname' => 'required',
				'address' => 'required', 
				'mobile' => 'required', 
				'email' => 'required|unique:user,email|', 
				'username' => 'required|unique:user,username|max:25', 
				'password' => 'required', 
				'confirm_password' => 'required|same:password',
				'profile_image' => 'required',							
				'accountName' => 'required',
				'accountNumber' => 'required|min:16', 
				'bankName' => 'required', 
				'bankIFSC' => 'required|alpha_num', 
				'franchisee_id'=> 'required|numeric'
            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();			
			return Response::json(['status'=>400,'message' => $errors]);	
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
			$objSave->password = Hash::make($request->password);
			$objSave->role_id = env('USER');
			$objSave->account_name = $request->accountName;
			$objSave->account_number = $request->accountNumber;
			$objSave->bank_name = $request->bankName;
			$objSave->ifsc_code = $request->bankIFSC;
			
			if(isset($fileNameFullPath)){
				$objSave->profile_image = $fileNameFullPath;		
			}			
			
			$objSave->created_date =  Carbon::now();			
			$objSave->save();
			
			//New record in user credits table
			$objSaveCredits = new User_Credits;
			$objSaveCredits->user_id = $objSave->id;
			$objSaveCredits->points = 0;
			$objSaveCredits->created_date =  Carbon::now();			
			$objSaveCredits->save();
			
			$objSavemap = new Franchisee_Customer_Map;
			$objSavemap->franchisee_id = $request->franchisee_id;
			$objSavemap->customer_id = $objSave->id;
			$objSavemap->created_date =  Carbon::now();
			$objSavemap->save();
			
			
			return Response::json(['status'=>200,'message' => 'User registered successfully. Please contact selected franchisee for approval']);		
		}
	}
	
	public function loginCustomer(UserLoginRequest $request){
		
		$user = array(
            'username' => $request->username,
            'password' => $request->password
        );
		
        $ObjUser = User::where('username', '=', $request->username)
							->first();

		if (count($ObjUser) != 0) { 
			
			if (Auth::attempt($user)) {
				
				if($ObjUser->approved_by_franchisee == env('ACTIVE'))
				{
					$objSaveTime = Time_instance::find(1);		
					$timeSecond = strtotime(Carbon::now());
					$timeFirst = strtotime($objSaveTime->current_instance);
					$differenceInSeconds = $timeSecond - $timeFirst;
					
					if($differenceInSeconds>90){
						$objSaveTime->current_instance = Carbon::now();	
						$objSaveTime->updated_by =  Carbon::now();			
						$objSaveTime->save();
						$differenceInSeconds = 1;
					}		
					
					$data = array(
						"currentSystemTime"=> $differenceInSeconds,
						"recentWinningItems" => $this->recentWinningItems(),
						"points"=> $this->userPoints($ObjUser->id),
						"userData"=> array(
							"user_id"=> $ObjUser->id,
							"name"=> $ObjUser->name,
							"address"=> $ObjUser->address,
							"mobile"=> $ObjUser->mobile,
							"email"=> $ObjUser->email,
							"profile_image"=> $ObjUser->profile_image
						)
					);
					
					Session::flush(); //clears out all the exisiting sessions
					
					return Response::json(['status'=>200,'message' => 'User logged successfully!', 'data'=> $data]);
				}else{
					return Response::json(['status'=>400,'message' => 'User is not activated. Please contact to franchisee']);
				}
			}else{
				return Response::json(['status'=>400,'message' => 'Invalid credentials. Please try later']);
			}
		}else{
			return Response::json(['status'=>400,'message' => 'Invalid credentials. Please try later']);
		}
				
	}
	
	public function recentWinningItems(){
		
		$data =  Master_Items::select('master_items.item_name')
					->join('betting_winner_item','betting_winner_item.item_id','=','master_items.id')
					->orderBy('betting_winner_item.id', 'desc')
					->limit(5)
					->get();
		return $data;
	}
	
	public function userPoints($id){
		$data = User_Credits::where('user_id','=',$id)->first();
		return $data->points;
	}
	
	public function getCurrentSystemTime(){		
						
		$objSaveTime = Time_instance::find(1);		
		$timeSecond = strtotime(Carbon::now());
		$timeFirst = strtotime($objSaveTime->current_instance);
		$differenceInSeconds = $timeSecond - $timeFirst;
		
		if($differenceInSeconds>90){
			$objSaveTime->current_instance = Carbon::now();	
			$objSaveTime->updated_by =  Carbon::now();			
			$objSaveTime->save();
			$differenceInSeconds = 1;
		}		
					
		return Response::json(['status'=>200,'currentSystemTime' => $differenceInSeconds]);
	}
	
	public function postBattingItems(request $request){
		
		$objValidation = Validator::make($request->all(), [
			'user_id' => 'required',
			'batting_items' => 'required', 
		]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();			
			return Response::json(['status'=>400,'message' => $errors]);	
		} else {
			$batting_items = $request->batting_items;
		
			if(count($batting_items)!==0)
			{  
				$sum =0;
				foreach($batting_items as $item => $point)
				{
					$sum = $sum + $point;
				}
				
				if($sum > $this->userPoints($request->user_id))
				{
					return Response::json(['status'=>400,'message' => "Enought credits are not available. Please contact franchisee"]);	
				}
		
				foreach($batting_items as $item => $point)
				{
					//Add betting to current betting table
					$objSaveBet =  new Betting_Current;
					$objSaveBet->user_id = $request->user_id;
					$objSaveBet->item_id = $this->getItemId($item);
					$objSaveBet->points = $point;
					$objSaveBet->created_date = Carbon::now();
					$objSaveBet->save();
					
					//Debit points from user balance
					$objSave = new User_Credits_History;
					$objSave->user_id = $request->user_id;
					$objSave->points_amt = $point;
					$objSave->type = env('DEBIT');
					$objSave->transaction_ref = "BTRN-". DB::table('user_credits_history')->max('id');
					$objSave->transaction_desc = "Points reduced as applied betting on $item";
					$objSave->created_date =  Carbon::now();	
					$objSave->save();
					
					//Reduce points from customer account
					$objSaveCredits = User_Credits::find($request->user_id);
					$objSaveCredits->points = $objSaveCredits->points - $point;
					$objSaveCredits->update_date =  Carbon::now();			
					$objSaveCredits->save();
				}
			}
			
			$objSaveTime = Time_instance::find(1);		
			$timeSecond = strtotime(Carbon::now());
			$timeFirst = strtotime($objSaveTime->current_instance);
			$differenceInSeconds = $timeSecond - $timeFirst;
			
			if($differenceInSeconds>90){
				$objSaveTime->current_instance = Carbon::now();	
				$objSaveTime->updated_by =  Carbon::now();			
				$objSaveTime->save();
				$differenceInSeconds = 1;
			}	
			
			return Response::json(["status"=>200, 
						"message" => "Betting locked successfully.",
						"currentSystemTime"=> $differenceInSeconds,
						"recentWinningItems" => $this->recentWinningItems(),
						"points"=> $this->userPoints($request->user_id)
					]);	
		}
	}
	
	public function getItemId($item){
		$data = Master_Items::where('item_name','=', $item)->first();
		return $data->id;
	}
	
	public function getItemName($item){
		$data = Master_Items::where('id','=', $item)->first();
		return $data->item_name;
	}
	
	public function bettingOver(request $request){

		$objValidation = Validator::make($request->all(), [
			'user_id' => 'required',
		]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();			
			return Response::json(['status'=>400,'message' => $errors]);	
		} else {
			
			$objSaveTime = Time_instance::find(1);		
			$timeSecond = strtotime(Carbon::now());
			$timeFirst = strtotime($objSaveTime->current_instance);
			$differenceInSeconds = $timeSecond - $timeFirst;
			
			if($differenceInSeconds>90){
				$objSaveTime->current_instance = Carbon::now();	
				$objSaveTime->updated_by =  Carbon::now();			
				$objSaveTime->save();
				$differenceInSeconds = 1;
			}	
			
			return Response::json(["status"=>200, 
						"message" => "Betting completed successfully.",
						"currentSystemTime"=> $differenceInSeconds,
						"recentWinningItems" => $this->recentWinningItems(),
						"points"=> $this->userPoints($request->user_id)
					]);	
		}
	}
	
	public function requestCredits(request $request){
		
		$objValidation = Validator::make($request->all(), [
				'user_id' => 'required|numeric',
				'credit_points' => 'required|numeric',
            ]);
			
		if ($objValidation->fails()) {
			$errors = $objValidation->errors();
			
			return Response::json(["status"=>400, 
							"message" => $errors,
					]);	
					
		} else {
			
			$checkRecordExists = User::where('id','=',$request->user_id)
				->where('isAdmin','!=', env('ISADMIN'))
				->where('role_id','=',env('USER'))
				->where('approved_by_franchisee','=', env('APROVED'))
				->where('isDeleted','=', env('NOTDELETED'))
				->count();
					
			if($checkRecordExists==1){
				//Debit points from user balance
				$objSave = new User_Credits_Request;
				$objSave->user_id = $request->user_id;
				$objSave->requested_points = $request->credit_points;			
				$objSave->created_date =  Carbon::now();	
				$objSave->save();
				
				return Response::json(["status"=>200, 
							"message" => 'Credit points request submitted successfully',
					]);
			}else{
				return Response::json(["status"=>400, 
							"message" => 'Provided Customer not exists in system',
					]);
			}
			
		}
	}
	
	public function dashboardContent(){
		
		$collection = array();
		$collection['recentWinner'] = $this->recentWinningItems();
		 
		$currentCollection = Betting_Current::select(DB::raw('(SELECT `item_name` FROM `jos_master_items` WHERE `id`= `jos_betting_current`.`item_id` AND `status`='.env('ACTIVE').') as item'),  DB::raw('IFNULL(SUM(points),0) as total_points'))
			->groupBy('item_id')
			->get();
			
		$collection['currentCollection'] = $currentCollection;
		 
		if(Auth::user()->isAdmin){
			$topListing = Users::select('user.name', 'user.mobile', 'user.address', DB::raw('(SELECT IFNULL(SUM(`bh`.`points`),0) FROM `jos_betting_history` as `bh`
			INNER JOIN  `jos_franchisee_customer_map` AS `fcm` ON `bh`.`user_id`=`fcm`.`customer_id` 
			WHERE `fcm`.`franchisee_id` = `jos_user`.`id`) AS total_points')) 
			->where('user.role_id','=',env('FRANCHISEE'))
			->where('user.isAdmin','!=', env('ISADMIN'))
			->where('user.isDeleted','=', env('NOTDELETED'))
			->orderBy('total_points', 'desc')
			->orderBy('user.name', 'asc')
			->limit(10)		
			->get();
			
			
		}else{
			$topListing = Users::select('user.name', 'user.mobile', 'user.address', DB::raw('(SELECT IFNULL(SUM(`bh`.`points`),0) FROM `jos_betting_history` as `bh`
			WHERE `bh`.`user_id` = `jos_user`.`id`) AS total_points')) 
			->join('franchisee_customer_map', 'franchisee_customer_map.customer_id','=','user.id')
			
			->where('franchisee_customer_map.franchisee_id','=',Auth::user()->id)
			->where('user.role_id','=',env('USER'))
			->where('user.isAdmin','!=', env('ISADMIN'))
			->where('user.isDeleted','=', env('NOTDELETED'))
			->orderBy('total_points', 'desc')
			->orderBy('user.name', 'asc')
			->limit(10)		
			->get();
		}
		$collection['topListing'] = $topListing;
		return Response::json(["status"=>200, 
							"message" => 'Record found',
							"data"=> $collection
					]);
	}
	
	public function cronBettingWinner(){
		
		$objSaveTime = Time_instance::find(1);		
		$timeSecond = strtotime(Carbon::now());
		$timeFirst = strtotime($objSaveTime->current_instance);
		$differenceInSeconds = $timeSecond - $timeFirst;
		
		if($differenceInSeconds>90){
			
			$objSaveTime->current_instance = Carbon::now();	
			$objSaveTime->updated_by =  Carbon::now();			
			$objSaveTime->save();
			$differenceInSeconds = 1;
		
			//Define winner
			$getTotalBettingAmount = Betting_Current::select(DB::raw('SUM(points) as total_points'))
					->limit(1)
					->first();
			
			$searchValue  = $getTotalBettingAmount->total_points*80/100;
			
			$bets = Betting_Current::select('item_id', DB::raw('SUM(points) as total_points'))
					->groupBy('item_id')
					->orderBy('total_points', 'asc')
					->get();
					
			$closest = null;
			$closestItem = null;
		    foreach ($bets as $item) {
				
				if($item->item_id==13){
					$returnValue = $item->total_points * 22;
					if ($closest === null || abs($searchValue - $closest) > abs($returnValue - $searchValue)) {
						$closest = $returnValue;
						$closestItem = $item->item_id;
					}
				}else{
					$returnValue = $item->total_points * 11;
					if ($closest === null || abs($searchValue - $closest) > abs($returnValue - $searchValue)) {
						$closest = $returnValue;
						$closestItem = $item->item_id;
					}
				}
		    }
		   
			if($closestItem==13){
				$closest =  $closest/22;
			}else{
				$closest =  $closest/11;
			}
			
			
			$bet = Betting_Current::select('item_id', DB::raw('SUM(points) as total_points'))
					->where('item_id','=', $closestItem)
					->groupBy('item_id')
					->limit(1)
					->first();
					
			
			$max = DB::table('betting_winner_item')->max('id');
			
			$max = (empty($max))?0:$max;
			
			$checkRecordExists = Betting_Winner_Item::where('betSlot','=', "BTTSLT-$max")
					->where('item_id','=', $bet->item_id )
					->count();

			if($checkRecordExists==0){
				$saveObj = new Betting_Winner_Item;
				$saveObj->item_id = $bet->item_id;
				$saveObj->created_date = Carbon::now();
				$saveObj->betSlot = "BTTSLT-$max";			
				$saveObj->save();
			}
			
			$getCurrentBettings = Betting_Current::select('user_id','item_id','points')
						->get();
			$collection = array();		
				
			foreach($getCurrentBettings as $getCurrentBetting)		
			{
				
				$insert = array(
					'user_id'=>  $getCurrentBetting->user_id,
					'item'=>  $this->getItemName($getCurrentBetting->item_id),
					'item_id'=>  $getCurrentBetting->item_id,
					'points'=>  $getCurrentBetting->points,
					'betSlot'=> "BTTSLT-$max",
					'created_date'=> Carbon::now(),
				);
				array_push($collection, $insert);
			
			}
			if(!empty($collection)){
				
				DB::table('betting_history')->insert($collection);
			}
			
			//Add profit to franchisee//Credit points to user
			$franchiseeBettings = Betting_Current::select('franchisee_customer_map.franchisee_id', DB::raw('SUM(points) as total_points'))
						->join('franchisee_customer_map','franchisee_customer_map.customer_id','=','betting_current.user_id')
						->groupBy('franchisee_customer_map.franchisee_id')
						->get();
						
			foreach($franchiseeBettings as $franchiseeBetting){
				$objSaveUser = new User_Credits_History;
				$objSaveUser->user_id = $franchiseeBetting->franchisee_id;				
				$objSaveUser->points_amt = $franchiseeBetting->total_points ;				
				$objSaveUser->type = env('CREDIT');
				$objSaveUser->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
				$objSaveUser->transaction_desc = "Total bettings points transfered for BTTSLT-$max";
				$objSaveUser->created_date =  Carbon::now();	
				$objSaveUser->save();
				
				$objSaveCreditsUser = User_Credits::find($franchiseeBetting->franchisee_id);
				$objSaveCreditsUser->points = $objSaveCreditsUser->points + $franchiseeBetting->total_points ;			
				$objSaveCreditsUser->update_date =  Carbon::now();			
				$objSaveCreditsUser->save();
			}
			
			
			//Add credits to winner users
			$winnerUsers = Betting_Current::select('user_id','item_id','points')
						->where('item_id','=',$bet->item_id)
						->get();

			foreach($winnerUsers as $winnerUser){				
				
				$pointsReciever = User::find($winnerUser->user_id);
				
				$franchisee = Franchisee_Customer_Map::where('customer_id','=',$winnerUser->user_id)->first();
				
				$pointsTransferer = User::find($franchisee->franchisee_id);
			
				if($winnerUser->item_id==13){
					$credit_points = $winnerUser->points*22;
				}else{
					$credit_points = $winnerUser->points*11;
				}
				
				//Debit points from user balance
				$objSave = new User_Credits_History;
				$objSave->user_id = $pointsTransferer->id;
				$objSave->points_amt = $credit_points;
				$objSave->type = env('DEBIT');
				$objSave->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
				$objSave->transaction_desc = "Winning Points transfered to ".$pointsReciever->name;
				$objSave->created_date =  Carbon::now();	
				$objSave->save();
				
				$objSaveCredits = User_Credits::find($pointsTransferer->id);
				$objSaveCredits->points = $objSaveCredits->points - $credit_points;
				$objSaveCredits->update_date =  Carbon::now();			
				$objSaveCredits->save();
				
			
				//Credit points to user
				$objSaveUser = new User_Credits_History;
				$objSaveUser->user_id = $winnerUser->user_id;				
				$objSaveUser->points_amt = $credit_points;				
				$objSaveUser->type = env('CREDIT');
				$objSaveUser->transaction_ref = "TRN-". DB::table('user_credits_history')->max('id');
				$objSaveUser->transaction_desc = "Winning points transfered by Franchisee ".$pointsTransferer->name;
				$objSaveUser->created_date =  Carbon::now();	
				$objSaveUser->save();
				
				$objSaveCreditsUser = User_Credits::find($winnerUser->user_id);
				$objSaveCreditsUser->points = $objSaveCreditsUser->points + $credit_points;			
				$objSaveCreditsUser->update_date =  Carbon::now();			
				$objSaveCreditsUser->save();				
			}
			
			
			Betting_Current::truncate();
		
			return Response::json(['status'=>200,'message' => "Betting is Completed"]);
		}else{
			return Response::json(['status'=>400,'message' => "Betting is not Completed"]);
		}
			
	}
}
	
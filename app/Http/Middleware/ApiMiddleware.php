<?php namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Routing\Middleware;
use App\User;

class ApiMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$payload = $request->header('X-Auth-Token');
		if($payload == ""){
			$response = Response::json([
				'error' => true,
				'message' => 'Not authenticated',
				'code' => 401],
				401 );
			$response->header('Content-Type', 'application/json');
			return $response;
		}
		$users = User::whereRaw("api_key = '" . $payload . "'")
						->take(1)
						->get();

		$response = array();
		if ($users->count() > 0) {
			$objUser = $users[0];
			Auth::loginUsingId( $objUser->id );
			return $next($request);
		} else {
			$response = Response::json([
				'error' => true,
				'message' => 'Not authenticated',
				'code' => 401],
				401 );
			$response->header('Content-Type', 'application/json');
			return $response;
		}
	}
}

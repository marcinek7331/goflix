<?php
namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Closure;

class Authorization {
  public function handle($request, Closure $next) {
      if($request->bearerToken() == null || !JWTAuth::parseToken()->authenticate()) {
        // return $this->unauthorized('Please, attach a Bearer Token to your request');
        return abort(401);
      }
      else {
        return $next($request);
      }
  }

  private function unauthorized($message = null){
      return response()->json([
          'message' => $message ? $message : 'You are unauthorized to access this resource',
          'success' => false
      ], 401);
  }

}



 ?>

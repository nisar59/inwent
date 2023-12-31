<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    function __construct()
    {
        auth()->setDefaultDriver('user');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($req, Closure $next)
    {
        try
        {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user){
                return response()->json(['status' => 'Authorization faild, Login again'], 410);
            }
        }
        catch(Exception $e){

            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException)
                {
                return response()->json(['status' => 'Token is Invalid'], 401);
                }
            else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException)
                {
                return response()->json(['status' => 'Token is Expired'], 401);
                }
            else
                {
                    return response()->json(['status' => 'Authorization Token not found'], 401);
                }
        }
        return $next($req);
    }
}

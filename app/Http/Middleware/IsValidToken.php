<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Jerry\JWT\JWT;
use Symfony\Component\HttpFoundation\Response;

class IsValidToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $req, Closure $next): Response
    {
        try {
            $decodeToken = JWT::decode($req->query("token"));
            if (!$decodeToken["userId"]) {
                return response()->json(["status"=>"IS NOT OK", "msg"=>"Please give valid token"]);
            }
            $user = User::find($decodeToken["userId"]);
            if(!$user){return response()->json(["status"=>"IS NOT OK", "msg"=>"Please give valid token"]);}

            if (Carbon::now()->timestamp > $decodeToken["expiration"]) {
                return response()->json(["status"=>"IS NOT OK", "msg"=>"Token is expired"]);
            }
            $req->attributes->add(["user"=>$user]);

            return $next($req);
        } catch (\Throwable $th) {
            throw $th;
        }        
    }
}

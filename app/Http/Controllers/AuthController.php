<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Jerry\JWT\JWT;

class AuthController extends Controller
{
    public function register(Request $req){
        try {
            $user = User::where("email", $req->input("email"))->first();
            if($user){return response()->json("Please give unsaved user because already exists");}
            
            $newUser = new User();
            $newUser->email = $req->input("email");
            $newUser->name = $req->input("name");
            $newUser->password = Hash::make($req->input("password"));
            $newUser->save();

            return response()->json(["status"=>"OK", "msg"=>"User is saved", "name"=>$newUser->name]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function login(Request $req){
        try {
            $user = User::where("email", $req->input("email"))->first();
            if(!$user){return response()->json("Please give saved mail");}
            
            if (!Hash::check($req->input("password"), $user->password)) {
                return response()->json(["status"=>"IS NOT OK", "msg"=>"Wrong Password"]);
            }

            $token = JWT::encode([
                "userId"=>$user->id,
                "expiration"=>Carbon::now()->addHours(4)->timestamp
            ]);

            $user->lastLoginToken = $token;
            $user->save();

            return response()->json(["status"=>"OK", "token"=>$token]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}

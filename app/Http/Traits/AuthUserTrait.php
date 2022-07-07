<?php 

namespace App\Http\Traits;
use Illuminate\Support\Facades\Auth;
trait AuthUserTrait
{
    private function getAuthUser(){
        try{
            return auth()->userOrFail();
        }catch(\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e){
            response()->json(['message'=>'Not authenticated, you have to login first!'])->send();
            exit;
        }
    }

    private function checkOwnership($owner){
        $user = $this->getAuthUser();
        if($user->id != $owner){
            response()->json(['message'=>'Not Authorized!'],403)->send();
            exit;
        }
    }
}
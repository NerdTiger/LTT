<?php

namespace App\Helper;


//use User_type_authorize;

class UserAuthorizeHelper
{
    static public function getUserAuthorizebyUserID($user_id){
        
        //$userTypeAuthorize = \App\UserTypeAuthorize::find(1);
        $userTypeAuthorize = \App\User_type_authorize::where('user_id', '=', $user_id)->first();
        if(empty($userTypeAuthorize ) )return null;
        else{ 
        $uts=UsertypeHelper::number2Usertypes($userTypeAuthorize->user_type_id);   
        $result=\App\User_type::whereIn('user_type_id', $uts)->get(); 
        return $result;
        
        }

    }
}
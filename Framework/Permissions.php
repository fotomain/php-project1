<?php

namespace Framework;

class Permissions {

    public static function sessionOfThisUser($user_id) {

//        echo Session::get('user')['id'];
//        inspect(Session::get('user')['id']);
//        echo $user_id;
//        inspectAndDie($user_id);

        if(Session::get('user')['id'] === $user_id){
            return true;
        }

        return false;

    }
    public static function updateJob($user_id) {
        return self::sessionOfThisUser($user_id);
    }
    public static function deleteJob($user_id) {
        return self::sessionOfThisUser($user_id);
    }

}
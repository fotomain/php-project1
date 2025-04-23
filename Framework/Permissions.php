<?php

namespace Framework;

class Permissions {

    public static function sessionOfThisUser($user_id) {

        if(Session::get('user')['id'] === $user_id){
            return true;
        }

        return false;

    }
    public static function updateJob($user_id) {
        $result = self::sessionOfThisUser($user_id);
        return $result;
    }
    public static function deleteJob($user_id) {
        return self::sessionOfThisUser($user_id);
    }

}
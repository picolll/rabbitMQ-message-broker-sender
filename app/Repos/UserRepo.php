<?php

class UserRepo
{

    public static $users = array();

    /**
     * @return mixed
     */
    public static function getUsers()
    {
        return self::$users;
    }

    public static function createUser(User $user)
    {
        $users = self::$users;
        $users[] = $user;
        self::$users = $users;
    }

    public static function clearUsers(){
        self::$users = array();
    }


}

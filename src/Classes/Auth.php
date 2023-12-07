<?php

namespace Web\Classes;

use Web\Entities\UserEntity;

class Auth
{

    public static function loginUser($user)
    {
        Session::set('user', $user->toArray());
    }

    public static function logoutUser()
    {
        Session::forget('user');
        redirect('index.php', ['action' => 'login']);
    }

    public static function getLoggedInUser()
    {
        return new UserEntity(Session::get('user'));
    }

    public static function isAuthenticated()
    {
        return Session::has('user') ? true : false;
    }

    public static function checkAuthenticated()
    {
        if (!self::isAuthenticated())
            redirect('index.php', ['action' => 'login']);
    }
}

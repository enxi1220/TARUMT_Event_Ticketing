<?php

require_once 'Subject.php';

session_start();
class LoginUser extends Subject{
    public function setLoginUser($username)
    {
        $_SESSION['username'] = $username;
        $this->notify();
    }

    public static function getLoginUser()
    {
        if(LoginUser::isLoggedIn()){
            return $_SESSION['username'];
        }else{
            return "";
        }
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }


}
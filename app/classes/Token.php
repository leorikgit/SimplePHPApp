<?php

class Token
{
    public static function generate($length){
        return bin2hex(random_bytes($length));
    }
    public static function tokenForm(){
        return Session::put(Config::get('session/token_name'), self::generate(128));
    }
    public static function check($token)
    {
        $token_name = Config::get('session/token_name');

       if(Session::exist($token_name) && Session::get($token_name) === $token){
           Session::delete($token_name);
           return true;
       }
       return false;
    }
}
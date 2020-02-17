<?php

class Input
{
    public static function exist($method = 'POST'){
        switch (strtoupper($method)){
            case 'POST':
                return ($_SERVER['REQUEST_METHOD'] === 'POST')? true : false;
                break;
            case 'GET':
                return ($_SERVER['REQUEST_METHOD'] === 'GET')? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($item){
        if(isset($_POST[$item])){
            return $_POST[$item];
        }elseif(isset($_GET[$item])){
            return $_GET[$item];
        }
        return '';
    }
}
<?php

class Config
{
    public static function get($path = null){
        try {
            if($path){
                $config = $GLOBALS['config'];
                $path = explode('/', $path);

                if(count($path) > 0){
                    foreach ($path as $bit){

                        if(isset($config[$bit])){
                            $config = $config[$bit];
                        }else{
                            throw new Exception();
                        }
                    }
                    return $config;
                }
                return $config[$path[0]];
            }elsE{
                throw new Exception();
            }
        }catch(Exception $e){
            die('Config class error: Wrong params');
        }
    }
}
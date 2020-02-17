<?php


class Connection
{
    private static $_instance;
    private $_PDO;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=".Config::get('mysql/host').";dbname=".Config::get('mysql/db')."";
            $user = Config::get('mysql/username');
            $passwd = Config::get('mysql/password');

            $this->_PDO = new PDO($dsn, $user, $passwd);
            $this->_PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        } catch (PDOException $e) {
            die( 'Connection failed: ' . $e->getMessage());
        }
    }

    public static function get(){
        if(!isset(self::$_instance)){
            self::$_instance = new Connection();
        }
        return self::$_instance;
    }
    public function getConnection(){
        return $this->_PDO;
    }
}
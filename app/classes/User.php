<?php

class User extends DB
{
    protected static $table_name = 'users';
    private $_data,
            $_session_name,
            $_is_loggedIn = false;

    public function __construct($user = null)
    {
        parent::__construct();
        $this->_session_name = Config::get('session/session_name');

        if(!$user){
            if(Session::exist($this->_session_name)){
                $userId = Session::get($this->_session_name);
                if($this->find($userId)){
                    $this->_is_loggedIn = true;
                }
            }
        }else{
            $this->find($user);
        }

    }

    public function getAllUsers(){
        return $this->query('SELECT * FROM users');
    }
    public function getUserById($id){
        return $this->query('SELECT * FROM users WHERE id=?', array($id));
    }
    public function find($param = null){
        if($param){
            $field = (is_numeric($param)) ? "id" : "email";

            $data = $this->query("SELECT * FROM ".static::$table_name." WHERE ".$field."=? ", [$param]);

            if($data->count()){
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    public function login($password = null, $email = null){

        $user = $this->find($email);
        if($user){
            Session::put($this->_session_name, $this->_data->id);
            return true;
        }else{
            return false;
        }
    }
    public function data(){
        return $this->_data;
    }
    public function register($fields){
        $fields['password'] = Hash::generate($fields['password']);
        $fields += ['group_id' => '1'];
        if(!$this->insert($fields)){
            throw new Exception('Something went wrong.');
        }

    }
    public function update($fields, $id){
        if(!$this->put($fields, $id)){
            throw new Exception('Something went wrong.');
        }

    }
    public function delete($id){
        if(!$this->destroy($id)){
            throw new Exception('Something went wrong.');
        }

    }
    public function isLoggedIn(){
        return $this->_is_loggedIn;

    }

    public function logout(){
        if(Session::exist($this->_session_name)){
            Session::delete($this->_session_name);
        }
        $this->_is_loggedIn = false;
    }
    public function hasPermission($key){
        if($this->isLoggedIn()){

            $group = $this->query("SELECT * FROM `groups` WHERE id=".$this->data()->group_id." ");

            if($group->count()){
                $permissions = json_decode($group->first()->permissions, true);
                if($permissions[$key] == true){
                    return true;
                }

            }
        }
        return false;
    }

}
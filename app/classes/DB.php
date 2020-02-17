<?php


class DB
{
    private  $_db;
    private
            $_error = false,
            $_count = 0,
            $_query,
            $_result;

    public function __construct()
    {
        $this->_db = Connection::get();
    }

    public  function query($sql, $params = array()){
        $this->_error = false;

        if($this->_query = $this->_db->getConnection()->prepare($sql)){
            if(count($params)){
                $counter = 1;
                foreach ($params as $param){
                    $this->_query->bindValue($counter, $param);
                    $counter++;
                }
            }
            if($this->_query->execute()){
                $queryFunction = explode(" ",$sql);
                if($queryFunction[0] == "SELECT"){
                    $this->_result= $this->_query->fetchAll(PDO::FETCH_OBJ);
                }


                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
            return $this;
        }
    }
    public function insert($fields){
       if(count($fields)){
           $keys = implode(',',array_keys($fields));
           $counter = 1;
           $values = "";
           foreach ($fields as $field){
               $values .='?';
               if($counter < count($fields)){
                   $values .= ',';
                   $counter++;
               }
           }
           $sql = "INSERT INTO ".static::$table_name." (".$keys.") VALUES ({$values})";
           if(!$this->query($sql, $fields)->getError()){
               return true;
           }
       }
       return false;
    }

    public function put($fields, $id){
        if(count($fields)){
            $keys = implode(',',array_keys($fields));
            $counter = 1;
            $set = "";
            foreach ($fields as $name => $value){
                $set .="{$name}=?";
                if($counter < count($fields)){
                    $set .= ',';
                    $counter++;
                }
            }
            $sql = "UPDATE ".static::$table_name." SET ".$set." WHERE id=".$id." ";

            if(!$this->query($sql, $fields)->getError()){
                return true;
            }
        }
        return false;
    }
    public function destroy($id){

        $sql = "DELETE FROM  ".static::$table_name." WHERE id=".$id." ";

            if(!$this->query($sql)->getError()){
                return true;
            }

        return false;
    }

    public function getError(){
        return $this->_error;
//        return $this->_query->errorInfo();
    }
    public function getResult(){
        return $this->_result;
    }
    public function first(){
        return $this->getResult()[0];
    }
    public function count(){
        return $this->_count;
    }

}
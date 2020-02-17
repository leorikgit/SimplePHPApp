<?php

class Validation
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;

    public function __construct()
    {
        $this->_db = Connection::get();
    }
    public function check($source, $items){

        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                $value = trim($source[$item]);

                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is required.");
                }else{
                    switch($rule){
                        case 'min':

                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'match':
                            if($value != $source[$rule_value]){
                                $this->addError("{$item} must match {$rule_value}.");

                            }

                            break;
                        case 'unique':
                            $query = $this->_db->getConnection()->prepare("SELECT * FROM ".$rule_value." WHERE email=?");
                            $query->bindValue(1,$value);
                            $query->execute();

                           if($query->rowCount()){
                               $this->addError("{$item} {$value} already exist.");
                           }
                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed = true;
        }
    }
    public function passed(){
        return $this->_passed;
    }
    public function getErrors(){
        return $this->_errors;
    }
    private function addError($error){
        $this->_errors[] = $error;
    }
}
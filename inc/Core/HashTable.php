<?php
namespace Core;

class HashTable{
    public static function set($key, $value){
        return HashTableClass::getInstance()->set($key, $value);
    }
    public static function get($key){
        return HashTableClass::getInstance()->get($key);
    }
}

class HashTableClass{
    private static $instance = null;
    private $hashTable = [];
    
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set($key, $value){
        if( !is_array($key) && !is_object($key) && !is_null($key)) {
            $this->hashTable[$key] = $value;
            return true;
        }else{
            return false;
        }
    }

    public function get($key){
        if( isset($this->hashTable[$key])){
            return $this->hashTable[$key];
        }else{
            return null;
        }
    }

}
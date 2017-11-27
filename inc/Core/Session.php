<?php
namespace Core;

class Session{
    public static function start(){
        return SessionClass::getInstance()->start();
    }
    public static function close(){
        return SessionClass::getInstance()->close();
    }
    public static function set($key, $value){
        return SessionClass::getInstance()->set($key, $value);
    }
    public static function get($key){
        return SessionClass::getInstance()->get($key);
    }
    public static function del($key){
        return SessionClass::getInstance()->del($key);
    }
    public static function export(){
        return SessionClass::getInstance()->export();
    }
}

class SessionClass{
    private static $instance = null;
    private $started = false;

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function start(){
        if(!$this->started )
            session_start();
        $this->started = true;
        return true;
    }

    public function close(){
        if(!$this->started )
            session_write_close();
        $this->started = false;
        return true;
    }

    public function set($key, $value){
        if(!$this->started )
            $this->throwError('session not started');
        if( !is_array($key) && !is_object($key) && !is_null($key)) {
            $_SESSION[$key] = $value;
            return true;
        }else{
            return false;
        }
    }

    public function get($key){
        if(!$this->started )
            $this->throwError('session not started');
        if( isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return null;
        }
    }

    public function del($key){
        if(!$this->started )
            $this->throwError('session not started');
        if( !is_array($key) && !is_object($key) && !is_null($key)) {
            unset( $_SESSION[$key]);
            return true;
        }else{
            return false;
        }
    }

    public function export(){
        if(!$this->started )
            $this->throwError('session not started');
        return $_SESSION;
    }

    private function throwError($data){
        var_dump($data);
        exit;
    }

}
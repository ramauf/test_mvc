<?php
namespace Core;
class DB{
    public static function begin($transMode = dbClass::TRANS_MODE_REPEATABLE_READ){
        return dbClass::getInstance()->begin($transMode);
    }
    public static function commit(){
        return dbClass::getInstance()->commit();
    }
    public static function rollback(){
        return dbClass::getInstance()->rollback();
    }
    public static function query($query, array $params = array()){
        return dbClass::getInstance()->query($query, $params);
    }
    public static function escape($str){
        return dbClass::getInstance()->escape($str);
    }
    public static function getInsId(){
        return dbClass::getInstance()->getInsId();
    }
}
class dbClass{
    const
        TRANS_MODE_READ_UNCOMMITTED = 'ISOLATION LEVEL READ UNCOMMITTED',
        TRANS_MODE_READ_COMMITTED = 'ISOLATION LEVEL READ COMMITTED',
        TRANS_MODE_REPEATABLE_READ = 'ISOLATION LEVEL REPEATABLE READ',
        TRANS_MODE_SERIALIZABLE = 'ISOLATION LEVEL SERIALIZABLE'
    ;
    private static $instance = null;
    public static function getInstance(){
        if (is_null(self::$instance)){
            if (function_exists('mysqli_connect')){
                self::$instance = new mysqliClass();
            }else{
                exit('mysqli extension is not loaded');
                //self::$instance = new mysqlClass();
            }
        }
        return self::$instance;
    }
}

class mysqliClass{
    private $dbLink = '';
    public function __construct(){
        $this->dbLink = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ('SQLi_Error: cant connect to DB, please configure inc/config.php');
        mysqli_query($this->dbLink, 'SET NAMES `utf8`');
    }

    public function begin($transMode = dbClass::TRANS_MODE_REPEATABLE_READ){
        Logger::log('sql_queries.txt', 'SET SESSION TRANSACTION '. $transMode);
        Logger::log('sql_queries.txt', 'START TRANSACTION');
        if (!mysqli_query($this->dbLink, 'SET SESSION TRANSACTION '. $transMode) || !mysqli_query($this->dbLink, 'START TRANSACTION')){
            throw new \Exception('Could not begin transaction');
        }
        return true;
    }

    public function commit(){
        Logger::log('sql_queries.txt', 'COMMIT');
        if (!mysqli_query($this->dbLink, 'COMMIT')){
            throw new \Exception('Could not commit transaction');
        }
        return true;
    }

    public function rollback(){
        Logger::log('sql_queries.txt', 'ROLLBACK');
        if (!mysqli_query($this->dbLink, 'ROLLBACK')){
            throw new \Exception('Could not rollback transaction');
        }
        return true;
    }

    public function query($query, array $params = array()){
        $query = $this->prepareQuery( $query, $params );
        Logger::log('sql_queries.txt', $query);
        $result = mysqli_query($this->dbLink, $query);
		if(!$result)
            $this->throwError(mysqli_error($this->dbLink));
        $return = array();
        while( $row = @mysqli_fetch_assoc($result)){
            $return[] = $row;
        }
        return $return;
    }

    public function escape($str){
        return mysqli_real_escape_string($this->dbLink, $str);
    }

    public function getInsId(){
        return mysqli_insert_id($this->dbLink);
    }

    public function __destruct(){
        if ($this->dbLink) mysqli_close($this->dbLink);
    }

    private function throwError($data){
        Logger::log('sql_errors.txt', $data);
        exit;
    }
    private function getReplacements(){
        return [
            'i' => function( $value ){
                return floatval($value);
            },
            's' => function( $value ){
                return '\''.$this->escape($value).'\'';
            }
        ];
    }

    private function prepareQuery( $query, array $params ){
        $query = $this->parseValues($query, $params);
        if(!preg_match('|\{ *if|i', $query))
            return $query;
        foreach ($params as $key => $value){
            View::assign($key, $value);
        }
        return View::fetch('string:'.$query);
    }

    private function parseValues( $query, $params ){
        $replacements = $this->getReplacements();   
        if( preg_match_all('|{{([^\(]+)\(([^\(\)]+)\)[^\)]+}}|', $query, $m )) {
            foreach ($m[1] as $ind => $val) {
                $func = trim($val);
                if (isset($replacements[$func])) {
                    $query = str_replace($m[0][$ind], $replacements[$func]($params[$m[2][$ind]]), $query);
                } else {
                    exit('undefined template modifier');
                }
            }
        }
        return $query;
    }
}

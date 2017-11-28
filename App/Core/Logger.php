<?php
namespace App\Core;

class Logger
{
    private static $instance = null;
    private $logDir;

    public function __construct()
    {
        $this->logDir = BASE_PATH.'/logs';
        if (!is_dir($this->logDir))
            mkdir($this->logDir, 0777);
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function log($file, $data)
    {
        $logData = null;
        if (is_array($data) || is_object($data)) {
            $logData = json_encode($data);
        } else {
            $logData = $data;
        }
        $logData = date('Y-m-d H:i:s').PHP_EOL.$logData.PHP_EOL.PHP_EOL;
        file_put_contents($this->logDir.'/'.$file, $logData, FILE_APPEND);
        return true;
    }
}

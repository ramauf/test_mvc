<?php
namespace App\Core;

use App\Core\Connectors\Smarty;

class View
{
    private static $JSControllers = [];
    private static $JSVariables = [];

    public static function addJSController($path)
    {
        if(!CACHE_ENABLED)
            $path.= '?anticache='.rand(1,10000);
        self::$JSControllers[$path] = $path;
    }

    public static function assignJS($name, $value)
    {
        self::$JSVariables[$name] = $value;
    }

    public static function assign($name, $value)
    {
        Smarty::getInstance()->assign($name, $value);
    }

    public static function setTemplateDir($templateDir)
    {
        Smarty::getInstance()->setTemplateDir('../'.$templateDir);
    }

    public static function setTemplate($template)
    {
        Smarty::getInstance()->setTemplate($template);
    }
    
    public static function setCompileDir($compileDir)
    {
        Smarty::getInstance()->setCompileDir($compileDir);
    }

    public static function display()
    {
        self::assign('JSControllers', self::$JSControllers);
        self::assign('JSVariables', json_encode(self::$JSVariables));
        Smarty::getInstance()->display();
    }

    public static function getObject()
    {
        return Smarty::getInstance();
    }

    public static function fetch($template)
    {
        self::assign('JSControllers', self::$JSControllers);
        self::assign('JSVariables', self::$JSVariables);
        return Smarty::getInstance()->fetch($template);
    }
}

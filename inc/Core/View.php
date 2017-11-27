<?php
namespace Core;
class View{
    private static $JSControllers = [];
    private static $JSVariables = [];

    public static function addJSController($path){
        if(!CACHE_ENABLED)
            $path.= '?anticache='.rand(1,10000);
        self::$JSControllers[$path] = $path;
    }

    public static function assignJS($name, $value){
        self::$JSVariables[$name] = $value;
    }

    public static function assign($name, $value){
        ViewClass::getInstance()->assign($name, $value);
    }

    public static function setTemplateDir($templateDir){
        ViewClass::getInstance()->setTemplateDir('../'.$templateDir);
    }

    public static function setTemplate($template){
        ViewClass::getInstance()->setTemplate($template);
    }

    public static function display(){
        self::assign('JSControllers', self::$JSControllers);
        self::assign('JSVariables', json_encode(self::$JSVariables));
        ViewClass::getInstance()->display();
    }

    public static function getObject(){
        return ViewClass::getInstance();
    }

    public static function fetch($template){
        self::assign('JSControllers', self::$JSControllers);
        self::assign('JSVariables', self::$JSVariables);
        return ViewClass::getInstance()->fetch($template);
    }
}

class ViewClass{
    private static $instance = null;
    private $template;
    private $smarty;
    public function __construct(){
        $this->smarty = new \Smarty();
    }

    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setTemplate($template){
        $this->template = $template;
    }

    public function assign($name, $value){
        $this->smarty->assign($name, $value);
    }

    public function setTemplateDir($templateDir){
        $this->smarty->setTemplateDir($templateDir);
    }

    public function display(){
        $this->smarty->display($this->template);
    }
    
    public function fetch($template = null){
        return $this->smarty->fetch($template);
    }

}
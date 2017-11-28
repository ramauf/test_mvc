<?php
namespace App\Core\Connectors;
class Smarty{
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
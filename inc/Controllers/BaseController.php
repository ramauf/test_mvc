<?php
namespace Controllers;
use Core\Session;
use Core\View;
use Models\Vk;

class BaseController{
    protected $templateDir;
    protected $controllerDir;
    protected $queryParams;
    protected $mainTemplate = '404.tpl';
    protected function postParams($key = null){
        if(!is_null($key)){
            if(isset($_POST[$key])){
                return $_POST[$key];
            }else{
                return null;
            }
        }else{
            return $_POST;
        }
    }
    protected function getParams($key = null){
        if(!is_null($key)){
            if(isset($_GET[$key])){
                return $_GET[$key];
            }else{
                return null;
            }
        }else{
            return $_GET;
        }
    }
}
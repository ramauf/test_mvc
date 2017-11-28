<?php
namespace App\Controllers;

use App\Core\View;

class BaseController
{
    protected $templateDir;
    protected $controllerDir;
    protected $queryParams;
    protected $mainTemplate = '404.tpl';

    public function __construct()
    {
        View::setCompileDir(BASE_PATH.'/templates_c');
    }

    protected function postParams($key = null)
    {
        if (!is_null($key)) {
            if (isset($_POST[$key])) {
                return $_POST[$key];
            } else {
                return null;
            }
        } else {
            return $_POST;
        }
    }

    protected function getParams($key = null)
    {
        if (!is_null($key)) {
            if (isset($_GET[$key])) {
                return $_GET[$key];
            } else {
                return null;
            }
        } else {
            return $_GET;
        }
    }
}

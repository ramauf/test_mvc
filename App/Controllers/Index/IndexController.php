<?php
namespace App\Controllers\Index;

use App\Controllers\BaseController;
use App\Core\Session;
use App\Core\View;

class IndexController extends BaseController{
    protected $authTemplate = 'main_auth.tpl';
    protected $unauthTemplate = 'main_unauth.tpl';

    public function __construct( $params ){
        $this->queryParams = $params;
        Session::getInstance()->start();
        View::setTemplateDir('templates/index');
        if( Session::getInstance()->get('user') === null ){
            View::setTemplate($this->unauthTemplate);
        }else{
            View::setTemplate($this->authTemplate);
        }
    }

}
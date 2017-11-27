<?php
namespace Controllers\Index;

use Controllers\BaseController;
use Core\Session;
use Core\View;
use Models\MenuService;

class IndexController extends BaseController{
    protected $authTemplate = 'main_auth.tpl';
    protected $unauthTemplate = 'main_unauth.tpl';

    public function __construct( $params ){
        $this->queryParams = $params;
        Session::start();
        View::setTemplateDir('templates/index');
        if( Session::get('user') === null ){
            View::setTemplate($this->unauthTemplate);
        }else{
            View::setTemplate($this->authTemplate);
        }
    }

}
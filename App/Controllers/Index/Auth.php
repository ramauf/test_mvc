<?php
namespace App\Controllers\Index;

use App\Core\Helpers\Http;
use App\Core\Session;
use App\Core\View;
use App\Models\UserObject;

class Auth extends IndexController{

    public function pageLogin(){
        View::assign('subTemplate', 'login.tpl');
        if( !empty( $this->postParams())){
            $UserObject = new UserObject();
            if( $UserObject->login( $this->postParams())){
                Session::getInstance()->set('user', $UserObject->export());
                Http::redirect('/');
            }else{
                View::assign('errors', ['Неверный логин или пароль']);
            }
        }
        if( Session::getInstance()->get('user') != null )
            Http::redirect('/');
    }

    public function pageLogout(){
        Session::getInstance()->del('user');
        Http::redirect('/');
    }
}
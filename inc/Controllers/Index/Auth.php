<?php
namespace Controllers\Index;

use Core\DB;
use Core\Helpers\Http;
use Core\Session;
use Core\View;
use Models\UserObject;

class Auth extends IndexController{

    public function pageLogin(){
        View::assign('subTemplate', 'login.tpl');
        if( !empty( $this->postParams())){
            $UserObject = new UserObject();
            if( $UserObject->login( $this->postParams())){
                Session::set('user', $UserObject->export());
                Http::redirect('/');
            }else{
                View::assign('errors', ['Неверный логин или пароль']);
            }
        }
        if( Session::get('user') != null )
            Http::redirect('/');
    }

    public function pageLogout(){
        Session::del('user');
        Http::redirect('/');
    }
}
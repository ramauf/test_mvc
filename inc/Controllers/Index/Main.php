<?php
namespace Controllers\Index;

use Core\DB;
use Core\Helpers\Http;
use Core\Session;
use Core\View;

class Main extends IndexController{

    public function pageIndex(){
        if( is_null( Session::get('user'))){
            Http::redirect('/login');
        }else{
            Http::redirect('/operations');
        }
    }
}
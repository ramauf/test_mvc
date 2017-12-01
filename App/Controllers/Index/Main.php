<?php
namespace App\Controllers\Index;

use App\Core\Helpers\Http;
use App\Core\Session;

class Main extends IndexController
{
    public function pageIndex()
    {
        if (is_null(Session::getInstance()->get('user'))) {
            Http::redirect('/login');
        } else {
            Http::redirect('/operations');
        }
    }
}

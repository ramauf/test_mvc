<?php
namespace App\Controllers\Index;

use App\Controllers\BaseController;
use App\Core\Helpers\Http;
use App\Core\Session;
use App\Core\View;
use App\Models\UserObject;

class IndexController extends BaseController
{
    protected $authTemplate = 'main_auth.tpl';
    protected $unauthTemplate = 'main_unauth.tpl';

    public function __construct($params)
    {
        parent::__construct();
        $this->queryParams = $params;
        Session::getInstance()->start();
        View::setTemplateDir('templates/index');
        if (Session::getInstance()->get('user') === null) {
            View::setTemplate($this->unauthTemplate);
        } else {
            $UserObject = new UserObject();
            $UserObject->loadById(Session::getInstance()->get('user')['id']);
            if ($UserObject->isLoaded()) {
                Session::getInstance()->set('user', $UserObject->export());
            } else {
                Http::redirect('/login');
            }
            View::setTemplate($this->authTemplate);
        }
    }

}

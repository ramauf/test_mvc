<?php
namespace App\Controllers\Index;

use App\Core\Helpers\Http;
use App\Core\Session;
use App\Core\View;
use App\Models\OperationObject;
use App\Models\OperationsCollection;
use App\Models\UserObject;

class Operations extends IndexController
{
    public function pageIndex($status = 'empty')
    {
        $user = Session::getInstance()->get('user');
        Session::getInstance()->close();
        $OperationsCollection = new OperationsCollection();
        $OperationsCollection->fetch([
            'user_id' => $user['id'],
            'by_id' => 'desc'
        ]);
        $operations = $OperationsCollection->select()->asArray();

        $balanceByDirections = $OperationsCollection->selectBalanceByDirections()->asArray();

        if ($this->postParams('address') !== null && $this->postParams('password') !== null && $this->postParams('amount') !== null) {
            $amount = floatval(str_replace(',', '.', $this->postParams('amount')));
            $address = trim($this->postParams('address'));

            $UserObject = new UserObject();
            $UserObject->begin();
            $UserObject->loadById($user['id']);
            if (!$UserObject->isLoaded()) {
                $UserObject->rollback();
                Http::redirect('/operations/fail');
            }

            if ($UserObject['balance'] >= $amount && $amount > 0 && !empty($address) && md5($this->postParams('password')) == $UserObject['payPass'] && !empty($this->postParams('address'))) {
                $OperationObject = new OperationObject();
                $OperationObject->fetch([
                    'user_id' => $user['id'],
                    'amount' => $amount,
                    'type' => 'out',
                    'address' => $this->postParams('address'),
                    'date' => time()
                ]);
                $OperationObject->create();
                $UserObject->merge([
                    'balance' => $UserObject['balance'] - $amount
                ]);
                $UserObject->update();
                $UserObject->commit();
                Http::redirect('/operations/success');
            } else {
                $UserObject->rollback();
                Http::redirect('/operations/fail');
            }
        }

        View::assign('status', $status);
        View::assign('balanceByDirections', $balanceByDirections);
        View::assign('currentBalance', $user['balance']);
        View::assign('operations', $operations);
        View::assign('menuName', 'Финансы');
        View::assign('subTemplate', 'operations_list.tpl');
        View::addJSController('/js/index/operations.js');
    }

    public function pageSuccess()
    {
        $this->pageIndex('success');
    }

    public function pageFail()
    {
        $this->pageIndex('fail');
    }
}

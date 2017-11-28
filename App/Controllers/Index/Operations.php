<?php
namespace App\Controllers\Index;

use App\Core\Helpers\Http;
use App\Core\Session;
use App\Core\View;
use App\Models\OperationObject;
use App\Models\OperationsCollection;

class Operations extends IndexController{

    public function pageIndex( $status = 'empty'){
        $user = Session::getInstance()->get('user');
        Session::getInstance()->close();
        $OperationsCollection = new OperationsCollection();
        $OperationsCollection->begin();
        $OperationsCollection->fetch([
            'user_id' => $user['id'],
            'by_id' => 'desc'
        ]);
        $operations = $OperationsCollection->select()->asArray();

        $currentBalance = 0;
        $balance = $OperationsCollection->selectBalance()->asArray();//Запрос аналогичный предыдущему, чтобы продемонстрировать сервис
        foreach( $balance as $operation ){
            $currentBalance += ($operation['type'] == 'in' ? 1 : -1 ) * $operation['amount'];
        }

        if( $this->postParams('address') !== null && $this->postParams('password') !== null && $this->postParams('amount') !== null ){
            $amount = str_replace(',', '.', $this->postParams('amount'))*1;
            $address = trim( $this->postParams('address'));
            if( $currentBalance >= $amount && $amount > 0 && !empty( $address ) && md5( $this->postParams('password')) == $user['payPass'] && !empty( $this->postParams('address'))){
                $OperationObject = new OperationObject();
                $OperationObject->fetch([
                    'user_id' => $user['id'],
                    'amount' => $amount,
                    'type' => 'out',
                    'address' => $this->postParams('address'),
                    'date' => time()
                ]);
                $OperationObject->create();
                $OperationsCollection->commit();
                Http::redirect('/operations/success');
            }else{
                $OperationsCollection->rollback();
                Http::redirect('/operations/fail');
            }
        }
        $OperationsCollection->commit();

        View::assign('status', $status );
        View::assign('balance', $balance );
        View::assign('currentBalance', $currentBalance );
        View::assign('operations', $operations );
        View::assign('menuName', 'Финансы');
        View::assign('subTemplate', 'operations_list.tpl');
        View::addJSController('/js/index/operations.js');
    }

    public function pageSuccess(){
        $this->pageIndex('success');
    }

    public function pageFail(){
        $this->pageIndex('fail');
    }
}
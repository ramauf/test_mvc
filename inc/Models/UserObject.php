<?php
namespace Models;
use Core\Models\AbstractField;
use Core\Models\AbstractObject;

class UserObject extends AbstractObject{
    protected $table = 'users';
    public function init(){
        $this
            ->addField('id', AbstractField::FIELD_INTEGER )
            ->setPrimary('id')
            ->addField('login', AbstractField::FIELD_STRING )
            ->addField('password', AbstractField::FIELD_STRING )
            ->addField('payPass', AbstractField::FIELD_STRING )
        ;
    }

    public function beforeCreate(){
        $this['password'] = md5( $this['password']);
        unset( $this['id']);
    }

    public function login( $data ){
        if( isset( $data['login']) && isset( $data['password'])){
            $this->fetch([
                'login' => $data['login'],
                'password' => md5( $data['password'])
            ]);
            $this->load();
        }
        return $this->isLoaded();
    }
}
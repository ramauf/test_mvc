<?php
namespace App\Models;
use App\Core\DB;
use App\Core\Models\AbstractCollection;
use App\Core\Models\AbstractField;

class OperationsCollection extends AbstractCollection{
    public static $typeNames = [
        'in' => 'Приход',
        'out' => 'Расход'
    ];
    protected $table = 'operations';

    protected function getService(){
        return new OperationService();
    }
    
    protected function getObject(){
        $EventObject = new OperationObject();
        $EventObject
            ->addField('typeName', AbstractField::FIELD_STRING)
        ;
        return $EventObject;
    }
    
    public function init(){
        $this
            ->addField('id', AbstractField::FIELD_INTEGER )
            ->addField('user_id', AbstractField::FIELD_INTEGER )
            ->addField('by_id', AbstractField::FIELD_STRING )
        ;
    }
    
    public function selectBalance(){
        return $this->collect( $this->getService()->selectBalance( $this->export()));
    }

    protected function collect( $data ){
        $this->collection = [];
        foreach ( $data as $row ){
            $object = $this->getObject();
            $row['typeName'] = self::$typeNames[$row['type']];
            $object->fetch( $row );
            $this->collection[] = $object;
        }
        return $this;
    }

}
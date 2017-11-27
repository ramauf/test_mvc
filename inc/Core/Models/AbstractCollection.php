<?php
namespace Core\Models;
use Core\DB;

abstract class AbstractCollection extends AbstractData{
    protected $collection = [];

    /**
     * @return AbstractObject
     */
    protected function getObject(){
        return null;
    }

    public function fetch( $data = []){
        foreach( $this->fields as $fieldName => $fieldInfo ){
            $fieldInfo['value'] = isset( $data[$fieldName]) ? $data[$fieldName] : $fieldInfo['defaultValue'];
            $this->data[$fieldName] = $fieldInfo;
        }
        return true;
    }

    public function merge( $data = []){
        foreach( $this->fields as $fieldName => $fieldInfo ){
            if( isset( $data[$fieldName]))
                $this->data[$fieldName]['value'] = $data[$fieldName];
        }
        return true;
    }

    public function select( array $params = []){
        if( empty( $this->data ))
            $this->fetch();
        $order = [];
        foreach( $this->export() as $ind => $val ){
            if( substr( $ind, 0, 3 ) == 'by_'){
                $order[substr( $ind, 3)] = $val;
                unset($this[$ind]);
            }
        }
        if(!empty( $order )){
            $tmp = [];
            foreach( $order as $ind => $val ){
                $tmp[] = $ind.' '.$val;
            }
            $order = 'ORDER BY '.implode(', ', $tmp);
        }else{
            $order = '';
        }
        $cond = [];
        foreach( $this->fields as $fieldName => $fieldInfo ){
            if( !is_null( $this->data[$fieldName]['value'])){
                $cond[] = '`'.$fieldName.'` = {{ '. $fieldInfo['type'] .'('. $fieldName .') }}';
            }
        }
        $cond = empty( $cond ) ? '' : ' AND '.implode(' AND ', $cond);
        $data =  DB::query('-- BASE_COLLECTION_SELECT
SELECT * FROM `'.$this->table.'` WHERE TRUE '. $cond.' '.$order, $params + $this->export());
        if( empty( $data ))
            return $this->emptyObject();
        return $this->collect( $data );
    }

    protected function collect( $data ){
        $this->collection = [];
        foreach ( $data as $row ){
            $object = $this->getObject();
            $object->fetch( $row );
            $this->collection[] = $object;
        }
        return $this;
    }

    public function export(){
        $return = [];
        foreach( $this->data as $fieldName => $fieldInfo ){
            $return[$fieldName] = $fieldInfo['value'];
        }
        return $return;
    }

    public function asArray( $arrayKey = null){
        $collection = [];
        foreach( $this->collection as $object ){
            $data = $object->export();
            if( is_null( $arrayKey )){
                $collection[] = $data;
            }else{
                $collection[$data[$arrayKey]] = $data;
            }
        }
        return $collection;
    }

    public function addField( $name, $type, $defaultValue = null ){
        $this->fields[$name] = ['type' => $type, 'value' => null, 'defaultValue' => $defaultValue];
        return $this;
    }

    protected function throwError($data){
        var_dump($data);
        exit;
    }
    protected function emptyObject(){
        $this->data = [];
        return $this;
    }
}
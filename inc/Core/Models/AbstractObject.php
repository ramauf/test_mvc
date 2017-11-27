<?php
namespace Core\Models;
use Core\DB;

abstract class AbstractObject extends AbstractData{
    private $primaryField = '';

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

    protected function beforeCreate(){
        //
    }

    public function create(){
        $this->beforeCreate();
        $data = [];
        foreach( $this->fields as $field => $params ){
            if( $field != $this->primaryField ){
                $data[$field] = '{{ '. $params['type'] .'('. $field .') }}';
            }
        }
        DB::query('-- BASE_OBJECT_INSERT
INSERT INTO `'.$this->table.'` (`'.implode('`, `', array_keys($data)).'`) VALUES ('.implode(',', array_values($data)).')', $this->export());
        if(!empty( $this->primaryField )){
            $this->loadById(DB::getInsId());
        }
        return true;
    }


    public function load(){
        if( empty( $this->data ))
            $this->fetch();
        $cond = [];
        foreach( $this->fields as $fieldName => $fieldInfo ){
            if( !is_null( $this->data[$fieldName]['value'])){
                $cond[] = '`'.$fieldName.'` = {{ '. $fieldInfo['type'] .'('. $fieldName .') }}';
            }
        }
        $cond = empty( $cond ) ? '' : ' AND '.implode(' AND ', $cond);
        $data =  DB::query('-- BASE_OBJECT_SELECT
SELECT * FROM `'.$this->table.'` WHERE TRUE '. $cond, $this->export());
        if( empty( $data )){
            return $this->emptyObject();
        }else{
            $data = reset( $data );
            $this->fetch( $data );
            return $this;
        }
    }

    protected function beforeUpdate(){
        //
    }

    /**
     * @return bool
     */
    public function update(){
        $this->beforeUpdate;
        $data = [];
        foreach( $this->fields as $field => $params ){
            if( $field != $this->primaryField){
                $data[] = '`'.$field.'` = {{ '. $params['type'] .'('. $field .') }}';
            }
        }
        DB::query('-- BASE_OBJECT_UPDATE
UPDATE `'.$this->table.'` SET '.implode(',', $data).' WHERE `'.$this->primaryField.'` = {{ i('.$this->primaryField.') }}', $this->export());
        return true;
    }

    public function delete(){
        if( is_null( $this->primaryField ))
            $this->throwError('cant delete object without primary key');
        DB::query('-- BASE_OBJECT_DELETE
DELETE FROM `'.$this->table.'` WHERE `'.$this->primaryField.'` = {{ i('.$this->primaryField.') }}', [$this->primaryField => $this->data['id']]);
        return true;
    }

    public function loadById($id){
        if( is_null( $this->primaryField ))
            $this->throwError('cant load object without primary key');
        $data =  DB::query('-- BASE_OBJECT_SELECT_BY_ID
SELECT * FROM `'.$this->table.'` WHERE `'.$this->primaryField.'` = {{ i('.$this->primaryField.') }}', [$this->primaryField => $id]);
        if( empty( $data ))
            return $this->emptyObject();
        $data = reset( $data );
        $this->fetch( $data );
        return $this;
    }

    public function export(){
        if( empty( $this->data ))
            $this->fetch();
        $return = [];
        foreach( $this->data as $fieldName => $fieldInfo ){
            $return[$fieldName] = $fieldInfo['value'];
        }
        return $return;
    }

    public function isLoaded(){
        return !empty( $this->data );
    }

    public function addField( $name, $type, $defaultValue = null ){
        $this->fields[$name] = ['type' => $type, 'value' => null, 'defaultValue' => $defaultValue];
        return $this;
    }

    public function getValidationErrors(){
        return [];
    }

    protected function setPrimary( $name ){
        if(!isset( $this->fields[$name]))
            $this->throwError('undefined field cant be set as primary');
        $this->primaryField = $name;
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
<?php
namespace App\Core\Helpers;
class Filter{
    /**
     * @param $source
     * @param $allowed
     */
    public static function fieldsOnly( $source, $allowed ){
        $allowed = array_flip($allowed);
        foreach( $source as $ind => $val ){
            if(!isset($allowed[$ind]))
                unset( $source[$ind]);
        }
        return $source;
    }
}
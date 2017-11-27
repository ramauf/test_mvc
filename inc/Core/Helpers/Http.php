<?php
namespace Core\Helpers;
class Http{
    public static function requestPost( $url, $post = '', $cookieFile = ''){
        if( is_array( $post )) $post = http_build_query( $post );
        $post = str_replace( array('%5Cr', '%5Cn'), array('%0D', '%0A'), $post );
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HEADER, 0 );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        if (!empty( $post )){
            curl_setopt( $ch, CURLOPT_POST, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $post );
        }
        if (!empty( $cookieFile )){
            curl_setopt( $ch, CURLOPT_COOKIEFILE, $cookieFile );
            curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookieFile );
        }
        $buf = curl_exec( $ch );
        curl_close ($ch);
        return $buf;
    }

    public static function requestGet( $url ){
        return file_get_contents( $url );
    }

    public static function redirect( $url ){
        header('Location:'. $url);
        exit;
    }
}

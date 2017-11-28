<?php
namespace App\Core;

class Routes{
    private static $instance = null;
    private $routes = [];
    public static function getInstance(){
        if (is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function addRoute($url, $className, $methodName, $params){
        if( !empty( $params )){
            $params = array_flip( $params );
            foreach( $params as &$param )
                $param = null;
            $this->routes[$url] = [$className, 'page' . ucfirst($methodName), $params];
        }else {
            $this->routes[$url] = [$className, 'page' . ucfirst($methodName), []];
        }
        return true;
    }
    public function loadRoute($url){
        $url = trim( $url, '/');
        foreach( $this->routes as $uri => &$route ){
            $uri = trim( $uri, '/');
            if( preg_match('|^'.$uri.'$|', $url, $m)){
                unset( $m[0] );
                foreach( $route[2] as $paramName => &$paramValue ){
                    $paramValue = current($m);
                    next($m);
                }
                $object = new $route[0]( $route[2]);
                if( method_exists( $object, $route[1])){
                    $object->$route[1]();
                    return true;
                }else{
                    exit('method not found');
                }
            }
        }
        exit('route not found');
    }

}
<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of UrlGenerator
 *
 * @author Hamza Waqas
 */
namespace Slimio\Util;

class UrlGenerator {
    
    
    private static $_url = "/";
    
    public static function generate ($frag = array()) {      
        if ( !is_array($frag) || empty($frag))
            throw  new \Exception('Generator needs URL Fragments to generate URL');//Exception('');
         
        self::$_url .= self::isIndex($frag, '_logic');        
        self::$_url .= '('.self::isIndex($frag, '_handler').')';
        self::$_url .= DS.(array_key_exists('_args', $frag) ? implode('/', $frag['_args']) : '');
        $query_params = (array_key_exists('_query', $frag) && !empty ($frag['_query'])? $frag['_query'] : array());
        $query_string = '';
        if ( ! empty ($query_params)) {
            foreach ($query_params as $param_name => $params_value) {
                $query_string .= $param_name.'='.$params_value;
            }
            self::$_url .= '?'.$query_string;
        }
        
        return self::$_url;
    }
    
    private static function isIndex($arr, $index) {
        if ( !array_key_exists($index, $arr))
               throw new \Exception('_logic is not found for generating url in '.  get_class($this));
        return $arr[$index];
    }
    
    
}

?>

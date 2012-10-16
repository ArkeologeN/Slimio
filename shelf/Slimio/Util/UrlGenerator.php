<?php
/**
 * Utlitity class for generating inhouse / internal URLs
 *
 * @author  HamzaWaqas
 * @package Slimio\Util
 * @version 1.0
 * @name    UrlGenerator
 * 
 */
namespace Slimio\Util;

class UrlGenerator {
    
    
    private static $_url = "/";
    
    /**
     *
     * @param Array $frag
     * @return String
     * @throws \Exception  if no $frags were defined
     * 
     * Helps to generate the url for moving towards other business logics on Presentation layer.
     */
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
    
    /**
     *
     * @param Array $arr
     * @param String $index
     * @return mixed
     * @throws \Exception   if key doesn't exist
     * 
     * Helps to double check the URL fragments already defined in array.
     */
    private static function isIndex($arr, $index) {
        if ( !array_key_exists($index, $arr))
               throw new \Exception('_logic is not found for generating url in '.  get_class($this));
        return $arr[$index];
    }
    
    
}

?>

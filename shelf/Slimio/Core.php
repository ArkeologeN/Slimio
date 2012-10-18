<?php


/**
 * The main Core class of the framework that registers autoloading
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    Core
 * 
 */

namespace Slimio;

class Core {
    
    private static $instance = null;
    
    public static function getInstance () {
        if ( ! (self::$instance instanceof Slimio_Autoloader)) 
            self::$instance = new Slimio_Autoloader ();
        
        return self::$instance;
    }
    
    public function initialize() {
        return $this->registerAutoloader();
    }
}

?>

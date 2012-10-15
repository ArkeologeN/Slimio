<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of Autoloader
 *
 * @author alihashmi
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

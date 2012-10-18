<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of Configuration
 *
 * @author alihashmi
 */

namespace Slimio;
use Slimio\Constants;

class Configuration {
    
    private $_filepath = null;
    private static $_instance = null;
    private $_configuration = array();
    
    public static function getInstance() {
        //
        if ( !self::$_instance instanceof Configuration) 
            self::$_instance = new \Slimio\Configuration();
        
        return self::$_instance;
    }
    
    public function load() {
        $this->_filepath = ROOT_DIR.DS.'system'.DS.Constants::DIR_CONFIGURATION.DS.'restrict.ini';
        if (!file_exists($this->_filepath))
            throw new \Exception('restrict.ini not found. Please create configuration file');
        
        if ( empty($this->_configuration)) {
            $this->_configuration = parse_ini_file($this->_filepath, true);
        }
        
        return self::$_instance;
    }


    public function getConfigurations($section = null) {
        //print $section; exit;
        if ( !is_null($section)) {
            if (array_key_exists($section, $this->_configuration)) {
                return ($this->_configuration[$section]);
#                echo "<pre>"; print_r(); exit;
            }
        }
    }
}

?>

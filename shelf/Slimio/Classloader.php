<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of Classloader
 *
 * @author Hamza Waqas
 */
namespace Slimio;
use Slimio\Constants;

class Classloader {
    
    
    private static $instance = null;
    private $_classPath = null;
    private $_className = null;


    public static function getInstance () {
        if ( ! self::$instance instanceof Classloader)
            self::$instance = new Classloader();
        return self::$instance;
    }
    
    public function loadClass ($className) {
        $this->setClassName(Constants::BL_CLASS_PREFIX.ucfirst($className));
        try {
            if ( !isset($className))
                $this->partialException('Class name not found');

            $this->defineClassPath($className);
            if ( $this->isFileExist() ) {
                $this->includeClassPath();
                if ( $this->isClassExist()) {
                    $reflecion_class = new \ReflectionClass($this->copyClone());
                    $class = $reflecion_class->newInstance();
                    return $class;
                } 
            } else {
                $this->partialException('Business Logic not found in /system/'.Constants::DIR_BL);
            }
         } catch (Exception $ex) {
            echo "<pre>"; print_r($ex); exit;
         }   
    }
    
    private function defineClassPath ($alias) {
        $this->_classPath = getcwd().DIRECTORY_SEPARATOR.'system'.DIRECTORY_SEPARATOR.Constants::DIR_BL.DIRECTORY_SEPARATOR.ucfirst($alias).'.'.Constants::BL_FILE_EXTENSION.'.php';
    }
    
    private function isFileExist () {
        if (file_exists($this->_classPath)) 
            return true;
        
        return;
    }
    
    private function includeClassPath () {
        include $this->_classPath;
    }    
    private function isClassExist () {
        $formatted_name = $this->getClassName();
        if (!class_exists($formatted_name))
                $this->partialException ($formatted_name." class not found in ".$this->_classPath);
        
        return true;
    }
    
    private function copyClone () {
        return  $this->getClassName();
    }
    
    private function partialException($msg) {
        throw new \Exception($msg);
    }
    
    private function setClassName ($name) {
        $this->_className = $name;
    }
    
    private function getClassName () {
        return $this->_className;
    }
}

?>

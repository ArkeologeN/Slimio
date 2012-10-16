<?php

/**
 * Core class helps to load the respective class on request fragments.
 * This works like a frontController. Pushes the calls to respective Business Logics.
 * 
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    Classloader
 * 
 */
namespace Slimio;
use Slimio\Constants;

class Classloader {
    
    
    private static $instance = null;
    private $_classPath = null;
    private $_className = null;
    private $_templateDispatcherVo = null;


    public static function getInstance () {
        if ( ! self::$instance instanceof Classloader)
            self::$instance = new Classloader();
        return self::$instance;
    }
    
    
    /**
     *
     * @param String $className
     * @return Object $class
     * 
     *  Method helps to load class dynamically without __autoload implementation.
     *  Pattern uses Reflection. 
     */
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
                    $class = $reflecion_class->newInstance($this->getTempalteDispatcherVO());   
                    return $class;
                } 
            } else {
                $this->partialException('Business Logic not found in /system/'.Constants::DIR_BL);
            }
         } catch (Exception $ex) {
            echo "<pre>"; print_r($ex); exit;
         }   
    }
    
    
    /**
     *
     * @param String $alias Defines the class path to be added.
     */
    private function defineClassPath ($alias) {
        $this->_classPath = getcwd().DS.'system'.DS.Constants::DIR_BL.DS.ucfirst($alias).'.'.Constants::BL_FILE_EXTENSION.'.php';
    }
    
    /**
     *
     * @return boolean Check if file exist on respective DIR
     */
    private function isFileExist () {
        if (file_exists($this->_classPath)) 
            return true;
        
        return;
    }
    
    /**
     * Loads Class 
     */
    private function includeClassPath () {
        include $this->_classPath;
    }    
    
    /**
     *
     * @return boolean Check if class already exist.
     */
    private function isClassExist () {
        $formatted_name = $this->getClassName();
        if (!class_exists($formatted_name))
                $this->partialException ($formatted_name." class not found in ".$this->_classPath);
        
        return true;
    }
    
    /**
     *
     * @return Object $Class Returns blueprint instance of Reflection class. 
     */
    private function copyClone () {
        return  $this->getClassName();
    }
    
    /**
     *
     * @param String $msg
     * @throws \Exception Throws exception with given message
     */
    private function partialException($msg) {
        throw new \Exception($msg);
    }
    
    /**
     *
     * @param String $name Possess class name and set it to internal usage.
     */
    private function setClassName ($name) {
        $this->_className = $name;
    }
    
    /**
     *
     * @return String returns class name. 
     */
    private function getClassName () {
        return $this->_className;
    }
    
    /**
     *
     * @param \Slimio\Vo\TemplateDispatcher $object sets template dispatcher object
     */
    public function setTemplateDispatcherVO (\Slimio\Vo\TemplateDispatcher $object) {
        $this->_templateDispatcherVo = $object;
    }
    
    /**
     *
     * @return Object $templateDispatcherVO Returns VO Object. 
     */
    public function getTempalteDispatcherVO () {
        return $this->_templateDispatcherVo;
    }
}

?>

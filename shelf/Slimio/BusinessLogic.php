<?php

/**
 * Abstract class to be extended for Business Logics / Controllers of the application.
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    BusinessLogic
 * 
 */

namespace Slimio;


abstract class BusinessLogic {
    
    private $_templateDispatcherVO = null;
    private $_presentationLayer = null;
    private $_hooker = null;
    
    public function __construct() {
        $this->_initialize();
        $func_args = func_get_args();
        if ( !$func_args[0] instanceof \Slimio\Vo\TemplateDispatcher) {
            throw new \Exception('TemplateDispatcher not found for template rendering.');
        }
        $this->_templateDispatcherVO = $func_args[0];
        
        if ( $func_args[1] instanceof \Hooking) {
            $this->setHooker($func_args[1]);
        }
        $this->getHooker()->beforeConstructor();
        $pl_dir = $this->_templateDispatcherVO->getBusinessLogicHandler();
        $pl_file = $this->_templateDispatcherVO->getPresentationLayerHander();
        $this->_presentationLayer = new \Slimio\PresentationLayer($pl_dir, $pl_file);   
    }
    
    public function setHooker($hook = null) {
        $this->_hooker = $hook;
    }
    
    public function getHooker() {
        return $this->_hooker;
    }
    
    public function runHook($hook_name, $values = array()) {
        if ( isset($hook_name)) {
            if (method_exists($this->_hooker, $hook_name)) {
                call_user_func_array(array($this->_hooker,$hook_name), array($values));
            }
        }
    }
    
    public function getFragments() {
        
    }
    
    

    /**
     *
     * @param String $vname
     * @param mixed $value 
     * 
     * Port the values from Business Logic to Presentation layer
     */
    public function transport($vname, $value) {
        $this->_presentationLayer->dataTransporter($vname, $value);
    }
    
    
    /**
     * Destructor of the class. 
     */
    public function __destruct() {
        $this->_presentationLayer->renderLayer();
    }
    
    
    /**
     * Do something before execution of parent code. 
     */
    public abstract function _initialize();
}

?>

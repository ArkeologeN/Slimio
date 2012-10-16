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
    
    public function __construct() {
        $this->_initialize();
        $func_args = func_get_args();
        if ( !$func_args[0] instanceof \Slimio\Vo\TemplateDispatcher) {
            throw new \Exception('TemplateDispatcher not found for template rendering.');
        }
        $this->_templateDispatcherVO = $func_args[0];
        
        $pl_dir = $this->_templateDispatcherVO->getBusinessLogicHandler();
        $pl_file = $this->_templateDispatcherVO->getPresentationLayerHander();
        $this->_presentationLayer = new \Slimio\PresentationLayer($pl_dir, $pl_file);    
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

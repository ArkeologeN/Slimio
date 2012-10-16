<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of BusinessLogic
 *
 * @author Hamza Waqas
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
    
    public function transport($vname, $value) {
        $this->_presentationLayer->dataTransporter($vname, $value);
    }
    
    public function __destruct() {
        $this->_presentationLayer->renderLayer();
    }

    public abstract function _initialize();
}

?>

<?php

/**
 * Value Object for transporting Request URL Path around the application
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    TemplateDispatcher
 * 
 */

namespace Slimio\Vo;

class TemplateDispatcher {
    
    private $_busineslogic, $_presentationlayer = null;
    
    
    public function __construct($bl, $pl) {
        $this->setBusinessLogicHandler($bl);
        $this->setPresentationLayerHandler($pl);
    }

    public function setBusinessLogicHandler($bl) {
        $this->_busineslogic = $bl;
    }
    
    public function getBusinessLogicHandler() {
        return $this->_busineslogic;
    }
    
    public function setPresentationLayerHandler($pl) {
        $this->_presentationlayer = $pl;
    }
    
    public function getPresentationLayerHander() {
        return $this->_presentationlayer;
    }
}

?>

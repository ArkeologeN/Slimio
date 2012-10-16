<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of TemplateDispatcher
 *
 * @author Hamza Waqas
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

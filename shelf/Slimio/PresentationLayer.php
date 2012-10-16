<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of PresentationLayer
 *
 * @author alihashmi
 */

namespace Slimio;

class PresentationLayer {
    
    private $_parentDir, $_handlerViewer = null;
    private $_dataVariables = array();
    
    public function __construct($parentDir, $handlerViewer) {
        $this->_parentDir = $parentDir;
        $this->_handlerViewer = $handlerViewer;
    }
    
    public function dataTransporter($vname, $value) {
        $this->_dataVariables[$vname] = $value;
    }


    public function renderLayer() {
        extract($this->_dataVariables);
        $formatted_handlerView = substr($this->_handlerViewer,0, strpos($this->_handlerViewer, 'Handler')).'.'.\Slimio\Constants::PL_SUB_EXTENSION.'.php';
        $file_path = getcwd().DS.\Slimio\Constants::DIR_PL.DS.$this->_parentDir.DS.$formatted_handlerView;
        if (!file_exists($file_path))
            throw new \Exception('Respective layout not found in: '.$file_path);
        
        include $file_path;
    }
    
    public function makeUrl($frag = array()) {
        return \Slimio\Util\UrlGenerator::generate($frag);
    }
}

?>

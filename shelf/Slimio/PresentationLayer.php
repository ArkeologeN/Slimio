<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Handles frontend rendering as 3rd Tier (View)
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    PresentationLayer
 * 
 */

namespace Slimio;

class PresentationLayer {
    
    private $_parentDir, $_handlerViewer = null;
    private $_dataVariables = array();
    
    /**
     *
     * @param String $parentDir         Presentation Layer sub-directory
     * @param String $handlerViewer     View name to be loaded
     */
    public function __construct($parentDir, $handlerViewer) {
        $this->_parentDir = $parentDir;
        $this->_handlerViewer = $handlerViewer;
    }
    
    /**
     *
     * @param String $vname
     * @param mixed $value 
     * 
     * It helps to register or pass data to the Presentation Layer
     */
    public function dataTransporter($vname, $value) {
        $this->_dataVariables[$vname] = $value;
    }
    
    /**
     *
     * @throws \Exception If layout not found
     * 
     * This function will proceed layout rendering and take the call to htmlize process.
     */
    public function renderLayer() {
        extract($this->_dataVariables);
        $formatted_handlerView = substr($this->_handlerViewer,0, strpos($this->_handlerViewer, 'Handler')).'.'.\Slimio\Constants::PL_SUB_EXTENSION.'.php';
        $file_path = getcwd().DS.'system'.DS.\Slimio\Constants::DIR_PL.DS.$this->_parentDir.DS.$formatted_handlerView;
        if (!file_exists($file_path))
            throw new \Exception('Respective layout not found in: '.$file_path);
        
        include ROOT_DIR.'/assets/layout/header.layout';
        include $file_path;
        include ROOT_DIR.'/assets/layout/footer.layout';
    }
    
    /**
     *
     * @param Array $frag
     * @return String url
     * 
     * Returns formatted URL to be linked for other pages via frags. 
     */
    public function makeUrl($frag = array()) {
        return \Slimio\Util\UrlGenerator::generate($frag);
    }
}

?>

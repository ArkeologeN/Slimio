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

use Slimio\Util\AssetsLoader;

class PresentationLayer {
    
    private $_parentDir,$_handlerViewer = null;
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
        $hook_object = new \Hooking();
        $hook_object->beforeLaunch();
        extract($this->_dataVariables);
        $formatted_handlerView = substr($this->_handlerViewer,0, strpos($this->_handlerViewer, 'Handler')).'.'.\Slimio\Constants::PL_SUB_EXTENSION.'.php';
        $file_path = getcwd().DS.'system'.DS.\Slimio\Constants::DIR_PL.DS.$this->_parentDir.DS.$formatted_handlerView;
        if (!file_exists($file_path))
            throw new \Exception('Respective layout not found in: '.$file_path);
        
        $css_files = AssetsLoader::getCSS();
        $js_files  = AssetsLoader::getJS();
        $scripts = ''; $styles = '';
        $scripts = $this->jsHtmlBuilder($js_files);
        $styles  = $this->cssHtmlBuilder($css_files);
        include ROOT_DIR.'/assets/layout/header.layout';
        include $file_path;
        include ROOT_DIR.'/assets/layout/footer.layout';
        $hook_object->afterLaunch();
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
    
    private function jsHtmlBuilder($js_files) {
        $scripts = '';
        if (is_array($js_files) && !empty ($js_files)) {
            foreach ($js_files as $js_file) {
                $scripts .= '<script type="text/javascript">'.$js_file.'</script>'. "\n";
            }
        }
        
        return $scripts;
    }
    
    private function cssHtmlBuilder($css_files) {
        $styles = '';
        if (is_array($css_files) && !empty($css_files)) {
            foreach ($css_files as $css_file) {
                $styles .= '<link rel="stylesheet" href="'.$css_file .'" media="all" '.'/>'. "\n";
            }
        }
        
        return $styles;
    }
}

?>

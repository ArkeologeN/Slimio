<?php

/**
 * Helps to load Assets dynamically on the run time.
 *
 * @author  HamzaWaqas
 * @access  Protected
 * @package Slimio
 * @name    AssetsLoader
 * @version 1.0
 * 
 */

namespace Slimio\Util;
class AssetsLoader {
    
    
    private static $js_files = array();
    private static $css_files = array();
    
    static function loadJS($filename) {
        $fpath = ASSETS_DIR.'js/'.$filename.'.js';
        if (!file_exists($fpath))
            throw new \Exception('JavaScript File: '.$filename.'.js not found in '.$fpath);
        
        self::$js_files[] = ltrim($fpath,'/');
    }
    
    static function loadCSS($filename) {
        $fpath = ASSETS_DIR.'css/'.$filename.'.css';
        if (!file_exists($fpath))
            throw new \Exception('CSS File: '.$filename.'.css not found in '.$fpath);
        
        self::$css_files[] = ltrim($fpath,'/');
    }
    
    static function getCSS() {
        return self::$css_files;
    }
    
    static function getJS() {
        return self::$js_files;
    }
    
    
}

?>

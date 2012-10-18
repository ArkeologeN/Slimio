<?php


/**
 * Pattern to give a new fresh instance of the circulating classes.
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    Factory
 * @uses    Slimio\Bootstrap, Slimio\Classloader
 * 
 */

namespace Slimio;

use Slimio\Bootstrap;
use Slimio\Classloader;
class Factory  {
    //put your code here
    
    public static function newBoostrapInstance() {
       return \Slimio\Bootstrap::getInstance();
    }
    
    public static function newClassloaderInstance () {
        return Classloader::getInstance();
    }
    
}

?>

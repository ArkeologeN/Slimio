<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of Factory
 *
 * @author alihashmi
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

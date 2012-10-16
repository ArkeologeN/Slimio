<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */

/**
 * Description of Index
 *
 * @author Hamza Waqas
 */

class BL_Index extends Slimio\BusinessLogic  {
    
    
    public function _initialize() {
        
    }
    
    public function helloHandler($fragment=array()) {
        #echo "<pre>"; print_r($fragment); exit;
        $this->transport("hi", "Hamza");
    }
    
    public function byeHandler($fragment = array()) {
        echo "<pre>"; print_r($fragment); exit;
    }

    
    
}

?>

<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */


class Hooking extends Slimio\Hook {
    
    public function after_handler($values) {
        echo ' from hook!';
    }
    
}
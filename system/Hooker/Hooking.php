<?php

/*
 *  Copyright (c) 2012. All Rights Reserved. The PlumTree Group
 *  Code is under development state at The PlumTree Group written by
 *  Hamza Waqas (Mobile Application Developer) at Karachi from MacOSX
 */


class Hooking extends Slimio\ConcreteHook {
    
    
    public function beforeConstructor() {
        parent::beforeConstructor();
        
    }
    
    public function onLaunch() {
        parent::onLaunch();
    }
    
    public function afterLaunch() {
        parent::afterLaunch();
    }
    
    public function beforeLaunch() {
        parent::beforeLaunch();
    }
    
    public function onBusinessLogic() {
        parent::onBusinessLogic();
    }
    
    public function onDataAccess() {
        parent::onDataAccess();
    }
    
    public function onPresentationLoad() {
        parent::onPresentationLoad();
    }
    
}
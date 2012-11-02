<?php

use Slimio\Util\AssetsLoader;
class BL_Index extends Slimio\BusinessLogic  {
    
    
    public function _initialize() {
        
    }
    
    public function helloHandler($fragment=array()) {
        AssetsLoader::loadJS('bootstrap');
        AssetsLoader::loadCSS("bootstrap.min");
        #$this->runHook('after_handler',array('hamza'));
        $this->transport("hi", "Hamza");
    }
    
    public function byeHandler($fragment = array()) {
        echo "<pre>"; print_r($fragment); exit;
    }

}

?>

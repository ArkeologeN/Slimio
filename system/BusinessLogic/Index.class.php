<?php


class BL_Index extends Slimio\BusinessLogic  {
    
    
    public function _initialize() {
        
    }
    
    public function helloHandler($fragment=array()) {
        $this->transport("hi", "Hamza");
    }
    
    public function byeHandler($fragment = array()) {
        echo "<pre>"; print_r($fragment); exit;
    }

}

?>

<?php

/**
 * Interface to be implemented on concrete hook for enabling hooking.
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    IHook
 * 
 */

namespace Slimio;

interface IHook {
    
    
    public function onBusinessLogic();
    public function onDataAccess();
    public function onPresentationLoad();
    public function beforeConstructor();
    public function beforeLaunch();
    public function afterLaunch();
    
}

?>

<?php

namespace Slimio;

use Slimio\Factory;

class Bootstrap  {
    //put your code here
    
    private static $instance = null;
    private $_app = null;
    
    public static function getInstance () {
        if ( ! (self::$instance instanceof \Slimio\Bootstrap))
            self::$instance = new \Slimio\Bootstrap;
        return self::$instance;
    }
    
    public function registerRequestHandler (\Slim\Slim $application) {
        #echo "<pre>"; print_r($application->request()); exit;
        $properties = array();
        $query_params = array();
        $args       = array();
        $method = null;
        try {
            $this->setAppObject($application);
            $path_info = $application->request()->getPathInfo();
            $query_params = $application->request()->get();
            if (strlen($path_info) > 0) {
                $properties = array_values(array_filter(explode('/', $path_info), 'strlen'));
                if (is_array($properties) && array_key_exists(0, $properties)) {
                    $method = rtrim(substr($properties[0], strpos($properties[0], '(')+1, strpos($path_info, ')')),')');//$properties[0];
                    $blalias = substr($properties[0],0, strpos($properties[0], '('));
                    $class_loader = Factory::newClassloaderInstance();
                    $class = $class_loader->loadClass($blalias);
                    $args = array_values($properties);
                    unset($args[0]);
                    if (method_exists($class, $method)) {
                        call_user_func_array(array($class,$method),array(
                            array('query'   => json_encode($query_params),
                                  'arg'     => json_encode($args))
                        ));
                        
                    }
                }
            }
           echo "<pre>"; print_r($properties); exit;
        } catch (Exception $ex) {
            echo "<pre>"; print_r($ex); exit;
        }
    }
    
    protected function start() {
        $this->getAppObject()->run();
    }
    
    private function setAppObject ( $application ) {
        $this->_app = $application;
    }
    
    private function getAppObject () {
        return $this->_app;
    }
    
}

?>

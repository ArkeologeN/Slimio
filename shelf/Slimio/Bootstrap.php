<?php

/**
 * Bootstraps on top of the 3 Tiers for Request Handling.
 *
 * @author  HamzaWaqas
 * @package Slimio
 * @version 1.0
 * @name    Bootstrap
 * 
 */
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
    
    /**
     *
     * @param \Slim\Slim $application Application Object.
     * @throws \Exception 
     */
    public function registerRequestHandler (\Slim\Slim $application) {
        $properties = $query_params = $args = array();
        $method = null;
        try {
            $this->setAppObject($application);
            $path_info = $application->request()->getPathInfo();
            $query_params = $application->request()->get();
            if (strlen($path_info) > 0) {
                $properties = array_values(array_filter(explode('/', $path_info), 'strlen'));
                if (is_array($properties) && array_key_exists(0, $properties)) {
                    $method = rtrim(substr($properties[0], strpos($properties[0], '(')+1, strpos($path_info, ')')),')').Constants::BL_HANDLER_SUFFIX;
                    $blalias = substr($properties[0],0, strpos($properties[0], '('));
                    $class_loader = Factory::newClassloaderInstance();
                    $class_loader->setTemplateDispatcherVO(new \Slimio\Vo\TemplateDispatcher($blalias, $method));
                    $class = $class_loader->loadClass($blalias);
                    $args = array_values($properties);
                    unset($args[0]);
                    $formatted_method = $method;
                    if (method_exists($class, $formatted_method)) {
                        call_user_func_array(array($class,$formatted_method),array(
                            array('query'   => json_encode($query_params),
                                  'arg'     => json_encode($args))
                        ));
                        
                    } else {
                        throw new \Exception('No respective Handler is defined as "'.$method.'"');
                    }
                }
            }
        } catch (Exception $ex) {
            echo "<pre>"; print_r($ex); exit;
        }
    }
    
    /**
     * Starts the request flow. 
     */
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

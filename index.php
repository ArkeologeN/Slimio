<?php 

try {
    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT_DIR", getcwd());    
//    echo "<pre>"; print_r($_SERVER); exit;
    /// Change Path Later for production
    define("ASSETS_DIR", 'http://'.$_SERVER['HTTP_HOST'].'/etcs/Slimio/assets/');
    require 'shelf/Slim/Slim.php';
    require 'shelf/Slimio/Factory.php';

    \Slim\Slim::registerAutoloader();

    $app = new \Slim\Slim();
    $boostrap = \Slimio\Factory::newBoostrapInstance();
    $boostrap->registerRequestHandler($app);
    $boostrap->start();
    //$app->run();

} catch (Exception $ex) {
    echo "<pre>"; print_r($ex); exit;
}

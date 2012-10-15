<?php 

try {
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

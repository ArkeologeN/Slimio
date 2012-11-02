<?php 

try {
    define("DS", DIRECTORY_SEPARATOR);
    define("ROOT_DIR", getcwd());
    define("BASE_URL", $_SERVER['HTTP_HOST']);
    define("ASSETS_DIR", dirname(__FILE__).'/assets/'); // Change it Later.
    require 'shelf/Slim/Slim.php';
    require 'shelf/Slimio/Factory.php';

    \Slim\Slim::registerAutoloader();

    $app = new \Slim\Slim();
    $app->hook('slimio.start', function() use ($app) {
        print 'called'; exit;
    });
    
    #$app->applyHook('slimio.start');
    $boostrap = \Slimio\Factory::newBoostrapInstance();
    $boostrap->registerRequestHandler($app);
    $boostrap->start();
    //$app->run();

} catch (Exception $ex) {
    echo "<pre>"; print_r($ex); exit;
}

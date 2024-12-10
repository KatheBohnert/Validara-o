<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

defined('APP_PATH') || define('APP_PATH', str_replace("\\", "/", realpath('.')));

// Load composer autoloader
require APP_PATH . "/vendor/autoload.php";

// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerNamespaces(
        [
            'Store\Toys' => __DIR__ . '/models/',
            'App\Controllers' => __DIR__ . '/controllers/',
            'App\Utils' => __DIR__ . '/utils/',
        ]
);

$loader->register();

$adapter = new Stream('/var/log/app/main.log');
$logger = new Logger(
        'messages',
        [
    'main' => $adapter,
        ]
);

use App\Controllers\RobotController;
/* use App\Controllers\CariController; */
use App\Controllers\MtController;
use App\Controllers\PrestadoresController;


$di = new FactoryDefault();

// Set up the database service
$di->set(
        'db', function () {
            return new PdoMysql([
        'host' => 'localhost',
        'username' => 'root',
        'password' => '#Defytek531!',
        'dbname' => 'robotics',
            ]);
        }
);

$di->setShared('logger', function () {
    $adapter = new Stream('/var/log/app/main.log');
    return new Logger(
    'messages',
    [
'main' => $adapter,
    ]
    );
});

// Create and bind the DI to the application
$app = new Micro($di);

$controller = new RobotController();
/* $caricontroller = new CariController(); */
$mtcontroller = new MtController(); 
$prestadorescontroller = new PrestadoresController();

// Retrieves all robots
$app->get(
        '/api/robots',
        function () use ($app, $controller) {
            $app->getSharedService('logger')->info("Getting all robots");
            $controller->getRobots($app);
        }
);

// Searches for robots with $name in their name
$app->get(
        '/api/robots/search/{name}',
        function ($name) use ($app, $controller) {
            $app->getSharedService('logger')->info("Searching robots by name $name");
            $controller->getRobotsByName($app, $name);
        }
);

// Retrieves robots based on primary key
$app->get(
        '/api/robots/{id:[0-9]+}',
        function ($id) use ($app, $controller) {
            $app->getSharedService('logger')->info("Getting robot by id $id");
            return $controller->getRobotById($app, $id);
        }
);

// Adds a new robot
$app->post(
        '/api/robots',
        function () use ($app, $controller) {
            return $controller->saveRobot($app);
        }
);

// Updates robots based on primary key
$app->put(
        '/api/robots/{id:[0-9]+}',
        function ($id) use ($app, $controller) {
            return $controller->updateRobot($app, $id);
        }
);

// Deletes robots based on primary key
$app->delete(
        '/api/robots/{id:[0-9]+}',
        function ($id) use ($app, $controller) {
            return $controller->deleteRobot($app, $id);
        }
);

/* $app->post(
        '/cari/cellverification',
        function () use ($app, $caricontroller) {
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $caricontroller->validateCellphone($app);
        }
);
*/

$app->post(
        '/mt/process',
        function () use ($app, $mtcontroller) {
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $mtcontroller->process($app);
        }
);
 
$app->post(
    '/prest/process',
    function () use ($app, $prestadorescontroller) {
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $prestadorescontroller->process($app);
    }
);



$app->handle($app->request->get('_url', 'striptags'));
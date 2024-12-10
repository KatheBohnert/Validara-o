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
use App\Controllers\Mt2Controller;
use App\Controllers\PrestadoresController;
use App\Controllers\PrestadoresPreproduccion;
use App\Controllers\EpmController;
use App\Controllers\IvantiController;
use App\Controllers\ViajesExitoController;
use App\Controllers\ComfandiController;
use App\Controllers\ComfandiControllerPreproduccion;
use App\Controllers\DpsController;
use App\Controllers\IcetexController;
use App\Controllers\ComfandiCarritoController;
use App\Controllers\BancoBogotaController;
use App\Controllers\JuanviController;
use App\Controllers\CristianController;
use App\Controllers\ComfandiCarritoControllerPreproduccion;
use App\Controllers\SantiagoController;
use App\Controllers\TuCalendarController;
use App\Controllers\SalinasController;
use App\Controllers\PreprodBdBController;
use App\Controllers\OracleResponsysController;
use App\Controllers\ArusController;
use App\Controllers\SoundlutionsUtilsController;
use App\Controllers\EnlaceOperativoController;
use App\Controllers\ZurichController;
use App\Controllers\KeraltyOpticaController;
use App\Controllers\BancoCompartamosController;
use App\Controllers\IvantiDemoCarvajalController;
use App\Controllers\ZurichFordController;
use App\Controllers\ColsanitasVideollamadaController;
use App\Controllers\SanitasEpsVideoCallController;
use App\Controllers\ColsanitasVideollamadaPreprodController;
use App\Controllers\SanitasEpsVideoCallPreprodController;
use App\Controllers\JuanviPreprodController;
use App\Controllers\KeraltyRecursosHumanosController;
use App\Controllers\KeraltyRecursosHumanosPreController;
use App\Controllers\JhonController;
use App\Controllers\KatheController;

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

/* $caricontroller = new CariController(); */

// Retrieves all robots
$app->get(
        '/api/robots',
        function () use ($app) {
            $controller = new RobotController();
            $app->getSharedService('logger')->info("Getting all robots");
            $controller->getRobots($app);
        }
);

// Searches for robots with $name in their name
$app->get(
        '/api/robots/search/{name}',
        function ($name) use ($app) {
            $controller = new RobotController();
            $app->getSharedService('logger')->info("Searching robots by name $name");
            $controller->getRobotsByName($app, $name);
        }
);

// Retrieves robots based on primary key
$app->get(
        '/api/robots/{id:[0-9]+}',
        function ($id) use ($app) {
            $controller = new RobotController();
            $app->getSharedService('logger')->info("Getting robot by id $id");
            return $controller->getRobotById($app, $id);
        }
);

// Adds a new robot
$app->post(
        '/api/robots',
        function () use ($app) {
            $controller = new RobotController();
            return $controller->saveRobot($app);
        }
);

// Updates robots based on primary key
$app->put(
        '/api/robots/{id:[0-9]+}',
        function ($id) use ($app, $controller) {
            $controller = new RobotController();
            return $controller->updateRobot($app, $id);
        }
);

// Deletes robots based on primary key
$app->delete(
        '/api/robots/{id:[0-9]+}',
        function ($id) use ($app, $controller) {
            $controller = new RobotController();
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
        function () use ($app) {
            $mtcontroller = new MtController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $mtcontroller->process($app);
        }
);

$app->post(
        '/mt2/process',
        function () use ($app) {
            $mt2controller = new Mt2Controller();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $mt2controller->process($app);
        }
);

$app->post(
        '/prest/process',
        function () use ($app) {
            $prestadorescontroller = new PrestadoresController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $prestadorescontroller->process($app);
        }
);
$app->post(
        '/prestadores_preproduccion/process',
        function () use ($app) {
            $prestadoresPreproduccion = new PrestadoresPreproduccion();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $prestadoresPreproduccion->process($app);
        }
);

$app->post(
        '/epm/process',
        function () use ($app) {
            $epmcontroller = new EpmController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $epmcontroller->process($app);
        }
);

$app->post(
        '/ivanti/process',
        function () use ($app) {
            $ivanticontroller = new IvantiController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $ivanticontroller->process($app);
        }
);

$app->post(
        '/viajesExito/process',
        function () use ($app) {
            $viajesExitoController = new ViajesExitoController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $viajesExitoController->process($app);
        }
);

$app->post(
        '/comfandi/process',
        function () use ($app) {
            $comfandiController = new ComfandiController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $comfandiController->process($app);
        }
);

$app->post(
        '/dps/process',
        function () use ($app) {
            $dpsController = new DpsController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $dpsController->process($app);
        }
);

$app->post(
        '/ice/process',
        function () use ($app) {
            $icetexController = new IcetexController();
            $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
            $icetexController->process($app);
        }
);

$app->post(
    '/comfandi_carrito/process',
    function () use ($app) {
        $comfandiCarritoController = new ComfandiCarritoController();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $comfandiCarritoController->process($app);
    }
);

$app->post(
    '/banco_bogota/process',
    function () use ($app) {
        $bancoBogotaController = new BancoBogotaController();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $bancoBogotaController->process($app);
    }
);

$app->post(
    '/juanviController/process',
    function () use ($app) {
        $juanviController = new JuanviController();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $juanviController->process($app);
    }
);

$app->post(
    '/cristianController/process',
    function () use ($app) {
        $cristianController = new CristianController();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $cristianController->process($app);
    }
);

$app->post(
    '/carritoPrepro/process',
    function () use ($app) {
        $carritoPreproController = new ComfandiCarritoControllerPreproduccion();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $carritoPreproController->process($app);
    }
);

$app->post(
    '/comfandi_preproduccion/process',
    function () use ($app) {
        $comfandiPreproController = new ComfandiControllerPreproduccion();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $comfandiPreproController->process($app);
    }
);

$app->post(
    '/santiagoController/process',
    function () use ($app) {
        $santiagoController = new SantiagoController();
        $app->getSharedService('logger')->info("Got request: " . print_r($app->request->get(), true));
        $santiagoController->process($app);
    }
);

$app->post(
    '/TuCalendarController/process',
    function () use ($app) {
        $tuCalendarController = new TuCalendarController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $tuCalendarController->process($app);
    }    
);

$app->post(
    '/slinas/process',
    function () use ($app) {
        $salinasController = new SalinasController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $salinasController->process($app);
    }    
);

$app->post(
    '/preprod_bdb/process',
    function () use ($app) {
        $bdbController = new PreprodBdBController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $bdbController->process($app);
    }
);

$app->post(
    '/oracle_responsys/process',
    function () use ($app) {
        $oracleResponsysController = new OracleResponsysController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $oracleResponsysController->process($app);
    }
);

$app->post(
    '/arus/process',
    function () use ($app) {
        $arusController = new ArusController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $arusController->process($app);
    }
);

$app->post(
    '/utils/process',
    function () use ($app) {
        $utilsController = new SoundlutionsUtilsController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $utilsController->process($app);
    }
);

$app->post(
    '/enlace/process',
    function () use ($app) {
        $enlaceController = new EnlaceOperativoController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $enlaceController->process($app);
    }
);

$app->post(
    '/zurich/process',
    function () use ($app) {
        $zurichController = new ZurichController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $zurichController->process($app);
    }
);

$app->post(
    '/keraltyOptica/process',
    function () use ($app) {
        $keraltyOpticaController = new KeraltyOpticaController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $keraltyOpticaController->process($app);
    }
);
$app->post(
    '/compartamos/process',
    function () use ($app) {
        $bancoCompartamosController = new BancoCompartamosController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $bancoCompartamosController->process($app);
    }
);

$app->post(
    '/ivanti_carvajal/process',
    function () use ($app) {
        $ivantiDemoCarvajalController = new IvantiDemoCarvajalController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $ivantiDemoCarvajalController->process($app);
    }
);

$app->post(
    '/zurich_ford/process',
    function () use ($app) {
        $zurichFordController = new ZurichFordController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $zurichFordController->process($app);
    }
);

$app->post(
    '/colsanitas-videollamada/process',
    function () use ($app) {
        $colsanitasVideollamadaController = new ColsanitasVideollamadaController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $colsanitasVideollamadaController->process($app);
    }
);

$app->post(
    '/epsSanitas-videollamada/process',
    function () use ($app) {
        $sanitasEpsVideoCallController = new SanitasEpsVideoCallController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $sanitasEpsVideoCallController->process($app);
    }
);

$app->post(
    '/pre-colsanitas-videollamada/process',
    function () use ($app) {
        $colsanitasVideollamadaPreprodController = new ColsanitasVideollamadaPreprodController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $colsanitasVideollamadaPreprodController->process($app);
    }
);

$app->post(
    '/pre-epsSanitas-videollamada/process',
    function () use ($app) {
        $sanitasEpsVideoCallPreprodController = new SanitasEpsVideoCallPreprodController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $sanitasEpsVideoCallPreprodController->process($app);
    }
);

$app->post(
    '/pre-juanvicontroller/process',
    function () use ($app) {
        $juanviPreprodController = new JuanviPreprodController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $juanviPreprodController->process($app);
    }
);

$app->post(
    '/keralty_rrhh_controller/process',
    function () use ($app) {
        $keraltyRecursosHumanos = new KeraltyRecursosHumanosController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $keraltyRecursosHumanos->process($app);
    }
);

$app->post(
    '/pre_keralty_rrhh_controller/process',
    function () use ($app) {
        $preKeraltyRecursosHumanos = new KeraltyRecursosHumanosPreController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $preKeraltyRecursosHumanos->process($app);
    }
);

$app->post(
    '/john-controller/process',
    function () use ($app) {
        $johnController = new JhonController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $johnController->process($app);
    }
);

$app->post(
    '/kathe-controller/process',
    function () use ($app) {
        $katheController = new KatheController();
        $app->getSharedService('logger')->info('Got request: ' . print_r($app->request->get(), true));
        $katheController->process($app);
    }
);

$app->handle($app->request->get('_url', 'striptags'));
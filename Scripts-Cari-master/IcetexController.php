<?php
namespace App\Controllers;

require_once '/var/www/app/controllers/lib/nusoap.php';

class IcetexController
{

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $chat_identification = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'convesartion_id' => $_POST['convesartion_id'],
        ];
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];
        $token = $_POST['token'];
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) { //operation
                case "allCat":
                    $response = $this->allCat($app);
                    echo $response;
                    break;
                case "login":
                    $response = $this->login($app);
                    echo $response;
                    break;
                case "creacionCaso":
                    $response = $this->creacionCaso($app);
                    echo $response;
                    break;
                case "consultaCaso":
                    $response = $this->consultaCaso($app);
                    echo $response;
                    break;
                case "listCategoria":
                    $response = $this->listCategoria($app);
                    echo $response;
                    break;
                case "listServicioCategoria":
                    $response = $this->listServicioCategoria($app);
                    echo $response;
                    break;
                case "listServicioProyecto":
                    $response = $this->listServicioProyecto($app);
                    echo $response;
                    break;			    
                case "nameCats":
                    $response = $this->nameCats($app);
                    echo $response;
                    break;			    
			    
			   
                default:
                    echo ("Es necesario indicar el operation");
                    break;

            }
        } else {
            $response = "useProduction and token is mandatory!";
            echo $response;
        }
    }

    public function allCat($app)
    {
	$tokenSms = "Basic V1I2TUk3NzhWMkozN04zSkI2RVNSRVFRVUlYTkszWVE6";
        $url = "https://comfandi-test.felinux.co/marketplace/api/categories/2?output_format=JSON";    
        $headers = array("Authorization" => $tokenSms);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, '', "GET", $token, $headers, $params_error_report, "ComfandiCarrito");

		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
	    
        return json_encode($response_object);
    }
	
    public function nameCats($app)
    {
	$idCat = $_POST['idCat'];
	$tokenSms = "Basic V1I2TUk3NzhWMkozN04zSkI2RVNSRVFRVUlYTkszWVE6";
        $url = "https://comfandi-test.felinux.co/marketplace/api/categories/".$idCat."?output_format=JSON";    
        $headers = array("Authorization" => $tokenSms);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, '', "GET", $token, $headers, $params_error_report, "ComfandiCarrito");

		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
	    
        return json_encode($response_object);
    }

    public function login($app)
    {
        $nameController = 'IcetexController';
        $nameFunction = "login()";
        $url = "http://172.31.86.182:10101/asdkapi/api/v8.6/user/login";
        $request = '[
	{"Field":"username","Value":"integracion"},
	{"Field":"password","Value":"Icetex2020*"}
	]';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Icetex");
        $datos = '{
	"UserId":"' . $response_object[0]->Value . '",
	"SessionID":"' . $response_object[1]->Value . '"
	}';
        return $datos;
    }

    public function creacionCaso($app)
    {
        $nameController = 'IcetexController';
        $nameFunction = "creacionCaso()";

        $tokenIce = $_POST['sessionId'];
        $userId = $_POST['userID'];
        $CategoryId = $_POST['CategoryId'];
        $GroupId = $_POST['GroupId'];
        $ServiceId = $_POST['ServiceId'];
        $SlaId = $_POST['SlaId'];

        //Quemadas temporalmente
        $CustomerId = $_POST['CustomerId'];
        $RegistryTypeId = $_POST['RegistryTypeId'];
        $Subject = $_POST['Subject'];
        $UrgencyId = $_POST['UrgencyId'];
        $Description = $_POST['Description'];

        $url = "http://172.31.86.182:10101/asdkapi/api/v8.6/item/add/1";
        $request = '[
	 {"Field":"AuthorId","Value":' . $userId . '},
	 {"Field":"CategoryId","Value":' . $CategoryId . '},
	 {"Field":"CustomerId","Value":8},
	 {"Field":"CompanyId ","Value":45},
	 {"Field":"Description","Value":"Item description"},
	 {"Field":"GroupId","Value":' . $GroupId . '},
	 {"Field":"ProjectId","Value":4},
	 {"Field":"RegistryTypeId","Value":6},
	 {"Field":"ServiceId","Value":' . $ServiceId . '},
	 {"Field":"Subject","Value":"Item subject"},
	 {"Field":"SlaId","Value":' . $SlaId . '},
	 {"Field":"UrgencyId","Value":3}
	]
	';

        $headers = array("Authorization" => $tokenIce);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Icetex");
        $datos = '{
	"itemId":"' . $response_object[0]->Value . '",
	"qs":"' . $response_object[1]->Value . '",
	"composedItemId":"' . $response_object[2]->Value . '"
	}';
        return $datos;
    }

    public function consultaCaso($app)
    {
        $nameController = 'IcetexController';
        $nameFunction = "consultaCaso()";

        $tokenIce = $_POST['sessionId'];
        $userId = $_POST['userID'];
        $itemId = $_POST['itemId'];
        $itemType = $_POST['itemType'];
        $level = $_POST['level'];

        $url = "http://172.31.86.182:10101/asdkapi/api/v8.6/item/" . $itemId . "/" . $itemType . "/" . $userId . "?level=" . $level;

        $headers = array("Authorization" => $tokenIce);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, "Icetex");

        return json_encode($response_object);
    }

    public function listCategoria($app)
    {
        $nameController = 'IcetexController';
        $nameFunction = "listCategoria()";

        $tokenIce = $_POST['sessionId'];
        $userId = $_POST['userID'];
        $projectId = $_POST['projectId'];
        $itemType = $_POST['itemType'];

        $url = "http://172.31.86.182:10101/asdkapi/api/v8.6/project/" . $projectId . "/" . $itemType . "/category/list";

        $headers = array("Authorization" => $tokenIce);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, "Icetex");

        return json_encode($response_object);
    }

    public function listServicioCategoria($app)
    {
        $nameController = 'IcetexController';
        $nameFunction = "listCategoria()";

        $tokenIce = $_POST['sessionId'];
        $categoryId = $_POST['categoryId'];
        $entityId = $_POST['entityId'];

        $url = "http://172.31.86.182:10101/asdkapi/api/v8.6/category/" . $categoryId . "/services";

        $headers = array("Authorization" => $tokenIce);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, "Icetex");

        return json_encode($response_object);
    }

    public function listServicioProyecto($app)
    {
        $nameController = 'IcetexController';
        $nameFunction = "listCategoria()";
        $tokenIce = $_POST['sessionId'];
        $projectId = $_POST['projectId'];

        $url = "http://172.31.86.182:10101/asdkapi/api/v8.6/project/" . $projectId . "/services";

        $headers = array("Authorization" => $tokenIce);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, "Icetex");

        return json_encode($response_object);
    }

}

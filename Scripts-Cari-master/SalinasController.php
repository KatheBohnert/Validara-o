<?php
namespace App\Controllers;

require_once '/var/www/app/controllers/lib/nusoap.php';

class SalinasController
{
  private $nameLog = "SalinasController";
    public function process(\Phalcon\Mvc\Micro$app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "SalinasController";
        $chat_id = $_POST['chat_identification'];
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
                case "getToken":
                   $response = $this->getToken($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
		case "changePass":
                   $response = $this->changePass($app, $params_error_report, $nameController, $chat_id);
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

    public function getToken($app, $params_error_report, $nameController, $chat_id , $name)
    {
	$nameFunction = "getToken";
	$url="https://mbgs.gruposalinas.com.mx/WebServiceChatbot/backoffice/chatbot/v1/api/token/generate";
	$headers = array("x-canal" => "teams");
	$request = '{"nombreEmpleado": "'.$name.'"}';
	$response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog,$datos);    
       	$result = $response_object->token;
	    
	 return $result;
    }
	
    public function changePass($app, $params_error_report, $nameController, $chat_id )
    {
	$name = $_POST['nameUser'];
	$password = $_POST['password'];
	$token = $this->getToken($app, $params_error_report, $nameController, $chat_id, $name);
	$nameFunction = "changePass";
	$url="https://mbgs.gruposalinas.com.mx/WebServiceChatbot/backoffice/chatbot/v1/api/account/change_password";
	$headers = array("Authorization" => "Bearer ".$token,"x-canal" => "teams");
	$request = '{"password": "'.$password.'"}';
	$response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "PUT", $token, $headers, $params_error_report, $this->nameLog,$datos);    
       return json_encode($response_object);
    }

}

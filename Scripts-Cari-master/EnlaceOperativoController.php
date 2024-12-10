<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of CariController
 *
 * @author rmelo
 */
class EnlaceOperativoController
{

    private $nameLog = "EnlaceOperativoController";

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "EnlaceOperativoController";
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
                case "validatePassword":
                    $response = $this->validateUser($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getToken":
                    $response = $this->getToken($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getTokenCurl":
                    $response = $this->getTokenCurl($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "dataUsers":
                    $response = $this->dataUsers($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getFormUser":
                    $response = $this->getFormUser($app, $params_error_report, $nameController, $chat_id);
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
    public function validateUser($app, $params_error_report, $nameController, $chat_id)
    {
        $password = $_POST['userPasword'];
        if ($password == '123456') {
            $validPasword = 1;
        } else {
            $validPasword = 0;
        }

        $datos = array(
            "user_pasword" => $password,
        );

        $var = '{
            "IngresoValido": "' . $validPasword . '"
        }';

        return $var;
    }

    public function getToken($app, $params_error_report, $nameController, $chat_id)
    {
        $url = "https://172.31.86.182:1446/api/v1/signin";
        $nameFunction = "getToken";
        $username = "chatbot";
        $password = "&%53dQAnCijA";
        $request = '{
            "username" : "' . $username . '",
            "password": "' . $password . '"
        }';
        $datos = array(
            "username" => $username,
            "password" => $password,
        );
        // $headers = array("Authorization" => $tokenSms);
        $response_object = \App\Utils\StaticExecuteServicePreproduccion::executeServicePreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);
        if ($response_object === false) {
            return;
        }
        print_r($response_object);

    }

    public function getTokenCurl($app, $params_error_report, $nameController, $chat_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://172.31.86.182:1446/api/v1/signin',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
        "username" : "chatbot",
        "password": "&%53dQAnCijA"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function dataUsers($app, $params_error_report, $nameController, $chat_id)
    {
        $url = "https://pruebascariia.integracionesarus.com/Cotizantes";
        $tipo_documento = $_POST['tipo_documento'];
        $num_documento = $_POST['num_documento'];
        $nameFunction = "dataUsers";

        $request = '{
            "tipo_documento" : "' . $tipo_documento . '",
            "num_documento": "' . $num_documento . '"
        }';
        $datos = array(
            "X-API-KEY" => "CaJKhy97KXghWU05o6orfNs4V883GeHLUEdnBZXI",
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
        );
        $headers = array("X-API-KEY" => "CaJKhy97KXghWU05o6orfNs4V883GeHLUEdnBZXI");
        $response_object = \App\Utils\StaticExecuteServicePreproduccion::executeServicePreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);
        if ($response_object === false) {
            return;
        }
        return json_encode($response_object);

    }

    public function getFormUser($app, $params_error_report, $nameController, $chat_id)
    {
        $userIdentification = $_POST['userIdentification'];
        $typeIdentification = $_POST['typeIdentification'];
        $url = 'https://qa.cariai.com/enlace/conectarBdMysql4?operation=' . $userIdentification;
        $nameFunction = "getFormUser";

        $request = '{
            "typeIdentification" : "' . $typeIdentification . '",
            "userIdentification": "' . $userIdentification . '"
        }';

        $datos = array(
            "typeIdentification" => $typeIdentification,
            "userIdentification" => $userIdentification,
        );

        $headers = array("TYPEREQUEST" => "GET");
        $response_object = \App\Utils\StaticExecuteServicePreproduccion::executeServicePreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);
        if ($response_object === []) {
            return '{
                "planillaGuardada": "0"
            }';
        }
       
        if(strlen($response_object[0]->nmnumero_planilla)>8){
            $response_object[0]->tipoPago='Efectivo';
            $response_object[0]->planillaGuardada='1';
        }else{
            $response_object[0]->tipoPago = 'Electronico';
            $response_object[0]->planillaGuardada='1';
        }

        return json_encode($response_object[0]);
    }
}

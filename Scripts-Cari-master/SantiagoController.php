<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use DateTime;
use DateTimeZone;
use stdClass;

/**
 * Description of CariController
 *
 * @author rmelo
 */
class SantiagoController {

    //put your code here
    public $nameLog = "SantiagoController";
    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "SantiagoController";
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
                case "getEndpoints":
                    $response = $this->getEndpoints($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getServiceInfo":
                    $response = $this->getServiceInfo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "dateHandler":
                    $response = $this->dateHandler($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "createProductRequest":
                    $response = $this->createProductRequestOracle($app, $params_error_report, $nameController, $chat_id);
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

    public function getEndpoints($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'SantiagoController';
        $nameFunction = "getEndpoints()";
        $url = "https://rickandmortyapi.com/api";
        $headers = array("Content-Type" => "application/json");

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, '', "GET", null, $headers, $params_error_report);

        return json_encode($response_object);
    }

    public function testDandoTicket($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'SantiagoController';
        $nameFunction = "getEndpoints()";

        $headers = [
            'Authorization' => 'Basic bWFyY28uanVsaW9Ac29tb3NkYW5kby5jb20vdG9rZW46VnZldG1DR3pVc0lWSHRTMUpadllhZERmQ0FvQWlRcnlUTTgyd1RleQ==',
            'Content-Type' => 'application/json',
            'Cookie' => '__cfruid=46419e9b3ebe55103b15533b860505cb09b951e2-1675973357; _zendesk_cookie=BAhJIhl7ImRldmljZV90b2tlbnMiOnt9fQY6BkVU--459ed01949a36415c1716b5711271c3d08918307'
        ];
        
        

    }

    public function getServiceInfo($app, $params_error_report, $nameController, $chat_id)
    {
        ///Estos son las variables tipo post para enviarlas como parte del body del controlador
        $chat_identification = $_POST['chat_id'];
        $nameController = 'SantiagoController';
        $nameFunction = "getServiceInfo()";
        ///Estas son las variables necesarias para consumir el servicio pues hacen parte de la peticion get (url)
        $limit = $_POST['limit'];
        $offset = $_POST['offset'];
        $search = $_POST['companyId'];
        $email = $_POST['email'];
        
        $datos = array(
            "search_term" => $search,
            "limit" => $limit,
            "offset" => $offset
        );

        $headers = array('Content-Type: application/json');

        $baseUrl = $_POST['url'];
        #$url = 'https://api.tucalendar.com/api/requests_list/?limit='.$limit.'&offset='.$offset.'&search='.$search;
        $url = $baseUrl.'?limit='.$limit.'&offset='.$offset.'&search='.$search.'&user__email='.$email;

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $resultado = $data['results'];
        $resultadoSize = count($resultado);

        $dataCariArray = new \stdClass();

        for ($i = 0; $i < $resultadoSize; $i++){
            $hostFirstName = $resultado[$i]['hosts']['first_name'];
            $hostLastName = $resultado[$i]['hosts']['last_name'];
            $hostFullName = $hostFirstName.' '.$hostLastName;
            $nombreServicio = $resultado[$i]['service']['name'];
            $dateInit = $resultado[$i]['start_time'];
            $dateInit2 = $resultado[$i]['finish_time'];
            $date = new DateTime($dateInit);
            $date2 = new DateTime($dateInit2);
            $convertedDate1 = $date->setTimezone(new DateTimeZone('America/Mexico_City'));
            $convertedDate2 = $date2->setTimezone(new DateTimeZone('America/Mexico_City'));
            $startTime = $convertedDate1->format('d-m-Y H:i');
            $finishTime = $convertedDate2->format('d-m-Y H:i');
            $etiquetaServicio = $nombreServicio.' - '.$startTime;
            
            // aquí se asignan los datos en el array
            //$cariDataArray->arrayDinamico[$j]->cardId = $actArray[$j];
            $dataCariArray->arrayDinamico[$i]->fechaInicio = $startTime;
            $dataCariArray->arrayDinamico[$i]->fechaFin = $finishTime;
            $dataCariArray->arrayDinamico[$i]->hostName = $hostFullName;
            $dataCariArray->arrayDinamico[$i]->nombreServicio = $etiquetaServicio;
            $dataCariArray->arrayDinamico[$i]->precioServicio = $resultado[$i]['service']['price'];
            $dataCariArray->arrayDinamico[$i]->descripcionServicio = $resultado[$i]['service']['description'];
            $dataCariArray->arrayDinamico[$i]->requerimientosServicio = $resultado[$i]['service']['requirements'];
            $dataCariArray->arrayDinamico[$i]->tipoServicio = $resultado[$i]['service']['service_type'];         
        }
        
        

        return \GuzzleHttp\json_encode($dataCariArray);

    }


    public function dateHandler($app, $params_error_report, $nameController, $chat_id){
        
        $setFecha = $_POST['fecha'];
        $setHora = $_POST['hora'];

        date_default_timezone_set("America/Bogota");
        $fechaFinal = $setFecha.' '.$setHora;
        $fechaOficial = date_create($fechaFinal);

        print_r($fechaFinal);
        print_r($fechaOficial);
        return date_format($fechaOficial,"d-M-Y H:i:s");
        

    }

    public function createProductRequestOracle($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'SantiagoController';//cambiar en oracle
        $nameFunction = "createProductRequest()";

        //Headers Post
        $token = $_POST['tokenAuth']; //copiar de funciones del controlador en el orden en el que estan
        $guid = $_POST['rquId']; //Este campo se copia de aquí
        $apiKey = $_POST['xApiKey']; //copiar de funciones del controlador en el orden en el que estan
        
        //Body Post (todo se copia)
        $docType = $_POST['docType'];
        $idNum = $_POST['idNum'];
        $lastName = $_POST['primerApellido'];
        $firstName = $_POST['primerNombre'];
        $productLine = $_POST['bin_line'];
        $campainId = $_POST['campaing_id'];
        $term = $_POST['plazoTermino'];
        $nmRateInit = $_POST['nm_rate'];
        $amInit = $_POST['aproved_value'];

        $nmRate = floatval(str_replace(',', '.', $nmRateInit));
        $nmRate = number_format($nmRate, 2);
        $amt = filter_var($amInit, FILTER_SANITIZE_NUMBER_INT);
        //No olvidar poner en datos array todos los campos post del body (copiar todo)
        $datos = array(
            'tokenAuth' => $token,
            'rquId' => $guid,
            'xApiKey' => $apiKey,
        );

        $initialDate1 = date('Y-m-d', strtotime('now'));
        $initialDate2 = date('H:i:s', strtotime('now'));
        $finalDate = $initialDate1. 'T'.$initialDate2;
        

        $headers = [
            'Authorization: '.$token,
            'X-RqUID: '.$guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 127.0.0.1',
            'X-BankId: 001',
            'X-ClientDt:'.$finalDate,
            'Content-Type: application/json',
            'x-api-key:'.$apiKey,
        ];

       
        $url = 'https://k91zkwrc65.execute-api.us-east-1.amazonaws.com/qa/customers/products/request';

        $request = '{
            "PersonInfo": {
              "GovIssueIdentType": "'.$docType.'",
              "IdentSerialNum": "'.$idNum.'",
              "PersonName": {
                "LastName": "'.$lastName.'",
                "FirstName": "'.$firstName.'"
              }
            },
            "ProductDetail": {
              "ProductLineId": "'.$productLine.'",
              "CampaignId": "'.$campainId.'",
              "Term": "'.$term.'",
              "Rate": "'.$nmRate.'",
              "Amt": "'.$amt.'"
            }
          }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos);  
        
        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $codeRequest = $data['CodeRequest'];

        $var = '{
            "statusCode":"'.$statusCode.'",
            "statusDesc":"'.$statusDesc.'",
            "codeRequest":"'.$codeRequest.'"
        }';

        ///return $var;
        
        return $nmRate;
    }




}

    
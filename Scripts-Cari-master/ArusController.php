<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use Utils\SetLogs;

/**
 * Description of CariController
 *
 * @author rmelo
 */
class ArusController {

    private $nameLog = "ArusController";

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "ArusController";
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

                case "serviceRequest":
                    $response = $this->serviceRequest($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;

                case "incidentRequest":
                    $response = $this->serviceRequest($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;
                case "editTicket":
                    $response = $this->editTicket($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;
                case "getInfo":
                    $response = $this->getInfo($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;
                case "changePassword":
                    $response = $this->changePassword($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;
                case "decoderAES":
                    $response = $this->decoderAES($app, $params_error_report, $nameController, $chat_id,$operation);
                    echo $response;
                    break;
                case "validateName":
                    $response = $this->validateName($app, $params_error_report, $nameController, $chat_id,$operation);
                    echo $response;
                    break;
                case "generateQuestions":
                    $response = $this->generateQuestions($app, $params_error_report, $nameController, $chat_id,$operation);
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

    private function serviceRequest($app, $params_error_report, $nameController, $chat_id, $operation)
    {
        // Chatbot variables
        $nameController = "ArusController";
        $nameFunction = "serviceRequest()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];

        // Body variables
        $requester_id = $_POST['requester_id'];
        $user_auth_token = $_POST['user_auth_token'];
        $slice_token = $_POST['slice_token'];
        $csm_app_url = $_POST['csm_app_url'];
        $webservice_user_name = $_POST['webservice_user_name'];
        $webservice_user_password = $_POST['webservice_user_password'];
        $requester_user_name = $_POST['requester_user_name'];
        $requested_for_user_name = $_POST['requested_for_user_name'];
        $assigned_group = $_POST['assigned_group'];
        $affected_service_id = $_POST['affected_service_id'];
        $source = $_POST['source'];
        $type_name = $_POST['type_name'];
        $description = $_POST['description'];
        $categorization = $_POST['categorization'];
        $description_long = $_POST['description_long'];
        $nombre_contacto = $_POST['nombre_contacto'];
        $baseUrl = $_POST['baseUrl']; // https://csmstaging.serviceaide.com/csmconnector/
        $cause = $_POST['cause'];
        $resolution = $_POST['resolution'];

        if ($operation == 'incidentRequest') {
            $url = $baseUrl . 'Incident';
        } elseif ($operation == 'serviceRequest') {
            $url = $baseUrl . 'ServiceRequest';
        }

        $datos = array(
            "user_auth_token" => $user_auth_token,
            "slice_token" => $slice_token,
            "csm_app_url" => $csm_app_url,
            "webservice_user_name" => $webservice_user_name,
            "webservice_user_password" => $webservice_user_password,
            "requester_user_name" => $requester_user_name,
            "requested_for_user_name" => $requested_for_user_name,
            "assigned_group" => $assigned_group,
            "affected_service_id" => $affected_service_id,
            "source" => $source,
            "type_name" => $type_name,
            "description" => $description,
            "categorization" => $categorization,
            "description_long" => $description_long,
            "nombre_contacto" => $nombre_contacto,
            "url" => $url,
            "cause" => $cause,
            "resolution" => $resolution
            );

        $request = '{
            "RequesterID": "'.$requester_id.'",
            "RequesterUserName": "'.$requester_user_name.'",
            "RequestedForUserName": "'.$requested_for_user_name.'",
            "AssignedGroup": "'.$assigned_group.'",
            "AffectedServiceID": "'.$affected_service_id.'",
            "Source": "'.$source.'",
            "TypeName": "'.$type_name.'",
            "Description": "'.$description.'",
            "Categorization": "'.$categorization.'",
            "DescriptionLong": "'.$description_long.'",
            "CustomAttributes":{
                "Nombre de contacto": "'.$nombre_contacto.'"
            },
            "Cause": "'.$cause.'",
            "Resolution" : "'.$resolution.'"
        }';


        $headers = array(
            'user_auth_token : '.$user_auth_token.'',
            'slice_token : '.$slice_token.'',
            'csm_app_url: '.$csm_app_url.'',
            'webservice_user_name : '.$webservice_user_name.'',
            'webservice_user_password : '.$webservice_user_password.'',
            'Content-Type: application/json'
        );        

        $response_object = \App\Utils\StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos, $tipoControlador = 'Arus', $user_agent = $webservice_user_name);
        $data = json_decode($response_object, true);

        $ticketIdentifier = $data['data']['TicketIdentifier'];
        $ticketTypeId = $data['data']['TicketTypeId'];
        $nonTranslatedTicketStatus = $data['data']['NonTranslatedTicketStatus'];
        $ticketStatus = $data['data']['TicketStatus'];

        $var = '{
            "ticketNumber": "'.$ticketIdentifier.'",
            "ticketTypeId": "'.$ticketTypeId.'",
            "nonTranslatedTicketStatus": "'.$nonTranslatedTicketStatus.'",
            "ticketStatus": "'.$ticketStatus.'"
        }';

        return $var;
    }

    private function editTicket($app, $params_error_report, $nameController, $chat_id, $operation)
    {
        // Chatbot variables
        $nameController = "ArusController";
        $nameFunction = "editTicket()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];

        // Body variables
        $requester_id = $_POST['requester_id'];
        $user_auth_token = $_POST['user_auth_token'];
        $slice_token = $_POST['slice_token'];
        $csm_app_url = $_POST['csm_app_url'];
        $webservice_user_name = $_POST['webservice_user_name'];
        $webservice_user_password = $_POST['webservice_user_password'];
        $nt_ticket_status = $_POST['nt_ticket_status'];
        $ticket_status = $_POST['ticket_status'];
        $ticket_type_id = $_POST['ticket_type_id'];
        $ticket_identifier = $_POST['ticket_identifier'];
        $baseUrl = $_POST['baseUrl']; // https://csmstaging.serviceaide.com/csmconnector/

        $url = $baseUrl . '/Ticket';

        $datos = array(
            "user_auth_token" => $user_auth_token,
            "slice_token" => $slice_token,
            "csm_app_url" => $csm_app_url,
            "webservice_user_name" => $webservice_user_name,
            "webservice_user_password" => $webservice_user_password,
            "nt_ticket_status" => $nt_ticket_status,
            "ticket_status" => $ticket_status,
            "ticket_type_id" => $ticket_type_id,
            "ticket_identifier" => $ticket_identifier,
            "url" => $url
            );

        $request = '{
            "NonTranslatedTicketStatus": "'.$nt_ticket_status.'",
            "TicketStatus": "'.$ticket_status.'",
            "TicketTypeId": "'.$ticket_type_id.'",
            "TicketIdentifier": "'.$ticket_identifier.'"
        }';


        $headers = array(
            'user_auth_token : '.$user_auth_token.'',
            'slice_token : '.$slice_token.'',
            'csm_app_url: '.$csm_app_url.'',
            'webservice_user_name : '.$webservice_user_name.'',
            'webservice_user_password : '.$webservice_user_password.'',
            'Content-Type: application/json'
        );

        $response_object = \App\Utils\StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'PUT', $request, $this->nameLog, $datos, $tipoControlador = 'Arus', $user_agent = $webservice_user_name);
        $response = json_decode($response_object, true);

        $data = $response['data'];
        $error = $response['error'];
        $status = $response['status'];
        
        if ($error != null) {
            $var = '{
                "error": "'.$error.'"
            }';

            return $var;
        }

        $var = '{
            "data": "'.$data.'",
            "status": "'.$status.'"
        }';

        return $var;
    }
    
    private function getInfo($app, $params_error_report, $nameController, $chat_id, $operation)
    {
        $nameController = "ArusController";
        $nameFunction = "editTicket()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];

        // Body variables
        $number_id = $_POST['number_id'];

        $csvFilePath = '/var/www/app/controllers/Usuarios.csv';

        if (($handle = fopen($csvFilePath, 'r')) !== false) {
            // Read the header row
            $header = fgetcsv($handle);
        
            $csvData = array();
        
            // Read each row of data
            while (($rowData = fgetcsv($handle)) !== false) {
                $rowArray = array_combine($header, $rowData);
                $csvData[] = $rowArray;
            }
        
            fclose($handle);
        
            // Now $data contains the CSV data as an array of associative arrays
        } else {
            echo "Unable to open file: $csvFilePath";
        }

        $matchingData = array();

        for ($i=0; $i < count($csvData); $i++){
            $value = $csvData[$i]['EDULA"'];
            if ($value === $number_id) {
                $matchingData[] = $csvData[$i];
            }

        }

        if (!empty($matchingData)) {
            $val = '{
                "nombreUser" : "'.$matchingData[0]['NOMBRE'].'",
                "jefeInmediato" : "'.$matchingData[0]['JEFE INMEDIATO'].'",
                "fondoObligatorio" : "'.$matchingData[0]['FONDO OBLIGATORIO'].'",
                "eps" : "'.$matchingData[0]['EPS'].'"
            }';
        } else {
            $val = '{
                "nombreUser" : "N/A",
                "jefeInmediato" : "N/A",
                "fondoObligatorio" : "N/A",
                "eps" : "N/A"
            }';

        }

        
        return $val;
    }

    public function changePassword($app, $params_error_report, $nameController, $chat_id, $operation) {
        $nameController = "ArusController";
        $nameFunction = "changePassword()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];

        $apiKey = $_POST['apiKey'];
        $documentNumber = $_POST['documentNumber'];
        $url = $_POST['url'];

        $headers = array(
            'x-api-key : '.$apiKey,
            'Content-Type: application/json'
        );

        $request = '{
            "cedula":"'.$documentNumber.'"
        }';

        $datos = [
            'apiKey' => $apiKey,
            'documentNumber' => $documentNumber,
            'url' => $url
        ];

        $response_object = \App\Utils\StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $status = $data['statusCode'];
        $body = $data['body'];
        $message = $body['message'];

        if ($status == 500) {
            $error = $body['error'];
            $var = '{
                "message": "'.$error.'",
            }';

            return $var;
        }

        $password = $body['contrasena'];

        $var = '{
            "message" : "'.$message.'",
            "password" : "'.$password.'"
        }';

        return $var;
    }

    private function decoderAES($app, $params_error_report, $nameController, $chat_id, $operation)
    {
        $nameFunction = 'decryptedPassword';
        $ciphertext = $_POST['cypher_text']; //contrasenha retornada por el servicio cambiar contrasenha
        $hexKey = $_POST['hex_key']; //secretKey Documentacion ARUS;
        $ciphertext = base64_decode($ciphertext);
        $secretKey = hex2bin($hexKey); // Convert hex key to binary 
        $iv = str_repeat("\x00", 16);

        $body = '{
            "cyperText" : "'.$ciphertext.'",
            "hexKey" : "'.$hexKey.'"
        }';

        $nheaders = '{}';

        $datosEntrada = array (
            "cipherText" => $ciphertext,
            "hexKey" => $hexKey
        );


        $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $secretKey, OPENSSL_RAW_DATA, $iv);

        if ($decrypted === false) {
            $decrypte = 'N/A';

            $respuesta = '{ 
                "newPassword" : "'.$decrypte.'"
            }';
        } else {
            $respuesta = '{ 
                "newPassword" : "'.$decrypted.'"
            }';
        }

        \App\Utils\StaticExecuteServicePreproduccion::createLogPreproduccion($respuesta, $body, $chat_id, $nameFunction,$type = 'POST',$this->nameLog,$snheaders,$datosEntrada);

        return $respuesta;
    }

    private function validateName($app, $params_error_report, $nameController, $chat_id, $operation) {

        $nameController = "ArusController";
        $nameFunction = "validateName()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $name = $_POST['nameBoss'];

        $str = iconv('UTF-8', 'ASCII//TRANSLIT', $name);

        $var = '{
            "nombreJefe" : "'.$str.'"
        }';

        return $var;

    }

    private function generateQuestions($app, $params_error_report, $nameController, $chat_id, $operation){

        $data = [0, 1, 2, 3];
        $newArray = [];
        
        while (count($newArray) < 3 && !empty($data)) {
            $randomIndex = array_rand($data);
            $randomValue = $data[$randomIndex];
            $newArray[] = $randomValue;
            unset($data[$randomIndex]);
        }        

        $questionClass = new \stdClass();

        for($i=0; $i <= count($newArray) - 1; $i++){

            $questionClass->questionArray[$i]->element = $newArray[$i];

        }

        return \GuzzleHttp\json_encode($questionClass);

    }

}
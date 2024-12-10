<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use DateTime;
use DateTimeZone;

/**
 * Description of CariController
 *
 * @author rmelo
 */
class TuCalendarController {

    //put your code here

    public $nameLog = "TuCalendarController";
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
                case "getUserRequests":
                    $response = $this->getUserRequests($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getNewDate":
                    $response = $this->getNewDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "updateRequestStatus":
                    $response = $this->updateRequestStatus($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getRequestInfo":
                    $response = $this->getRequestInfo($app, $params_error_report, $nameController, $chat_id);
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

    public function getUserRequests($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_id'];
        $nameController = "TuCalendarController";
        $nameFunction = "getUserRequests()";

        $limit = $_POST['limit'];
        $offset = $_POST['offset'];
        $search = $_POST['companyId'];
        $email = $_POST['email'];
        $timeZone = $_POST['timezone'];

        $pre_date = new DateTime('now');
        $date_timezone = $pre_date->setTimezone(new DateTimeZone('UTC'));
        $actualDate1 = $date_timezone->format('Y-m-d');
        $actualDate2 = $date_timezone->format('H:i:s');
        $actualDate = $actualDate1.'+'.$actualDate2;
        
        $datos = array(
            "search_term" => $search,
            "limit" => $limit,
            "offset" => $offset,
            "email" => $email,
            "timezone" => $timeZone
        );

        $headers = array('Content-Type: application/json');

        $baseUrl = $_POST['url'];
        #$url = 'https://api.tucalendar.com/api/requests_list/?limit='.$limit.'&offset='.$offset.'&search='.$search;
        $url = $baseUrl.'?limit='.$limit.'&offset='.$offset.'&search='.$search.'&user__email='.$email.'&start_time__gte='.$actualDate;

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
            $convertedDate1 = $date->setTimezone(new DateTimeZone($timeZone));
            $convertedDate2 = $date2->setTimezone(new DateTimeZone($timeZone));
            $startTime = $convertedDate1->format('d-m-Y H:i');
            $finishTime = $convertedDate2->format('d-m-Y H:i');

            $redX = "\u{274C}";
            $greenCheck = "\u{2705}";

            $estadoServicio = $resultado[$i]['status'][0]['name'];
            
            if($estadoServicio == 'Cancelado') {
                $etiquetaServicio = $nombreServicio.' - '.$startTime . ' ' . $redX; 
            } else {
                $etiquetaServicio = $nombreServicio.' - '.$startTime . ' ' . $greenCheck;
                $estadoServicio = 'Agendado';
            }
            
            // aquí se asignan los datos en el array
            //$cariDataArray->arrayDinamico[$j]->cardId = $actArray[$j];
            $dataCariArray->arrayDinamico[$i]->idRequest = $resultado[$i]['id'];
            $dataCariArray->arrayDinamico[$i]->idUsuario = $resultado[$i]['user']['id'];
            $dataCariArray->arrayDinamico[$i]->fechaInicio = $startTime;
            $dataCariArray->arrayDinamico[$i]->fechaFin = $finishTime;
            $dataCariArray->arrayDinamico[$i]->hostName = $hostFullName;
            $dataCariArray->arrayDinamico[$i]->nombreServicio = $etiquetaServicio;
            $dataCariArray->arrayDinamico[$i]->precioServicio = $resultado[$i]['service']['price'];
            $dataCariArray->arrayDinamico[$i]->descripcionServicio = $resultado[$i]['service']['description'];
            $dataCariArray->arrayDinamico[$i]->requerimientosServicio = $resultado[$i]['service']['requirements'];
            $dataCariArray->arrayDinamico[$i]->tipoServicio = $resultado[$i]['service']['service_type'];
            $dataCariArray->arrayDinamico[$i]->nombreDetalleServicio = $nombreServicio;
            $dataCariArray->arrayDinamico[$i]->statusServicio = $estadoServicio;         
        }
        
        

        return \GuzzleHttp\json_encode($dataCariArray);
    }
    
        public function getNewDate($app, $params_error_report, $nameController, $chat_id)
    {
        $fecha = $_POST['fecha'];
        $horas = $_POST['horas'];
        $nameFunction = "getNewDate()";
            
        date_default_timezone_set("America/Bogota");
        $mifecha = new DateTime($fecha);
        $mifecha->modify($horas.'hours'); 
        $fechaNueva = $mifecha->format('Y-m-d H:i:s');
        return $fechaNueva;
    }

    public function updateRequestStatus($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_id'];
        $nameController = "TuCalendarController";
        $nameFunction = "updateRequestStatus()";

        $requestId = $_POST['requestId'];
        $statusId = $_POST['statusId'];
        $userId = $_POST['userId'];
        $motivoCancelacion = $_POST['motivoCancelacion'];

        $datosArray = array(
            'requestId' => $requestId,
            'statusId' => $statusId,
            'userId' => $userId,
            'motivoCancelacion' => $motivoCancelacion
        );

        $headers = array('Content-Type: application/json');
        
        $url = 'https://api.tucalendar.com/api/request_status/';

        $requestFields = '{
            "request":"'.$requestId.'",
            "status":"'.$statusId.'",
            "user":"'.$userId.'",
            "note":"'.$motivoCancelacion.'"
        }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'POST', $requestFields, $this->nameLog, $datosArray);

        $data = json_decode($response_object, true);
        
        $infoRequest = $data['request'];
        $infoStatusRequest = $data['status'];
        $infoUserId = $data['user'];
        $infoNotes = $data['note'];

        $objectData = '{
            "infoRequest":"'.$infoRequest.'",
            "infoStatusRequest":"'.$infoStatusRequest.'",
            "infoUserId":"'.$infoUserId.'",
            "infoNotes":"'.$infoNotes.'"
        }';

        return $objectData;
    
    }

    public function getRequestInfo($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_id'];
        $nameController = "TuCalendarController";
        $nameFunction = "getRequestInfo()";

        $idRequest = $_POST['requestId'];
        $timeZone = $_POST['timeZone'];
        
                
        $datos = array(
            "requestId" => $idRequest
        );

        $headers = array('Content-Type: application/json');

        $baseUrl = $_POST['url'];
        #$url = 'https://api.tucalendar.com/api/requests_list/'.$idRequest;
        $url = $baseUrl.$idRequest.'/';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        #print_r($response_object);

        $data = json_decode($response_object, true);

        $clientName = $data['client_name'];
        $startDate = $data['start_time'];
        $clientMessage = $data['notes_message'];
        $hostFirstName = $data['hosts']['first_name'];
        $hostLastName = $data['hosts']['last_name'];
        $hostFullName = $hostFirstName.' '.$hostLastName;
        $serviceName = $data['service']['name'];
        $userFirstName = $data['user']['first_name'];
        $userLastName = $data['user']['last_name'];
        $userFullName = $userFirstName.' '.$userLastName;
        $userEmail = $data['user']['email'];
        $status = $data['status'][0]['name'];

        if($status == 'Cancelado') {
            $statusLabel = $status; 
        } else {
            $statusLabel = 'Agendado';
        };

        ///Este es el seteo de la fecha para poderla visualizar en el formato requerido
        if ($timeZone==null){
            $dateInit = new DateTime($startDate);
            $convertDate = $dateInit->setTimezone(new DateTimeZone('America/Bogota'));
            $finalDate = $convertDate->format('d-m-y H:i'); 
        }else{
            $dateInit = new DateTime($startDate);
            $convertDate = $dateInit->setTimezone(new DateTimeZone($timeZone));
            $finalDate = $convertDate->format('d-m-y H:i');
        }


        $showObject = '{
            "nombre_cliente":"'.$clientName.'",
            "fecha_inicio":"'.$finalDate.'",
            "mensaje_cliente":"'.$clientMessage.'",
            "nombre_host":"'.$hostFullName.'",
            "servicio":"'.$serviceName.'",
            "nombre_usuario":"'.$userFullName.'",
            "email_usuario":"'.$userEmail.'",
            "estado_cita":"'.$statusLabel.'"

        }';
        
        return $showObject;

    }
}

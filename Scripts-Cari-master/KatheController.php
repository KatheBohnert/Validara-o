<?php

namespace App\Controllers;

use App\Utils\StaticExecuteServicePreproduccion;

/**
 * Description of KatheController
 * Este es un controlador para la API de getAvailability
 * @author KatherinBK
 */
class KatheController
{
  public $nameLog = "KatheController";

  public function process(\Phalcon\Mvc\Micro $app)
  {
    header('Access-Control-Allow-Origin: *');
    $chat_id = $_POST['chat_identification'];
    $operation = $_POST['operation'];
    $useProduction = $_POST['useProduction'];
    $token = $_POST['token'];
    $chat_id = $_POST['chat_identification'];
    $params_error_report = [
      'enterprise_id' => $_POST['enterprise_id'],
      'session_id' => $_POST['session_id'],
      'bot_id' => $_POST['bot_id'],
      'convesartion_id' => $_POST['convesartion_id'],
  ];


    if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
      switch ($operation) {
        case "checkAvailability":
          $res = $this->checkAvailability($app, $chat_id,$params_error_report);
          echo $res;
          break;

        default:
          echo "Operación no válida";
          break;
      }
    } else {
      echo "useProduction y token son obligatorios!";
    }
  }

  public function checkAvailability($app, $chat_id,$params_error_report )
  {
    $nameController = "KatheController";
    $nameFunction = "checkAvailability";
    $url = 'https://dev.34-149-116-245.nip.io/v1/appointments/getAvailability';
    $auth = $_POST['auth'];
    $partnerCode = $_POST['partnerCode'];
    $hashKey = $_POST['hashKey'];
     //parametros para datos de los pacientes
     $patientId = $_POST['patientId'] ?? 'Bukeala|CC|1013583710'; 
     $serviceType = $_POST['serviceType'] ?? 'Bukeala/TipoAtencion|M';
     $specialityId = $_POST['specialityId'] ?? 'Bukeala|890244';

    $headers = [
      'Authorization: Bearer ' . $auth,
      'Content-Type: application/json',
      'UUID: 123',
      'partnerCode: ' . $partnerCode,
      'hashKey: ' . $hashKey,
    ];
    $data = [
      'partnerCode: ' . $partnerCode,
            'hashKey: ' . $hashKey,
            'auth: ' . $auth,
            'url: ' . $url
    ];

    $body = json_encode([
      "resourceType" => "Bundle",
      "id" => "bundle-request-scheduler",
      "type" => "batch",
      "entry" => [
        [
          "request" => [
            "method" => "GET",
            "url" => "Appointment?_count=15&location.identifier=Bukeala%2Fsede%7C172652&patient.identifier%3Aof-type%20eq%20Bukeala%7CCC%7C52326427&_include=Appointment%3Alocation&appointment-type%3Atext=true&date=ge2023-02-23&location.address-city=11001&service-type=Bukeala%2FTipoAtencion%7CM&specialty=Bukeala%7C275&status=proposed&supporting-info.identifier=Bukeala%2FProducto%7C30&supporting-info.identifier=Bukeala%2FPlan%7C10"
          ]
        ]
      ]
    ]);

    $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $data);

    return $response_object;

    $data = json_decode($response_object, true);
    $entry = $data["entry"];
  }
}

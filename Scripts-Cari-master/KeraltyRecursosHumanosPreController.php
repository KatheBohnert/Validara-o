<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Utils\StaticExecuteService;
use App\Utils\StaticExecuteServicePreproduccion;
use \App\Controllers\SoundlutionsUtilsController;

/**
 * Description of CariController
 *
 * @author soundlutions
 */
class KeraltyRecursosHumanosPreController
{
  public string $nameLog = "KeraltyRecursosHumanosPreController";
  public string $nameController = "KeraltyRecursosHumanosPreController";

  public function process(\Phalcon\Mvc\Micro $app)
  {
    header('Access-Control-Allow-Origin: *');
    $chat_id = $_POST['chat_identification'];
    $params_error_report = [
      'enterprise_id' => $_POST['enterprise_id'],
      'session_id' => $_POST['session_id'],
      'bot_id' => $_POST['bot_id'],
      'conversation_id' => $_POST['conversation_id'],
    ];
    $operation = $_POST['operation'];
    $useProduction = $_POST['useProduction'];
    $token = $_POST['token'];

    if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
      // code
      switch ($operation) {
        case "test":
          $response = "El controlador de preprod ya funciona";
          break;

        case "getAuthToken":
          $response = $this->getAuthToken($app, $params_error_report, $this->nameController, $chat_id);
          echo $response;
          break;

        default:
          $response = "Es necesario indicar el operation";
          echo $response;
          break;
      }
    } else {
      $response = "Faltan useProduction o token. Ambos parámetros son obligatorios";
      echo $response;
    }
  }

  private function getAuthToken($app, $params_error_report, $nameController, $chat_id)
  {
    $nameFunction = "getAuthToken()";
    $url = $_POST['url'];

    $headers = array(
      'grant_type: client_credentials',
      'Content-Type: application/x-www-form-urlencoded',
      'Authorization: Basic TzRWSmp6SXhnMHdhVWRGUDZ1d0dXYmNGVGwyRExrQVIwQUUzREhjN0RFRmZFR3VjOkFybFhTWWxEQzRqQXNvOGZTWDExUVlKZEFjQlFhTVFWRURYZ0dUdldTcEI1YzA3ZWRIaVlQa1E2MWk5WG80aVQ='
    );

    $request = [
      "resourceType" => "Bundle",
      "type" => "batch",
      "entry" => [
        [
          "request" => [
            "method" => "POST",
            "url" => "Auth/token"
          ]
        ]
      ]
    ];

    $request = 'grant_type=client_credentials';
    $datos = [
      'auth' => $url
    ];

    $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos);

    $data = json_decode($response_object, true);
    return $data['access_token'];
  }
}

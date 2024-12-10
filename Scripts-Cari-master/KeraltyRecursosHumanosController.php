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
class KeraltyRecursosHumanosController {
  public string $namelog = "KeraltyRecursosHumanosController";

  public function process(\Phalcon\Mvc\Micro $app) 
  {
    header('Access-Control-Allow-Origin: *');
    $nameController = "KeraltyRecursosHumanosController";
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
          $response = "El controlador de prod ya funciona";
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

}
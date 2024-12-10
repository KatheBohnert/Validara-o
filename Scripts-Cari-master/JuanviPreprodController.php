<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Utils\StaticExecuteServicePreproduccion;
use App\Controllers\SoundlutionsUtilsController;

/**
 * Description of CariController
 *
 * @author jvreyes
 */
class JuanviPreprodController
{
  public $nameLog = "JuanviPreprodController";

  public function process(\Phalcon\Mvc\Micro $app)
  {
    header('Access-Control-Allow-Origin: *');
    $nameController = "JuanviPreprodController";
    $chat_id = $_POST['chat_identification'];
    $params_error_report = [
      'enterprise_id' => $_POST['enterprise_id'],
      'session_id' => $_POST['session_id'],
      'bot_id' => $_POST['bot_id'],
      'convesartion_id' => $_POST['convesartion_id'],
    ];
    $operation = $_POST['operation'];
    $url = $_POST["url"];

    if (!$url) {
      echo "No se ha especificado una url";
    };

    switch ($operation) {
      case "getExams":
        $res = $this->getExams($url);
        echo $res;
        break;

      case "getUserSelectedExams":
        $res = $this->getUserSelectedExams($url);
        echo $res;
        break;

      default:
        echo "Operacion no valida";
        break;
    }
  }

  private function getExams($url)
  {
    // "https://cariai.com/hospital/getReport/"
    $channel = curl_init();
    curl_setopt($channel, CURLOPT_URL, $url);
    curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($channel);
    curl_close($channel);
    return $result;
  }

  private function getUserSelectedExams($url)
  {
    $id = $_POST['idDocumento'];

    print_r($id);

    if (!$id) {
      return "No se ha especificado un id";
    };

    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://cariai.com/hospital/datawebview",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => [
        "idDocumento" => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"idDocumento\"\r\n\r\n2795981792024-09-1010:50:25\r\n-----011000010111000001101001--\r\n"
      ],
      CURLOPT_HTTPHEADER => [
        "Accept: */*",
        "Authorization: Basic VXNlckhvc3BpdGFsOkM0cjFBSS4qMTk5NzE1Kyo=",
        "content-type: multipart/form-data; boundary=---011000010111000001101001"
      ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
  }


  



}
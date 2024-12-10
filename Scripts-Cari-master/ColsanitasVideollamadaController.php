<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Utils\StaticExecuteServicePreproduccion;

/**
 * Description of CariController
 *
 * @author devteam
 */

class ColsanitasVideollamadaController
{
    public string $nameLog = "ColsanitasVideollamadaController";
    public string $baseUrl = 'https://cariai.com/colsanitasagenteenlinea/'; //QA https://qa.cariai.com/colsanitasdevelop/  - DEV https://cariai.com/colsanitasdevelop/
    private static $cariSec = null;

    public function process(\Phalcon\Mvc\Micro $app)
    {
        header('Access-Control-Allow-Origin: *');
        $nameController = "ColsanitasVideollamadaController";
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
            switch ($operation) {
                case 'userConsultVideoCall':
                    $response = $this->userConsultVideoCall($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;

                case 'userConsultOTP':
                    $response = $this->userConsultOTP($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;

                default:
                    $response = 'Es necesario indicar la operation';
                    echo $response;
                    break;
            }
        }
    }

    private function generateCariSec($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "ColsanitasVideollamadaController";
        $nameFunction = "generateCariSec()";

        $body = [
            "credentials" => "cVhlaTdqekZaZkkyL1VVSjZzVjdZMFI0b2hkLzVVMXhmM0xsaDNxWmVScmxQdGNUVWlNcExPVnlsdDNDb2podzFyWEFyblpaWmJmeQ=="
        ];
        $url = $this->baseUrl . 'createtoken';

        $datos = [
          "url" => $url
        ];

        $headers = [
            'Content-Type: application/json'
        ];

        $body = json_encode($body);

        return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
    }

    public function userConsultVideoCall($app, $params_error_report, $nameController, $chat_id, $operation): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "ColsanitasVideollamadaController";
        $nameFunction = "userConsultVideoCall()";

        $url = $this->baseUrl . $operation;
        $idType = $_POST['typeDocument'];
        $idNumber = $_POST['numberDocument'];
        $userName = $_POST['fullUserName'];
        $userEmail = $_POST['emailUser'];
        $userCellphone = $_POST['phoneUser'];
        $serviceType = $_POST['serviceType'];

        // Se genera el token la primera vez
        self::$cariSec = $this->generateCariSec($app, $params_error_report, $nameController, $chat_id);
        self::$cariSec = json_decode(self::$cariSec, true);
        // Valida si el token ya expiró
        if (self::$cariSec && isset(self::$cariSec['expiresIn']) && strtotime(self::$cariSec['expiresIn'] > time())) {
            self::$cariSec = self::$cariSec['cariSec'];
        } else {
            self::$cariSec = json_decode($this->generateCariSec($app, $params_error_report, $nameController, $chat_id), true);
            self::$cariSec = self::$cariSec['cariSec'];
        }

        $datos = [
            "url" => $url,
            "tipoDocumento" => $idType,
            "numeroDocumento" => $idNumber,
            "nombreUsuario" => $userName,
            "correoUsuario" => $userEmail,
            "celularUsuario" => $userCellphone,
            "servicioSeleccionado" => $serviceType,
            "cariSec" => self::$cariSec
        ];

        $headers = array(
            'Content-Type: application/json',
            'cariSec: ' . self::$cariSec
        );

        $body = '{
            "typeDocument": "' . $idType . '",
            "numberDocument": "' . $idNumber . '",
            "fullNameUser": "' . $userName . '",
            "emailUser": "'. $userEmail .'",
            "phoneUser": "'. $userCellphone .'",
            "serviceType": "'. $serviceType .'"
        }';

        return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
    }

    public function userConsultOTP($app, $params_error_report, $nameController, $chat_id, $operation): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "ColsanitasVideollamadaController";
        $nameFunction = "userConsultOtp()";

        $url = $this->baseUrl . $operation;
        $idType = $_POST['typeDocument'];
        $idNumber = $_POST['numberDocument'];
        $userName = $_POST['fullUserName'];
        $userEmail = $_POST['emailUser'];
        $userCellphone = $_POST['phoneUser'];
        $serviceType = $_POST['serviceType'];
        $otpMethod = $_POST['otpMetod'];
        $otpForwarding = $_POST['otpForwarding'];
//        $otpForwarding = (int)$otpForwarding;

        if (self::$cariSec && isset(self::$cariSec['expiresIn']) && strtotime(self::$cariSec['expiresIn'] > time())) {
            self::$cariSec = self::$cariSec['cariSec'];
        } else {
            self::$cariSec = json_decode($this->generateCariSec($app, $params_error_report, $nameController, $chat_id), true);
            self::$cariSec = self::$cariSec['cariSec'];
        }

        $datos = [
            "url" => $url,
            "tipoDocumento" => $idType,
            "numeroDocumento" => $idNumber,
            "nombreUsuario" => $userName,
            "correoUsuario" => $userEmail,
            "celularUsuario" => $userCellphone,
            "servicioSeleccionado" => $serviceType,
            "reenvioOtp" => $otpForwarding
        ];

//        $headers = array(
//            'Content-Type: application/json',
//            'Authorization: Basic SzNyNGxUMTo0QTRwRmRmRGVQWXhtYw=='
//        );

        $headers = array(
            'Content-Type: application/json',
            'cariSec: ' . self::$cariSec
        );

        $body = '{
            "typeDocument": "' . $idType . '",
            "numberDocument": "' . $idNumber . '",
            "fullNameUser": "' . $userName . '",
            "emailUser": "'. $userEmail .'",
            "phoneUser": "'. $userCellphone .'",
            "serviceType": "'. $serviceType .'",
            "otpMetod": "'. $otpMethod .'",
            "otpForwarding": ' . $otpForwarding . '
        }';

        return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
    }
}
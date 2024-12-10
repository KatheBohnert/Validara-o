<?php

namespace App\Controllers;

use App\Utils\StaticExecuteServicePreproduccion;

/**
 * This is a medium-level controller designed to make requests and obtain responses from the services
 * created by CariAi for EPS Sanitas Landing Page.
 *
 * @author devteam
 */

class SanitasEpsVideoCallController {
    public string $nameLog = "SanitasEpsVideoCallController";
    public string $baseUrl = "";
    private static $cariSec = null;

    public function process(\Phalcon\Mvc\Micro $app) {
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
        $urlType = $_POST['urlType'];

        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6' && $urlType) {
            switch ($operation) {
                case "userConsultVideoCall":
                    if($urlType == 1) {
                        $this->baseUrl = "https://cariai.com/sanitasvideocall/"; // Dev
                    } else {
                        $this->baseUrl = ""; // Prod
                    }
                    $res = $this->userConsultVideoCall($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $res;
                    break;

                case "userConsultOTP":
                    if($urlType == 1) {
                        $this->baseUrl = 'https://cariai.com/sanitasvideocall/'; // Dev
                    } else {
                        $this->baseUrl = ""; // Prod
                    }
                    $res = $this->userConsultOTP($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $res;
                    break;

                default:
                    $res = "Es necesario indicar el operation";
                    echo $res;
                    break;
            }
        } else {
            echo "useProduction, token and urlType are mandatory";
        }
    }

    private function generateCariSec($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "SanitasEpsVideoCallController";
        $nameFunction = "generateCariSec()";

        $body = [
            "credentials" => "cVhlaTdqekZaZkkyL1VVSTZzVjdZMFI0b2hkLzVVMXhmM0xsaDNxWmVScmxQdGNUVWlNcExPVnlsdDNDb2podzFyWEFyblpaWmJmeQ=="
        ];
        $url = 'https://cariai.com/sanitasvideocall/createtoken';

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
            "cariSec" => self::$cariSec
        ];

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . self::$cariSec
        );

        $body = '{
            "typeDocument": "' . $idType . '",
            "numberDocument": "' . $idNumber . '"
        }';

        return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
    }

    public function userConsultOTP($app, $params_error_report, $nameController, $chat_id, $operation): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "SanitasEpsVideollamadaController";
        $nameFunction = "userConsultOtp()";

        $url = $this->baseUrl . $operation;
        $idType = $_POST['typeDocument'];
        $idNumber = $_POST['numberDocument'];
        $serviceType = $_POST['serviceType'];
        $otpMethod = $_POST['otpMetod'];
        $otpForwarding = $_POST['otpForwarding'];
        $file1 = $_POST['file1'];
        $file2 = $_POST['file2'];
        $file3 = $_POST['file3'];
//        $otpForwarding = (int)$otpForwarding;

        if (self::$cariSec && isset(self::$cariSec['expiresIn']) && strtotime(self::$cariSec['expiresIn'] > time())) {
            self::$cariSec = self::$cariSec['cariSec'];
        } else {
            self::$cariSec = json_decode($this->generateCariSec($app, $params_error_report, $nameController, $chat_id), true);
            self::$cariSec = self::$cariSec['cariSec'];
        }

        if (!$file1) {
            $file1 = null;
        }

        if (!$file2) {
            $file2 = null;
        }

        if(!$file3) {
            $file3 = null;
        }

        if ($otpForwarding === 'false' || $otpForwarding === '0') {
            $otpForwarding = 0;
        }

        $datos = [
            "url" => $url,
            "tipoDocumento" => $idType,
            "numeroDocumento" => $idNumber,
            "servicioSeleccionado" => $serviceType,
            "reenvioOtp" => $otpForwarding
        ];

//        $headers = array(
//            'Content-Type: application/json',
//            'Authorization: Basic SzNyNGxUMTo0QTRwRmRmRGVQWXhtYw=='
//        );

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . self::$cariSec
        );

        /*$body = '{
            "typeDocument": "' . $idType . '",
            "numberDocument": "' . $idNumber . '",
            "serviceType": "'. $serviceType .'",
            "otpMetod": "'. $otpMethod .'",
            "otpForwarding": ' . $otpForwarding . ',
            "firstFile": '. $file1 . ',
            "secondFile": '. $file2 . ',
            "thirdFile": '. $file3 . '
        }';*/

        $body = array(
            'typeDocument' => $idType,
            'numberDocument' => $idNumber,
            'serviceType' => intval($serviceType),
            'otpMetod' => $otpMethod,
            'otpForwarding' => intval($otpForwarding),
            'firstFile' => $file1 ?: null,
            'secondFile' => $file2 ?: null,
            'thirdFile' => $file3 ?: null
        );
        $body = json_encode($body);

        // return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
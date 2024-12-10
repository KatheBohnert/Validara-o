<?php

namespace App\Controllers;

use App\Utils\StaticExecuteServicePreproduccion;

/**
 * This controller is used for dev environment in Colsanitas VideoCall Service
 *
 * @author devteam
 */

class ColsanitasVideollamadaPreprodController {
    public string $nameLog = 'ColsanitasVideollamadaPreprodController';
    public string $baseUrl = 'https://cariai.com/colsanitasdevelop/';
    private static $cariSec = null;
    public function process(\Phalcon\Mvc\Micro $app)
    {
        header('Access-Control-Allow-Origin: *');
        $nameController = "ColsanitasVideollamadaPreprodController";
        $chat_id = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'conversation_id' => $_POST['conversation_id'],
        ];
        $operation = $_POST['operation'];
        switch ($operation) {
            case 'userConsultVideoCall':
                $response = $this->userConsultVideoCall($app, $params_error_report, $nameController, $chat_id, $operation);
                echo $response;
                break;

            case 'userConsultOTP':
                $response = $this->userConsultOTP($app, $params_error_report, $nameController, $chat_id, $operation);
                echo $response;
                break;

            case 'validateOtp':
                $response = $this->validateOtp();
                echo $response;
                break;

            case 'test':
                $response = "El controlador está melo";
                echo $response;
                break;

            default:
                $response = 'Es necesario indicar la operation';
                echo $response;
                break;
        }
    }

    private function generateCariSec($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "ColsanitasVideollamadaPreprodController";
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
        $nameController =  "ColsanitasVideollamadaPreprodController";
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
        $nameController =  "ColsanitasVideollamadaPreprodController";
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
        $encodeKey = $_POST['key'];

        if (!isset($encodeKey)) {
            $var = [
                "message" => "Hacen falta datos"
            ];
            return json_encode($var);
        }
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

        $res = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
        $data = json_decode($res, true);
        $sentOtp = $data['message'][0]['codigoOtp'];
        $encodedOtp = $this->secureEncode($encodeKey, $sentOtp);
        $callLink = $data['message'][0]['url'];
        $var = [
            "message" => "Success",
            "id" => $encodedOtp,
            "url" => $callLink
        ];
        return json_encode($var);
    }

    private function validateOtp(): string
    {
        $userOtp = $_POST['userOtp'];
        $decodeKey = $_POST['key'];
        $otp = $_POST['otp'];
        $otp = $this->secureDecode($decodeKey, $otp);

        if ($otp == $userOtp) {
            http_response_code(200);
            $var = [
                "message" => "Success"
            ];
        } else {
            http_response_code(400);
            $var = [
                "message" => "Failed"
            ];
        }

        return json_encode($var);
    }

    private function validateDecodeKey($key): bool
    {
        $correctKey = 'Ñato2024@ñ';
        $correctKey = substr(hash('sha256', $correctKey), 0, 32);

        return $key === $correctKey;
    }

    private function secureEncode($key, $otp): string
    {
        if (!$this->validateDecodeKey($key)) {
            http_response_code(403);
            return '{ "mensaje": "Credenciales inválidas", "detalle": "No tienes permisos para esta acción" }';
        }

        // Crea un vector de seguridad
        $iV = openssl_random_pseudo_bytes(16);

        // Encripta utilizando openssl bajo el algoritmo AES-256 y con la respectiva clave para poder decodificar
        $cifrado = openssl_encrypt($otp, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iV);


        return base64_encode($iV . $cifrado);
    }

    private function secureDecode($key, $otpCifrado): string
    {
        if (!$this->validateDecodeKey($key)) {
            http_response_code(403);
            return '{ "mensaje": "Credenciales inválidas" }';
        }

        $otpCifrado = base64_decode($otpCifrado);

        $iv = substr($otpCifrado, 0, 16);

        $cifrado = substr($otpCifrado, 16);

        $otp = openssl_decrypt($cifrado, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

        return $otp;
    }
}
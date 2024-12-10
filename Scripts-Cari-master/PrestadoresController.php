<?php

namespace App\Controllers;

require_once '/var/www/app/controllers/lib/nusoap.php';
use DateTime;

class PrestadoresController
{
    public $nameLog = "Prestadores";
    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "PrestadoresController";
        $chat_id = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'convesartion_id' => $_POST['convesartion_id'],
        ];
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];

        if ($useProduction == 1) {
            $urlIn = "https://api.colsanitas.com/osi/api/";
        } else {
            $urlIn = "https://papi.colsanitas.com/osi/api/";
        }

        $token = $_POST['token'];
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) {
                case "getToken":
                    $response = $this->getTokenWs($app);
                    echo $response;
                    break;
                case "getTokenWsV2":
                    $response = $this->getTokenWsV2($app);
                    echo $response;
                    break;
                case "authentication":
                    $response = $this->authentication($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "prestacionPorCodigoRest":
                    $response = $this->prestacionPorCodigoRest($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "getMail":
                    $response = $this->getMail($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "recordarContra":
                    $response = $this->recordarContra($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "curlRecordarContra":
                    $response = $this->curlRecordarContra($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "cambiarContra":
                    $response = $this->cambiarContra($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "curlCambiarContra":
                    $response = $this->curlCambiarContra($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "obtenerRelacionUsuario":
                    $response = $this->obtenerRelacionUsuario($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "relacionUsuario":
                    $response = $this->relacionUsuario($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "listDoctor":
                    $response = $this->ListDoctor($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "listSucursal":
                    $response = $this->ListSucursal($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "validateCmv":
                    $response = $this->validateCmv($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "checkRegister":
                    $response = $this->checkRA($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "cancelRegister":
                    $response = $this->cancelRegister($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "cancelRegisterV2":
                    $response = $this->cancelRegisterV2($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "validateRegister":
                    $response = $this->validarCodigoRegistroAtencion($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "validateDate":
                    $response = $this->validateDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getDate":
                    $response = $this->getDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validateUser":
                    $response = $this->validateUser($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "salidaFecha":
                    $response = $this->fechaDesde($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "listContracts":
                    $response = $this->listContracts($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "ConsultarAutorizacionNumero":
                    $response = $this->ConsultarAutorizacionNumero($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "ConsultarAutorizacionNumeroV2":
                    $response = $this->ConsultarAutorizacionNumeroV2($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "prestacionesByCod":
                    $response = $this->prestacionesByCod($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "listAuthorization":
                    $response = $this->listAuthorization($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
case "listAuthorizationV2":
                    $response = $this->listAuthorizationV2($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "confirmarUtilizacionPin":
                    $response = $this->confirmarUtilizacionPin($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionAuth":
                    $response = $this->grabarAtencionAuth($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionAuthV2":
                    $response = $this->grabarAtencionAuthV2($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionAuthSinPin":
                    $response = $this->grabarAtencionAuthNoPin($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionAuthSinPinV2":
                    $response = $this->grabarAtencionAuthNoPinV2($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionSinAuth":
                    $response = $this->grabarAtencion($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionSinAuthPin":
                    $response = $this->grabarAtencionPin($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionPinCurl":
                    $response = $this->grabarAtencionPinCurl($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "grabarAtencionSinAuthSinPin":
                    $response = $this->grabarAtencionSinAuthSinPin($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "marcarAutorizacion":
                    $response = $this->marcarAutorizacion($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "listViasAtencion":
                    $response = $this->listViasAtencion($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "consultService":
                    $response = $this->consultService($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "basicData":
                    $response = $this->basicData($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "recaudoEfectivo":
                    $response = $this->recaudoEfectivo($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "ListVales":
                    $response = $this->ListVales($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "validatePinStatus":
                    $response = $this->validatePinStatus($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "validatePinStatus2":
                    $response = $this->validatePinStatus2($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "requierePin":
                    $response = $this->requierePin($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "convenioVigente":
                    $response = $this->convenioVigente($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getRegister":
                    $response = $this->getRegister($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "curl":
                    $response = $this->getCurl($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getActualDate":
                    $response = $this->getActualDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "ReversarUtilPin":
                    $response = $this->ReversarUtilPin($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "ConsultarServPorDesc":
                    $response = $this->ConsultarServPorDesc($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validateContractDate":
                    $response = $this->validateContractDate($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "ValidateAttentionDate":
                    $response = $this->ValidateAttentionDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "cuadroMedico":
                    $response = $this->CuadroMedico($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "cuadroMedicoDinamico":
                    $response = $this->CuadroMedicoDinamico($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validarContratos":
                    $response = $this->validarContratos($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "listarAutorizacionesHijas":
                    $response = $this->listarAutorizacionesHijas($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "verificarContratoHabilitado":
                    $response = $this->verificarContratoHabilitado($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "getDataRA":
                    $response = $this->getDataRA($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "consultarPrecio":
                    $response = $this->consultarPrecio($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "valesDiferenciales":
                    $response = $this->valesDiferenciales($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "consultarPin":
                    $response = $this->consultarPin($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "consultarPinPruebaProduccion":
                    $response = $this->consultarPinPruebaProduccion($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "puertaDeEntrada":
                    $response = $this->puertaDeEntrada($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "consultContractByNumber":
                    $response = $this->consultContractByNumber($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "dateRange":
                    $response = $this->dateRange($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "reglasDelDia":
                    $response = $this->reglasDelDia($app, $params_error_report, $nameController, $chat_id, $urlIn);
                    echo $response;
                    break;
                case "asignarPin":
                    $response = $this->asignarPin($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "consultServiceInfo":
                    $res = $this->consultServiceInfo($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;

                case "agreementValue2":
                    $res = $this->agreementValue2($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;
                case "consultarValorConvenio":
                    $res = $this->agreementValue($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;
                case "cuadroMedicoEspecialidadFrecuente":
                    $res = $this->cmEspecialidadFrecuente($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;
                case "cuadroMedicoPrestadorPuertaDeEntrada":
                    $res = $this->cmPrestadorPuertaDeEntrada($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;
                case "AuthBonoCero":
                    $res = $this->AuthBonoCero($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;
                case "getRoleRips":
                    $res = $this->getRoleRips($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
                    break;
                case "validarPrestacionConsulta":
                    $res = $this->validarPrestacionConsulta($app, $params_error_report, $nameController, $chat_id);
                    echo $res;
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

    public function createLog($response, $datosEntrada, $chat_id, $nameFunction, $typeRequest)
    {
        try {
            $response = json_encode($response);
            if (gettype($datosEntrada) == "array") {
                $datosEntrada = json_encode($datosEntrada);
            }
            $bodyLog = 'Funcion: ' . $nameFunction . ' ---------Type: ' . $typeRequest . ' ----------Datos de Entrada: ' . $datosEntrada . ' ----------Respuesta del servicio:' . $response;

            \App\Utils\SetLogs::customLog($this->nameLog, $bodyLog, $chat_id);
        } catch (\Exception $e) {
            return $e;
        }
    }

    private function getTokenWs($app, $getResponseToken = false)
    {
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $botId = 1104;
        } else {
            $botId = 2711;
        }
        $token = \Store\Toys\PrestadoresApiToken::getToken($app, $botId);
        // $token = PrestadoresApiToken::getToken($this->useProduction, $botId);
        if ($token) {
            return $token;
        }
        try {
            if ($_POST['useProduction'] == 1) {
                $url = "https://api.colsanitas.com/token";
                $params = 'grant_type=password' .
                    '&username=CO11VG60AMCHATBOTPREST' .
                    '&password=lnoVVRHHwLMY3XXnB8Eck';
                $token = "cVBQNk1SQVBPOW8zNHVpUVBnYkRNSHkxVmRFYTpPUFdLRk9OdG9mczhnZm94ZlVNazFSemNndEVh";
            } else {
                $url = "https://papi.colsanitas.com/token";
                $params = 'grant_type=password' .
                    '&username=CO11VG60AMPCHATBOTPREST' .
                    '&password=FtRvf8y05wntUg5iU0Jca';
                $token = "SzBtMl95RkhOem51MVNWY0k3aUJPc2Z0OEc0YTpDQ0k1WXFBRlBQc3Z6UDd4aG8zTktmYlJFVDhh";
            }

            $http_options[CURLOPT_CUSTOMREQUEST] = 'POST';
            $http_options[CURLOPT_HTTPHEADER] = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Basic ' . $token);
            $http_options[CURLOPT_POSTFIELDS] = $params;
            $http_options[CURLOPT_RETURNTRANSFER] = true;
            $http_options[CURLOPT_POST] = true;
            $http_options[CURLOPT_SSL_VERIFYPEER] = false;

            if (!$timeOut) {
                $http_options[CURLOPT_TIMEOUT] = 30;
            } else {
                $http_options[CURLOPT_TIMEOUT] = $timeOut;
            }
            $handle = curl_init($url);
            if (!curl_setopt_array($handle, $http_options)) {
                echo "error!!";
                throw new RestClientException("Error setting cURL request options.");
            }
            $response_object = curl_exec($handle);

            $obj = json_decode($response_object);
            $token = $obj->access_token;

            if ($token) {
                $expires_in = $obj->expires_in;
                date_default_timezone_set('America/Bogota');

                $ctime = date("Y-m-d H:i:s", strtotime("+$expires_in seconds"));

                $saveToken = \Store\Toys\PrestadoresApiToken::saveToken($app, $token, $expires_in, $ctime, $botId);
            } else {
                $token = false;
            }

        } catch (\Exception $e) {
            return 'Error inesperado';
        }

        if ($getResponseToken === true) {
            $token = '{"access_token": "' . $token . '"}';
        }

        return $token;
    }

    public function getTokenWsV2($app, $getResponseToken = false)
    {

        if ($_POST['useProduction'] == 1) {
            $url = "https://api.colsanitas.com/token";
            $params = 'grant_type=password' .
                '&username=CO11VG60AMCHATBOTPREST' .
                '&password=lnoVVRHHwLMY3XXnB8Eck';
            $token = "cVBQNk1SQVBPOW8zNHVpUVBnYkRNSHkxVmRFYTpPUFdLRk9OdG9mczhnZm94ZlVNazFSemNndEVh";
        } else {
            $url = "https://papi.colsanitas.com/token";
            $params = 'grant_type=password' .
                '&username=CO11VG60AMPCHATBOTPREST' .
                '&password=FtRvf8y05wntUg5iU0Jca';
            $token = "SzBtMl95RkhOem51MVNWY0k3aUJPc2Z0OEc0YTpDQ0k1WXFBRlBQc3Z6UDd4aG8zTktmYlJFVDhh";
        }

        $http_options[CURLOPT_CUSTOMREQUEST] = 'POST';
        $http_options[CURLOPT_HTTPHEADER] = array('Content-Type: application/x-www-form-urlencoded', 'Authorization: Basic ' . $token);
        $http_options[CURLOPT_POSTFIELDS] = $params;
        $http_options[CURLOPT_RETURNTRANSFER] = true;
        $http_options[CURLOPT_POST] = true;
        $http_options[CURLOPT_SSL_VERIFYPEER] = false;
        $http_options[CURLOPT_TIMEOUT] = 30;

        $handle = curl_init($url);
        if (!curl_setopt_array($handle, $http_options)) {
            echo "error!!";
            throw new RestClientException("Error setting cURL request options.");
        }
        $response_object = curl_exec($handle);

        $obj = json_decode($response_object);

        $token = $obj->access_token;

        $token2 = '{"access_token": "' . $token . '"}';

        return $token2;

    }

    public function authentication($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "authentication";
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $token = $this->getTokenWs($app, false);
        $url = $urlIn . 'prestadores/v1.0.0/authentication/userName/' . $userName . '/password/' . $password;
        $datos = array(
            "userName" => $userName,
            "password" => $password,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 25);

        return json_encode($response_object);
    }

    public function getMail($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "getMail";
        $temp = $_POST['user'];
        $temp2 = '2';
        $token = $this->getTokenWs($app, false);
        $url = $urlIn . 'prestador/v1.0.0/usuarios/relaciones/consultarRelacionesDelUsuario?usuario=' . $temp . '&tiporelacion=' . $temp2;
        $datos = array(
            "user" => $temp,
            "tipoRelacion" => $temp2,
            "url" => $url,
        );
        //$response_object = $this->executeService($app, $url, '', "GET", $token, $headers);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, '', "GET", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 15, $resetHeader = 'n');
        // $this->createLog( $response_object,$url,$chat_id,$nameFunction,"GET");

        if (count($response_object->relacion) == '0') {
            $msj = 'No tenemos un correo registrado';

        } else {
            $correoJSN = $response_object->relacion[0]->usuario->userMail;
            $mail = $correoJSN;
            $arroba = strpos($mail, '@') - 1;
            $mailPriv = substr($mail, 0, -(strlen($mail) - 2)) . 'xxxx' . substr($mail, $arroba);
            $msj = $mailPriv;
        }

        $correo = '{
            "msj" : "' . $msj . '",
            "userEmail":"' . $correoJSN . '"
        }';

        return $correo;
    }

    public function obtenerRelacionUsuario($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "obtenerRelacionUsuario";
        $usuarioPrest = $_POST['usuario'];
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "prestador/v1.0.0/usuarios/relaciones/consultarRelacionesDelUsuario?usuario=" . $usuarioPrest . "&tiporelacion=2";

        $datos = array(
            "usuarioPrest" => $usuarioPrest,
            "tipoRelacion" => 2,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, null, "GET", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 15, $resetHeader = 's');
        // $this->createLog( $response_object,$url,$chat_id,$nameFunction,"GET");

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
        return '{
            "size":' . count($response_object->relacion) . ',
            "numeroDocumentoPrestadoresDelegado":"' . $response_object->relacion[0]->usuario->document . '",
            "tipoDocumentoPrestadoresDelegados":"' . $response_object->relacion[0]->usuario->tipoDoc . '",
            "nombrePrestadoresDelegados":"' . $response_object->relacion[0]->usuario->userName . '",
            "apellidoPrestadoresDelegados":"' . $response_object->relacion[0]->usuario->userLastName . '",
            "userRegisterValid":"' . $response_object->relacion[0]->usuario->document . "_" . $response_object->relacion[0]->usuario->userName . " " . $response_object->relacion[0]->usuario->userLastName . '",
            "numId":"' . $response_object->relacion[0]->prestador->numId . '"
        }';
    }

    public function relacionUsuario($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "relacionUsuario";
        $usuarioPrest = $_POST['usuario'];
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "prestador/v1.0.0/usuarios/relaciones/consultarRelacionesDelUsuario?usuario=" . $usuarioPrest . "&tiporelacion=2";

        $datos = array(
            "usuarioPrest" => $usuarioPrest,
            "tipoRelacion" => 2,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, null, "GET", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 15, $resetHeader = 's');
        // $this->createLog( $response_object,$url,$chat_id,$nameFunction,"GET");

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
        return '{
            "tamano2":' . count($response_object->relacion) . ',
            "numId":"' . $response_object->relacion[0]->prestador->numId . '",
            "documento":"' . $response_object->relacion[0]->usuario->document . '",
            "nombre":"' . $response_object->relacion[0]->usuario->userName . '",
            "apellido":"' . $response_object->relacion[0]->usuario->userLastName . '",
            "tipoDoc":"' . $response_object->relacion[0]->usuario->tipoDoc . '",
            "fullname":"' . $response_object->relacion[0]->usuario->userName . ' ' . $response_object->relacion[0]->usuario->userLastName . '"
        }';
    }

    public function ListDoctor($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "ListDoctor()";
        $user = $_POST['userToList'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $tipoRelacion = '2';
        $tipoConsulta = 1;
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $token = $this->getTokenWs($app, false);
        $url = $urlIn . "prestador/v1.0.0/usuarios/relaciones/consultarRelacionesDelUsuario?usuario=" . $user . "&tiporelacion=" . $tipoRelacion;
        $datos = array(
            "user" => $user,
            "tipoRelacion" => $tipoRelacion,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "tipoConsulta" => $tipoConsulta,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 15, $resetHeader = 's');
        // Datos de entrada, chat_id, response, construir un String con estos datos y enviarlo como segundo parametro.
        $datosEntrada = array('userToList' => $user, 'tipoConsulta' => $tipoConsulta, 'tipoRelacion' => $tipoRelacion, 'ciclo' => $ciclo, 'cantidad' => $cantidad);
        $typeRequest = "GET";
        // $this->createLog( $response_object,$url,$chat_id,$nameFunction,$typeRequest);
        \App\Utils\SetLogs::customLog($this->nameLog, json_encode($response_object), $chat_identification, $nameFunction);

        if ($response_object === false) {
            $mensajeError = 'Ws Caidos! saliendo';
            return $mensajeError;
        }

        $listadoMedicos = array();
        $temporalArray = array();
        $listadoNumId = array();
        $longitud = count($response_object->relacion);

        if (count($response_object->relacion) == '0') {
            return $msj = 'No tenemos un correo registrado';
        } else {
            for ($i = 0; $i < $longitud; $i++) {
                if ($response_object->relacion[$i]->prestador->tipoId !== '4' && !(in_array($response_object->relacion[$i]->prestador->numId, $listadoNumId))) {

                    array_push($listadoNumId, $response_object->relacion[$i]->prestador->numId);
                    array_push($listadoMedicos, $response_object->relacion[$i]->prestador);
                }
            }
            $longitud2 = count($listadoMedicos);
            if ($final > ($longitud2 - 1)) {
                //$rest = $final - ($longitud2);
                for ($i = $inicio; $i < $longitud2; $i++) {
                    array_push($temporalArray, $listadoMedicos[$i]);
                }
            } else {

                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listadoMedicos[$i]);
                }
            }
        }

        $longitudMedicos = sizeof($temporalArray);
        $response = new \stdClass();
        $response->numVerMas = ceil($longitud2 / $cantidad);
        $tipoDocumento = $response_object->relacion[0]->usuario->tipoDoc;

        switch ($tipoDocumento) {
            case "01":
                $tipoDocumento = "CC";
                break;
            case "02":
                $tipoDocumento = "CE";
                break;
            case "03":
                $tipoDocumento = "MS";
                break;
            case "04":
                $tipoDocumento = "NIT";
                break;
            case "05":
                $tipoDocumento = "NIP";
                break;
            case "06":
                $tipoDocumento = "PA";
                break;
            case "07":
                $tipoDocumento = "RC";
                break;
            case "08":
                $tipoDocumento = "TI";
                break;
            case "09":
                $tipoDocumento = "CD";
                break;
            case "10":
                $tipoDocumento = "CN";
                break;
            case "11":
                $tipoDocumento = "SC";
                break;
            case "12":
                $tipoDocumento = "PD";
                break;
            case "13":
                $tipoDocumento = "PE";
                break;
            case "15":
                $tipoDocumento = "PT";
                break;
            default:
                $tipoDocumento = "N/A";
                break;
        };

        $response->tipoDocPrestador = $tipoDocumento;
        $response->sizeArray = count($temporalArray);
        for ($i = 0; $i < $longitudMedicos; $i++) {
            $nombrePrestador = $temporalArray[$i]->razonSocial;
            $nombrePrestador = preg_replace('/[0-9]+/', '', $nombrePrestador);
            $nombrePrestador = preg_replace('/[-]+/', '', $nombrePrestador);
            $nombrePrestador = trim($nombrePrestador);
            $response->dynamicArray[$i]->mensaje_doctor = "Doctor : " . $nombrePrestador;
            $response->dynamicArray[$i]->doctorName = $nombrePrestador;
            $response->dynamicArray[$i]->document = $temporalArray[$i]->numId;
            $response->dynamicArray[$i]->cdperson = $temporalArray[$i]->cdperson;
            $response->dynamicArray[$i]->tipoId = $temporalArray[$i]->tipoId;
            $response->dynamicArray[$i]->prestadorId = $temporalArray[$i]->prestadorId;
            $response->dynamicArray[$i]->sucursal = $temporalArray[$i]->sucursal;
        }
        $object = json_encode($response);
        return \GuzzleHttp\json_encode($response);

    }

    public function ListSucursal($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "ListSucursal()";
        $tipoConsulta = 1;
        $identificationType = $_POST['identificationType'];
        $identificationNumber = $_POST['identificationNumber'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $token = $this->getTokenWs($app, false);

        switch ($identificationType) {
            case "01":
                $identificationType = "CC";
                break;
            case "02":
                $identificationType = "CE";
                break;
            case "03":
                $identificationType = "MS";
                break;
            case "04":
                $identificationType = "NIT";
                break;
            case "05":
                $identificationType = "NIP";
                break;
            case "06":
                $identificationType = "PA";
                break;
            case "07":
                $identificationType = "RC";
                break;
            case "08":
                $identificationType = "TI";
                break;
            case "09":
                $identificationType = "CD";
                break;
            case "10":
                $identificationType = "CN";
                break;
            case "11":
                $identificationType = "SC";
                break;
            case "12":
                $identificationType = "PD";
                break;
            case "13":
                $identificationType = "PE";
                break;
            case "15":
                $identificationType = "PT";
                break;
            default:
                $identificationType = "N/A";
                break;
        };

        $url = $urlIn . "providersAndAgreements/Providers/v1.0.0/practitioner/contactInformation?identificationType=" . $identificationType . "&identificationNumber=" . $identificationNumber;

        $datos = array(
            "identificationNumber" => $identificationNumber,
            "identificationType" => $identificationType,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "tipoConsulta" => $tipoConsulta,
            "token" => $token,
            "url" => $url,
        );
        $headers = array("TipoConsulta" => $tipoConsulta);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, "Prestadores", $datos);

        // $this->createLog( $response_object,$url,$chat_id,$nameFunction,"GET");

        //$response_object = $this->executeService($app,$url, '', "GET", $token, $headers, $params_error_report);

        if ($response_object === false) {
            $mensajeError = 'Ws Caidos! saliendo';
            return $mensajeError;
        }

        $listadoSucursales = array();
        $temporalArray = array();
        $longitud = count($response_object->data);

        if (count($response_object->data) == '0') {
            return $msj = 'No tenemos un correo registrado';
        } else {
            for ($i = 0; $i < $longitud; $i++) {
                if ($response_object->data[$i]->identifier) {
                    array_push($listadoSucursales, $response_object->data[$i]);
                }
            }
            $longitud2 = count($listadoSucursales);
            if ($final > ($longitud2 - 1)) {
                for ($i = $inicio; $i < $longitud2; $i++) {
                    array_push($temporalArray, $listadoSucursales[$i]);
                }
            } else {

                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listadoSucursales[$i]);
                }
            }
        }

        $longitudSucursales = sizeof($listadoSucursales);
        $response = new \stdClass();
        $response->numVerMas = ceil($longitud / $cantidad);
        for ($i = 0; $i < $longitudSucursales; $i++) {
            $response->dynamicArray[$i]->mensaje_sucursal = "Sucursal : " . $temporalArray[$i]->identifier[2]->value . " - Ciudad: " . $temporalArray[$i]->address[0]->city->name;
            $response->dynamicArray[$i]->codigo_sucursal = $temporalArray[$i]->identifier[2]->value;
            $response->dynamicArray[$i]->codigo_city = $temporalArray[$i]->address[0]->city->code;
        };

        $object = json_encode($response);
        return \GuzzleHttp\json_encode($response);

    }

    public function validateCmv($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "validateCmv()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $codSucursal = $_POST['codigoSucursal'];
        $username = $_POST['userServ'];
        $url = $urlIn . 'assurance/providersAgreements/medicalAccount/userValidate/rulesDay/v1.0.0/chatbot/cashCollection';
        $token = $this->getTokenWs($app, false);

        switch ($tipoId) {
            case "CC":
                $tipoId = "01";
                break;
            case "CE":
                $tipoId = "02";
                break;
            case "MS":
                $tipoId = "03";
                break;
            case "NIT":
                $tipoId = "04";
                break;
            case "NIP":
                $tipoId = "05";
                break;
            case "PA":
                $tipoId = "06";
                break;
            case "RC":
                $tipoId = "07";
                break;
            case "TI":
                $tipoId = "08";
                break;
            case "CD":
                $tipoId = "09";
                break;
            case "CN":
                $tipoId = "10";
                break;
            case "SC":
                $tipoId = "11";
                break;
            case "PD":
                $tipoId = "12";
                break;
            case "PE":
                $tipoId = "13";
                break;
            case "PT":
                $tipoId = "15";
                break;
            default:
                $tipoId = $tipoId;
                break;
        };

        $request = '{
            "identificationType" : "' . $tipoId . '",
            "identificationNumber": "' . $numId . '",
            "branchOfficeId": "' . $codSucursal . '",
            "user": "' . $username . '"
        }';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "codSucursal" => $codSucursal,
            "username" => $username,
            "token" => $token,
            "url" => $url,
        );

        //$response_object = $this->executeService($app, $url, $request, "POST", $token, $headers, $params_error_report);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $validCMV = $response_object->isCMV;

        if (!$validCMV) {
            return '{
                "validaCmv":"0"
            }';
        } else {
            return '{
                "validaCmv":"1"
            }';
        }

    }

    public function ConsultarAutorizacionNumero($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $tipoConsulta = 1;
        $numAuthorization = $_POST['numAuthorization'];
        $sucursalPrestadorSeleccionado = $_POST['sucursalPrestadorSeleccionado'];
        $token = $this->getTokenWs($app, false);
        $nameFunction = "ConsultarAutorizacionNumero";
        $AuthVencida = "0";
        date_default_timezone_set('America/Bogota');

        $url = $urlIn . "insurance/operationsSupport/medicalServicesAuthorization/V1.0.0/autorizathion/consultAuthorization";

        $headers = array("tipoconsulta" => $tipoConsulta);

        $request = '{
            "identifier": [
                {
                  "type": "AUTORIZACION",
                  "value": "' . $numAuthorization . '"
                }
              ]
        }';

        $datos = array(
            "numAuthorization" => $numAuthorization,
            "tipoConsulta" => $tipoConsulta,
            "sucursalPrestadorSeleccionado" => $sucursalPrestadorSeleccionado,
            "url" => $url,
            "request" => $request,
            "headers" => $headers,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 30);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");
        if ($response_object === false) {
            return '{
                "errorService": "1"
            }';
        }
        if ($response_object->code == "RAU02" && $response_object->value == "Registro no existe.") {
            return '{
	    	"exitoso": "No",
		"mensajeError": "El registro ingresado no existe"
	    }';
        }
        $fechaFinalizacion = $response_object->authorization[0]->occurrence->end;
        $fechaActual = date('Y-m-d');
        $fechaActual = strtotime($fechaActual);
        $fechastr = strtotime($fechaFinalizacion);
        $fechaFini = date('Y-m-d', $fechastr);
        $autorizacionesHijas = 0;
        if ($response_object->authorization[0]->reference) {
            $autorizacionesHijas = 1;
        }
        if ($fechaActual > $fechastr) {
            $AuthVencida = "1";
        }
        $mensajeNotes = "";
        $mensajeNotesRA = "";
        $procedimientosLabel = "";

        for ($j = 0; $j < count($response_object->authorization[0]->note); $j++) {
            if ($response_object->authorization[0]->note[$j]->printed == true) {
                $mensajeNotes = $mensajeNotes . ($j + 1) . ". " . $response_object->authorization[0]->note[$j]->text . " - " . $response_object->authorization[0]->note[$j]->supportingInfo;
            }
        }
        for ($j = 0; $j < count($response_object->authorization[0]->note); $j++) {
            if ($response_object->authorization[0]->note[$j]->printed == true) {
                $mensajeNotesRA = $mensajeNotesRA . " " . $response_object->authorization[0]->note[$j]->text . " " . $response_object->authorization[0]->note[$j]->supportingInfo;
            }
        }
        for ($j = 0; $j < count($response_object->authorization[0]->procedure); $j++) {
            $procedimientosLabel = $procedimientosLabel . ($j + 1) . ". " . $response_object->authorization[0]->procedure[$j]->identifier[0]->value . " " . $response_object->authorization[0]->procedure[$j]->identifier[1]->value . " - " . $response_object->authorization[0]->procedure[$j]->numberUVR . " UVR Bilateralidad: " . ($response_object->authorization[0]->procedure[$j]->interventionType->code == '1' ? "S" : "N") . "\\n";
        }
        $isConsumed = $response_object->authorization[0]->isConsumed;
        $SegundoNombre = $response_object->authorization[0]->subject->patient->secondName;
        $SegundoApellido = $response_object->authorization[0]->subject->patient->secondFamily;
        //probar si el true o false del isconsumed es retornado como un String
        $tipoIdentificacionPaciente = $response_object->authorization[0]->subject->patient->identifier[0]->value;
        switch ($tipoIdentificacionPaciente) {
            case "CC":
                $tipoIdentificacionPaciente = "1";
                break;
            case "CE":
                $tipoIdentificacionPaciente = "2";
                break;
            case "MS":
                $tipoIdentificacionPaciente = "3";
                break;
            case "NIT":
                $tipoIdentificacionPaciente = "4";
                break;
            case "NIP":
                $tipoIdentificacionPaciente = "5";
                break;
            case "PA":
                $tipoIdentificacionPaciente = "6";
                break;
            case "RC":
                $tipoIdentificacionPaciente = "7";
                break;
            case "TI":
                $tipoIdentificacionPaciente = "8";
                break;
            case "CD":
                $tipoIdentificacionPaciente = "9";
                break;
            case "CN":
                $tipoIdentificacionPaciente = "10";
                break;
            case "SC":
                $tipoIdentificacionPaciente = "11";
                break;
            case "PD":
                $tipoIdentificacionPaciente = "12";
                break;
            case "PE":
                $tipoIdentificacionPaciente = "13";
                break;
            case "PT":
                $tipoIdentificacionPaciente = "15";
                break;
            default:
                $tipoIdentificacionPaciente = $tipoIdentificacionPaciente;
        };

        // if ($isConsumed === true) {
        //     return '{
        //         "isConsumed" : "1"
        //     }';
        // } else {
        return '{
                "especialidadPrestador":"' . $response_object->authorization[0]->serviceRequest->requester->practitioner->specialty->value . '",
		        "cod_practitioner":"' . $response_object->authorization[0]->performer->practitioner->identifier[1]->value . '",
                ' . ($isConsumed ? '"isConsumed" : "1"' : '"isConsumed" : "0"') . ',
                "tipoIdentificacionPaciente":"' . $tipoIdentificacionPaciente . '",
                "tipoIdentificacionPacienteLetras":"' . $response_object->authorization[0]->subject->patient->identifier[0]->value . '",
                "numeroIdentificacionPaciente":"' . $response_object->authorization[0]->subject->patient->identifier[1]->value . '",
                "nombrePaciente":"' . $response_object->authorization[0]->subject->patient->name . '",
                "PrimerNombre":"' . $response_object->authorization[0]->subject->patient->firstName . '",
                ' . ($SegundoNombre ? '"SegundoNombre" : "' . $response_object->authorization[0]->subject->patient->secondName . '"' : '"SegundoNombre" : "."') . ',
                "PrimerApellido":"' . $response_object->authorization[0]->subject->patient->firstFamily . '",
                ' . ($SegundoApellido ? '"SegundoApellido" : "' . $response_object->authorization[0]->subject->patient->secondFamily . '"' : '"SegundoApellido" : "."') . ',
		        "cod_autorizacion":"' . $response_object->authorization[0]->identifier[0]->value . '",
                "tipoSolicitud" :"' . $response_object->authorization[0]->orderDetail->name . '",
                "tipoSolicitudCodigo" :"' . $response_object->authorization[0]->orderDetail->code . '",
		        "fechaAprovacion":"' . date('Y-m-d', strtotime($response_object->authorization[0]->occurrence->start)) . '",
		        "fechaVencimiento":"' . date('Y-m-d', strtotime($response_object->authorization[0]->occurrence->end)) . '",
		        "fechaAprovacionRA":"' . $response_object->authorization[0]->occurrence->start . '",
		        "fechaVencimientoRA":"' . $response_object->authorization[0]->occurrence->end . '",
		        "descripcionServicio":"' . $response_object->authorization[0]->status->description . '",
		        "statusAutorizacion":"' . $response_object->authorization[0]->status->code . '",
		        "prestadorQuePractica":"' . $response_object->authorization[0]->performer->practitioner->name . '",
		        "uvrAutorizacion":"' . $response_object->authorization[0]->procedure[0]->numberUVR . '",
		        "codigoBH":"' . $response_object->authorization[0]->procedure[0]->identifier[0]->value . '",
                "descripcionBH":"' . $response_object->authorization[0]->procedure[0]->identifier[1]->value . '",
		        "descripcionLabelDetalle":"' . $procedimientosLabel . '",
                "descripcionAlias":"' . $response_object->authorization[0]->procedure[0]->identifier[1]->value . " " . $response_object->authorization[0]->procedure[0]->identifier[0]->value . '",
		        "bilateralidad":"' . $response_object->authorization[0]->insurance->claimResponse->type . '",
		        "cantidad":"' . $response_object->authorization[0]->procedure[0]->quantity . '",
		        "name_practitioner":"' . $response_object->authorization[0]->serviceRequest->requester->practitioner->name . '",
                "noteDescription":"' . $mensajeNotes . '",
                "noteDescriptionRA":"' . $mensajeNotesRA . '",
		        "fechaExpedicionRadicacion":"' . $response_object->authorization[0]->applicationDate . '",
		        "tipoIdPrestador":"' . $response_object->authorization[0]->performer->practitioner->identifier[0]->value . '",
		        "idSucursal":"' . $response_object->authorization[0]->performer->practitioner->identifier[2]->value . '",
		        "codigoCiudadAuth":"' . $response_object->authorization[0]->performer->practitioner->providerAddress->city->code . '",
		        "codigoEstadoAuth":"' . $response_object->authorization[0]->status->code . '",
                "autorizacionesHijas":"' . $autorizacionesHijas . '",
                "codigoProducto": "' . $response_object->authorization[0]->insurance->coverage->insurancePlan->identifier[0]->value . '",
                "codigoPlan": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[0]->value . '",
                "contrato": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[2]->value . '",
                "codigoTipoAtencioVales": "' . $response_object->authorization[0]->encounter->class->code . '",
                "numeroFamilia": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[3]->value . '",
                "numeroUsuario": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[4]->value . '",
                "tipoVolanteNew": "' . $response_object->authorization[0]->orderDetail->name . '",
                "sesionesNew": "' . $response_object->authorization[0]->procedure[0]->quantity . '",
                "codigoDiagnosticoNew": "' . $response_object->authorization[0]->serviceRequest->reason->code . '",
                "codigoOrigenAutorizacionNew": "' . $response_object->authorization[0]->serviceRequest->reasonReference->condition->code . '",
                "AuthVencida":' . $AuthVencida . ',
                ' . ($sucursalPrestadorSeleccionado == $response_object->authorization[0]->performer->practitioner->identifier[2]->value ? '"sucursalValida" : "1"' : '"sucursalValida" : "0"') . '
            }';

        // }
    }

    public function ConsultarAutorizacionNumeroV2($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $tipoConsulta = 1;
        $numAuthorization = $_POST['numAuthorization'];
        $sucursalPrestadorSeleccionado = $_POST['sucursalPrestadorSeleccionado'];
        $token = $this->getTokenWs($app, false);
        $nameFunction = "ConsultarAutorizacionNumeroV2";
        $AuthVencida = "0";
        date_default_timezone_set('America/Bogota');

        $url = $urlIn . "insurance/operationsSupport/medicalServicesAuthorization/V1.0.0/autorizathion/consultAuthorization";

        $headers = array("tipoconsulta" => $tipoConsulta);

        $request = '{
            "identifier": [
                {
                  "type": "AUTORIZACION",
                  "value": "' . $numAuthorization . '"
                }
              ]
        }';

        $datos = array(
            "numAuthorization" => $numAuthorization,
            "tipoConsulta" => $tipoConsulta,
            "sucursalPrestadorSeleccionado" => $sucursalPrestadorSeleccionado,
            "url" => $url,
            "request" => $request,
            "headers" => $headers,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 30);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");
        if ($response_object === false) {
            return '{
                "errorService": "1"
            }';
        }
        if ($response_object->code == "RAU02" && $response_object->value == "Registro no existe.") {
            return '{
	    	"exitoso": "No",
		"mensajeError": "El registro ingresado no existe"
	    }';
        }
        $fechaFinalizacion = $response_object->authorization[0]->occurrence->end;
        $fechaActual = date('Y-m-d');
        $fechaActual = strtotime($fechaActual);
        $fechastr = strtotime($fechaFinalizacion);
        $fechaFini = date('Y-m-d', $fechastr);
        $autorizacionesHijas = 0;
        if ($response_object->authorization[0]->reference) {
            $autorizacionesHijas = 1;
        }
        if ($fechaActual > $fechastr) {
            $AuthVencida = "1";
        }
        $mensajeNotes = "";
        $mensajeNotesRA = "";
        $procedimientosLabel = "";

        for ($j = 0; $j < count($response_object->authorization[0]->note); $j++) {
            if ($response_object->authorization[0]->note[$j]->printed == true) {
                $mensajeNotes = $mensajeNotes . ($j + 1) . ". " . $response_object->authorization[0]->note[$j]->text . " - " . " " . $response_object->authorization[0]->note[$j]->supportingInfo;
            }
        }
        for ($j = 0; $j < count($response_object->authorization[0]->note); $j++) {
            if ($response_object->authorization[0]->note[$j]->printed == true) {
                $mensajeNotesRA = $mensajeNotesRA . " " . $response_object->authorization[0]->note[$j]->text . " " . $response_object->authorization[0]->note[$j]->supportingInfo;
            }
        }

        for ($j = 0; $j < count($response_object->authorization[0]->procedure); $j++) {
            $procedimientosLabel = $procedimientosLabel . ($j + 1) . ". " . $response_object->authorization[0]->procedure[$j]->identifier[0]->value . " " . $response_object->authorization[0]->procedure[$j]->identifier[1]->value . " - " . $response_object->authorization[0]->procedure[$j]->numberUVR . " UVR Bilateralidad: " . ($response_object->authorization[0]->procedure[$j]->interventionType->code == '1' || $response_object->authorization[0]->procedure[$j]->interventionType->code == '3' || $response_object->authorization[0]->procedure[$j]->interventionType->code == '4' ? "S" : "N") . "\\n";
        }
        for ($j = 0; $j < count($response_object->authorization[0]->procedure); $j++) {
            $consultaServiciosAutorizacion = $consultaServiciosAutorizacion . "\\n" . "Código: " . $response_object->authorization[0]->procedure[$j]->identifier[0]->value . "\\n" . "Descripción: " . $response_object->authorization[0]->procedure[$j]->identifier[1]->value . "\\n" . "Bilateralidad: " . ($response_object->authorization[0]->procedure[$j]->interventionType->code == '1' || $response_object->authorization[0]->procedure[$j]->interventionType->code == '3' || $response_object->authorization[0]->procedure[$j]->interventionType->code == '4' ? "S" : "N") . "\\n\\n" . "Cantidad: " . $response_object->authorization[0]->procedure[0]->quantity . "\\n" . "Detalle: " . $response_object->authorization[0]->serviceRequest->requester->practitioner->name . "\\n" . "Observaciones codificadas: " . $mensajeNotes . "\\n" . "Procedimiento con código CUPS y  UVR: " . $response_object->authorization[0]->procedure[$j]->identifier[0]->value . " " . $response_object->authorization[0]->procedure[$j]->numberUVR . " UVR";
        }
        $isConsumed = $response_object->authorization[0]->isConsumed;
        $SegundoNombre = $response_object->authorization[0]->subject->patient->secondName;
        $SegundoApellido = $response_object->authorization[0]->subject->patient->secondFamily;
        //probar si el true o false del isconsumed es retornado como un String
        $tipoIdentificacionPaciente = $response_object->authorization[0]->subject->patient->identifier[0]->value;
        switch ($tipoIdentificacionPaciente) {
            case "CC":
                $tipoIdentificacionPaciente = "1";
                break;
            case "CE":
                $tipoIdentificacionPaciente = "2";
                break;
            case "MS":
                $tipoIdentificacionPaciente = "3";
                break;
            case "NIT":
                $tipoIdentificacionPaciente = "4";
                break;
            case "NIP":
                $tipoIdentificacionPaciente = "5";
                break;
            case "PA":
                $tipoIdentificacionPaciente = "6";
                break;
            case "RC":
                $tipoIdentificacionPaciente = "7";
                break;
            case "TI":
                $tipoIdentificacionPaciente = "8";
                break;
            case "CD":
                $tipoIdentificacionPaciente = "9";
                break;
            case "CN":
                $tipoIdentificacionPaciente = "10";
                break;
            case "SC":
                $tipoIdentificacionPaciente = "11";
                break;
            case "PD":
                $tipoIdentificacionPaciente = "12";
                break;
            case "PE":
                $tipoIdentificacionPaciente = "13";
                break;
            case "PT":
                $tipoIdentificacionPaciente = "15";
                break;
            default:
                $tipoIdentificacionPaciente = $tipoIdentificacionPaciente;
        };

        if (count($response_object->authorization[0]->procedure) > 1) {
            $codigoBh = "";
            $descripcionBH = "";
            $uvrAutorizacion = "";
            $sesionesNew = "";
            for ($i = 0; $i < count($response_object->authorization[0]->procedure); $i++) {
                if ($i < (count($response_object->authorization[0]->procedure) - 1)) {
                    $codigoBh = $codigoBh . $response_object->authorization[0]->procedure[$i]->identifier[0]->value . '-';
                    $descripcionBH = $descripcionBH . $response_object->authorization[0]->procedure[$i]->identifier[1]->value . '-';
                    $uvrAutorizacion = $uvrAutorizacion . $response_object->authorization[0]->procedure[$i]->numberUVR . '-';
                    $sesionesNew = $sesionesNew . $response_object->authorization[0]->procedure[$i]->quantity . '-';
                } else {
                    $codigoBh = $codigoBh . $response_object->authorization[0]->procedure[$i]->identifier[0]->value;
                    $descripcionBH = $descripcionBH . $response_object->authorization[0]->procedure[$i]->identifier[1]->value;
                    $uvrAutorizacion = $uvrAutorizacion . $response_object->authorization[0]->procedure[$i]->numberUVR;
                    $sesionesNew = $sesionesNew . $response_object->authorization[0]->procedure[$i]->quantity;
                }
            }
        } else {
            $codigoBh = $response_object->authorization[0]->procedure[0]->identifier[0]->value;
            $descripcionBH = $descripcionBH . $response_object->authorization[0]->procedure[0]->identifier[1]->value;
            $uvrAutorizacion = $uvrAutorizacion . $response_object->authorization[0]->procedure[0]->numberUVR;
            $sesionesNew = $sesionesNew . $response_object->authorization[0]->procedure[0]->quantity;
        }

        $codigoBh = trim($codigoBh);
        $descripcionBH = trim($descripcionBH);
        $uvrAutorizacion = trim($uvrAutorizacion);
        $sesionesNew = trim($sesionesNew);
        return '{
                "especialidadPrestador":"' . $response_object->authorization[0]->serviceRequest->requester->practitioner->specialty->value . '",
		        "cod_practitioner":"' . $response_object->authorization[0]->performer->practitioner->identifier[1]->value . '",
                ' . ($isConsumed ? '"isConsumed" : "1"' : '"isConsumed" : "0"') . ',
                "tipoIdentificacionPaciente":"' . $tipoIdentificacionPaciente . '",
                "tipoIdentificacionPacienteLetras":"' . $response_object->authorization[0]->subject->patient->identifier[0]->value . '",
                "numeroIdentificacionPaciente":"' . $response_object->authorization[0]->subject->patient->identifier[1]->value . '",
                "nombrePaciente":"' . $response_object->authorization[0]->subject->patient->name . '",
                "PrimerNombre":"' . $response_object->authorization[0]->subject->patient->firstName . '",
                ' . ($SegundoNombre ? '"SegundoNombre" : "' . $response_object->authorization[0]->subject->patient->secondName . '"' : '"SegundoNombre" : "."') . ',
                "PrimerApellido":"' . $response_object->authorization[0]->subject->patient->firstFamily . '",
                ' . ($SegundoApellido ? '"SegundoApellido" : "' . $response_object->authorization[0]->subject->patient->secondFamily . '"' : '"SegundoApellido" : "."') . ',
		        "cod_autorizacion":"' . $response_object->authorization[0]->identifier[0]->value . '",
                "tipoSolicitud" :"' . $response_object->authorization[0]->orderDetail->name . '",
                "tipoSolicitudCodigo" :"' . $response_object->authorization[0]->orderDetail->code . '",
		        "fechaAprovacion":"' . date('Y-m-d', strtotime($response_object->authorization[0]->occurrence->start)) . '",
		        "fechaVencimiento":"' . date('Y-m-d', strtotime($response_object->authorization[0]->occurrence->end)) . '",
		        "fechaAprovacionRA":"' . $response_object->authorization[0]->occurrence->start . '",
		        "fechaVencimientoRA":"' . $response_object->authorization[0]->occurrence->end . '",
		        "descripcionServicio":"' . $response_object->authorization[0]->status->description . '",
		        "statusAutorizacion":"' . $response_object->authorization[0]->status->code . '",
		        "prestadorQuePractica":"' . $response_object->authorization[0]->performer->practitioner->name . '",
		        "uvrAutorizacion":"' . $uvrAutorizacion . '",
		        "codigoBH":"' . $codigoBh . '",
                "descripcionBH":"' . $descripcionBH . '",
		        "descripcionLabelDetalle":"' . $procedimientosLabel . '",
                "descripcionAlias":"' . $response_object->authorization[0]->procedure[0]->identifier[1]->value . " " . $response_object->authorization[0]->procedure[0]->identifier[0]->value . '",
		        "bilateralidad":"' . $response_object->authorization[0]->insurance->claimResponse->type . '",
		        "cantidad":"' . $response_object->authorization[0]->procedure[0]->quantity . '",
		        "name_practitioner":"' . $response_object->authorization[0]->serviceRequest->requester->practitioner->name . '",
                "noteDescription":"' . $mensajeNotes . '",
                "noteDescriptionRA":"' . $mensajeNotesRA . '",
		        "fechaExpedicionRadicacion":"' . $response_object->authorization[0]->applicationDate . '",
		        "tipoIdPrestador":"' . $response_object->authorization[0]->performer->practitioner->identifier[0]->value . '",
		        "idSucursal":"' . $response_object->authorization[0]->performer->practitioner->identifier[2]->value . '",
		        "codigoCiudadAuth":"' . $response_object->authorization[0]->performer->practitioner->providerAddress->city->code . '",
		        "codigoEstadoAuth":"' . $response_object->authorization[0]->status->code . '",
                "autorizacionesHijas":"' . $autorizacionesHijas . '",
                "codigoProducto": "' . $response_object->authorization[0]->insurance->coverage->insurancePlan->identifier[0]->value . '",
                "codigoPlan": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[0]->value . '",
                "contrato": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[2]->value . '",
                "codigoTipoAtencioVales": "' . $response_object->authorization[0]->encounter->class->code . '",
                "numeroFamilia": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[3]->value . '",
                "numeroUsuario": "' . $response_object->authorization[0]->insurance->coverage->contract->identifier[4]->value . '",
                "tipoVolanteNew": "' . $response_object->authorization[0]->orderDetail->name . '",
                "sesionesNew": "' . $sesionesNew . '",
                "codigoDiagnosticoNew": "' . $response_object->authorization[0]->serviceRequest->reason->code . '",
                "codigoOrigenAutorizacionNew": "' . $response_object->authorization[0]->serviceRequest->reasonReference->condition->code . '",
                "consultaServiciosAutorizacion": "' . $consultaServiciosAutorizacion . '",
                "AuthVencida":' . $AuthVencida . ',
                ' . ($sucursalPrestadorSeleccionado == $response_object->authorization[0]->performer->practitioner->identifier[2]->value ? '"sucursalValida" : "1"' : '"sucursalValida" : "0"') . '
            }';

    }

    public function consultContractByNumber($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "consultContractByNumber()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $codProducto = $_POST['codProducto'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $plan = $_POST['plan'];
        $url = $urlIn . 'assurance/affiliations/affiliationsAndNewsManagements/contract/v1.0.0/cover';
        $token = $this->getTokenWs($app, false);
        $tipoId = substr($tipoId, 0, 2);
        $tipoId = strtoupper($tipoId);
        $request = '{
            "subject": {
              "identifier": [
                {
                  "type": "TIPO_IDENTIFICACION",
                  "value": "' . $tipoId . '"
                },
                {
                  "type": "NUMERO_IDENTIFICACION",
                  "value": "' . $numId . '"
                }
              ]
            },
            "coverage": {
              "insurancePlan": {
                "type": "CODIGO_PRODUCTO",
                "value": "' . $codProducto . '"
              },
              "contract": [
                {
                  "type": "PLAN",
                  "value": "' . $plan . '"
                },
                {
                  "type": "CONTRATO",
                  "value": "' . $contrato . '"
                },
                {
                  "type": "FAMILIA",
                  "value": "' . $familia . '"
                }
              ]
            },
            "swFamily": true,
            "lastValid": false,
            "planType": ""
          } ';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "codProducto" => $codProducto,
            "contrato" => $contrato,
            "familia" => $familia,
            "plan" => $plan,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        //$response_object = $this->executeService($app,$url, $request, "POST", $token, $headers, $params_error_report);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $longitud = count($response_object->coverFamilyResponse);
        $response = new \stdClass();

        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d\Th:i:s');

        for ($i = 0; $i < $longitud; $i++) {
            $listPatients = $response_object->coverFamilyResponse[$i]->contract->subject->patient;
            $longitudPacientes = count($listPatients);
            for ($j = 0; $j < $longitudPacientes; $j++) {
                $numIdentificacionPaciente = $listPatients[$j]->identifier[1]->value;
                $fechaPaciente_vencimiento = $listPatients[$j]->applies->end;
                if ($numIdentificacionPaciente == $numId) {
                    $fecha_final = $listPatients[$j]->applies->end;
                    $cod_producto = $response_object->coverFamilyResponse[$i]->insurancePlan->identifier[0]->value;

                    if ($cod_producto != 30) {
                        if ($date <= $fecha_final || $fecha_final == null) {
                            return '{
                               "estado": "Habilitado"
                            }';
                        }
                    }
                }
            }

        }

        return '{
            "estado": "InHabilitado"
         }';
    }

    public function listarAutorizacionesHijas($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $tipoConsulta = 1;
        $numAuthorization = $_POST['numAuthorization'];
        $token = $this->getTokenWs($app, false);
        $nameFunction = "listarAutorizacionesHijas()";
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;

        $url = $urlIn . "insurance/operationsSupport/medicalServicesAuthorization/V1.0.0/autorizathion/consultAuthorization";

        $headers = array("tipoconsulta" => $tipoConsulta);
        $request = '{
            "identifier": [
                {
                  "type": "AUTORIZACION",
                  "value": "' . $numAuthorization . '"
                }
              ]
        }';
        $datos = array(
            "tipoConsulta" => $tipoConsulta,
            "numAuthorization" => $numAuthorization,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object->code == "RAU02" && $response_object->value == "Registro no existe.") {
            return '{
	    	"exitoso": "No",
		"mensajeError": "El registro ingresado no existe"
	    }';
        }

        $listaAutorizacionesHijas = $response_object->authorization[0]->reference;
        $listadoAutorizaciones = array();
        $temporalArray = array();
        $longitud = count($listaAutorizacionesHijas);

        if ($longitud === 0) {
            return $msj = 'No se encontraron autorizaciones relacionadas a su usuario';
        } else {
            if ($final > ($longitud - 1)) {
                for ($i = $inicio; $i < $longitud; $i++) {
                    array_push($temporalArray, $listaAutorizacionesHijas[$i]);
                }
            } else {
                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listaAutorizacionesHijas[$i]);
                }
            }
        }

        $longitudAutorizaciones = sizeof($temporalArray);
        $response = new \stdClass();
        $response->numVerMas = ceil($longitud / $cantidad);
        for ($i = 0; $i < $longitudAutorizaciones; $i++) {
            $datosAuthHija = $this->getInfoAuthHija($app, $temporalArray[$i]->value, $urlIn);
            $response->dynamicArray[$i]->mensaje_autorizacion_hija = $datosAuthHija->numeroSolicitud . " " . $datosAuthHija->tipoSolicitud . " " . $datosAuthHija->descripcionServicio;
            $response->dynamicArray[$i]->numeroSolicitud = $datosAuthHija->numeroSolicitud;
            $response->dynamicArray[$i]->tipoSolicitud = $datosAuthHija->tipoSolicitud;
            $response->dynamicArray[$i]->descripcionServicio = $datosAuthHija->descripcionServicio;
        }
        $object = json_encode($response);
        return \GuzzleHttp\json_encode($response);
    }

    public function prestacionPorCodigoRest($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $nameFunction = "prestacionPorCodigoRest()";
        $tipoIdentificacion = $_POST['tipoIdentificacion'];
        $numeroIdentificacion = $_POST['numeroIdentificacion'];
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $codigoPrestacion = $_POST['codigoPrestacion'];
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "articulation/articulationOfHealthCare/coverage/v1.0.0/coverageRequest";

        $request = '{
  "patient": {
    "identifier": [
      {
        "type": "TIPO_IDENTIFICACION",
        "value": "' . $tipoIdentificacion . '"
      },
      {
        "type": "NUMERO_IDENTIFICACION",
        "value": "' . $numeroIdentificacion . '"
      }
    ]
  },
  "coverage": {
    "insurancePlan": {
      "type": "CODIGO_PRODUCTO",
      "value": "' . $codigoProducto . '"
    },
    "contract": [
      {
        "type": "PLAN",
        "value": "' . $codigoPlan . '"
      },
      {
        "type": "CONTRATO",
        "value": "' . $contrato . '"
      },
      {
        "type": "FAMILIA",
        "value": "' . $familia . '"
      }
    ]
  },
  "procedure": [
    {
      "identifier": [
        {
          "type": "CODIGO_BH",
          "value": "' . $codigoPrestacion . '"
        }
      ],
      "encounter": {
        "class": {
          "code": 1
        }
      },
      "quantity": 1
    }
  ]
}';

        $datos = array(
            "tipoIdentificacion" => $tipoIdentificacion,
            "numeroIdentificacion" => $numeroIdentificacion,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "contrato" => $contrato,
            "familia" => $familia,
            "codigoPrestacion" => $codigoPrestacion,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        return json_encode($response_object);

    }

    public function getInfoAuthHija($app, $numAuthHija, $urlIn)
    {

        $tipoConsulta = 1;
        $numAuthorization = $numAuthHija;
        $token = $this->getTokenWs($app, false);
        $nameFunction = "getInfoAuthHija()";

        $url = $urlIn . "insurance/operationsSupport/medicalServicesAuthorization/V1.0.0/autorizathion/consultAuthorization";

        $headers = array("tipoconsulta" => $tipoConsulta);
        $request = '{
                "identifier": [
                    {
                      "type": "AUTORIZACION",
                      "value": "' . $numAuthorization . '"
                    }
                  ]
            }';

        $datos = array(
            "tipoConsulta" => $tipoConsulta,
            "numAuthHija" => $numAuthHija,
            "url" => $url,
            "request" => $request,
            "headers" => $headers,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object->code == "RAU02" && $response_object->value == "Registro no existe.") {
            return '{
                    "exitoso": "No",
                    "mensajeError": "El registro ingresado no existe"
                }';
        }
        $response = new \stdClass();
        $response->numeroSolicitud = $response_object->authorization[0]->identifier[0]->value;
        $response->tipoSolicitud = $response_object->authorization[0]->orderDetail->name;
        $response->descripcionServicio = $response_object->authorization[0]->procedure[0]->identifier[1]->value;
        return $response;

    }

    public function ValidateAttentionDate($app, $params_error_report, $nameController, $chat_id)
    {
        date_default_timezone_set('America/Bogota');
        $fecha_atencion_str = $_POST['fechaAtencionCambio'];

        $fecha_atencion = DateTime::createFromFormat('d/m/Y', $fecha_atencion_str);
        $current_date = new DateTime();

        if ($fecha_atencion === false) {
            $var = '{
                "fechafechaAtencionValida" : "0"
            }';
        } else {
            $days_difference = $current_date->diff($fecha_atencion)->days;

            if ($days_difference > 60) {
                $var = '{
                    "fechafechaAtencionValida" : "0"
                }';
            } else {
                $var = '{
                    "fechafechaAtencionValida" : "1",
                    "fechaRa": "' . $fecha_atencion->format("Y-m-d") . "T" . $fecha_atencion->format("H:i:s") . '"
                }';
            }
        }

        return $var;

    }

    public function dateRange($app, $params_error_report, $nameController, $chat_id)
    {
        date_default_timezone_set('America/Bogota');
        $current_date = new DateTime();

        $two_months_ago_date = clone $current_date;
        $two_months_ago_date->modify('-2 months');

        $current_date_formatted = $current_date->format("d/m/Y");
        $two_months_ago_formatted = $two_months_ago_date->format("d/m/Y");

        return '{
            "fechaActual":"' . $current_date_formatted . '",
            "fechaRangoMin":"' . $two_months_ago_formatted . '"
        }';

    }

    public function ConsultarServPorDesc($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "ConsultarServPorDesc()";
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password
        $consultType = $_POST['tipoConsulta'];
        $codProducto = $_POST['codigoProducto'];
        $codPlan = $_POST['codigoPlan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numIdentificacion = $_POST['numIdentificacion'];
        $tipoIdentificacion = $_POST['tipoIdentificacion'];
        $cantidadPrestacion = $_POST['cantidadPrestacion'];
        $descripcionServicio = $_POST['servicioDescripcion'];
        $codSucursalPractica = $_POST['codSucursalPractica'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $descripcionServicio = $this->quitarTildes($descripcionServicio);
        $descripcionServicio = strtoupper($descripcionServicio);
        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona">
   <soapenv:Header>
      <pres:HeaderRqust>
         <!--Optional:-->
         <pres:header>
            <!--Optional:-->
            <nof:messageHeader>
               <!--Optional:-->

               <!--Optional:-->
               <nof:messageInfo>

                  <nof:tipoConsulta>' . $consultType . '</nof:tipoConsulta>
               </nof:messageInfo>
               <!--Optional:-->

            </nof:messageHeader>
            <!--Optional:-->

         </pres:header>
      </pres:HeaderRqust>
   </soapenv:Header>
   <soapenv:Body>
      <pres:ConsultarServicioEnt>
         <!--Optional:-->
         <pres:consultarServicioEnt>
            <!--Optional:-->
            <srv:ConsultarServicio>
               <!--Optional:-->
               <srv:Cobertura>
                  <!--Optional:-->
                  <srv:codigoProducto>' . $codProducto . '</srv:codigoProducto>
                  <!--Optional:-->
                  <srv:codigoPlan>' . $codPlan . '</srv:codigoPlan>
               </srv:Cobertura>
               <!--Optional:-->
               <srv:Contrato>
                  <!--Optional:-->
                  <srv:numContrato>' . $contrato . '</srv:numContrato>
                  <!--Optional:-->
                  <srv:numeroFamilia>' . $familia . '</srv:numeroFamilia>
                  <!--Optional:-->
                  <srv:identificacionAfiliado>
                     <!--Optional:-->
                     <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                     <!--Optional:-->
                     <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                     <!--Optional:-->
                     <per:descTipoIdentificacion></per:descTipoIdentificacion>
                  </srv:identificacionAfiliado>
               </srv:Contrato>
               <!--Zero or more repetitions:-->
               <srv:PrestacionMedicamento>
                  <!--Optional:-->
                  <srv:codPrestacionMedicamentoOSI></srv:codPrestacionMedicamentoOSI>
                  <srv:cantidadPrestacionMedicamentoOSI>' . $cantidadPrestacion . '</srv:cantidadPrestacionMedicamentoOSI>
               </srv:PrestacionMedicamento>
               <!--Optional:-->
               <srv:nomPrestacionMedicamentoOSI>' . $descripcionServicio . '</srv:nomPrestacionMedicamentoOSI>
               <!--Optional:-->
               <srv:PrestPracticaRemitente>
                  <!--Optional:-->
                  <srv:codSucursalRemitente></srv:codSucursalRemitente>
                  <!--Optional:-->
                  <srv:codSucursalPractica>' . $codSucursalPractica . '</srv:codSucursalPractica>
               </srv:PrestPracticaRemitente>
               <!--Optional:-->
               <srv:CTC>
                  <!--Optional:-->
                  <srv:indConsultaNOPOS></srv:indConsultaNOPOS>
                  <!--Optional:-->
                  <srv:codDiagnostico></srv:codDiagnostico>
               </srv:CTC>
               <!--Optional:-->
               <srv:codTipoAtencion></srv:codTipoAtencion>
               <!--Optional:-->
               <srv:fecConvenio></srv:fecConvenio>
               <!--Optional:-->
               <srv:indVisibleAutorizaciones></srv:indVisibleAutorizaciones>
            </srv:ConsultarServicio>
         </pres:consultarServicioEnt>
      </pres:ConsultarServicioEnt>
   </soapenv:Body>
</soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/Prestaciones/ConsultarServicio",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $datos = array(
            "consultType" => $consultType,
            "codProducto" => $codProducto,
            "codPlan" => $codPlan,
            "descripcionServicio" => $descripcionServicio,
            "codSucursalPractica" => $codSucursalPractica,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $soapUrl,
        );
        $response1 = str_replace('<s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', '<Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', $response);
        $response2 = str_replace("</s:Body>", "</Body>", $response1);
        $response3 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response2);
        $response4 = str_replace("</s:Envelope>", "</Envelope>", $response3);
        $response5 = str_replace("<s:Header>", "<Header>", $response4);
        $response6 = str_replace("</s:Header>", "</Header>", $response5);

        $parser = simplexml_load_string($response6);
        $response = json_decode(json_encode($parser));
        \App\Utils\StaticExecuteService::createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST", "Prestadores", $headers, $datos);
        //   return \GuzzleHttp\json_encode($response);

        // $this->createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST");

        $listadoServicios = array();
        $temporalArray = array();
        $longitud = count((array) $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento);
        if ($longitud == 0) {
            return '{
                "error": "1"
            }';
        }
        if (gettype($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento) == "array") {

            for ($i = 0; $i < $longitud; $i++) {
                if ($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento[$i]->codPrestacionOSI) {
                    array_push($listadoServicios, $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento[$i]);
                }
            }
            $longitud2 = count($listadoServicios);
            if ($final > ($longitud2 - 1)) {
                for ($i = $inicio; $i < $longitud2; $i++) {
                    array_push($temporalArray, $listadoServicios[$i]);
                }
            } else {
                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listadoServicios[$i]);
                }
            }

            $longitudServicios = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud2 / $cantidad);
            for ($i = 0; $i < $longitudServicios; $i++) {
                $response->dynamicArray[$i]->mensaje = $temporalArray[$i]->codPrestacionOSI . ' - ' . $temporalArray[$i]->nombrePrestacionMedicamentoOSI;
                $response->dynamicArray[$i]->descripcionAlias = $temporalArray[$i]->nombrePrestacionMedicamentoOSI . ' ' . $temporalArray[$i]->codPrestacionOSI;
                $response->dynamicArray[$i]->especialidadFrecuente = $temporalArray[$i]->informacionConfCoberturas->convenioPrestador->especialdadFrecuente;
                $response->dynamicArray[$i]->longitudTipoAtencion = 0;
                $response->dynamicArray[$i]->nombrePrestacionMedicamentoOSI = $temporalArray[$i]->nombrePrestacionMedicamentoOSI;
                $response->dynamicArray[$i]->codPrestacionOsi = $temporalArray[$i]->codPrestacionOSI;
                if (substr($response->dynamicArray[$i]->codPrestacionOsi = $temporalArray[$i]->codPrestacionOSI, 0, 4) == "8904") {
                    $response->dynamicArray[$i]->interconsulta = "1";
                } else {
                    $response->dynamicArray[$i]->interconsulta = "0";
                }
                if (gettype($temporalArray[$i]->informacionConfCoberturas) == 'array') {
                    $response->dynamicArray[$i]->longitudTipoAtencion = count($temporalArray[$i]->informacionConfCoberturas);
                    for ($j = 0; $j < count($temporalArray[$i]->informacionConfCoberturas); $j++) {
                        $response->dynamicArray[$i]->tipoAtencion[$j]->tipoAtencionName = $temporalArray[$i]->informacionConfCoberturas[$j]->nomTipoAtencion;
                        $response->dynamicArray[$i]->tipoAtencion[$j]->requiereAutorizacion = $temporalArray[$i]->informacionConfCoberturas[$j]->requiereAutorizacion;
                        $response->dynamicArray[$i]->tipoAtencion[$j]->especialidadPrestador = $temporalArray[$i]->informacionConfCoberturas[$j]->convenioPrestador->especialdadFrecuente;

                    }
                } else {
                    $response->dynamicArray[$i]->tipoAtencion = $temporalArray[$i]->informacionConfCoberturas->nomTipoAtencion;
                    $response->dynamicArray[$i]->requiereAutorizacion = $temporalArray[$i]->informacionConfCoberturas->requiereAutorizacion;
                    $response->dynamicArray[$i]->especialidadPrestador = $temporalArray[$i]->informacionConfCoberturas->convenioPrestador->especialdadFrecuente;

                }
            };

            $object = json_encode($response);
            return \GuzzleHttp\json_encode($response);
        } else {
            array_push($temporalArray, $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento);
            $response = new \stdClass();

            $response->dynamicArray[0]->mensaje = $temporalArray[0]->codPrestacionOSI . ' - ' . $temporalArray[0]->nombrePrestacionMedicamentoOSI;
            $response->dynamicArray[0]->descripcionAlias = $temporalArray[0]->nombrePrestacionMedicamentoOSI . ' ' . $temporalArray[0]->codPrestacionOSI;
            $response->dynamicArray[0]->especialidadFrecuente = $temporalArray[0]->informacionConfCoberturas->convenioPrestador->especialdadFrecuente;

            $response->dynamicArray[0]->nombrePrestacionMedicamentoOSI = $temporalArray[0]->nombrePrestacionMedicamentoOSI;
            $response->dynamicArray[0]->codPrestacionOsi = $temporalArray[0]->codPrestacionOSI;
            if (substr($response->dynamicArray[0]->codPrestacionOsi = $temporalArray[0]->codPrestacionOSI, 0, 4) == "8904") {
                $response->dynamicArray[0]->interconsulta = "1";
            } else {
                $response->dynamicArray[0]->interconsulta = "0";
            }
            if (gettype($temporalArray[0]->informacionConfCoberturas) == 'array') {
                $response->dynamicArray[0]->longitudTipoAtencion = count($temporalArray[0]->informacionConfCoberturas);
                for ($j = 0; $j < count($temporalArray[0]->informacionConfCoberturas); $j++) {
                    $response->dynamicArray[0]->tipoAtencion[$j]->tipoAtencionName = $temporalArray[0]->informacionConfCoberturas[$j]->nomTipoAtencion;
                    $response->dynamicArray[0]->tipoAtencion[$j]->requiereAutorizacion = $temporalArray[0]->informacionConfCoberturas[$j]->requiereAutorizacion;
                    $response->dynamicArray[$i]->tipoAtencion[$j]->especialidadPrestador = $temporalArray[$i]->informacionConfCoberturas[$j]->convenioPrestador->especialdadFrecuente;
                }
            } else {
                $response->dynamicArray[0]->tipoAtencion = $temporalArray[0]->informacionConfCoberturas->nomTipoAtencion;
                $response->dynamicArray[0]->requiereAutorizacion = $temporalArray[0]->informacionConfCoberturas->requiereAutorizacion;
                //$response->dynamicArray[$i]->especialidadPrestador = $temporalArray[$i]->informacionConfCoberturas->convenioPrestador->especialdadFrecuente;
            }
            $object = json_encode($response);
            return \GuzzleHttp\json_encode($response);
        }

    }

    public function prestacionesByCod($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "prestacionesByCod()";
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password
        $tipoConsulta = $_POST['tipoConsulta'];
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numIdentificacion = $_POST['numIdentificacion'];
        $tipoIdentificacion = $_POST['tipoIdentificacion'];
        $codPrestacionMedicamentoOSI = $_POST['codPrestacionMedicamentoOSI'];
        $cantidadPrestacion = $_POST['cantidadPrestacion'];
        $codSucursalPractica = $_POST['codSucursalPractica'];

        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona">
    <soapenv:Header>
       <pres:HeaderRqust>
          <!--Optional:-->
          <pres:header>
             <!--Optional:-->
             <nof:messageHeader>
                <!--Optional:-->

                <!--Optional:-->
                <nof:messageInfo>

                    <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                 </nof:messageInfo>
                 <!--Optional:-->

              </nof:messageHeader>
              <!--Optional:-->

           </pres:header>
        </pres:HeaderRqust>
     </soapenv:Header>
     <soapenv:Body>
        <pres:ConsultarServicioEnt>
           <!--Optional:-->
           <pres:consultarServicioEnt>
              <!--Optional:-->
              <srv:ConsultarServicio>
                 <!--Optional:-->
                 <srv:Cobertura>
                    <!--Optional:-->
                    <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                    <!--Optional:-->
                    <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                 </srv:Cobertura>
                 <!--Optional:-->
                 <srv:Contrato>
                    <!--Optional:-->
                    <srv:numContrato>' . $contrato . '</srv:numContrato>
                    <!--Optional:-->
                    <srv:numeroFamilia>' . $familia . '</srv:numeroFamilia>
                    <!--Optional:-->
                    <srv:identificacionAfiliado>
                       <!--Optional:-->
                       <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                       <!--Optional:-->
                       <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                       <!--Optional:-->
                       <per:descTipoIdentificacion></per:descTipoIdentificacion>
                    </srv:identificacionAfiliado>
                 </srv:Contrato>
                 <!--Zero or more repetitions:-->
                 <srv:PrestacionMedicamento>
                    <!--Optional:-->
                    <srv:codPrestacionMedicamentoOSI>' . $codPrestacionMedicamentoOSI . '</srv:codPrestacionMedicamentoOSI>
                    <srv:cantidadPrestacionMedicamentoOSI>' . $cantidadPrestacion . '</srv:cantidadPrestacionMedicamentoOSI>
                 </srv:PrestacionMedicamento>
                 <!--Optional:-->
                 <srv:nomPrestacionMedicamentoOSI></srv:nomPrestacionMedicamentoOSI>
                 <!--Optional:-->
                 <srv:PrestPracticaRemitente>
                    <!--Optional:-->
                    <srv:codSucursalRemitente></srv:codSucursalRemitente>
                    <!--Optional:-->
                    <srv:codSucursalPractica>' . $codSucursalPractica . '</srv:codSucursalPractica>
                 </srv:PrestPracticaRemitente>
                 <!--Optional:-->
                 <srv:CTC>
                    <!--Optional:-->
                    <srv:indConsultaNOPOS></srv:indConsultaNOPOS>
                    <!--Optional:-->
                    <srv:codDiagnostico></srv:codDiagnostico>
                 </srv:CTC>
                 <!--Optional:-->
                 <srv:codTipoAtencion></srv:codTipoAtencion>
                 <!--Optional:-->
                 <srv:fecConvenio></srv:fecConvenio>
                 <!--Optional:-->
                 <srv:indVisibleAutorizaciones></srv:indVisibleAutorizaciones>
              </srv:ConsultarServicio>
           </pres:consultarServicioEnt>
        </pres:ConsultarServicioEnt>
     </soapenv:Body>
    </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/Prestaciones/ConsultarServicio",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $datos = array(
            "tipoConsulta" => $tipoConsulta,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "codSucursalPractica" => $codSucursalPractica,
            "codPrestacionMedicamentoOSI" => $codPrestacionMedicamentoOSI,
            "url" => $soapUrl,
        );
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);
        $response1 = str_replace('<s:Body ', '<Body ', $response);
        $response2 = str_replace("</s:Body>", "</Body>", $response1);
        $response3 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response2);
        $response4 = str_replace("</s:Envelope>", "</Envelope>", $response3);
        $response5 = str_replace("<s:Header>", "<Header>", $response4);
        $response6 = str_replace("</s:Header>", "</Header>", $response5);
        $parser = simplexml_load_string($response6);
        $response = json_decode(json_encode($parser));
        $this->createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST");
        if (gettype($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->validaciones) == "array") {
            $codigoError = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->validaciones[0]->codigo;
            if ($codigoError == "PRE14" || $codigoError == "PRE29" || $codigoError == "PRE12") {
                return '{
                    "statusN" : "0"
                }';
            }
        } else {
            $codigoError = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->validaciones->codigo;
            if ($codigoError == "PRE14" || $codigoError == "PRE29" || $codigoError == "PRE12") {
                return '{
                    "statusN" : "0"
                }';
            }
        }
        $responseObject = new \stdClass();
        if (gettype($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas) == "object") {

            $responseObject->codPrestacionOSI = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->codPrestacionOSI;
            if (substr($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->codPrestacionOSI, 0, 4) == "8904") {
                $responseObject->interconsulta = "1";
            } else {
                $responseObject->interconsulta = "0";
            }
            $responseObject->nombrePrestacionMedicamentoOSI = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->nombrePrestacionMedicamentoOSI;
            $responseObject->descripcionAlias = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->nombrePrestacionMedicamentoOSI . ' ' . $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->codPrestacionOSI;
            $responseObject->longitudTipoAtencion = 0;
            $responseObject->nomTipoAtencion = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->nomTipoAtencion;
            $responseObject->requiereAutorizacion = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->requiereAutorizacion;
            $responseObject->especialidadPrestador = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->convenioPrestador->especialdadFrecuente;

            return \GuzzleHttp\json_encode($responseObject);

        } else {
            $longitud = count($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas);
            $responseObject->codPrestacionOSI = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->codPrestacionOSI;
            if (substr($response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->codPrestacionOSI, 0, 4) == "8904") {
                $responseObject->interconsulta = "1";
            } else {
                $responseObject->interconsulta = "0";
            }
            $responseObject->nombrePrestacionMedicamentoOSI = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->nombrePrestacionMedicamentoOSI;
            $responseObject->longitudTipoAtencion = $longitud;
            for ($i = 0; $i < $longitud; $i++) {
                $responseObject->informacionConfCoberturas[$i]->nomTipoAtencion = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas[$i]->nomTipoAtencion;
                $responseObject->informacionConfCoberturas[$i]->requiereAutorizacion = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas[$i]->requiereAutorizacion;
                $responseObject->informacionConfCoberturas[$i]->especialidadPrestador = $response->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas[$i]->convenioPrestador->especialdadFrecuente;

            }
            return \GuzzleHttp\json_encode($responseObject);

        }
    }

    public function ReversarUtilPin($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "ReversarUtilPin()";
        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $codigoCompania = $_POST['codigoCompania'];
        $codigoPlan = $_POST['codigoPlan'];
        $numeroContrato = $_POST['numeroContrato'];
        $numeroFlia = $_POST['numeroFlia'];
        $numeroUsuario = $_POST['numeroUsuario'];
        $numeroUsuerio = '0' . $numeroUsuario;
        $numeroPin = $_POST['numeroPin'];
        $Documento = $_POST['Documento'];
        $TipoDocumento = $_POST['TipoDocumento'];
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        switch ($TipoDocumento) {
            case "1":
                $TipoDocumento = "01";
                break;
            case "2":
                $TipoDocumento = "02";
                break;
            case "3":
                $TipoDocumento = "03";
                break;
            case "4":
                $TipoDocumento = "04";
                break;
            case "5":
                $TipoDocumento = "05";
                break;
            case "6":
                $TipoDocumento = "06";
                break;
            case "7":
                $TipoDocumento = "07";
                break;
            case "8":
                $TipoDocumento = "08";
                break;
            case "9":
                $TipoDocumento = "09";
                break;
            case "10":
                $TipoDocumento = "10";
                break;
            case "11":
                $TipoDocumento = "11";
                break;
            case "12":
                $TipoDocumento = "12";
                break;
            case "13":
                $TipoDocumento = "13";
                break;
            case "15":
                $TipoDocumento = "15";
                break;
            default:
                $TipoDocumento = $TipoDocumento;
                break;
        };

        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ges="http://www.colsanitas.com/GestionPines/" xmlns:com="http://www.colsanitas.com/schema/osi/comun" xmlns:srv="http://www.colsanitas.com/schema/osi/srv">
   <soapenv:Header>
      <ges:HeaderRqust>
         <header>
            <!--Optional:-->
            <com:messageHeader>
               <!--Optional:-->
               <com:messageKey>
                  <!--Optional:-->
                  <com:correlationId></com:correlationId>
                  <com:requestVersion></com:requestVersion>
                  <com:requestUUID></com:requestUUID>
               </com:messageKey>
               <!--Optional:-->
               <com:messageInfo>
                  <com:timeZone></com:timeZone>
                  <com:dateTime></com:dateTime>
                  <!--Optional:-->
                  <com:systemId></com:systemId>
               </com:messageInfo>
               <!--Optional:-->
               <com:trace>
                  <!--Optional:-->
                  <com:processId></com:processId>
                  <!--Optional:-->
                  <com:integrationId></com:integrationId>
                  <!--Optional:-->
                  <com:tracingId></com:tracingId>
               </com:trace>
            </com:messageHeader>
            <com:user>
               <com:userName>' . $userName . '</com:userName>
               <com:userToken>' . $userToken . '</com:userToken>
            </com:user>
         </header>
      </ges:HeaderRqust>
   </soapenv:Header>
   <soapenv:Body>
      <ges:ReversaUtilizacionPinEnt>
         <consulta>
            <srv:consulta>
               <srv:codigoCompania>' . $codigoCompania . '</srv:codigoCompania>
               <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
               <srv:numeroContrato>' . $numeroContrato . '</srv:numeroContrato>
            </srv:consulta>
            <srv:numeroFlia>' . $numeroFlia . '</srv:numeroFlia>
            <srv:numeroUsuario>' . $numeroUsuario . '</srv:numeroUsuario>
            <srv:numeroPin>' . $numeroPin . '</srv:numeroPin>
            <srv:prestador>
               <com:Documento>' . $Documento . '</com:Documento>
               <com:TipoDocumento>' . $TipoDocumento . '</com:TipoDocumento>
            </srv:prestador>
         </consulta>
      </ges:ReversaUtilizacionPinEnt>
   </soapenv:Body>
</soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/GestionPines/ReversaUtilizacionPin",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $datos = array(
            "userName" => $userName,
            "userToken" => $userToken,
            "codigoCompania" => $codigoCompania,
            "codigoPlan" => $codigoPlan,
            "numeroContrato" => $numeroContrato,
            "numeroFlia" => $numeroFlia,
            "numeroUsuario" => $numeroUsuario,
            "numeroPin" => $numeroPin,
            "Documento" => $Documento,
            "TipoDocumento" => $TipoDocumento,
            "url" => $soapUrl,
        );
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);
        $response1 = str_replace("<soap:Body>", "", $response);
        $response2 = str_replace("</soap:Body>", "", $response1);
        $this->createLog($response2, $xml_post_string, $chat_id, $nameFunction, "POST");

        if ($http_code === 200) {

            $responseRev = '{
        "statusRevPin": "1",
        "msjSalidaRevPin": "' . $response2 . '"
        }';
        } else {
            $responseRev = '{
        "statusRevPin": "0",
        "msjSalidaRevPin": "Este pin se encuentra habilitado"
        }';
        }
        return $responseRev;
    }

    public function cambiarContra($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "cambiarContra()";
        $tipoConsulta = 1;
        $usuario = $_POST['usuario'];
        $claveActual = $_POST['claveActual'];
        $claveNueva = $_POST['claveNueva'];
        $confirmarClaveNueva = $_POST['confirmarClaveNueva'];
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "user/userManagement/gestorCredenciales/v1.0.0/cambiarContrasena";

        $request = '{
    "usuario" : "' . $usuario . '",
    "claveActual" :  "' . $claveActual . '",
    "claveNueva" : "' . $claveNueva . '",
    "confirmarClaveNueva" : "' . $confirmarClaveNueva . '"
}';

        $datos = array(
            "usuario" => $usuario,
            "claveActual" => $claveActual,
            "claveNueva" => $claveNueva,
            "confirmarClaveNueva" => $confirmarClaveNueva,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return json_encode($response_object);
    }
    public function curlCambiarContra($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "curlCambiarContra()";
        $usuario = $_POST['usuario'];
        $claveActual = $_POST['claveActual'];
        $claveNueva = $_POST['claveNueva'];
        $confirmarClaveNueva = $_POST['confirmarClaveNueva'];
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "user/userManagement/gestorCredenciales/v1.0.0/cambiarContrasena";

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
            CURLOPT_POSTFIELDS => '{
            "usuario" : "' . $usuario . '",
            "claveActual" :  "' . $claveActual . '",
            "claveNueva" : "' . $claveNueva . '",
            "confirmarClaveNueva" : "' . $confirmarClaveNueva . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token . '',
                'Accept: application/json',
                'Content-Type: application/json',
                'Cookie: incap_ses_9207_2178250=mrYDcgOSJQluKr8S29XFfyrcxGYAAAAAFAiqGCogf89o9WovW08ftA==; incap_ses_9207_2197032=lMfVa5x4eD63VbQS29XFf5bMxGYAAAAAhLd4D18OKNCPWPbHebXy2Q==; visid_incap_2178250=CgqW2piySPiD5Gpnh0UGILD2qGYAAAAAQUIPAAAAAADWQ/8yPEQVPLY/bbshzOgg; visid_incap_2197031=gdQmSjaFQh2lTVe1451L05ghuWUAAAAAQUIPAAAAAACpsUo6g+kgcdvp62v/6O6W; visid_incap_2197032=4FBXuQb0SS2rNnBmY3NLQJl6oWUAAAAAQUIPAAAAAACW3ktlLjfG+vAVE1KNE4eZ; BIGipServer~Produccion~Pool_Colsanitas-PINT01=2533466122.23328.0000; BIGipServer~Produccion~Pool_Colsanitas_Gaudi-Services=1073848330.36895.0000; BIGipServer~Produccion~Pool_Colsanitas_osi-api=1342283786.22560.0000; BIGipServer~Produccion~Pool_Colsanitas_token=2516688906.22560.0000; eed9178d96b75dde44848d5c203acd39=837fa7791e51a347e646f2dfd71424ff',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $parametros = array(
            "usuario" => $usuario,
            "claveActual" => $claveActual,
            "claveNueva" => $claveNueva,
            "confirmarClaveNueva" => $confirmarClaveNueva,
            "url" => $url,
            "token" => $token,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");
        return $response;

    }

    public function curlRecordarContra($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "curlRecordarContra()";
        $tipoConsulta = 1;
        $userPass = $_POST['userPass'];
        $fechaPeticion = "2019-05-01T00:00:00";
        $codAplicacion = "SIE000000136";
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "user/userManagement/gestorCredenciales/v1.0.0/recordarContrasena";

        $headers = array("tipoConsulta" => $tipoConsulta, "fechaPeticion" => $fechaPeticion, "CodAplicacion" => $codAplicacion);

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
            CURLOPT_POSTFIELDS => '{
    "usuario": "' . $userPass . '"
}',
            CURLOPT_HTTPHEADER => array(
                'tipoConsulta: 1',
                'fechaPeticion: 2019-05-01T00:00:00',
                'CodAplicacion: SIE000000136',
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token . '',
                'Cookie: incap_ses_9207_2178250=aPAcEkgdb1acKWwT29XFf9hSxmYAAAAACWThRO4RxIsnL9B890/T0g==; incap_ses_9207_2197032=lMfVa5x4eD63VbQS29XFf5bMxGYAAAAAhLd4D18OKNCPWPbHebXy2Q==; incap_ses_9220_2178250=UxwpP+wCLnh5ytEdRwX0f+RNx2YAAAAA+hfQt3G8sUj4A5eEAkqLsQ==; visid_incap_2178250=CgqW2piySPiD5Gpnh0UGILD2qGYAAAAAQUIPAAAAAADWQ/8yPEQVPLY/bbshzOgg; visid_incap_2197031=gdQmSjaFQh2lTVe1451L05ghuWUAAAAAQUIPAAAAAACpsUo6g+kgcdvp62v/6O6W; visid_incap_2197032=4FBXuQb0SS2rNnBmY3NLQJl6oWUAAAAAQUIPAAAAAACW3ktlLjfG+vAVE1KNE4eZ; BIGipServer~Produccion~Pool_Colsanitas-PINT01=1359061002.23328.0000; BIGipServer~Produccion~Pool_Colsanitas_Gaudi-Services=1073848330.36895.0000; BIGipServer~Produccion~Pool_Colsanitas_osi-api=1342283786.22560.0000; BIGipServer~Produccion~Pool_Colsanitas_token=2516688906.22560.0000; eed9178d96b75dde44848d5c203acd39=837fa7791e51a347e646f2dfd71424ff',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $parametros = array(
            "userPass" => $userPass,
            "url" => $url,
            "token" => $token,
        );
        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");
        return $response;

    }

    public function recordarContra($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "recordarContra()";
        $tipoConsulta = 1;
        $userPass = $_POST['userPass'];
        $fechaPeticion = "2019-05-01T00:00:00";
        $codAplicacion = "SIE000000136";
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "user/userManagement/gestorCredenciales/v1.0.0/recordarContrasena";

        $headers = array("tipoConsulta" => $tipoConsulta, "fechaPeticion" => $fechaPeticion, "CodAplicacion" => $codAplicacion);

        $request = '{
            "usuario" : "' . $userPass . '"
        }';

        $datos = array(
            "tipoConsulta" => $tipoConsulta,
            "userPass" => $userPass,
            "fechaPeticion" => $fechaPeticion,
            "codAplicacion" => $codAplicacion,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return json_encode($response_object);
    }

    public function validarCodigoRegistroAtencion($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "   ()";
        $codRegistro = $_POST['registroNumero'];
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/consultaRegistroAtencion';
        $token = $this->getTokenWs($app, false);
        $request = '{
            "numRefRegistroAtencion": "' . $codRegistro . '"
        }';

        $datos = array(
            "codRegistro" => $codRegistro,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $longitud = count($response_object->infoPrestador->infoAtencion);
        $listaRA = array();
        $listaCod = array();
        $listaDateCreate = array();
        $listaUsuarios = array();
        $estadosRA = array();
        $opcionesRA = array();
        $listNumId = array();
        $listTipoId = array();
        $listNit = array();
        $listPlan = array();
        $listProducto = array();
        $listVale = array();
        $listAuthRA = array();
        $listSucursal = array();
        $i = 0;

        $response = new \stdClass();

        for ($i == 0; $i <= $longitud - 1; $i++) {

            $id = $response_object->infoPrestador->infoAtencion[$i]->numeroReferencia;
            $nitPrestador = $response_object->infoPrestador->nitPrest;
            $cod = $response_object->infoPrestador->infoAtencion[$i]->codProducto;
            $codPlan = $response_object->infoPrestador->infoAtencion[$i]->codPlan;
            $date = $response_object->infoPrestador->infoAtencion[$i]->fechaCreacion;
            $user_create = $response_object->infoPrestador->infoAtencion[$i]->usuario;
            $estado = $response_object->infoPrestador->infoAtencion[$i]->estado;
            $num_vale = $response_object->infoPrestador->infoAtencion[$i]->numValeElect;
            $opcion = $id . ' - ' . $date;
            $autorizacionRA = $response_object->infoPrestador->infoAtencion[$i]->numAutor;
            $sucursalCod = $response_object->infoPrestador->codSucursalPres;

            if ($num_vale == null) {
                $num_vale = "NA";
            }

            if ($autorizacionRA == null) {
                $autorizacionRA = "NA";
            }

            array_push($listaRA, $id);
            array_push($listaCod, $cod);
            array_push($listProducto, $cod);
            array_push($listaDateCreate, $date);
            array_push($listaUsuarios, $user_create);
            array_push($estadosRA, $estado);
            array_push($opcionesRA, $opcion);
            array_push($listPlan, $codPlan);
            array_push($listNit, $nitPrestador);
            array_push($listVale, $num_vale);
            array_push($listAuthRA, $autorizacionRA);
            array_push($listSucursal, $sucursalCod);

            $response->dynamicArray[$i]->numeroId = $listaRA[$i];
            $response->dynamicArray[$i]->codCompany = $listaCod[$i];
            $response->dynamicArray[$i]->dateCreation = $listaDateCreate[$i];
            $response->dynamicArray[$i]->userRegister = $listaUsuarios[$i];
            $response->dynamicArray[$i]->estadoRegister = $estadosRA[$i];
            $response->dynamicArray[$i]->opcionesRegister = $opcionesRA[$i];
            $response->dynamicArray[$i]->codPlan = $listPlan[$i];
            $response->dynamicArray[$i]->nitPrestador = $listNit[$i];
            $response->dynamicArray[$i]->codigoProducto = $listProducto[$i];
            $response->dynamicArray[$i]->numValeElect = $listVale[$i];
            $response->dynamicArray[$i]->numAutorizacion = $listAuthRA[$i];
            $response->dynamicArray[$i]->codigoSucursal = $listSucursal[$i];
        }

        return \GuzzleHttp\json_encode($response);

    }

    public function checkRA($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "checkRA()";
        $codSucursal = $_POST['codigoSucursal'];
        $fechaInicio = $_POST['fechaDesde'];
        $fechaFin = $_POST['fechaHasta'];
        $tipoDoc = $_POST['tipoIdentificacion'];
        $numDoc = $_POST['numeroIdentificacion'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/consultaRegistroAtencion';
        $token = $this->getTokenWs($app, false);
        $request = '{
            "codSucursalPres": "' . $codSucursal . '",
            "fechaInicio": "' . $fechaInicio . '",
            "fechaFin": "' . $fechaFin . '",
            "tipoDoc": "' . $tipoDoc . '",
            "numDoc": "' . $numDoc . '",
            "codProducto": null,
            "numVale": null,
            "numAutor": null
        }';

        $datos = array(
            "codSucursal" => $codSucursal,
            "fechaInicio" => $fechaInicio,
            "fechaFin" => $fechaFin,
            "tipoDoc" => $tipoDoc,
            "numDoc" => $numDoc,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "token" => $token,
            "url" => $url,
        );

        //$response_object = $this->executeService($app, $url, $request, "POST", $token, $headers, $params_error_report);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $sucursalCodigo = $response_object->infoPrestador->codSucursalPres;

        $listadoRA = array();
        $temporalArray = array();
        $longitud = count($response_object->infoPrestador->infoAtencion);

        if (count($response_object->infoPrestador->infoAtencion) == '0') {
            return $msj = 'null';
        } else {
            for ($i = 0; $i < $longitud; $i++) {
                array_push($listadoRA, $response_object->infoPrestador->infoAtencion[$i]);
            }
            $longitud2 = count($listadoRA);
            if ($final > ($longitud2 - 1)) {
                //$rest = $final - ($longitud2);
                for ($i = $inicio; $i < $longitud2; $i++) {
                    array_push($temporalArray, $listadoRA[$i]);
                }
            } else {

                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listadoRA[$i]);
                }
            }
        }

        $longitudRA = sizeof($temporalArray);
        $response = new \stdClass();
        $response->numVerMas = ceil($longitud / $cantidad);

        switch ($tipoDoc) {
            case "CC":
                $tipoDoc = "1";
                break;
            case "CE":
                $tipoDoc = "2";
                break;
            case "MS":
                $tipoDoc = "3";
                break;
            case "NIT":
                $tipoDoc = "4";
                break;
            case "NIP":
                $tipoDoc = "5";
                break;
            case "PA":
                $tipoDoc = "6";
                break;
            case "RC":
                $tipoDoc = "7";
                break;
            case "TI":
                $tipoDoc = "8";
                break;
            case "CD":
                $tipoDoc = "9";
                break;
            case "CN":
                $tipoDoc = "10";
                break;
            case "SC":
                $tipoDoc = "11";
                break;
            case "PD":
                $tipoDoc = "12";
                break;
            case "PE":
                $tipoDoc = "13";
                break;
            case "PT":
                $tipoDoc = "15";
                break;
            default:
                $tipoDoc = $tipoDoc;
                break;
        };

        for ($i = 0; $i < $longitudRA; $i++) {

            $autorizacionRA = $temporalArray[$i]->numAutor;
            $pinRA = $temporalArray[$i]->numValeElect;

            if ($pinRA == null) {
                $pinRA = "NA";
            }

            if ($autorizacionRA == null) {
                $autorizacionRA = "NA";
            }

            $response->dynamicArray[$i]->numeroId = $temporalArray[$i]->numeroReferencia;
            $response->dynamicArray[$i]->nitPrestador = $response_object->infoPrestador->nitPrest;
            $response->dynamicArray[$i]->codCompany = $temporalArray[$i]->codProducto;
            $response->dynamicArray[$i]->codigoProducto = $temporalArray[$i]->codProducto;
            $response->dynamicArray[$i]->codPlan = $temporalArray[$i]->codPlan;
            $response->dynamicArray[$i]->dateCreation = $temporalArray[$i]->fechaCreacion;
            $response->dynamicArray[$i]->userRegister = $temporalArray[$i]->usuario;
            $response->dynamicArray[$i]->estadoRegister = $temporalArray[$i]->estado;
            $response->dynamicArray[$i]->codigoSucursal = $sucursalCodigo;
            $response->dynamicArray[$i]->numValeElect = $pinRA;
            $response->dynamicArray[$i]->numAutorizacion = $autorizacionRA;

            $response->dynamicArray[$i]->opcionesRegister = $temporalArray[$i]->numeroReferencia . ' ' . $temporalArray[$i]->fechaCreacion;

        }

        return \GuzzleHttp\json_encode($response);
    }

    public function validateDate($app, $params_error_report, $nameController, $chat_id)
    {
        $fechaObtenida = $_POST['fechaInicial'];
        $fecha1 = date_create(date($fechaObtenida));
        $fecha2 = date_create(date('Y-m-d h:i:s'));
        $interval = date_diff($fecha1, $fecha2);
        $valid_date = '{
            "diasDiff": "' . $interval->format('%d') . '",
            "mesesDiff": "' . $interval->format('%m') . '",
            "anhosDiff": "' . $interval->format('%y') . '"
        }';
        return $valid_date;
    }

    public function fechaDesde()
    {
        $fecha1 = $_POST['fecha1'];
        $fecha2 = $_POST['fecha2'];
        $fechaUno = date_create(date($fecha1));
        $fechaDos = date_create(date($fecha2));
        $salida = '{
            "fechaInicial": "' . date_format($fechaUno, 'Y-m-d\Th:i:s') . '",
            "fechaFinal": "' . date_format($fechaDos, 'Y-m-d\Th:i:s') . '"
        }';
        return $salida;
    }

    public function getDate($app, $params_error_report, $nameController, $chat_id)
    {
        $fecha1 = $_POST['fechaInicial'];
        $fecha2 = $_POST['fechaFinal'];
        $fecha1 = str_replace(' ', 'T', $fecha1);
        $fecha2 = str_replace(' ', 'T', $fecha2);
        $fecha2_1 = substr($fecha2, 0, -8);
        $hora_final = "23:59:59";
        $fecha2_2 = $fecha2_1 . $hora_final;
        $actual_date = '{
            "fechaDesde": "' . $fecha1 . '",
            "fechaHasta": "' . $fecha2_2 . '"
        }';
        return $actual_date;
    }

    public function validateUser($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "validateUser()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $url = $urlIn . 'assurance/affiliations/affiliationsAndNewsManagements/contract/v1.0.0/cover';
        $token = $this->getTokenWs($app, false);
        $tipoId = substr($tipoId, 0, 2);
        $tipoId = strtoupper($tipoId);
        $numId = strtoupper($numId);
        $request = '{
            "subject": {
                "identifier": [
                    {
                        "type": "TIPO_IDENTIFICACION",
                        "value": "' . $tipoId . '"
                    },
                    {
                        "type": "NUMERO_IDENTIFICACION",
                        "value": "' . $numId . '"
                    }
                ]
            },
            "coverage": {
                "insurancePlan": {
                    "type": "CODIGO_PRODUCTO",
                    "value": ""
                },
                "contract": [
                    {
                        "type": "PLAN",
                        "value": ""
                    },
                    {
                        "type": "CONTRATO",
                        "value": ""
                    },
                    {
                        "type": "FAMILIA",
                        "value": ""
                    }
                ]
            },
            "swFamily": true,
            "lastValid": true,
            "planType": ""
        }';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "token" => $token,
            "url" => $url,
        );

        //$response_object = $this->executeService($app,$url, $request, "POST", $token, $headers, $params_error_report);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $longitud = sizeof($response_object->coverFamilyResponse);
        // $longitud2 = sizeof($response_object->coverResponse);

        if ($longitud == 0) {
            $validUser = '{
                "UsuarioValido": "0"
            }';
        } else {
            $validUser = '{
                "UsuarioValido": "1"
            }';
        }
        return $validUser;

    }

// se elimina crearErrorLog porque ahora esta en la ruta /var/www/app/models para poder ser usado en cualquier otro controlador.
    //Para saber que argumentos enviarle ver funcion ListDoctor.

    private function cancelRegister($app, $params_error_report, $nameController, $chat_id)
    {
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/IVRServices.IVRServicesHttpSoap12Endpoint?wsdl"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/IVRServices.IVRServicesHttpSoap12Endpoint?wsdl';
        }
        $codigo = $_POST['codigo'];
        $username = $_POST['user'];
        $usertoken = $_POST['tokenUser'];
        $codigodocumento = $_POST['tipoDocumento'];
        $documentoidentidad = $_POST['numDocumento'];
        $codigoregistro = $_POST['codigoRegistro'];
        $nameFunction = "cancelRegister()";

        $tipo = "POST";

        $datos = array(
            "codigo" => $codigo,
            "username" => $username,
            "usertoken" => $usertoken,
            "codigodocumento" => $codigodocumento,
            "documentoidentidad" => $documentoidentidad,
            "codigoregistro" => $codigoregistro,
            "url" => $url,
        );

        if (strpos($codigodocumento, '0') === false) {
            $codigodocumento = '0' . $codigodocumento;
        }

        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ivrservices.osi.com/">
        <soapenv:Header/>
        <soapenv:Body>
           <ser:anularRegistroAtencion>
              <!--Optional:-->
              <anularRegistroAtencionEnt>
                 <!--Optional:-->
                 <compania>
                    <!--Optional:-->
                    <codigo>' . $codigo . '</codigo>
                 </compania>
                 <!--Optional:-->
                 <headerUsuarioPines>
                    <!--Optional:-->
                    <userName>' . $username . '</userName>
                    <!--Optional:-->
                    <userToken>' . $usertoken . '</userToken>
                 </headerUsuarioPines>
                 <!--Optional:-->
                 <prestador>
                    <!--Optional:-->
                    <identificacion>
                       <!--Optional:-->
                       <codigoTipoDocumento>' . $codigodocumento . '</codigoTipoDocumento>
                       <!--Optional:-->
                       <documentoIdentidad>' . $documentoidentidad . '</documentoIdentidad>
                    </identificacion>
                    <!--Optional:-->
                    <sucursal></sucursal>
                 </prestador>
                 <!--Optional:-->
                 <registroAtencion>
                    <!--Optional:-->
                    <codigoRegistro>' . $codigoregistro . '</codigoRegistro>
                 </registroAtencion>
              </anularRegistroAtencionEnt>
           </ser:anularRegistroAtencion>
        </soapenv:Body>
     </soapenv:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: ""',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $respuesta = curl_exec($ch);
        $this->createLog($respuesta, $datos, $chat_id, $nameFunction, "POST");

        $respuesta1 = str_replace("<env:Envelope xmlns:env='http://schemas.xmlsoap.org/soap/envelope/'>", "<Envelope xmlns:env='http://schemas.xmlsoap.org/soap/envelope/'>", $respuesta);
        $respuesta2 = str_replace("<env:Header></env:Header>", "<Header></Header>", $respuesta1);
        $respuesta3 = str_replace("<env:Body>", "<Body>", $respuesta2);
        $respuesta4 = str_replace('<ns2:anularRegistroAtencionResponse xmlns:ns2="http://service.ivrservices.osi.com/">', '<anularRegistroAtencionResponse xmlns:ns2="http://service.ivrservices.osi.com/">', $respuesta3);
        $respuesta5 = str_replace("</ns2:anularRegistroAtencionResponse>", "</anularRegistroAtencionResponse>", $respuesta4);
        $respuesta6 = str_replace("</env:Body>", "</Body>", $respuesta5);
        $respuesta7 = str_replace("</env:Envelope>", "</Envelope>", $respuesta6);

        $parser = simplexml_load_string($respuesta7);

        $validacionCodigo = $parser->Body->anularRegistroAtencionResponse->anularRegistroAtencionSal->mensajeRespuestaError->codigo;
        $mensajeSalida = $parser->Body->anularRegistroAtencionResponse->anularRegistroAtencionSal->mensajeRespuestaError->descripcion;
        $type_msj = gettype($mensajeSalida);

        if ($type_msj == "NULL") {
            $mensajeSalida1 = "null";
        }

        $valid_Anulacion = '{
            		"RAnulado": "' . $validacionCodigo . '",
                    "msjSalida": "' . $mensajeSalida1 . '"
        	}';

        return $valid_Anulacion;

    }

    public function cancelRegisterV2($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'articulation/articulationOfHealthCare/healthCareRecords/v1.0.0/anular-registro-atencion';
        $nameFunction = "cancelRegisterV2()";
        $usuarioPrestador = $_POST['usuarioPrestador'];
        $numRefRegistroAtencion = $_POST['numRefRegistroAtencion'];

        $token = $this->getTokenWs($app, false);
        $request = '{
	    "usuarioPrestador" : "' . $usuarioPrestador . '",
	    "numRefRegistroAtencion": "' . $numRefRegistroAtencion . '"

	}';

        $datos = array(
            "usuarioPrestador" => $usuarioPrestador,
            "numRefRegistroAtencion" => $numRefRegistroAtencion,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object->codigoMensaje == 'OK') {
            $response = '{
	   	"anulacion" : "1"
		}';
        } else {
            $response = '{
        "anulacion" : "0"
        }';
        }

        return $response;

    }

    public function recaudoEfectivo($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "recaudoEfectivo()";
        $identificationType = $_POST['identificationType'];
        $identificationNumber = $_POST['identificationNumber'];
        $branchOfficeId = $_POST['branchOfficeId'];
        $user = $_POST['user'];

        $tipoDoc = $identificationType;
        $tipoDoc = substr($tipoDoc, 0, 2);
        $tipoDoc = strtoupper($tipoDoc);
        switch ($tipoDoc) {
            case "CC":
                $tipoDoc = "01";
                break;
            case "CE":
                $tipoDoc = "02";
                break;
            case "MS":
                $tipoDoc = "03";
                break;
            case "NIT":
                $tipoDoc = "04";
                break;
            case "NIP":
                $tipoDoc = "05";
                break;
            case "PA":
                $tipoDoc = "06";
                break;
            case "RC":
                $tipoDoc = "07";
                break;
            case "TI":
                $tipoDoc = "08";
                break;
            case "CD":
                $tipoDoc = "09";
                break;
            case "CN":
                $tipoDoc = "10";
                break;
            case "SC":
                $tipoDoc = "11";
                break;
            case "PD":
                $tipoDoc = "12";
                break;
            case "PE":
                $tipoDoc = "13";
                break;
            case "PT":
                $tipoDoc = "15";
                break;
            default:
                $tipoDoc = $identificationType;
                break;
        };

        $url = $urlIn . 'assurance/providersAgreements/medicalAccount/userValidate/rulesDay/v1.0.0/chatbot/cashCollection';
        $token = $this->getTokenWs($app, false);
        $request = '{
	    "identificationType" : "' . $tipoDoc . '",
	    "identificationNumber": "' . $identificationNumber . '",
	    "branchOfficeId": "' . $branchOfficeId . '",
	    "user": "' . $user . '"
	}';

        $datos = array(
            "tipoDoc" => $tipoDoc,
            "identificationNumber" => $identificationNumber,
            "branchOfficeId" => $branchOfficeId,
            "user" => $user,
            "documentoidentidad" => $documentoidentidad,
            "codigoregistro" => $codigoregistro,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object->collection == 'S') {
            $request = '{
	   	"efect" : "1"
		}';
        } else {
            $request = '{
	   	"efect" : "0"
		}';
        }

        return $request;

    }

    public function listContracts($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "listContracts()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $url = $urlIn . 'assurance/affiliations/affiliationsAndNewsManagements/contract/v1.0.0/cover';
        $token = $this->getTokenWs($app, false);
        $tipoId = substr($tipoId, 0, 2);
        $tipoId = strtoupper($tipoId);
        $numId = strtoupper($numId);
        $request = '{
            "subject": {
              "identifier": [
                {
                  "type": "TIPO_IDENTIFICACION",
                  "value": "' . $tipoId . '"
                },
                {
                  "type": "NUMERO_IDENTIFICACION",
                  "value": "' . $numId . '"
                }
              ]
            },
            "coverage": {
              "insurancePlan": {
                "type": "CODIGO_PRODUCTO",
                "value": ""
              },
              "contract": [
                {
                  "type": "PLAN",
                  "value": null
                },
                {
                  "type": "CONTRATO",
                  "value": null
                },
                {
                  "type": "FAMILIA",
                  "value": null
                }
              ]
            },
            "swFamily": true,
            "lastValid": false,
            "planType": ""
          } ';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $longitud = count($response_object->coverFamilyResponse);

        $lista_contratos = array();
        $lista_cod_producto = array();
        $lista_familia = array();
        $lista_plan = array();
        $lista_estados = array();
        $lista_opciones = array();
        $lista_user = array();
        $lista_num_contratos = array();
        $lista_fecha_inicial = array();
        $lista_fecha_final = array();
        $lista_plan_medico = array();
        $lista_noValido = array();
        $lista_tipo_plan = array();
        $lista_role = array();
        $lista_parentesco = array();

        $i = 0;
        $response = new \stdClass();

        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d');

        for ($i = 0; $i < $longitud; $i++) {
            // $flagPatient = 0;
            $listPatients = $response_object->coverFamilyResponse[$i]->contract->subject->patient;
            $longitudPacientes = count($listPatients);
            for ($j = 0; $j < $longitudPacientes; $j++) {
                $numIdentificacionPaciente = $listPatients[$j]->identifier[1]->value;
                $fechaPaciente_vencimiento = $listPatients[$j]->applies->end;
                if ($numIdentificacionPaciente == $numId) {

                    $user = $listPatients[$j]->identifier[2]->value;
                    $role = $listPatients[$j]->role[1]->value;
                    $parentesco = $listPatients[$j]->relationShip->desc;
                    $fecha_inicial = $listPatients[$j]->applies->start;
                    $fecha_final = $listPatients[$j]->applies->end;
                    $cod_producto = $response_object->coverFamilyResponse[$i]->insurancePlan->identifier[0]->value;
                    $plan = $response_object->coverFamilyResponse[$i]->contract->identifier[0]->value;
                    $nombre_contrato = $response_object->coverFamilyResponse[$i]->contract->identifier[3]->value;
                    $numero_contrato = $response_object->coverFamilyResponse[$i]->contract->identifier[1]->value;
                    $familia = $response_object->coverFamilyResponse[$i]->contract->identifier[2]->value;

                    $tipo_planes = $response_object->coverFamilyResponse[$i]->contract->identifier;
                    $longTipoPlan = count($tipo_planes);
                    for ($k = 0; $k <= $longTipoPlan; $k++) {
                        if ($tipo_planes[$k]->type === "TIPO_PLAN") {
                            $tipo_plan = $tipo_planes[$k]->value;
                        }
                    }

                    if ($cod_producto == 10 || $cod_producto == 20) {

                        if ($date <= $fecha_final || $fecha_final == null) {

                            if ($tipo_plan === "PLAN") {
                                $estado = "Habilitado";
                                $opcion = $nombre_contrato . ' - Contrato ' . $numero_contrato . ' - Familia ' . $familia . ' - ' . $estado;

                                array_push($lista_plan, $plan);
                                array_push($lista_contratos, $nombre_contrato);
                                array_push($lista_cod_producto, $cod_producto);
                                array_push($lista_familia, $familia);
                                array_push($lista_estados, $estado);
                                array_push($lista_opciones, $opcion);
                                array_push($lista_user, $user);
                                array_push($lista_num_contratos, $numero_contrato);
                                array_push($lista_fecha_inicial, $fecha_inicial);
                                array_push($lista_fecha_final, $fecha_final);
                                array_push($lista_role, $role);
                                array_push($lista_parentesco, $parentesco);
                            }
                        }
                    }

                }
            }

        }

        $longitud2 = count($lista_plan);

        $j = 0;
        if ($longitud2 > 0) {
            for ($j == 0; $j < $longitud2; $j++) {

                $response->arrayDinamico[$j]->nombreContrato = $lista_contratos[$j];
                $response->arrayDinamico[$j]->codProducto = $lista_cod_producto[$j];
                $response->arrayDinamico[$j]->codFamilia = $lista_familia[$j];
                $response->arrayDinamico[$j]->planContrato = $lista_plan[$j];
                $response->arrayDinamico[$j]->estadoContrato = $lista_estados[$j];
                $response->arrayDinamico[$j]->opcionesContrato = $lista_opciones[$j];
                $response->arrayDinamico[$j]->opcionesUser = $lista_user[$j];
                $response->arrayDinamico[$j]->numeroContrato = $lista_num_contratos[$j];
                $response->arrayDinamico[$j]->fechaInicial = $lista_fecha_inicial[$j];
                $response->arrayDinamico[$j]->fechaFinal = $lista_fecha_final[$j];
                $response->arrayDinamico[$j]->role = $lista_role[$j];
                $response->arrayDinamico[$j]->parentesco = $lista_parentesco[$j];

            }
        } else {
            return $msj = 'No tiene contratos habilitados';
        }

        return \GuzzleHttp\json_encode($response);
    }

    public function listViasAtencion($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "listViasAtencion()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $codSucursal = $_POST['codigoSucursal'];
        $username = $_POST['userServ'];
        $url = $urlIn . 'assurance/providersAgreements/medicalAccount/userValidate/rulesDay/v1.0.0/chatbot/cashCollection';
        $token = $this->getTokenWs($app, false);
        $tipoId = substr($tipoId, 0, 2);
        $tipoId = strtoupper($tipoId);

        switch ($tipoId) {
            case "CC":
                $tipoId = "1";
                break;
            case "CE":
                $tipoId = "2";
                break;
            case "MS":
                $tipoId = "3";
                break;
            case "NIT":
                $tipoId = "4";
                break;
            case "NIP":
                $tipoId = "5";
                break;
            case "PA":
                $tipoId = "6";
                break;
            case "RC":
                $tipoId = "7";
                break;
            case "TI":
                $tipoId = "8";
                break;
            case "CD":
                $tipoId = "9";
                break;
            case "CN":
                $tipoId = "10";
                break;
            case "SC":
                $tipoId = "11";
                break;
            case "PD":
                $tipoId = "12";
                break;
            case "PE":
                $tipoId = "13";
                break;
            case "PT":
                $tipoId = "15";
                break;
            default:
                $tipoId = $tipoId;
                break;
        };

        $request = '{
            "identificationType" : "' . $tipoId . '",
            "identificationNumber": "' . $numId . '",
            "branchOfficeId": "' . $codSucursal . '",
            "user": "' . $username . '"
        }';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "codSucursal" => $codSucursal,
            "username" => $username,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object == false) {
            return;
        }
        $response = new \stdClass();
        $listaViaAtencion = array();

//        if ($response_object->emergencyEntryRoute === 'S') {
        //            array_push($listaViaAtencion, "Urgencias");
        //        }

        if ($response_object->authorizedEntryRoute === 'S') {
            array_push($listaViaAtencion, "Con Autorización");
        }

        if ($response_object->unauthorizedEntryRoute === 'S') {
            array_push($listaViaAtencion, "Sin Autorización");
        }

        $longitud = count($listaViaAtencion);

        for ($i = 0; $i < $longitud; $i++) {

            $response->dynamicArray[$i]->viaAtencion = $listaViaAtencion[$i];

        }

        return \GuzzleHttp\json_encode($response);

    }

    public function listAuthorization($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "listAuthorization()";
        $tipoIdentificacion = $_POST['tipoIdentificacion'];
        $numeroIdentificacion = $_POST['numeroIdentificacion'];
        $codigoProducto = $_POST['codigoProducto'];
        $numIdPrestador = $_POST['numIdPrestador'];
        $sucursal = $_POST['sucursal'];
        $tipoConsulta = 2;
        $token = $this->getTokenWs($app, false);
        date_default_timezone_set('America/Bogota');
        $Date = date('Y-m-d');
        $time = date('h:i:s');
        $atras = date('Y-m-d', strtotime($Date . "- 1 year"));
        $adelante = date('Y-m-d', strtotime($Date . "+ 1 year"));
        $fechaStart = $atras . 'T' . $time;
        //$fechaStart = $_POST['fechaStart'];
        $fechaEnd = $adelante . 'T' . $time;
        //$fechaEnd = $_POST['fechaEnd'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $tipoIdentificacion = substr($tipoIdentificacion, 0, 2);
        $tipoIdentificacion = strtoupper($tipoIdentificacion);

        $url = $urlIn . "insurance/operationsSupport/medicalServicesAuthorization/V1.0.0/autorizathion/consultAuthorization";

        $headers = array("tipoconsulta" => $tipoConsulta);

        $request = '{

            "subject": {
              "patient": {
                "identifier": [
                  {
                    "type": "TIPO_IDENTIFICACION",
                    "value": "' . $tipoIdentificacion . '"
                  },
                  {
                    "type": "NUMERO_IDENTIFICACION",
                    "value": "' . $numeroIdentificacion . '"
                  }
                ]
              }
            },

            "validityRange": {
                "start": "' . $fechaStart . '",
                "end": "' . $fechaEnd . '"
            },
            "insurance": {
              "coverage": {
                "insurancePlan": {
                  "identifier": [
                    {
                      "type": "CODIGO_PRODUCTO",
                      "value": "' . $codigoProducto . '"
                    }
                  ]
                }
              }
            },
            "status": [
              8
            ],
            "onlyValidAuthorization": false,
            "copaymentPercentage": false
          }';

        $datos = array(
            "tipoIdentificacion" => $tipoIdentificacion,
            "numeroIdentificacion" => $numeroIdentificacion,
            "codigoProducto" => $codigoProducto,
            "numIdPrestador" => $numIdPrestador,
            "tipoConsulta" => $tipoConsulta,
            "sucursal" => $sucursal,
            "fechaStart" => $fechaStart,
            "fechaEnd" => $fechaEnd,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        $listadoAutorizaciones = array();
        $temporalArray = array();
        $longitud = count($response_object->authorization);

        if ($longitud === 0) {
            return '{
                    "sinAuth" : "1"
                }';
        } else {
            try {
                //code...
                for ($i = 0; $i < $longitud; $i++) {
                    $fechaFinalizacion = $response_object->authorization[$i]->occurrence->end;
                    $fechaActual = strtotime(date('Y-m-d'));
                    $fechastr = strtotime($fechaFinalizacion);
                    $prestadorAsociado = $response_object->authorization[$i]->performer->practitioner->identifier[1]->value;
                    $sucursalPracticante = $response_object->authorization[$i]->performer->practitioner->identifier[2]->value;
                    // $fechaFini = strtotime(date('Y-m-d', $fechastr));
                    //if ($response_object->authorization[$i]->isConsumed === false) {
                    if ($numIdPrestador) {
                        if ($numIdPrestador == $prestadorAsociado) {
                            if ($fechaActual <= $fechastr && !$response_object->authorization[$i]->isConsumed) {
                                if ($sucursalPracticante == $sucursal) {
                                    array_push($listadoAutorizaciones, $response_object->authorization[$i]);
                                }
                            }
                        }
                    } else {
                        if ($fechaActual <= $fechastr && !$response_object->authorization[$i]->isConsumed) {
                            if ($sucursalPracticante == $sucursal) {
                                array_push($listadoAutorizaciones, $response_object->authorization[$i]);
                            }
                        }
                    }
                }
                $longitud2 = count($listadoAutorizaciones);
                if ($final > ($longitud2 - 1)) {
                    for ($i = $inicio; $i < $longitud2; $i++) {
                        array_push($temporalArray, $listadoAutorizaciones[$i]);
                    }
                } else {
                    for ($i = $inicio; $i <= $final; $i++) {
                        array_push($temporalArray, $listadoAutorizaciones[$i]);
                    }
                }
            } catch (\Exception $e) {
                echo 'error2';
                return 'error';
            }
        }

        try {
            $longitudAutorizaciones = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud2 / $cantidad);
            $response->nombrePaciente = $temporalArray[0]->subject->patient->name;
            $response->firstName = $temporalArray[0]->subject->patient->firstName;
            $secondName = $temporalArray[0]->subject->patient->secondName;
            $secondNameEmpty = ".";
            $secondFamilyEmpty = ".";
            $secondName ? $response->secondName = $secondName : $response->secondName = $secondNameEmpty;
            $response->firstFamily = $temporalArray[0]->subject->patient->firstFamily;
            $secondFamily = $temporalArray[0]->subject->patient->secondFamily;
            $secondFamily ? $response->secondFamily = $secondFamily : $response->secondFamily = $secondFamilyEmpty;
            for ($i = 0; $i < $longitudAutorizaciones; $i++) {
                $response->dynamicArray[$i]->mensaje_autorizacion = "Autorización : " . $temporalArray[$i]->identifier[0]->value . " " . $temporalArray[$i]->orderDetail->name . " " . $temporalArray[$i]->procedure[0]->identifier[1]->value;
                $response->dynamicArray[$i]->mensaje_autorizacion2 = "Practitioner : " . $temporalArray[$i]->serviceRequest->requester->practitioner->identifier[1]->value;
                //$response->dynamicArray[$i]->idSucursal = $temporalArray[$i]->serviceRequest->requester->practitioner->identifier[2]->value;
                $response->dynamicArray[$i]->idSucursal = $temporalArray[$i]->performer->practitioner->identifier[2]->value;
                $response->dynamicArray[$i]->fechaExpedicionRadicacion = $temporalArray[$i]->applicationDate;
                $response->dynamicArray[$i]->cod_practitioner = $temporalArray[$i]->serviceRequest->requester->practitioner->identifier[1]->value;
                $tipoIdentificacionPaciente = $temporalArray[$i]->subject->patient->identifier[0]->value;

                switch ($tipoIdentificacionPaciente) {
                    case "CC":
                        $tipoIdentificacionPaciente = "01";
                        break;
                    case "CE":
                        $tipoIdentificacionPaciente = "02";
                        break;
                    case "MS":
                        $tipoIdentificacionPaciente = "03";
                        break;
                    case "NIT":
                        $tipoIdentificacionPaciente = "04";
                        break;
                    case "NIP":
                        $tipoIdentificacionPaciente = "05";
                        break;
                    case "PA":
                        $tipoIdentificacionPaciente = "06";
                        break;
                    case "RC":
                        $tipoIdentificacionPaciente = "07";
                        break;
                    case "TI":
                        $tipoIdentificacionPaciente = "08";
                        break;
                    case "CD":
                        $tipoIdentificacionPaciente = "09";
                        break;
                    case "CN":
                        $tipoIdentificacionPaciente = "10";
                        break;
                    case "SC":
                        $tipoIdentificacionPaciente = "11";
                        break;
                    case "PD":
                        $tipoIdentificacionPaciente = "12";
                        break;
                    case "PE":
                        $tipoIdentificacionPaciente = "13";
                        break;
                    case "PT":
                        $tipoIdentificacionPaciente = "15";
                        break;
                    default:
                        $tipoIdentificacionPaciente = "N/A";
                        break;
                }
                $response->dynamicArray[$i]->tipoIdentificacionPaciente = $tipoIdentificacionPaciente;
                $response->dynamicArray[$i]->numeroIdentificacionPaciente = $temporalArray[$i]->subject->patient->identifier[1]->value;
                $response->dynamicArray[$i]->cod_autorizacion = $temporalArray[$i]->identifier[0]->value;
                $response->dynamicArray[$i]->tipoSolicitud = $temporalArray[$i]->orderDetail->name;
                $response->dynamicArray[$i]->tipoSolicitudCodigo = $temporalArray[$i]->orderDetail->code;
                $response->dynamicArray[$i]->fechaAprovacion = $temporalArray[$i]->occurrence->start;
                $response->dynamicArray[$i]->fechaVencimiento = $temporalArray[$i]->occurrence->end;
                $response->dynamicArray[$i]->descripcionServicio = $temporalArray[$i]->status->description;
                $response->dynamicArray[$i]->prestadorQuePractica = $temporalArray[$i]->performer->practitioner->name;
                $response->dynamicArray[$i]->codigoBH = $temporalArray[$i]->procedure[0]->identifier[0]->value;
                $response->dynamicArray[$i]->descripcionBH = $temporalArray[$i]->procedure[0]->identifier[1]->value;
                $response->dynamicArray[$i]->descripcionAlias = $temporalArray[$i]->procedure[0]->identifier[1]->value . ' ' . $temporalArray[$i]->procedure[0]->identifier[0]->value;
                $response->dynamicArray[$i]->bilateralidad = $temporalArray[$i]->insurance->claimResponse->type;
                $response->dynamicArray[$i]->cantidad = $temporalArray[$i]->procedure[0]->quantity;
                $response->dynamicArray[$i]->name_practitioner = $temporalArray[$i]->serviceRequest->requester->practitioner->name;
                // $response->dynamicArray[$i]->cantidadNotas = count($temporalArray[$i]->note);
                $mensajeNotes = "";
                for ($j = 0; $j < count($temporalArray[$i]->note); $j++) {
                    $mensajeNotes = $mensajeNotes . ($j + 1) . ". " . $temporalArray[$i]->note[$j]->text . " - ";
                }
                $response->dynamicArray[$i]->noteDescription = $mensajeNotes;

            }
            $object = json_encode($response);
            return \GuzzleHttp\json_encode($response);
        } catch (\Exception $e) {
            echo 'error1';
            return 'error';
        }

    }

    public function listAuthorizationV2($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "listAuthorization()";
        $tipoIdentificacion = $_POST['tipoIdentificacion'];
        $numeroIdentificacion = $_POST['numeroIdentificacion'];
        $codigoProducto = $_POST['codigoProducto'];
        $numIdPrestador = $_POST['numIdPrestador'];
        $sucursal = $_POST['sucursal'];
        $tipoConsulta = 2;
        $token = $this->getTokenWs($app, false);
        date_default_timezone_set('America/Bogota');
        $Date = date('Y-m-d');
        $time = date('h:i:s');
        $atras = date('Y-m-d', strtotime($Date . "- 6 months"));
        $adelante = date('Y-m-d', strtotime($Date . "+ 6 months"));
        $fechaStart = $atras . 'T' . $time;
        //$fechaStart = $_POST['fechaStart'];
        $fechaEnd = $adelante . 'T' . $time;
        //$fechaEnd = $_POST['fechaEnd'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $tipoIdentificacion = substr($tipoIdentificacion, 0, 2);
        $tipoIdentificacion = strtoupper($tipoIdentificacion);

        $url = $urlIn . "insurance/operationsSupport/medicalServicesAuthorization/V1.0.0/autorizathion/consultAuthorization";

        $headers = array("tipoconsulta" => $tipoConsulta);

        $request = '{

            "subject": {
              "patient": {
                "identifier": [
                  {
                    "type": "TIPO_IDENTIFICACION",
                    "value": "' . $tipoIdentificacion . '"
                  },
                  {
                    "type": "NUMERO_IDENTIFICACION",
                    "value": "' . $numeroIdentificacion . '"
                  }
                ]
              }
            },

            "validityRange": {
                "start": "' . $fechaStart . '",
                "end": "' . $fechaEnd . '"
            },
            "insurance": {
              "coverage": {
                "insurancePlan": {
                  "identifier": [
                    {
                      "type": "CODIGO_PRODUCTO",
                      "value": "' . $codigoProducto . '"
                    }
                  ]
                }
              }
            },
            "status": [
              8
            ],
            "onlyValidAuthorization": false,
            "copaymentPercentage": false
          }';

        $datos = array(
            "tipoIdentificacion" => $tipoIdentificacion,
            "numeroIdentificacion" => $numeroIdentificacion,
            "codigoProducto" => $codigoProducto,
            "numIdPrestador" => $numIdPrestador,
            "tipoConsulta" => $tipoConsulta,
            "fechaStart" => $fechaStart,
            "fechaEnd" => $fechaEnd,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        $listadoAutorizaciones = array();
        $temporalArray = array();

        $longitud = count($response_object->authorization);

        if ($longitud === 0) {
            return '{
                    "sinAuth" : "1"
                }';
        } else {
            try {
                //code...
                for ($i = 0; $i < $longitud; $i++) {
                    $fechaFinalizacion = $response_object->authorization[$i]->occurrence->end;
                    $fechaActual = strtotime(date('Y-m-d'));
                    $fechastr = strtotime($fechaFinalizacion);
                    $prestadorAsociado = $response_object->authorization[$i]->performer->practitioner->identifier[1]->value;
                    $sucursalPracticante = $response_object->authorization[$i]->performer->practitioner->identifier[2]->value;
                    // $fechaFini = strtotime(date('Y-m-d', $fechastr));
                    //if ($response_object->authorization[$i]->isConsumed === false) {
                    if ($numIdPrestador) {
                        if ($numIdPrestador == $prestadorAsociado) {
                            if ($fechaActual <= $fechastr && !$response_object->authorization[$i]->isConsumed) {
                                    array_push($listadoAutorizaciones, $response_object->authorization[$i]);
                            }
                        }
                    } else {
                        if ($fechaActual <= $fechastr && !$response_object->authorization[$i]->isConsumed) {
                                array_push($listadoAutorizaciones, $response_object->authorization[$i]);
                        }
                    }
                }
                $longitud2 = count($listadoAutorizaciones);
                if ($final > ($longitud2 - 1)) {
                    for ($i = $inicio; $i < $longitud2; $i++) {
                        array_push($temporalArray, $listadoAutorizaciones[$i]);
                    }
                } else {
                    for ($i = $inicio; $i <= $final; $i++) {
                        array_push($temporalArray, $listadoAutorizaciones[$i]);
                    }
                }
            } catch (\Exception $e) {
                echo 'error2';
                return 'error';
            }
        }

        try {
            $longitudAutorizaciones = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud2 / $cantidad);
            $response->nombrePaciente = $temporalArray[0]->subject->patient->name;
            $response->firstName = $temporalArray[0]->subject->patient->firstName;
            $secondName = $temporalArray[0]->subject->patient->secondName;
            $secondNameEmpty = ".";
            $secondFamilyEmpty = ".";
            $secondName ? $response->secondName = $secondName : $response->secondName = $secondNameEmpty;
            $response->firstFamily = $temporalArray[0]->subject->patient->firstFamily;
            $secondFamily = $temporalArray[0]->subject->patient->secondFamily;
            $secondFamily ? $response->secondFamily = $secondFamily : $response->secondFamily = $secondFamilyEmpty;
            for ($i = 0; $i < $longitudAutorizaciones; $i++) {
                $response->dynamicArray[$i]->mensaje_autorizacion = "Autorización : " . $temporalArray[$i]->identifier[0]->value . " " . $temporalArray[$i]->orderDetail->name . " " . $temporalArray[$i]->procedure[0]->identifier[1]->value;
                $response->dynamicArray[$i]->mensaje_autorizacion2 = "Practitioner : " . $temporalArray[$i]->serviceRequest->requester->practitioner->identifier[1]->value;
                //$response->dynamicArray[$i]->idSucursal = $temporalArray[$i]->serviceRequest->requester->practitioner->identifier[2]->value;
                $response->dynamicArray[$i]->idSucursal = $temporalArray[$i]->performer->practitioner->identifier[2]->value;
                $response->dynamicArray[$i]->fechaExpedicionRadicacion = $temporalArray[$i]->applicationDate;
                $response->dynamicArray[$i]->cod_practitioner = $temporalArray[$i]->serviceRequest->requester->practitioner->identifier[1]->value;
                $tipoIdentificacionPaciente = $temporalArray[$i]->subject->patient->identifier[0]->value;

                switch ($tipoIdentificacionPaciente) {
                    case "CC":
                        $tipoIdentificacionPaciente = "01";
                        break;
                    case "CE":
                        $tipoIdentificacionPaciente = "02";
                        break;
                    case "MS":
                        $tipoIdentificacionPaciente = "03";
                        break;
                    case "NIT":
                        $tipoIdentificacionPaciente = "04";
                        break;
                    case "NIP":
                        $tipoIdentificacionPaciente = "05";
                        break;
                    case "PA":
                        $tipoIdentificacionPaciente = "06";
                        break;
                    case "RC":
                        $tipoIdentificacionPaciente = "07";
                        break;
                    case "TI":
                        $tipoIdentificacionPaciente = "08";
                        break;
                    case "CD":
                        $tipoIdentificacionPaciente = "09";
                        break;
                    case "CN":
                        $tipoIdentificacionPaciente = "10";
                        break;
                    case "SC":
                        $tipoIdentificacionPaciente = "11";
                        break;
                    case "PD":
                        $tipoIdentificacionPaciente = "12";
                        break;
                    case "PE":
                        $tipoIdentificacionPaciente = "13";
                        break;
                    case "PT":
                        $tipoIdentificacionPaciente = "15";
                        break;
                    default:
                        $tipoIdentificacionPaciente = "N/A";
                        break;
                }
                $response->dynamicArray[$i]->tipoIdentificacionPaciente = $tipoIdentificacionPaciente;
                $response->dynamicArray[$i]->numeroIdentificacionPaciente = $temporalArray[$i]->subject->patient->identifier[1]->value;
                $response->dynamicArray[$i]->cod_autorizacion = $temporalArray[$i]->identifier[0]->value;
                $response->dynamicArray[$i]->tipoSolicitud = $temporalArray[$i]->orderDetail->name;
                $response->dynamicArray[$i]->tipoSolicitudCodigo = $temporalArray[$i]->orderDetail->code;
                $response->dynamicArray[$i]->fechaAprovacion = $temporalArray[$i]->occurrence->start;
                $response->dynamicArray[$i]->fechaVencimiento = $temporalArray[$i]->occurrence->end;
                $response->dynamicArray[$i]->descripcionServicio = $temporalArray[$i]->status->description;
                $response->dynamicArray[$i]->prestadorQuePractica = $temporalArray[$i]->performer->practitioner->name;
                $response->dynamicArray[$i]->codigoBH = $temporalArray[$i]->procedure[0]->identifier[0]->value;
                $response->dynamicArray[$i]->descripcionBH = $temporalArray[$i]->procedure[0]->identifier[1]->value;
                $response->dynamicArray[$i]->descripcionAlias = $temporalArray[$i]->procedure[0]->identifier[1]->value . ' ' . $temporalArray[$i]->procedure[0]->identifier[0]->value;
                $response->dynamicArray[$i]->bilateralidad = $temporalArray[$i]->insurance->claimResponse->type;
                $response->dynamicArray[$i]->cantidad = $temporalArray[$i]->procedure[0]->quantity;
                $response->dynamicArray[$i]->name_practitioner = $temporalArray[$i]->serviceRequest->requester->practitioner->name;
                // $response->dynamicArray[$i]->cantidadNotas = count($temporalArray[$i]->note);
                $mensajeNotes = "";
                for ($j = 0; $j < count($temporalArray[$i]->note); $j++) {
                    $mensajeNotes = $mensajeNotes . ($j + 1) . ". " . $temporalArray[$i]->note[$j]->text . " - ";
                }
                $response->dynamicArray[$i]->noteDescription = $mensajeNotes;

            }
            $object = json_encode($response);
            return \GuzzleHttp\json_encode($response);
        } catch (\Exception $e) {
            echo 'error1';
            return 'error';
        }

    }

    public function confirmarUtilizacionPin($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $url = $urlIn . 'gestionpines/v1.0.0/confirmarutilizacionpin';
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "confirmarUtilizacionPin()";
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $user_name = $_POST['userName'];
        $user_token = $_POST['userToken'];
        $codigo_comp = $_POST['codigocompania'];
        $codigo_plan = $_POST['codigoplan'];
        $num_contrato = $_POST['numerocontrato'];
        $num_fila = $_POST['numeroFlia'];
        $num_usuario = $_POST['numeroUsuario'];
        $num_pin = $_POST['numeroPin'];
        $num_doc_prestador = $_POST['numDocPrestador'];
        $tipo_doc_prestador = $_POST['tipoDocPrestador'];
        $tipo_doc_prestador = substr($tipo_doc_prestador, 0, 2);

        switch ($tipo_doc_prestador) {
            case "1":
                $tipo_doc_prestador = "01";
                break;
            case "2":
                $tipo_doc_prestador = "02";
                break;
            case "3":
                $tipo_doc_prestador = "03";
                break;
            case "4":
                $tipo_doc_prestador = "04";
                break;
            case "5":
                $tipo_doc_prestador = "05";
                break;
            case "6":
                $tipo_doc_prestador = "06";
                break;
            case "7":
                $tipo_doc_prestador = "07";
                break;
            case "8":
                $tipo_doc_prestador = "08";
                break;
            case "9":
                $tipo_doc_prestador = "09";
                break;
            default:
                $tipo_doc_prestador = $tipo_doc_prestador;
                break;
        };

        if (ctype_digit($codigo_servicio)) {
            $codigo_servicio = $codigo_servicio;
        } else {
            $codigo_servicio = substr($codigo_servicio, 0, 6);
        }

        $token = $this->getTokenWs($app, false);
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {

            $request = '{
            "userName":"' . $user_name . '",
            "userToken":"' . $user_token . '",
            "codigocompania":"' . $codigo_comp . '",
            "codigoplan":"' . $codigo_plan . '",
            "numerocontrato":"' . $num_contrato . '",
            "numeroFlia":"' . $num_fila . '",
            "numeroUsuario":"' . $num_usuario . '",
            "numeroPin":"' . $num_pin . '",
            "numDocPrestador":"' . $num_doc_prestador . '",
            "tipoDocPrestador":"' . $tipo_doc_prestador . '"
            }';
        } else {
            $request = '{
                "userName":"' . $user_name . '",
                "userToken":"' . $user_token . '",
                "codigocompania":"' . $codigo_comp . '",
                "codigoplan":"' . $codigo_plan . '",
                "numerocontrato":"' . $num_contrato . '",
                "numeroFlia":"' . $num_fila . '",
                "numeroUsuario":"' . $num_usuario . '",
                "numeroPin":"' . $num_pin . '",
                "numDocPrestador":"' . $num_doc_prestador . '",
                "tipoDocPrestador":"' . $tipo_doc_prestador . '",
                "aplicacionUtiliza" : "CHATBOT_PREST_MP"
                }';
        }

        $datos = array(
            "user_name" => $user_name,
            "user_token" => $user_token,
            "codigo_comp" => $codigo_comp,
            "codigo_plan" => $codigo_plan,
            "num_contrato" => $num_contrato,
            "num_fila" => $num_fila,
            "num_usuario" => $num_usuario,
            "num_pin" => $num_pin,
            "num_doc_prestador" => $num_doc_prestador,
            "tipo_doc_prestador" => $tipo_doc_prestador,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        if ($response_object === false) {
            return;
        }

        $response = $response_object->ConfirmaUtilizacionPinSal->pinUtilizado->NumeroPin;

        $response2 = '{
            "NumeroPin" : "' . $response . '"
        }';

        return $response2;

    }

    public function grabarAtencionPin($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $nameFunction = "grabarAtencionPin()";
        $tipo_documento = $_POST['tipoDocumento'];
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $codigo_servicio_new = $_POST['codigoServicioNew'];
        $codigo_alias = $_POST['codigoAlias'];
        $descripcion_alias = $_POST['descripcionAlias'];
        $descripcion_tipo_atencion = $_POST['descripcionTipoAtencion'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $cantidad = $_POST['cantidad'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $bilateral = $_POST['bilateral'];
        $existe_valor = $_POST['existeValorConvenio'];

        $codigo_pin = $_POST['codigoPin'];
        $valor_pago_pin = $_POST['valorPagoPin'];
        $categoria_pin = $_POST['categoria'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "paisNacimiento" => $paisNacimiento,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,
            "nombre_prestador" => $nombre_prestador,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,
            "codigo_servicio" => $codigo_servicio,
            "codigo_servicio_new" => $codigo_servicio_new,
            "codigo_alias" => $codigo_alias,
            "descripcion_alias" => $descripcion_alias,
            "descripcion_tipo_atencion" => $descripcion_tipo_atencion,
            "cantidad" => $cantidad,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "bilateral" => $bilateral,
            "existe_valor" => $existe_valor,
            "codigo_pin" => $codigo_pin,
            "valor_pago_pin" => $valor_pago_pin,
            "categoria_pin" => $categoria_pin,
            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "id_tipo_excepcion_new" => $id_tipo_excepcion_new,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "rips" => $rips,
            "token" => $token,
            "url" => $url,
        );

        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }
        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }
        if (!$categoria_pin) {
            $categoria_pin = "";
        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };

        if (!$valor_convenio) {
            $valor_convenio = 0;
        }

        if (!$valor_servicio) {
            $valor_servicio = "null";
        }

        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";
        } elseif ($valor_servicio == "null" || $valor_servicio == "0" || $valor_servicio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }
        if ($id_tipo_pago == 3 || $id_tipo_pago == "3") {
            $codigo_pin = "0";
            $valor_pago_pin = 0;
            $categoria_pin = "";
            $valor_pago = 0;
        }

        $nombre_usuario_separado = explode('.', $nombre_usuario);

        $token = $this->getTokenWsV2($app, false);
        $token = (json_decode($token)->access_token);
        $request = '
        {
            "usuario":{
               "tipoDocumento":"' . $tipo_documento . '",
               "numeroDocumento":"' . $num_documento . '",
               "edad":' . $edad . ',
               "fechaNacimiento":"' . $fecha_nacimiento . '",
               "genero":"' . $genero . '",
               "primerNombre":"' . $primer_nombre . '",
               "segundoNombre":"' . $segundo_nombre . '",
               "primerApellido":"' . $primer_apellido . '",
               ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
               "segundoApellido":"' . $segundo_apellido . '"
            },
            "contrato":{
               "compania":' . $compania . ',
               "plan":' . $plan . ',
               "contrato":' . $contrato . ',
               "familia":' . $familia . ',
               "numeroUsuario":' . $numero_usuario . ',
               "estadoContrato":' . $estado_contrato . '
            },
            "prestador":{
               "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
               "numeroDocumento":"' . $num_id_prestador . '",
               "tipoDocumento":"' . $tipo_id_prestador . '",
               "especialidad":"' . $especialidad . '",
               "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
               "codigoSucursal":"' . $cod_sucursal . '",
               "ciudad":"' . $ciudad . '"
            },
                "servicios": [
                    {
                        "codigo":"' . $codigo_servicio_new . '",
                        "codigoAlias":"' . $codigo_alias . '",
                        "descripcionAlias":"' . $descripcion_alias . " - " . $uvr . ' UVR",
                        "descripcionTipoAtencion":"' . $descripcion_tipo_atencion . '",
                        "cantidad": ' . $cantidad . ',
                        "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                        "fechaVencimiento":"' . $fecha_vencimiento . '",
                        "estado":' . $estado_servicio . ',
                        "valor": ' . $valor_servicio . ',
                        "uvr": ' . $uvr . ',
                        "viaIngreso": "' . $via_ingreso . '",
                        "bilateral": ' . $bilateral . ',
                        "existeValorConvenio": "' . $existe_valor . '",
                        "tipoAtencion": "' . $tipo_atencion . '"
                    }
                ],
            "pines": [
                {
                    "codigoPin": "' . $codigo_pin . '",
                    "valorPago": ' . $valor_pago_pin . ',
                    "categoria": "' . $categoria_pin . '"
                }
            ],
            "idTipoPago":' . $id_tipo_pago . ',
            "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
            ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
            "valorPago":' . $valor_pago . ',
            "fechaConsulta": "' . $fecha_consulta . '",
            "fechaAtencion": "' . $fecha_atencion . '",
            ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
            "canal": "' . $canal . '"
         }';

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        if ($response_object === false || $response_object === "") {
            return;
            //$response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        }

        $response = '{
            "NumRa" : "' . $response_object . '"
        }';

        return $response;

    }

    public function grabarAtencionPinCurl($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $nameFunction = "grabarAtencionPinCurl()";
        $tipo_documento = $_POST['tipoDocumento'];
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $codigo_servicio_new = $_POST['codigoServicioNew'];
        $codigo_alias = $_POST['codigoAlias'];
        $descripcion_alias = $_POST['descripcionAlias'];
        $descripcion_tipo_atencion = $_POST['descripcionTipoAtencion'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $cantidad = $_POST['cantidad'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $bilateral = $_POST['bilateral'];
        $existe_valor = $_POST['existeValorConvenio'];

        $codigo_pin = $_POST['codigoPin'];
        $valor_pago_pin = $_POST['valorPagoPin'];
        $categoria_pin = $_POST['categoria'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "paisNacimiento" => $paisNacimiento,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,
            "nombre_prestador" => $nombre_prestador,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,
            "codigo_servicio" => $codigo_servicio,
            "codigo_servicio_new" => $codigo_servicio_new,
            "codigo_alias" => $codigo_alias,
            "descripcion_alias" => $descripcion_alias,
            "descripcion_tipo_atencion" => $descripcion_tipo_atencion,
            "cantidad" => $cantidad,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "bilateral" => $bilateral,
            "existe_valor" => $existe_valor,
            "codigo_pin" => $codigo_pin,
            "valor_pago_pin" => $valor_pago_pin,
            "categoria_pin" => $categoria_pin,
            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "id_tipo_excepcion_new" => $id_tipo_excepcion_new,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "rips" => $rips,
            "token" => $token,
            "url" => $url,
        );

        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }
        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }
        if (!$categoria_pin) {
            $categoria_pin = "";
        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };

        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }
        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_servicio == "null" || $valor_servicio == "0" || $valor_servicio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }

        $nombre_usuario_separado = explode('.', $nombre_usuario);

        $token = $this->getTokenWs($app, false);
        $request = [
            'usuario' => [
                'tipoDocumento' => $tipo_documento,
                'numeroDocumento' => $num_documento,
                'edad' => $edad,
                'fechaNacimiento' => $fecha_nacimiento,
                'genero' => $genero,
                'primerNombre' => $primer_nombre,
                'segundoNombre' => $segundo_nombre,
                'primerApellido' => $primer_apellido,
                'segundoApellido' => $segundo_apellido,
            ],
            'contrato' => [
                'compania' => $compania,
                'plan' => $plan,
                'contrato' => $contrato,
                'familia' => $familia,
                'numeroUsuario' => $numero_usuario,
                'estadoContrato' => $estado_contrato,
            ],
            'prestador' => [
                'nombrePrestador' => $cod_sucursal . "-" . $nombre_prestador,
                'numeroDocumento' => $num_id_prestador,
                'tipoDocumento' => $tipo_id_prestador,
                'especialidad' => $especialidad,
                'nombreUsuario' => $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados,
                'codigoSucursal' => $cod_sucursal,
                'ciudad' => $ciudad,
            ],
            'servicios' => [
                [
                    'codigo' => $codigo_servicio_new,
                    'codigoAlias' => $codigo_alias,
                    'descripcionAlias' => $descripcion_alias . " - " . $uvr . ' UVR',
                    'descripcionTipoAtencion' => $descripcion_tipo_atencion,
                    'cantidad' => $cantidad,
                    'fechaExpedicionRadicacion' => $fecha_expedicion,
                    'fechaVencimiento' => $fecha_vencimiento,
                    'estado' => $estado_servicio,
                    'valor' => $valor_servicio,
                    'uvr' => $uvr,
                    'viaIngreso' => $via_ingreso,
                    'bilateral' => $bilateral,
                    'existeValorConvenio' => $existe_valor,
                    'tipoAtencion' => $tipo_atencion,
                ],
            ],
            'pines' => [
                [
                    'codigoPin' => $codigo_pin,
                    'valorPago' => $valor_pago_pin,
                    'categoria' => $categoria_pin,
                ],
            ],
            'idTipoPago' => $id_tipo_pago,
            'descripcionTipoPago' => $descripcion_tipo_pago,
            'valorPago' => $valor_pago,
            'fechaConsulta' => $fecha_consulta,
            'fechaAtencion' => $fecha_atencion,
            'canal' => $canal,
        ];

        if ($rips == 1) {
            $request['usuario']['paisNacimiento'] = $paisNacimiento;
            $request['generarRIPS'] = true;
        }
        if ($id_tipo_excepcion_new) {
            $request['idTipoExcepcion'] = $id_tipo_excepcion_new;
        }

        // Convertir a JSON
        $jsonData = json_encode($request);

        // URL del servicio
        $jsonData = json_encode($request);

        $ch = curl_init();

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Configurar las cabeceras para indicar que se está enviando JSON y el Bearer Token
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
            'Authorization: Bearer ' . $token,
        ]);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Manejar errores
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            // Decodificar la respuesta si es JSON
            $data = json_decode($response, true);
        }

        // Cerrar la sesión cURL
        curl_close($ch);

        $datos = array(
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );

        \App\Utils\StaticExecuteService::createLog($response, $jsonData, $chat_id, $nameFunction, "POST", "Prestadores", $headers, $datos);

        if ($response == false || $response == "") {
            return;
        }

        $response2 = '{
            "NumRa" : "' . $response . '"
        }';

        return $response2;
    }

    public function grabarAtencion($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $nameFunction = "grabarAtencion()";
        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $codigo_servicio_new = $_POST['codigoServicioNew'];
        $codigo_alias = $_POST['codigoAlias'];
        $descripcion_alias = $_POST['descripcionAlias'];
        $descripcion_tipo_atencion = $_POST['descripcionTipoAtencion'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $cantidad = $_POST['cantidad'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $bilateral = $_POST['bilateral'];
        $existe_valor = $_POST['existeValorConvenio'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }

        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };

        // if (ctype_digit($codigo_servicio)) {
        //     $codigo_servicio = $codigo_servicio;
        // } else {
        //     $codigo_servicio = substr($codigo_servicio, 0, 6);
        // }

        // if (preg_match('/[a-zA-Z]/', $codigo_servicio)) {
        //     $codigo_servicio = $codigo_servicio_new;
        // }
        $nombre_usuario_separado = explode('.', $nombre_usuario);

        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }
        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_servicio == "null" || $valor_servicio == "0" || $valor_servicio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }

        $token = $this->getTokenWs($app, false);
        $request = '
        {
            "usuario":{
               "tipoDocumento":' . $tipo_documento . ',
               "numeroDocumento":"' . $num_documento . '",
               "edad":' . $edad . ',
               "fechaNacimiento":"' . $fecha_nacimiento . '",
               "genero":"' . $genero . '",
               "primerNombre":"' . $primer_nombre . '",
               "segundoNombre":"' . $segundo_nombre . '",
               "primerApellido":"' . $primer_apellido . '",
               ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
               "segundoApellido":"' . $segundo_apellido . '"
            },
            "contrato":{
               "compania":' . $compania . ',
               "plan":' . $plan . ',
               "contrato":' . $contrato . ',
               "familia":' . $familia . ',
               "numeroUsuario":' . $numero_usuario . ',
               "estadoContrato":' . $estado_contrato . '
            },
            "prestador":{
               "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
               "numeroDocumento":"' . $num_id_prestador . '",
               "tipoDocumento":"' . $tipo_id_prestador . '",
               "especialidad":"' . $especialidad . '",
               "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
               "codigoSucursal":"' . $cod_sucursal . '",
               "ciudad":"' . $ciudad . '"
            },
            "servicios": [
                {
                    "codigo":"' . $codigo_servicio_new . '",
                    "codigoAlias":"' . $codigo_alias . '",
                    "descripcionAlias":"' . $descripcion_alias . " - " . $uvr . ' UVR",
                    "descripcionTipoAtencion":"' . $descripcion_tipo_atencion . '",
                    "cantidad": ' . $cantidad . ',
                    "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                    "fechaVencimiento":"' . $fecha_vencimiento . '",
                    "estado":' . $estado_servicio . ',
                    "valor": ' . $valor_servicio . ',
                    "uvr": ' . $uvr . ',
                    "viaIngreso": "' . $via_ingreso . '",
                    "bilateral": ' . $bilateral . ',
                    "existeValorConvenio": "' . $existe_valor . '",
                    "tipoAtencion": ' . $tipo_atencion . '
                }
            ],
            "idTipoPago":' . $id_tipo_pago . ',
            "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
            ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
            "valorPago":' . $valor_pago . ',
            "fechaConsulta": "' . $fecha_consulta . '",
            "fechaAtencion": "' . $fecha_atencion . '",
            ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
            "canal": "' . $canal . '"
         }';

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,
            "nombre_prestador" => $nombre_prestador,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,
            "codigo_servicio" => $codigo_servicio,
            "codigo_alias" => $codigo_alias,
            "descripcion_alias" => $descripcion_alias,
            "descripcion_tipo_atencion" => $descripcion_tipo_atencion,
            "cantidad" => $cantidad,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "bilateral" => $bilateral,
            "existe_valor" => $existe_valor,
            "id_tipo_pago" => $id_tipo_pago,
            "valor_pago_pin" => $valor_pago_pin,
            "categoria_pin" => $categoria_pin,
            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 30);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");
        if ($response_object == false || $response_object == "") {
            return;
            //$response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 30);
        }

        $response = '{
            "NumRa" : "' . $response_object . '"
        }';

        return $response;

    }

    public function grabarAtencionSinAuthSinPin($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $nameFunction = "grabarAtencionSinAuthSinPin()";
        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];
        $nombre_usuario = $_POST['nombreUsuario'];

        $codigo_servicio_new = $_POST['codigoServicioNew'];
        $codigo_alias = $_POST['codigoAlias'];
        $descripcion_alias = $_POST['descripcionAlias'];
        $descripcion_tipo_atencion = $_POST['descripcionTipoAtencion'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $cantidad = $_POST['cantidad'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $bilateral = $_POST['bilateral'];
        $existe_valor = $_POST['existeValorConvenio'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };
        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }
        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }
        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_servicio == "null" || $valor_servicio == "0" || $valor_servicio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }
        if ($id_tipo_pago == 9) {
            $valor_pago = 0;
        }
        $nombre_usuario_separado = explode('.', $nombre_usuario);

        $token = $this->getTokenWs($app, false);
        $request = '
        {
            "usuario":{
               "tipoDocumento":' . $tipo_documento . ',
               "numeroDocumento":"' . $num_documento . '",
               "edad":' . $edad . ',
               "fechaNacimiento":"' . $fecha_nacimiento . '",
               "genero":"' . $genero . '",
               "primerNombre":"' . $primer_nombre . '",
               "segundoNombre":"' . $segundo_nombre . '",
               "primerApellido":"' . $primer_apellido . '",
               ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
               "segundoApellido":"' . $segundo_apellido . '"
            },
            "contrato":{
               "compania":' . $compania . ',
               "plan":' . $plan . ',
               "contrato":' . $contrato . ',
               "familia":' . $familia . ',
               "numeroUsuario":' . $numero_usuario . ',
               "estadoContrato": 1
            },
            "prestador":{
               "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
               "numeroDocumento":"' . $num_id_prestador . '",
               "tipoDocumento":"' . $tipo_id_prestador . '",
               "especialidad":"' . $especialidad . '",
               "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
               "codigoSucursal":"' . $cod_sucursal . '",
               "ciudad":"' . $ciudad . '"
            },
            "servicios": [
                {
                    "codigo":"' . $codigo_servicio_new . '",
                    "codigoAlias":"' . $codigo_alias . '",
                    "descripcionAlias":"' . $descripcion_alias . " - " . $uvr . ' UVR",
                    "descripcionTipoAtencion":"' . $descripcion_tipo_atencion . '",
                    "cantidad": ' . $cantidad . ',
                    "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                    "fechaVencimiento":"' . $fecha_vencimiento . '",
                    "estado":' . $estado_servicio . ',
                    "valor": ' . $valor_servicio . ',
                    "uvr": ' . $uvr . ',
                    "viaIngreso": "' . $via_ingreso . '",
                    "bilateral": ' . $bilateral . ',
                    "existeValorConvenio": "' . $existe_valor . '",
                    "tipoAtencion": ' . $tipo_atencion . '
                }
            ],
            "idTipoPago":' . $id_tipo_pago . ',
            "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
            ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
            "valorPago":' . $valor_pago . ',
            "fechaConsulta": "' . $fecha_consulta . '",
            "fechaAtencion": "' . $fecha_atencion . '",
            ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
            "canal": "' . $canal . '"
         }';

        $datos = array(
            "request" => $request,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 40);

        if ($response_object == false || $response_object == "") {
            return;
        }

        $response = '{
            "NumRa" : "' . $response_object . '"
        }';

        return $response;

    }

    private function quitarTildes($cadena)
    {
        if ($cadena == false) {
            return "";
        }
        $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
        );

        $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena);

        $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena);

        $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena);

        $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena);

        $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
        );

        return $cadena;
    }

    private function CuadroMedicoDinamico($app, $params_error_report, $nameController, $chat_id)
    {

        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $url = "https://osiapppre02.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password
        $nameFunction = "cuadroMedicoDinamico()";
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $numIdentificacion = $_POST['numeroIdentidad'];
        $tipoIdentificacion = $_POST['tipoIdentidad'];
        $numContrato = $_POST['numContrato'];
        $nombrePrest = $_POST['nombrePrestador'];
        $tipoConsulta = $_POST['tipoConsulta'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $tipoIdentificacion = strtoupper($tipoIdentificacion);
        $nombrePrest = $this->quitarTildes($nombrePrest);
        $nombrePrest = str_replace(" ", "%", $nombrePrest);
        if ($tipoIdentificacion === "NIT") {
            $tipoIdentificacion = "NI";
        };

        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/PrestadoresServicio/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona" xmlns:pres1="http://colsanitas.com/osi/comun/prestadores" xmlns:ubic="http://colsanitas.com/osi/comun/ubicacion">
        <soapenv:Header>
               <pres:HeaderRqust>
                      <!--Optional:-->
                      <pres:header>
                             <!--Optional:-->
                             <nof:messageHeader>
                                <!--Optional:-->
                                <!--Optional:-->
                                <nof:messageInfo>
                                       <!--Optional:-->
                                       <nof:tipoConsulta>3</nof:tipoConsulta>
                                </nof:messageInfo>
                                <!--Optional:-->
                             </nof:messageHeader>
                             <!--Optional:-->
                             <nof:user>
                                <!--Optional:-->
                                <nof:userName></nof:userName>
                                <!--Optional:-->
                                <nof:userToken></nof:userToken>
                             </nof:user>
                      </pres:header>
               </pres:HeaderRqust>
        </soapenv:Header>
        <soapenv:Body>
               <pres:CuadroMedicoEnt>
                      <!--Optional:-->
                      <pres:cuadroMedicoEnt>
                             <!--Optional:-->
                             <srv:CuadroMedico>
                                <!--Optional:-->
                                <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                                <!--Optional:-->
                                <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                                <!--Optional:-->
                                <srv:identificacionPrestador>
                                       <!--Optional:-->
                                       <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                                       <!--Optional:-->
                                       <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                                       <!--Optional:-->
                                       <per:descTipoIdentificacion></per:descTipoIdentificacion>
                                </srv:identificacionPrestador>
                                <!--Optional:-->
                                <srv:nombrePrestador>' . $nombrePrest . '</srv:nombrePrestador>
                                <!--Optional:-->
                                <srv:nombreSede></srv:nombreSede>
                                <!--Optional:-->
                                <srv:codSucursalPrestador></srv:codSucursalPrestador>
                                <!--Optional:-->
                                <srv:nomSucursalPrestador></srv:nomSucursalPrestador>
                                <!--Optional:-->
                                <srv:codRegionalSucursal></srv:codRegionalSucursal>
                                <!--Optional:-->
                                <srv:fechaInicioConsultaVigencia></srv:fechaInicioConsultaVigencia>
                                <!--Optional:-->
                                <srv:fechaFinConsultaVigencia></srv:fechaFinConsultaVigencia>
                                <!--Optional:-->
                                <srv:ciudad></srv:ciudad>
                                <!--Optional:-->
                                <srv:codGrupoCuadroMedico></srv:codGrupoCuadroMedico>
                                <!--Zero or more repetitions:-->
                                <srv:ServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:codServicioCuadroMedico></pres1:codServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:nombreServicioCuadroMedico></pres1:nombreServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:direccionCompleta></pres1:direccionCompleta>
                                       <!--Optional:-->
                                       <pres1:latitud></pres1:latitud>
                                       <!--Optional:-->
                                       <pres1:longitud></pres1:longitud>
                                       <!--Optional:-->
                                       <pres1:nivel></pres1:nivel>
                                       <!--Zero or more repetitions:-->
                                       <pres1:telefono>
                                              <!--Optional:-->
                                              <ubic:codigo>0</ubic:codigo>
                                              <!--Optional:-->
                                              <ubic:numero></ubic:numero>
                                              <!--Optional:-->
                                              <ubic:ext></ubic:ext>
                                              <!--Optional:-->
                                              <ubic:indicativo>
                                                     <!--Optional:-->
                                                     <ubic:indicativoPais></ubic:indicativoPais>
                                                     <!--Optional:-->
                                                     <ubic:codigoArea></ubic:codigoArea>
                                              </ubic:indicativo>
                                       </pres1:telefono>
                                </srv:ServicioCuadroMedico>
                                <!--Optional:-->
                                <srv:longitudMin></srv:longitudMin>
                                <!--Optional:-->
                                <srv:longitudMax></srv:longitudMax>
                                <!--Optional:-->
                                <srv:latitudMin></srv:latitudMin>
                                <!--Optional:-->
                                <srv:latitudMax></srv:latitudMax>
                                <!--Optional:-->
                                <srv:numContrato>' . $numContrato . '</srv:numContrato>
                             </srv:CuadroMedico>
                      </pres:cuadroMedicoEnt>
               </pres:CuadroMedicoEnt>
        </soapenv:Body>
     </soapenv:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestadores/CuadroMedico"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");
        $datos = array(
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "numIdentificacion" => $numIdentificacion,
            "tipoIdentificacion" => $tipoIdentificacion,
            "numContrato" => $numContrato,
            "nombrePrest" => $nombrePrest,
            "tipoConsulta" => $tipoConsulta,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $soapUrl,
        );
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);
        $response1 = str_replace('<s:Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $response);
        $response2 = str_replace("</s:Body>", "</Body>", $response1);
        $response3 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response2);
        $response4 = str_replace("</s:Envelope>", "</Envelope>", $response3);
        $response5 = str_replace("<s:Header>", "<Header>", $response4);
        $response6 = str_replace("</s:Header>", "</Header>", $response5);

        $parser = simplexml_load_string($response6);
        $finalResponse = json_decode(json_encode($parser));
        $this->createLog($finalResponse, $soapXML, $chat_id, $nameFunction, "POST");
        $finalResponseList = $finalResponse->{'Body'}->{'CuadroMedicoSal'}->{'cuadroMedicoSal'}->{'datosBasicosConvenio'};
        $tipoRespuesta = gettype($finalResponseList);
        $datosBasicosPrestador = $finalResponse->{'Body'}->{'CuadroMedicoSal'}->{'cuadroMedicoSal'}->{'datosBasicosConvenio'}->{'datosBasicosPrestador'};
        $tipoRespuesta2 = gettype($datosBasicosPrestador);

        if ($tipoRespuesta == 'array') {
            $finalResponseList = (array) $finalResponse->{'Body'}->{'CuadroMedicoSal'}->{'cuadroMedicoSal'}->{'datosBasicosConvenio'};
            $longitud = count($finalResponseList);
            $listadoPrestadoresServicios = array();
            $temporalArray = array();
            $longitud = count($finalResponseList);
            if ($longitud == '0') {
                return $msj = 'error';
            } else {
                for ($i = 0; $i < $longitud; $i++) {
                    array_push($listadoPrestadoresServicios, $finalResponseList[$i]);
                }
                $longitud2 = count($listadoPrestadoresServicios);
                if ($final > ($longitud2 - 1)) {
                    for ($i = $inicio; $i < $longitud2; $i++) {
                        array_push($temporalArray, $listadoPrestadoresServicios[$i]);
                    }
                } else {
                    for ($i = $inicio; $i <= $final; $i++) {
                        array_push($temporalArray, $listadoPrestadoresServicios[$i]);
                    }
                }

            }

            $longitudPrestadoresServicios = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud2 / $cantidad);
            for ($i = 0; $i < $longitudPrestadoresServicios; $i++) {

                $response->dynamicArray[$i]->mensaje = $temporalArray[$i]->datosBasicosPrestador->identificacion->tipoIdentificacion . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->identificacion->numIdentificacion . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->codigoPrestador . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->nombrePrestador . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->datosGenericos->ciudad->departamento->descripcion . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->datosGenericos->ciudad->descripcion . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->datosGenericos->direccion . ' - ' .
                $temporalArray[$i]->datosBasicosPrestador->datosGenericos->telefono;
                $response->dynamicArray[$i]->tipoIdentificacion = $temporalArray[$i]->datosBasicosPrestador->identificacion->tipoIdentificacion;
                $response->dynamicArray[$i]->numIdentificacion = $temporalArray[$i]->datosBasicosPrestador->identificacion->numIdentificacion;
                $response->dynamicArray[$i]->codigoPrestador = $temporalArray[$i]->datosBasicosPrestador->codigoPrestador;
                $response->dynamicArray[$i]->nombrePrestador = $temporalArray[$i]->datosBasicosPrestador->nombrePrestador;
                $response->dynamicArray[$i]->departamento = $temporalArray[$i]->datosBasicosPrestador->datosGenericos->ciudad->departamento->descripcion;
                $response->dynamicArray[$i]->Municipio = $temporalArray[$i]->datosBasicosPrestador->datosGenericos->ciudad->descripcion;
                $response->dynamicArray[$i]->direccion = $temporalArray[$i]->datosBasicosPrestador->datosGenericos->direccion;
                $response->dynamicArray[$i]->telefono = $temporalArray[$i]->datosBasicosPrestador->datosGenericos->telefono;
            };
            return \GuzzleHttp\json_encode($response);

        } elseif ($tipoRespuesta2 == 'array') {
            $finalResponseList = (array) $finalResponse->{'Body'}->{'CuadroMedicoSal'}->{'cuadroMedicoSal'}->{'datosBasicosConvenio'}->{'datosBasicosPrestador'};
            $longitud = count($finalResponseList);
            $listadoPrestadoresServicios = array();
            $temporalArray = array();
            $longitud = count($finalResponseList);
            if ($longitud == '0') {
                return $msj = 'error';
            } else {
                for ($i = 0; $i < $longitud; $i++) {
                    array_push($listadoPrestadoresServicios, $finalResponseList[$i]);
                }
                $longitud2 = count($listadoPrestadoresServicios);
                if ($final > ($longitud2 - 1)) {
                    for ($i = $inicio; $i < $longitud2; $i++) {
                        array_push($temporalArray, $listadoPrestadoresServicios[$i]);
                    }
                } else {
                    for ($i = $inicio; $i <= $final; $i++) {
                        array_push($temporalArray, $listadoPrestadoresServicios[$i]);
                    }
                }

            }

            $longitudPrestadoresServicios = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud2 / $cantidad);
            for ($i = 0; $i < $longitudPrestadoresServicios; $i++) {

                $response->dynamicArray[$i]->mensaje = $temporalArray[$i]->identificacion->tipoIdentificacion . ' - ' .
                $temporalArray[$i]->identificacion->numIdentificacion . ' - ' .
                $temporalArray[$i]->codigoPrestador . ' - ' .
                $temporalArray[$i]->nombrePrestador . ' - ' .
                $temporalArray[$i]->datosGenericos->ciudad->departamento->descripcion . ' - ' .
                $temporalArray[$i]->datosGenericos->ciudad->descripcion . ' - ' .
                $temporalArray[$i]->datosGenericos->direccion . ' - ' .
                $temporalArray[$i]->datosGenericos->telefono;
                $response->dynamicArray[$i]->tipoIdentificacion = $temporalArray[$i]->identificacion->tipoIdentificacion;
                $response->dynamicArray[$i]->numIdentificacion = $temporalArray[$i]->identificacion->numIdentificacion;
                $response->dynamicArray[$i]->codigoPrestador = $temporalArray[$i]->codigoPrestador;
                $response->dynamicArray[$i]->nombrePrestador = $temporalArray[$i]->nombrePrestador;
                $response->dynamicArray[$i]->departamento = $temporalArray[$i]->datosGenericos->ciudad->departamento->descripcion;
                $response->dynamicArray[$i]->Municipio = $temporalArray[$i]->datosGenericos->ciudad->descripcion;
                $response->dynamicArray[$i]->direccion = $temporalArray[$i]->datosGenericos->direccion;
                $response->dynamicArray[$i]->telefono = $temporalArray[$i]->datosGenericos->telefono;
            };
            return \GuzzleHttp\json_encode($response);
        } else {
            $finalResponseList = $finalResponse->{'Body'}->{'CuadroMedicoSal'}->{'cuadroMedicoSal'}->{'datosBasicosConvenio'}->{'datosBasicosPrestador'};
            if (!$finalResponseList->identificacion->tipoIdentificacion) {
                return '{
                "error": "1"

            }';
            }
            return '{
            "esObjeto" : "1",
            "tipoIdentificacion":"' . $finalResponseList->identificacion->tipoIdentificacion . '",
            "numIdentificacion":"' . $finalResponseList->identificacion->numIdentificacion . '",
            "codigoPrestador":"' . $finalResponseList->codigoPrestador . '",
            "nombrePrestador":"' . $finalResponseList->nombrePrestador . '",
            "departamento":"' . $finalResponseList->datosGenericos->ciudad->departamento->descripcion . '",
            "Municipio":"' . $finalResponseList->datosGenericos->ciudad->descripcion . '",
            "direccion":"' . $finalResponseList->datosGenericos->direccion . '",
            "telefono":"' . $finalResponseList->datosGenericos->telefono . '",
            "especialidad":"' . $finalResponseList->sucursales->especialidadFrecuente . '"
        }';
        }

    }
    public function marcarAutorizacion($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $tipoConsulta = 1;
        $numeroAutorizacion = $_POST['numeroAutorizacion'];
        $utilizado = $_POST['utilizado'];
//         $fechaUtilizacion = $_POST['fechaUtilizacion'];
        $fechaUtilizacion = date('Y-m-d');
        $codProducto = $_POST['codProducto'];
        $codSucursalIPSPrestador = $_POST['codSucursalIPSPrestador'];
        $token = $this->getTokenWs($app, false);
        $nameFunction = "marcarAutorizacion()";
        $fechapeticion = date('Y-m-d');

        $url = $urlIn . "prestaciones/v1.0.0/marcarutilizacion/numeroAutorizacion/" . $numeroAutorizacion . "/utilizado/" . $utilizado . "/fechaUtilizacion/" . $fechaUtilizacion . "/codProducto/" . $codProducto . "/codSucursalIPSPrestador/" . $codSucursalIPSPrestador;

        $headers = array("tipoconsulta" => $tipoConsulta, "fechapeticion" => $fechapeticion);

        $request = '{}';
        $datos = array(
            "tipoConsulta" => $tipoConsulta,
            "numeroAutorizacion" => $numeroAutorizacion,
            "utilizado" => $utilizado,
            "fechaUtilizacion" => $fechaUtilizacion,
            "codProducto" => $codProducto,
            "codSucursalIPSPrestador" => $codSucursalIPSPrestador,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
        $marcacion = $response_object->MarcarUtilizacionSal->MarcarUtilizacion->MarcarUtilizacion->mensaje;
        //probar si el true o false del isconsumed es retornado como un String
        if ($marcacion === 'Se presentaron errores en el proceso de marcacion') {
            return '{
                "marcacionExitosa" : "0"
            }';
        } else {
            return '{
                "marcacionExitosa" : "1"
            }';
        }

    }

    private function consultService($app, $params_error_report, $nameController, $chat_id)
    {
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint?wsdl"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint?wsdl';
        }
        $codigo = $_POST['codigo'];
        $username = $_POST['user'];
        $usertoken = $_POST['tokenUser'];
        $codProducto = $_POST['codigoProducto'];
        $codPlan = $_POST['codigoPlan'];
        $nombreServicio = $_POST['nombreService'];
        $nameFunction = "consultService()";
        $tipoConsulta = 1;

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];
        $parametros = array('ConsultarServicioEnt' => array('consultarServicioEnt' => array('ConsultarServicio' => array('Cobertura' => array('codigoProducto' => $codProducto, 'codigoPlan' => $codPlan), 'PrestacionMedicamento' => array('codPrestacionMedicamentoOSI' => '', 'cantidadPrestacionMedicamentoOSI' => ''), 'nomPrestacionMedicamentoOSI' => $nombreServicio))));
        $tipo = "POST";
        $opcion = "ConsultarServicio";
        $respuesta = \App\Utils\StaticExecuteService::executeServiceSOAP($chat_id, $nameController, $nameFunction, $app, $url, $parametros, $tipo, $opcion, $params_error_report, "Prestadores", $token = null, $headersS);
        // $this->createLog( $respuesta,$parametros,$chat_id,$nameFunction,"POST");

        $listServices = $respuesta->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->nomServicio;
        //aqui esta saltando un error porque hay que hacer json_encode para poder imprimirlo
        return $listServices;

    }

    private function basicData($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $nameFunction = "basicData()";
        $userIdentification = $_POST['userId'];
        $typeIdentification = $_POST['typeId'];
        $token = $this->getTokenWs($app, false);
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        switch ($typeIdentification) {
            case "01":
                $typeIdentification = "CC";
                break;
            case "02":
                $typeIdentification = "CE";
                break;
            case "03":
                $typeIdentification = "MS";
                break;
            case "04":
                $typeIdentification = "NIT";
                break;
            case "05":
                $typeIdentification = "NIP";
                break;
            case "06":
                $typeIdentification = "PA";
                break;
            case "07":
                $typeIdentification = "RC";
                break;
            case "08":
                $typeIdentification = "TI";
                break;
            case "09":
                $typeIdentification = "CD";
                break;
            case "10":
                $typeIdentification = "CN";
                break;
            case "11":
                $typeIdentification = "SC";
                break;
            case "12":
                $typeIdentification = "PD";
                break;
            case "13":
                $typeIdentification = "PE";
                break;
            case "15":
                $typeIdentification = "PT";
                break;
            default:
                $typeIdentification = $typeIdentification;
                break;
        };

        $typeIdentification = substr($typeIdentification, 0, 2);
        $typeIdentification = strtoupper($typeIdentification);
        $userIdentification = strtoupper($userIdentification);
        $url = $urlIn . 'user/userManagement/patient/v1.0.0/basicData?identificationNumber=' . $userIdentification . '&identificationType=' . $typeIdentification . '';
        $tipoConsulta = 1;
        $headers = array("tipoConsulta" => $tipoConsulta);
        $datos = array(
            "userIdentification" => $userIdentification,
            "typeIdentification" => $typeIdentification,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$url,$chat_id,$nameFunction,"GET");

        $f_name = $response_object->data[0]->name->name->firstName;
        $s_name = $response_object->data[0]->name->name->secondName;
        $l_name = $response_object->data[0]->name->name->firstFamily;
        $l2_name = $response_object->data[0]->name->name->secondFamily;
        $gender = $response_object->data[0]->gender;
        $b_date = $response_object->data[0]->birthDate;
        $age = $response_object->data[0]->age;

        $var = '{
            "PrimerNombre": "' . $f_name . '",
            "SegundoNombre": "' . $s_name . '",
            "PrimerApellido": "' . $l_name . '",
            "SegundoApellido": "' . $l2_name . '",
            "Genero": "' . $gender . '",
            "FechaNacimiento": "' . $b_date . '",
            "Edad": "' . $age . '",
            "NombreCompleto": "' . $f_name . ' ' . $s_name . ' ' . $l_name . ' ' . $l2_name . '"
        }';

        return $var;
    }

    public function ListVales($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "ListVales()";
        $codCia = $_POST['codigoCompania'];
        $codplan = $_POST['codigoPlan'];
        $contrato = $_POST['numeroContrato'];
        $familia = $_POST['numFamilia'];

        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $numeroPin = $_POST['numeroPin'];
        $categoria = $_POST['categoria'];

        if (!$categoria) {
            $categoria = "";
        }

        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $token = $this->getTokenWs($app, false);
        $url = $urlIn . "valeshistorico/v1.0.0/consultaDispPorCto/codCia/" . $codCia . "/codPlan/" . $codplan . "/contUser/" . $contrato . "/famUser/" . $familia;

        $datos = array(
            "codCia" => $codCia,
            "codplan" => $codplan,
            "contrato" => $contrato,
            "familia" => $familia,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, "Prestadores", $datos, $timeOut = 15, $resetHeader = 'no', $getXml = 'si');

        $response_object = json_decode($response_object);
        $listadoVales = array();
        if (gettype($response_object->Vale) == "object") {
            $temporalArray = array();
            $longitud = count($response_object->Vale);

            if (count($response_object->Vale) === 0) {
                return $msj = 'No tiene vales asociados';
            } else {
                for ($i = 0; $i < $longitud; $i++) {
                    if ($response_object->Vale->codigo && $response_object->Vale->estado->descripcion == "HABILITADO") {
                        array_push($listadoVales, $response_object->Vale);
                    }
                }
                $longitud2 = count($listadoVales);
                if ($final > ($longitud2 - 1)) {
                    //$rest = $final - ($longitud2);
                    for ($i = $inicio; $i < $longitud2; $i++) {
                        array_push($temporalArray, $listadoVales[$i]);
                    }
                } else {

                    for ($i = $inicio; $i <= $final; $i++) {
                        array_push($temporalArray, $listadoVales[$i]);
                    }
                }
            }
            $longitudVales = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud / $cantidad);
            for ($i = 0; $i < $longitudVales; $i++) {
                $response->dynamicArray[$i]->mensaje_codigo = "Vale Disponible No: " . $temporalArray[$i]->codigo;
                $response->dynamicArray[$i]->codigo = $temporalArray[$i]->codigo;
                $response->dynamicArray[$i]->valorTotal = $temporalArray[$i]->precio->valorTotal;
            }
            $object = json_encode($response);
            return \GuzzleHttp\json_encode($response);
        } else {
            $temporalArray = array();
            $longitud = count($response_object->Vale);

            if (count($response_object->Vale) === 0) {
                return $msj = 'No tiene vales asociados';
            } else {
                for ($i = 0; $i < $longitud; $i++) {
                    if ($response_object->Vale[$i]->codigo && $response_object->Vale[$i]->estado->descripcion == "HABILITADO") {
                        // if ($categoria == "") {
                        //     array_push($listadoVales, $response_object->Vale[$i]);
                        // } else {
                        $validPin = $this->localConsultarPin($app, $params_error_report, $nameController, $chat_id, $userName, $userToken, $codCia, $codplan, $contrato, $familia, ($response_object->Vale[$i]->codigo), $categoria);
                        if ($validPin == 1) {
                            array_push($listadoVales, $response_object->Vale[$i]);
                            $longitudVales = sizeof($listadoVales);
                            $response = new \stdClass();
                            $response->numVerMas = ceil($longitud / $cantidad);
                            for ($i = 0; $i < $longitudVales; $i++) {
                                $response->dynamicArray[$i]->mensaje_codigo = "Vale Disponible No: " . $listadoVales[$i]->codigo;
                                $response->dynamicArray[$i]->codigo = $listadoVales[$i]->codigo;
                                $response->dynamicArray[$i]->valorTotal = $listadoVales[$i]->precio->valorTotal;
                            }
                            $object = json_encode($response);
                            return \GuzzleHttp\json_encode($response);
                        }
                        // }
                    }
                }
                $longitud2 = count($listadoVales);
                if ($final > ($longitud2 - 1)) {
                    //$rest = $final - ($longitud2);
                    for ($i = $inicio; $i < $longitud2; $i++) {
                        array_push($temporalArray, $listadoVales[$i]);
                    }
                } else {

                    for ($i = $inicio; $i <= $final; $i++) {
                        array_push($temporalArray, $listadoVales[$i]);
                    }
                }
            }
            $longitudVales = sizeof($temporalArray);
            $response = new \stdClass();
            $response->numVerMas = ceil($longitud / $cantidad);
            for ($i = 0; $i < $longitudVales; $i++) {
                $response->dynamicArray[$i]->mensaje_codigo = "Vale Disponible No: " . $temporalArray[$i]->codigo;
                $response->dynamicArray[$i]->codigo = $temporalArray[$i]->codigo;
                $response->dynamicArray[$i]->valorTotal = $temporalArray[$i]->precio->valorTotal;
            }
            $object = json_encode($response);
            return \GuzzleHttp\json_encode($response);

        }
    }

    public function requierePin($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "requierePin()";
        $canalIngreso = $_POST['canalIngreso'];
        $codPlan = $_POST['codPlan'];
        $codProducto = $_POST['codProducto'];
        $idConcepto = $_POST['idConcepto'];
        $numContrato = $_POST['numContrato'];
        $numFamilia = $_POST['numFamilia'];

        $ciudad = $_POST['ciudad'];
        $numDoc = $_POST['numDoc'];
        $numReferenciaPago = $_POST['numReferenciaPago'];
        $tipoDoc = $_POST['tipoDoc'];
        $tipoDoc = substr($tipoDoc, 0, 2);
        $tipoDoc = strtoupper($tipoDoc);
        switch ($tipoDoc) {
            case "CC":
                $tipoDoc = "01";
                break;
            case "CE":
                $tipoDoc = "02";
                break;
            case "MS":
                $tipoDoc = "03";
                break;
            case "NIT":
                $tipoDoc = "04";
                break;
            case "NIP":
                $tipoDoc = "05";
                break;
            case "PA":
                $tipoDoc = "06";
                break;
            case "RC":
                $tipoDoc = "07";
                break;
            case "TI":
                $tipoDoc = "08";
                break;
            case "CD":
                $tipoDoc = "09";
                break;
            case "CN":
                $tipoDoc = "10";
                break;
            case "SC":
                $tipoDoc = "11";
                break;
            case "PD":
                $tipoDoc = "12";
                break;
            case "PE":
                $tipoDoc = "13";
                break;
            case "PT":
                $tipoDoc = "15";
                break;
            default:
                $tipoDoc = $tipoDoc;
                break;
        };

        $token = $this->getTokenWs($app, false);
        $url = $urlIn . "recaudo/v1.0.0/consulta/concepto";

        $request = '{
        	        "requestCabecera": {
 				"canalIngreso": "' . $canalIngreso . '",
 				"codPlan": "' . $codPlan . '",
 				"codProducto": "' . $codProducto . '",
 				"idConcepto": "' . $idConcepto . '",
 				"numContrato": "' . $numContrato . '",
 				"numFamilia": "' . $numFamilia . '"
  			},
  			"requestConsultaConcepto": {
 				"ciudad": "' . $ciudad . '",
 				"numDoc": "' . $numDoc . '",
 				"numReferenciaPago": "' . $numReferenciaPago . '",
 				"tipoDoc": "' . $tipoDoc . '"
 		 	}
        	    }';
        $datos = array(
            "canalIngreso" => $canalIngreso,
            "codPlan" => $codPlan,
            "codProducto" => $codProducto,
            "idConcepto" => $idConcepto,
            "numContrato" => $numContrato,
            "numFamilia" => $numFamilia,
            "ciudad" => $ciudad,
            "numDoc" => $numDoc,
            "numReferenciaPago" => $numReferenciaPago,
            "tipoDoc" => $tipoDoc,
            "token" => $token,
            "url" => $url,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 30);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        $validPin = json_encode($response_object->responseConsultaventa->requierePin);
        $valor_total = json_encode($response_object->responseConsultaventa->valorTotal);
        $messageCode = json_encode($response_object->responseCabecera->messageCode);
        return '{
		 	"requierePin": "' . $validPin . '",
            "valorTotal" : "' . $valor_total . '",
            "messageCode" : ' . $messageCode . '

			}';

    }

    public function convenioVigente($app, $params_error_report, $nameController, $chat_id)
    {
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint?wsdl"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint?wsdl';
        }
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $numIdentificacion = $_POST['numeroIdentidad'];
        $tipoIdentificacion = $_POST['tipoIdentidad'];
        $numContrato = $_POST['numeroContrato'];
        $tipoConsulta = $_POST['tipoConsulta'];
        $nameFunction = "convenioVigente()";

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/PrestadoresServicio/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona" xmlns:pres1="http://colsanitas.com/osi/comun/prestadores" xmlns:ubic="http://colsanitas.com/osi/comun/ubicacion">
        <soapenv:Header>
               <pres:HeaderRqust>
                      <!--Optional:-->
                      <pres:header>
                             <!--Optional:-->
                             <nof:messageHeader>
                                <!--Optional:-->
                                <!--Optional:-->
                                <nof:messageInfo>
                                       <!--Optional:-->
                                       <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                                </nof:messageInfo>
                                <!--Optional:-->
                             </nof:messageHeader>
                             <!--Optional:-->
                             <nof:user>
                                <!--Optional:-->
                                <nof:userName></nof:userName>
                                <!--Optional:-->
                                <nof:userToken></nof:userToken>
                             </nof:user>
                      </pres:header>
               </pres:HeaderRqust>
        </soapenv:Header>
        <soapenv:Body>
               <pres:CuadroMedicoEnt>
                      <!--Optional:-->
                      <pres:cuadroMedicoEnt>
                             <!--Optional:-->
                             <srv:CuadroMedico>
                                <!--Optional:-->
                                <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                                <!--Optional:-->
                                <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                                <!--Optional:-->
                                <srv:identificacionPrestador>
                                       <!--Optional:-->
                                       <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                                       <!--Optional:-->
                                       <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                                       <!--Optional:-->
                                       <per:descTipoIdentificacion></per:descTipoIdentificacion>
                                </srv:identificacionPrestador>
                                <!--Optional:-->
                                <srv:nombrePrestador></srv:nombrePrestador>
                                <!--Optional:-->
                                <srv:nombreSede></srv:nombreSede>
                                <!--Optional:-->
                                <srv:codSucursalPrestador></srv:codSucursalPrestador>
                                <!--Optional:-->
                                <srv:nomSucursalPrestador></srv:nomSucursalPrestador>
                                <!--Optional:-->
                                <srv:codRegionalSucursal></srv:codRegionalSucursal>
                                <!--Optional:-->
                                <srv:fechaInicioConsultaVigencia></srv:fechaInicioConsultaVigencia>
                                <!--Optional:-->
                                <srv:fechaFinConsultaVigencia></srv:fechaFinConsultaVigencia>
                                <!--Optional:-->
                                <srv:ciudad></srv:ciudad>
                                <!--Optional:-->
                                <srv:codGrupoCuadroMedico></srv:codGrupoCuadroMedico>
                                <!--Zero or more repetitions:-->
                                <srv:ServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:codServicioCuadroMedico></pres1:codServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:nombreServicioCuadroMedico></pres1:nombreServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:direccionCompleta></pres1:direccionCompleta>
                                       <!--Optional:-->
                                       <pres1:latitud></pres1:latitud>
                                       <!--Optional:-->
                                       <pres1:longitud></pres1:longitud>
                                       <!--Optional:-->
                                       <pres1:nivel></pres1:nivel>
                                       <!--Zero or more repetitions:-->
                                       <pres1:telefono>
                                              <!--Optional:-->
                                              <ubic:codigo>0</ubic:codigo>
                                              <!--Optional:-->
                                              <ubic:numero></ubic:numero>
                                              <!--Optional:-->
                                              <ubic:ext></ubic:ext>
                                              <!--Optional:-->
                                              <ubic:indicativo>
                                                     <!--Optional:-->
                                                     <ubic:indicativoPais></ubic:indicativoPais>
                                                     <!--Optional:-->
                                                     <ubic:codigoArea></ubic:codigoArea>
                                              </ubic:indicativo>
                                       </pres1:telefono>
                                </srv:ServicioCuadroMedico>
                                <!--Optional:-->
                                <srv:longitudMin></srv:longitudMin>
                                <!--Optional:-->
                                <srv:longitudMax></srv:longitudMax>
                                <!--Optional:-->
                                <srv:latitudMin></srv:latitudMin>
                                <!--Optional:-->
                                <srv:latitudMax></srv:latitudMax>
                                <!--Optional:-->
                                <srv:numContrato>' . $numContrato . '</srv:numContrato>
                             </srv:CuadroMedico>
                      </pres:cuadroMedicoEnt>
               </pres:CuadroMedicoEnt>
        </soapenv:Body>
     </soapenv:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestadores/CuadroMedico"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $respuesta = curl_exec($ch);
        $this->createLog($respuesta, $parametros, $chat_id, $nameFunction, "POST");

        $respuesta1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $respuesta);
        $respuesta2 = str_replace('<s:Header>', '<Header>', $respuesta1);
        $respuesta3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">',
            '<HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $respuesta2);

        $respuesta4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $respuesta3);
        $respuesta5 = str_replace('</s:Header>', '</Header>', $respuesta4);
        $respuesta6 = str_replace('<s:Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">',
            '<Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $respuesta5);

        $respuesta7 = str_replace('</s:Body>', '</Body>', $respuesta6);
        $respuesta8 = str_replace('</s:Envelope>', '</Envelope>', $respuesta7);

        $parser = simplexml_load_string($respuesta8);

        $codigoPrestador = $parser->Body->CuadroMedicoSal->cuadroMedicoSal->datosBasicosConvenio->datosBasicosPrestador->codigoPrestador;

        $valid_Anulacion = '{
            		"RAnulado": "1",
                    "msjSalida": "' . $codigoPrestador . '"
        	}';

        return $valid_Anulacion;

    }

    public function AuthBonoCero($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "AuthBonoCero()";
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint?wsdl"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint?wsdl';
        }
        $numAuth = $_POST['numAuth'];
        $tipoConsulta = $_POST['tipoConsulta'];

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona">
        <soapenv:Header>
           <pres:HeaderRqust>
              <!--Optional:-->
              <pres:header>
                 <!--Optional:-->
                 <nof:messageHeader>
                    <nof:messageInfo>
                       <!--Optional:-->
                       <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                    </nof:messageInfo>
                 </nof:messageHeader>
              </pres:header>
           </pres:HeaderRqust>
        </soapenv:Header>
        <soapenv:Body>
           <pres:ConsultarEnt>
              <!--Optional:-->
              <pres:consultarEnt>
                 <!--Optional:-->
                 <srv:Consultar>
                    <!--Optional:-->
                    <srv:numAutorizacion>' . $numAuth . '</srv:numAutorizacion>
                 </srv:Consultar>
              </pres:consultarEnt>
           </pres:ConsultarEnt>
        </soapenv:Body>
     </soapenv:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestaciones/ConsultarAutorizaciones"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $respuesta = curl_exec($ch);
        $parametros = array(
            "numeroAutorizacion" => $numAuth);
        $this->createLog($respuesta, $parametros, $chat_id, $nameFunction, "POST");

        $respuesta1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
        ', $respuesta);
        $respuesta2 = str_replace('<s:Header>', '<Header>', $respuesta1);
        $respuesta3 = str_replace('<h:HeaderRspns ', '<HeaderRspns ', $respuesta2);

        $respuesta4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $respuesta3);
        $respuesta5 = str_replace('</s:Header>', '</Header>', $respuesta4);
        $respuesta6 = str_replace('<s:Body ', '<Body ', $respuesta5);

        $respuesta7 = str_replace('</s:Body>', '</Body>', $respuesta6);
        $respuesta8 = str_replace('</s:Envelope>', '</Envelope>', $respuesta7);
        $parser = simplexml_load_string($respuesta8);

        $headers = json_encode($parser->Header->HeaderRspns->header->responseStatus->businessException->errorDetails);
        $authPagoInfo = json_encode($parser->Body->ConsultarSal->consultarSal->Autorizaciones->ValorAutorizacion);
        $codTipoAtencion = json_decode($parser->Body->ConsultarSal->consultarSal->Autorizaciones->InformacionAutorizacion->codTipoAtencion);
        $valorTotalNegociado = json_decode($parser->Body->ConsultarSal->consultarSal->Autorizaciones->Procedimientos->valorTotalNegociado);

        $procedimientos1 = ($parser->Body->ConsultarSal->consultarSal->Autorizaciones);
        $procedimientos2 = json_decode(json_encode($procedimientos1))->Procedimientos;
//print_r(gettype($procedimientos2));
        $valorTotalNegociado = "";
        if (gettype($procedimientos2) == 'array') {
            for ($j = 0; $j < count($procedimientos2); $j++) {
                if ($j < (count($procedimientos2) - 1)) {
                    $valorTotalNegociado = $valorTotalNegociado . $procedimientos2[$j]->valorTotalNegociado . '-';
                } else {
                    $valorTotalNegociado = $valorTotalNegociado . $procedimientos2[$j]->valorTotalNegociado;
                }
            }
        } else {

            $valorTotalNegociado = json_decode($parser->Body->ConsultarSal->consultarSal->Autorizaciones->Procedimientos->valorTotalNegociado);
        }
        $errorCode = json_decode($headers);
        $cantidadBonos = json_decode($authPagoInfo)->cantidadBonos;
        $porcentajeCopago = json_decode($authPagoInfo)->porcentajeCopago;

        if ($errorCode->errorCode == "OK") {
            if (!$porcentajeCopago && $cantidadBonos == 0) {
                return '{
                    "authExento": "1",
                    "codTipoAtencionAuthNew": "' . $codTipoAtencion . '",
                    "valorTotalNegociadoAuthNew": "' . $valorTotalNegociado . '"
                }';
            } elseif ($porcentajeCopago == 0 && $cantidadBonos == 0) {
                return '{
                    "authExento": "1",
                    "codTipoAtencionAuthNew": "' . $codTipoAtencion . '",
                    "valorTotalNegociadoAuthNew": "' . $valorTotalNegociado . '"
                }';
            } else {
                return '{
                    "authExento": "0",
                    "codTipoAtencionAuthNew": "' . $codTipoAtencion . '",
                    "valorTotalNegociadoAuthNew": "' . $valorTotalNegociado . '"
                }';
            }
        } else {
            return '{
                "authExento": "0",
                "codTipoAtencionAuthNew": "' . $codTipoAtencion . '",
                "valorTotalNegociadoAuthNew": "' . $valorTotalNegociado . '"
            }';
        }

    }

    public function validatePinStatus($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $nameFunction = "validatePinStatus()";
        $codCia = $_POST['codCompania'];
        $numPin = $_POST['numPinVale'];
        $docType = $_POST['tipoDocumento'];
        $codplan = $_POST['codigoPlan'];
        $contrato = $_POST['numeroContrato'];
        $familia = $_POST['numFamilia'];
        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $categoria = $_POST['categoria'];

        $numeroPin = $_POST['numeroPin'];

        $url = $urlIn . 'financialResourceManagement/payment/electronicVaucher/v1.0.0/consultar';
        $token = $this->getTokenWs($app, false);
        $request = '{
            "codigoCompania" : "' . $codCia . '",
            "numeroPinVale": "' . $numPin . '",
            "tipoDocumento": "' . $docType . '"
            }';

        $datos = array(
            "codCia" => $codCia,
            "numPin" => $numPin,
            "docType" => $docType,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        $valorPinCorrecto = $this->localConsultarPin($app, $params_error_report, $nameController, $chat_id, $userName, $userToken, $codCia, $codplan, $contrato, $familia, $numPin, $categoria);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $validPin = $response_object->consultarResponse->pinVale->estado;
        $numPin = $response_object->consultarResponse->pinVale->numeroPinVale;
        $valorPin = $response_object->consultarResponse->pinVale->precioPin->valorTotal;
        $contratoVale = $response_object->consultarResponse->pinVale->numeroContrato;
        $familiaVale = $response_object->consultarResponse->pinVale->numeroFamilia;
        $usuarioVale = $response_object->consultarResponse->pinVale->numeroUsuario;
        $valorCorrecto = $valorPinCorrecto;

        switch ($validPin) {
            case '1':
                $val = "Habilitado";
                break;
            case '2':
                $val = "Anulado";
                break;
            case '3':
                $val = "Utilizado";
                break;
            case '4':
                $val = "Utilizado Administrativo";
                break;
            case '5':
                $val = "Facturado";
                break;
            case '6':
                $val = "Anulado cortesía";
                break;
            default:
                $val = 'N';
        };

        if ($val == 'N') {
            $numPin = 0;
            $valorPin = 0;
        }

        $salida = '{
                "estadoPin" : "' . $val . '",
                "numeroPin" : ' . $numPin . ',
                "valorPin" : ' . $valorPin . ',
                "contratoVale" : "' . $contratoVale . '",
                "familiaVale" : ' . $familiaVale . ',
                "valorCorrecto" : ' . $valorPinCorrecto . ',
                ' . ($usuarioVale ? '"usuarioVale" : "' . $usuarioVale . '"' : '"usuarioVale" : "null"') . '
            }';

        return $salida;

    }

    private function getRegister($app, $params_error_report, $nameController, $chat_id)
    {

        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/IVRServices.IVRServicesHttpSoap12Endpoint?wsdl"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/IVRServices.IVRServicesHttpSoap12Endpoint?wsdl';
        }
        $codigo = $_POST['codigo'];
        $nameFunction = "getRegister()";
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password
        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ivrservices.osi.com/">
           <soapenv:Header/>
           <soapenv:Body>
              <ser:consultarRegistroAtencion>
                 <!--Optional:-->
                 <consultarRegistroAtencionEnt>
                    <!--Optional:-->
                    <registroAtencion>
                       <!--Optional:-->
                       <codigoRegistro>' . $codigo . '</codigoRegistro>
                    </registroAtencion>
                 </consultarRegistroAtencionEnt>
              </ser:consultarRegistroAtencion>
           </soapenv:Body>
        </soapenv:Envelope>';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/IVRServices.IVRServicesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/IVRServices.IVRServicesHttpSoap11Endpoint';
        }

        // Set cURL options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: ""',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $respuesta = curl_exec($ch);

        $respuesta1 = str_replace("<env:Envelope xmlns:env='http://schemas.xmlsoap.org/soap/envelope/'>", '<Envelope xmlns:env="http://schemas.xmlsoap.org/soap/envelope/">', $respuesta);
        $respuesta2 = str_replace('<env:Header></env:Header>', '<Header></Header>', $respuesta1);
        $respuesta3 = str_replace('<env:Body>', '<Body>', $respuesta2);
        $respuesta4 = str_replace('<ns2:consultarRegistroAtencionResponse xmlns:ns2="http://service.ivrservices.osi.com/">', '<consultarRegistroAtencionResponse xmlns:ns2="http://service.ivrservices.osi.com/">', $respuesta3);
        $respuesta5 = str_replace('</ns2:consultarRegistroAtencionResponse>', '</consultarRegistroAtencionResponse>', $respuesta4);
        $respuesta6 = str_replace('</env:Body>', '</Body>', $respuesta5);
        $respuesta7 = str_replace('</env:Envelope>', '</Envelope>', $respuesta6);

        $parser = simplexml_load_string($respuesta7);

        $prestId = $parser->Body->consultarRegistroAtencionResponse->consultarRegistroAtencionSal->prestador->identificacion->documentoIdentidad;
        $prestTypeId = $parser->Body->consultarRegistroAtencionResponse->consultarRegistroAtencionSal->prestador->identificacion->codigoTipoDocumento;

        return '{
            "numPrest": "' . $prestId . '",
            "typePrest": "' . $prestTypeId . '"
        }';
    }

    private function getCurl($app, $params_error_report, $nameController, $chat_id)
    {
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint?wsdl"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/ProxyPrestacionesBono.ProxyPrestacionesBonoHttpSoap11Endpoint?wsdl"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona">
                <soapenv:Header>
                   <pres:HeaderRqust>
                      <!--Optional:-->
                      <pres:header>
                         <!--Optional:-->
                         <nof:messageHeader>
                            <!--Optional:-->

                            <!--Optional:-->
                            <nof:messageInfo>

                               <nof:tipoConsulta>1</nof:tipoConsulta>
                            </nof:messageInfo>
                            <!--Optional:-->

                         </nof:messageHeader>
                         <!--Optional:-->

                      </pres:header>
                   </pres:HeaderRqust>
                </soapenv:Header>
                <soapenv:Body>
                   <pres:ConsultarServicioEnt>
                      <!--Optional:-->
                      <pres:consultarServicioEnt>
                         <!--Optional:-->
                         <srv:ConsultarServicio>
                            <!--Optional:-->
                            <srv:Cobertura>
                               <!--Optional:-->
                               <srv:codigoProducto>10</srv:codigoProducto>
                               <!--Optional:-->
                               <srv:codigoPlan>10</srv:codigoPlan>
                            </srv:Cobertura>
                            <!--Optional:-->
                            <srv:Contrato>
                               <!--Optional:-->
                               <srv:numContrato></srv:numContrato>
                               <!--Optional:-->
                               <srv:numeroFamilia></srv:numeroFamilia>
                               <!--Optional:-->
                               <srv:identificacionAfiliado>
                                  <!--Optional:-->
                                  <per:numIdentificacion></per:numIdentificacion>
                                  <!--Optional:-->
                                  <per:tipoIdentificacion></per:tipoIdentificacion>
                                  <!--Optional:-->
                                  <per:descTipoIdentificacion></per:descTipoIdentificacion>
                               </srv:identificacionAfiliado>
                            </srv:Contrato>
                            <!--Zero or more repetitions:-->
                            <srv:PrestacionMedicamento>
                               <!--Optional:-->
                               <srv:codPrestacionMedicamentoOSI></srv:codPrestacionMedicamentoOSI>
                               <srv:cantidadPrestacionMedicamentoOSI></srv:cantidadPrestacionMedicamentoOSI>
                            </srv:PrestacionMedicamento>
                            <!--Optional:-->
                            <srv:nomPrestacionMedicamentoOSI>FRACTURA DE FEMUR</srv:nomPrestacionMedicamentoOSI>
                            <!--Optional:-->
                            <srv:PrestPracticaRemitente>
                               <!--Optional:-->
                               <srv:codSucursalRemitente></srv:codSucursalRemitente>
                               <!--Optional:-->
                               <srv:codSucursalPractica></srv:codSucursalPractica>
                            </srv:PrestPracticaRemitente>
                            <!--Optional:-->
                            <srv:CTC>
                               <!--Optional:-->
                               <srv:indConsultaNOPOS></srv:indConsultaNOPOS>
                               <!--Optional:-->
                               <srv:codDiagnostico></srv:codDiagnostico>
                            </srv:CTC>
                            <!--Optional:-->
                            <srv:codTipoAtencion></srv:codTipoAtencion>
                            <!--Optional:-->
                            <srv:fecConvenio></srv:fecConvenio>
                            <!--Optional:-->
                            <srv:indVisibleAutorizaciones></srv:indVisibleAutorizaciones>
                         </srv:ConsultarServicio>
                      </pres:consultarServicioEnt>
                   </pres:ConsultarServicioEnt>
                </soapenv:Body>
               </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/Prestaciones/ConsultarServicio",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        curl_close($ch);

        // converting
        $response1 = str_replace("<soap:Body>", "", $response);
        $response2 = str_replace("</soap:Body>", "", $response1);
        // convertingc to XML
        $parser = simplexml_load_string($response, 'JsonSerializer');

        return $response;
    }

    private function getActualDate($app, $params_error_report, $nameController, $chat_id)
    {
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d\TH:i:s');
        $date2 = '{
                    "fechaConsulta": "' . $date . '",
                    "fechaAtencion": "' . $date . '"
                }';
        return $date2;

    }

    private function validateContractDate($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "validateContractDate()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $url = $urlIn . 'assurance/affiliations/affiliationsAndNewsManagements/contract/v1.0.0/cover';
        $token = $this->getTokenWs($app, false);
        $tipoId = substr($tipoId, 0, 2);
        $tipoId = strtoupper($tipoId);
        $numId = strtoupper($numId);
        $request = '{
                    "subject": {
                    "identifier": [
                        {
                        "type": "TIPO_IDENTIFICACION",
                        "value": "' . $tipoId . '"
                        },
                        {
                        "type": "NUMERO_IDENTIFICACION",
                        "value": "' . $numId . '"
                        }
                    ]
                    },
                    "coverage": {
                    "insurancePlan": {
                        "type": "CODIGO_PRODUCTO",
                        "value": ""
                    },
                    "contract": [
                        {
                        "type": "PLAN",
                        "value": null
                        },
                        {
                        "type": "CONTRATO",
                        "value": null
                        },
                        {
                        "type": "FAMILIA",
                        "value": null
                        }
                    ]
                    },
                    "swFamily": true,
                    "lastValid": false,
                    "planType": ""
                } ';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $longitud = count($response_object->coverFamilyResponse);

        $lista_fecha_final = array();

        $i = 0;

        $response = new \stdClass();

        for ($i == 0; $i < $longitud; $i++) {
            $fecha_final = $response_object->coverFamilyResponse[$i]->contract->applies->end;
            date_default_timezone_set('America/Bogota');
            $date = date('Y-m-d\Th:i:s');

            if ($date <= $fecha_final) {
                $value_contract = "1";
                break;
            } else {
                $value_contract = "0";
            }
        }

        $value = '{
                    "validContract": "' . $value_contract . '"
                }';

        return $value;

    }

    private function grabarAtencionAuth($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "grabarAtencionAuth()";
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $descripcion_servicio = $_POST['descripcion'];
        $numero_solicitud = $_POST['numeroSolicitud'];
        $tipo_volante = $_POST['tipoVolante'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $valor_unitario = $_POST['valorUnitario'];
        $sesiones = $_POST['sesiones'];
        $existe_valor = $_POST['existeValorConvenio'];
        $codigo_origen_autorizacion = $_POST['codigoOrigenAutorizacion'];
        $valor_convenio = $_POST['valorConvenio'];
        $codigo_diagnostico = $_POST['codigoDiagnostico'];
        $observaciones = $_POST['observaciones'];

        $codigo_pin = $_POST['codigoPin'];
        $valor_pago_pin = $_POST['valorPago'];
        $categoria_pin = $_POST['categoria'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }
        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }
        if (!$categoria_pin) {
            $categoria_pin = "";
        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };

        $nombre_usuario_separado = explode('.', $nombre_usuario);
        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }
        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }

        $token = $this->getTokenWs($app, false);
        $request = '
                {
                    "usuario":{
                       "tipoDocumento":"' . $tipo_documento . '",
                       "numeroDocumento":"' . $num_documento . '",
                       "edad":' . $edad . ',
                       "fechaNacimiento":"' . $fecha_nacimiento . '",
                       "genero":"' . $genero . '",
                       "primerNombre":"' . $primer_nombre . '",
                       "segundoNombre":"' . $segundo_nombre . '",
                       "primerApellido":"' . $primer_apellido . '",
                       ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
                       "segundoApellido":"' . $segundo_apellido . '"
                    },
                    "contrato":{
                       "compania":' . $compania . ',
                       "plan":' . $plan . ',
                       "contrato":' . $contrato . ',
                       "familia":' . $familia . ',
                       "numeroUsuario":' . $numero_usuario . ',
                       "estadoContrato":' . $estado_contrato . '
                    },
                    "prestador":{
                       "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
                       "numeroDocumento":"' . $num_id_prestador . '",
                       "tipoDocumento":"' . $tipo_id_prestador . '",
                       "especialidad":"' . $especialidad . '",
                       "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
                       "codigoSucursal":"' . $cod_sucursal . '",
                       "ciudad":"' . $ciudad . '"
                    },
                        "servicios": [
                            {
                                "codigo":"' . $codigo_servicio . '",
                                "descripcion":"' . $descripcion_servicio . '",
                                "numeroSolicitud":"' . $numero_solicitud . '",
                                "tipoVolante": "' . $tipo_volante . '",
                                "tipoAtencion":"' . $tipo_atencion . '",
                                "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                                "fechaVencimiento": "' . $fecha_vencimiento . '",
                                "observaciones" : "' . $observaciones . '",
                                "estado":' . $estado_servicio . ',
                                "valor": ' . $valor_servicio . ',
                                "uvr": ' . $uvr . ',
                                "viaIngreso": "' . $via_ingreso . '",
                                "valorUnitario":' . $valor_unitario . ' ,
                                "sesiones": ' . $sesiones . ',
                                "existeValorConvenio": "' . $existe_valor . '",
                                "codigoDiagnostico": "' . $codigo_diagnostico . '",
                                "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                                "valorConvenio": ' . $valor_convenio . '
                            }
                        ],
                    "pines": [
                        {
                            "codigoPin": "' . $codigo_pin . '",
                            "valorPago": ' . $valor_pago_pin . ',
                            "categoria": "' . $categoria_pin . '"
                        }
                    ],
                    "idTipoPago":' . $id_tipo_pago . ',
                    "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
                    ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
                    "valorPago":' . $valor_pago . ',
                    "fechaConsulta": "' . $fecha_consulta . '",
                    "fechaAtencion": "' . $fecha_atencion . '",
                    ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
                    "canal": "' . $canal . '"
                 }';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 30);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $response = '{
                    "NumRa" : "' . $response_object . '"
                }';

        return $response;

    }

    private function grabarAtencionAuthV2($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "grabarAtencionAuthV2()";
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $descripcion_servicio = $_POST['descripcion'];
        $numero_solicitud = $_POST['numeroSolicitud'];
        $tipo_volante = $_POST['tipoVolante'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $valor_unitario = $_POST['valorUnitario'];
        $sesiones = $_POST['sesiones'];
        $existe_valor = $_POST['existeValorConvenio'];
        $codigo_origen_autorizacion = $_POST['codigoOrigenAutorizacion'];
        $valor_convenio = $_POST['valorConvenio'];
        $codigo_diagnostico = $_POST['codigoDiagnostico'];
        $observaciones = $_POST['observaciones'];

        $codigo_pin = $_POST['codigoPin'];
        $valor_pago_pin = $_POST['valorPago'];
        $categoria_pin = $_POST['categoria'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }
        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }
        if (!$categoria_pin) {
            $categoria_pin = "";
        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };

        $nombre_usuario_separado = explode('.', $nombre_usuario);
        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }

        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }

        if ($id_tipo_pago == 3 || $id_tipo_pago == "3") {
            $codigo_pin = "0";
            $valor_pago_pin = 0;
            $categoria_pin = "";
            $valor_pago = 0;
        }

        $space_position = strpos($codigo_servicio, '-');

        if ($space_position) {
            $servicios = "";
            $codigoServicioArray = explode("-", $codigo_servicio);
            $descripcionServicioArray = explode("-", $descripcion_servicio);
            $uvrArray = explode("-", $uvr);
            $sesionesArray = explode("-", $sesiones);
            $valorDelServicioArray = explode("-", $valor_servicio);
            $contador = count($codigoServicioArray);

            for ($i = 0; $i < $contador; $i++) {
                $valor_convenio = $this->localAgreementValue($app, $params_error_report, $nameController, $chat_id, 1, $compania, $plan, $codigoServicioArray[$i], $tipo_atencion, $cod_sucursal, "");
                if ($i < ($contador - 1)) {
                    if ($compania == 30 || $compania == 31) {
                        $existe_valor = "null";

                    } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
                        $existe_valor = "N";
                    } else {
                        $existe_valor = "S";
                    }

                    $servicios = $servicios . '
        {
            "codigo":"' . $codigoServicioArray[$i] . '",
            "descripcion":"' . $descripcionServicioArray[$i] . '",
            "numeroSolicitud":"' . $numero_solicitud . '",
            "tipoVolante": "' . $tipo_volante . '",
            "tipoAtencion":"' . $tipo_atencion . '",
            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
            "fechaVencimiento":"' . $fecha_vencimiento . '",
            "observaciones":"' . $observaciones . '",
            "estado":' . $estado_servicio . ',
            "valor": ' . $valorDelServicioArray[$i] . ',
            "uvr": ' . $uvrArray[$i] . ',
            "viaIngreso": "' . $via_ingreso . '",
            "valorUnitario": ' . $valor_unitario . ',
            "sesiones": ' . $sesionesArray[$i] . ',
            "existeValorConvenio": "' . $existe_valor . '",
            "codigoDiagnostico":"' . $codigo_diagnostico . '",
            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
            "valorConvenio": ' . $valor_convenio . '
            },
            ';
                } else {
                    if ($compania == 30 || $compania == 31) {
                        $existe_valor = "null";

                    } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
                        $existe_valor = "N";
                    } else {
                        $existe_valor = "S";
                    }
                    $servicios = $servicios . '
                        {
                            "codigo":"' . $codigoServicioArray[$i] . '",
                            "descripcion":"' . $descripcionServicioArray[$i] . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valorDelServicioArray[$i] . ',
                            "uvr": ' . $uvrArray[$i] . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesionesArray[$i] . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                            }
                            ';
                }
            }
        } else {
            $servicios = '
                        {
                            "codigo":"' . $codigo_servicio . '",
                            "descripcion":"' . $descripcion_servicio . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valor_servicio . ',
                            "uvr": ' . $uvr . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesiones . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                        }
                    ';
        }

        // $token = $this->getTokenWs($app, false);
        $token = $this->getTokenWsV2($app, false);
        $token = (json_decode($token)->access_token);
        $request = '
                {
                    "usuario":{
                       "tipoDocumento":"' . $tipo_documento . '",
                       "numeroDocumento":"' . $num_documento . '",
                       "edad":' . $edad . ',
                       "fechaNacimiento":"' . $fecha_nacimiento . '",
                       "genero":"' . $genero . '",
                       "primerNombre":"' . $primer_nombre . '",
                       "segundoNombre":"' . $segundo_nombre . '",
                       "primerApellido":"' . $primer_apellido . '",
                       ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
                       "segundoApellido":"' . $segundo_apellido . '"
                    },
                    "contrato":{
                       "compania":' . $compania . ',
                       "plan":' . $plan . ',
                       "contrato":' . $contrato . ',
                       "familia":' . $familia . ',
                       "numeroUsuario":' . $numero_usuario . ',
                       "estadoContrato":' . $estado_contrato . '
                    },
                    "prestador":{
                       "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
                       "numeroDocumento":"' . $num_id_prestador . '",
                       "tipoDocumento":"' . $tipo_id_prestador . '",
                       "especialidad":"' . $especialidad . '",
                       "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
                       "codigoSucursal":"' . $cod_sucursal . '",
                       "ciudad":"' . $ciudad . '"
                    },
                        "servicios": [
                    ' . $servicios . '
                    ],
                    "pines": [
                        {
                            "codigoPin": "' . $codigo_pin . '",
                            "valorPago": ' . $valor_pago_pin . ',
                            "categoria": "' . $categoria_pin . '"
                        }
                    ],
                    "idTipoPago":' . $id_tipo_pago . ',
                    "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
                    ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
                    "valorPago":' . $valor_pago . ',
                    "fechaConsulta": "' . $fecha_consulta . '",
                    "fechaAtencion": "' . $fecha_atencion . '",
                    ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
                    "canal": "' . $canal . '"
                 }';

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "paisNacimiento" => $paisNacimiento,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,

            "nombre_prestador" => $nombre_prestador,
            "nombrePrestadoresDelegados" => $nombrePrestadoresDelegados,
            "apellidoPrestadoresDelegados" => $apellidoPrestadoresDelegados,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,

            "codigo_servicio" => $codigo_servicio,
            "descripcion_servicio" => $descripcion_servicio,
            "numero_solicitud" => $numero_solicitud,
            "tipo_volante" => $tipo_volante,
            "tipo_atencion" => $tipo_atencion,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "valor_unitario" => $valor_unitario,
            "sesiones" => $sesiones,
            "existe_valor" => $existe_valor,
            "codigo_diagnostico" => $codigo_diagnostico,
            "codigo_origen_autorizacion" => $codigo_origen_autorizacion,
            "valor_convenio" => $valor_convenio,
            "observaciones" => $observaciones,

            "codigo_pin" => $codigo_pin,
            "valor_pago_pin" => $valor_pago_pin,
            "categoria_pin" => $categoria_pin,

            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "id_tipo_excepcion_new" => $id_tipo_excepcion_new,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "rips" => $rips,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 30);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            return;
        }

        $response = '{
                    "NumRa" : "' . $response_object . '"
                }';

        return $response;

    }

    private function grabarAtencionAuthNoPin($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "grabarAtencionAuthNoPin()";
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $descripcion_servicio = $_POST['descripcion'];
        $numero_solicitud = $_POST['numeroSolicitud'];
        $tipo_volante = $_POST['tipoVolante'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $valor_unitario = $_POST['valorUnitario'];
        $sesiones = $_POST['sesiones'];
        $existe_valor = $_POST['existeValorConvenio'];
        $codigo_diagnostico = $_POST['codigoDiagnostico'];
        $codigo_origen_autorizacion = $_POST['codigoOrigenAutorizacion'];
        $valor_convenio = $_POST['valorConvenio'];
        $observaciones = $_POST['observaciones'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }

        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };
        $nombre_usuario_separado = explode('.', $nombre_usuario);
        $token = $this->getTokenWs($app, false);
        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }
        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }

        $request = '
                {
                    "usuario":{
                       "tipoDocumento":"' . $tipo_documento . '",
                       "numeroDocumento":"' . $num_documento . '",
                       "edad":' . $edad . ',
                       "fechaNacimiento":"' . $fecha_nacimiento . '",
                       "genero":"' . $genero . '",
                       "primerNombre":"' . $primer_nombre . '",
                       "segundoNombre":"' . $segundo_nombre . '",
                       "primerApellido":"' . $primer_apellido . '",
                       ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
                       "segundoApellido":"' . $segundo_apellido . '"
                    },
                    "contrato":{
                       "compania":' . $compania . ',
                       "plan":' . $plan . ',
                       "contrato":' . $contrato . ',
                       "familia":' . $familia . ',
                       "numeroUsuario":' . $numero_usuario . ',
                       "estadoContrato":' . $estado_contrato . '
                    },
                    "prestador":{
                       "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
                       "numeroDocumento":"' . $num_id_prestador . '",
                       "tipoDocumento":"' . $tipo_id_prestador . '",
                       "especialidad":"' . $especialidad . '",
                       "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
                       "codigoSucursal":"' . $cod_sucursal . '",
                       "ciudad":"' . $ciudad . '"
                    },
                    "servicios": [
                        {
                            "codigo":"' . $codigo_servicio . '",
                            "descripcion":"' . $descripcion_servicio . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valor_servicio . ',
                            "uvr": ' . $uvr . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesiones . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                        }
                    ],
                    "idTipoPago":' . $id_tipo_pago . ',
                    "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
                    ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
                    "valorPago":' . $valor_pago . ',
                    "fechaConsulta": "' . $fecha_consulta . '",
                    "fechaAtencion": "' . $fecha_atencion . '",
                    ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
                    "canal": "' . $canal . '"
                 }';

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,
            "nombre_prestador" => $nombre_prestador,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,
            "codigo_servicio" => $codigo_servicio,
            "descripcion_servicio" => $descripcion_servicio,
            "numero_solicitud" => $numero_solicitud,
            "tipo_volante" => $tipo_volante,
            "tipo_atencion" => $tipo_atencion,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "valor_unitario" => $valor_unitario,
            "sesiones" => $sesiones,
            "existe_valor" => $existe_valor,
            "codigo_diagnostico" => $codigo_diagnostico,
            "codigo_origen_autorizacion" => $codigo_origen_autorizacion,
            "valor_convenio" => $valor_convenio,
            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $response = '{
                    "NumRa" : "' . $response_object . '"
                }';

        return $response;

    }

    private function grabarAtencionAuthNoPinV2($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/guardar';
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "grabarAtencionAuthNoPinV2()";
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_documento = substr($tipo_documento, 0, 2);
        $tipo_documento = strtoupper($tipo_documento);
        $num_documento = $_POST['numeroDocumento'];
        $edad = $_POST['edad'];
        $fecha_nacimiento = $_POST['fechaNacimiento'];
        $genero = $_POST['genero'];
        $primer_nombre = $_POST['primerNombre'];
        $segundo_nombre = $_POST['segundoNombre'];
        $primer_apellido = $_POST['primerApellido'];
        $segundo_apellido = $_POST['segundoApellido'];
        $paisNacimiento = $_POST['paisNacimiento'];

        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $contrato = $_POST['contrato'];
        $familia = $_POST['familia'];
        $numero_usuario = $_POST['numeroUsuario'];
        $estado_contrato = $_POST['estadoContrato'];

        $nombre_prestador = $_POST['nombrePrestador'];
        $nombrePrestadoresDelegados = $_POST['nombrePrestadoresDelegados'];
        $apellidoPrestadoresDelegados = $_POST['apellidoPrestadoresDelegados'];
        $num_id_prestador = $_POST['numeroDocumentoPrestador'];
        $tipo_id_prestador = $_POST['tipoDocumentoPrestador'];
        $especialidad = $_POST['especialidad'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $cod_sucursal = $_POST['codigoSucursal'];
        $ciudad = $_POST['ciudad'];

        $codigo_servicio = $_POST['codigo'];
        $descripcion_servicio = $_POST['descripcion'];
        $numero_solicitud = $_POST['numeroSolicitud'];
        $tipo_volante = $_POST['tipoVolante'];
        $tipo_atencion = $_POST['tipoAtencion'];
        $fecha_expedicion = $_POST['fechaExpedicionRadicacion'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $estado_servicio = $_POST['estado'];
        $valor_servicio = $_POST['valor'];
        $uvr = $_POST['uvr'];
        $via_ingreso = $_POST['viaIngreso'];
        $valor_unitario = $_POST['valorUnitario'];
        $sesiones = $_POST['sesiones'];
        $existe_valor = $_POST['existeValorConvenio'];
        $codigo_diagnostico = $_POST['codigoDiagnostico'];
        $codigo_origen_autorizacion = $_POST['codigoOrigenAutorizacion'];
        $valor_convenio = $_POST['valorConvenio'];
        $observaciones = $_POST['observaciones'];

        $id_tipo_pago = $_POST['idTipoPago'];
        $descripcion_tipo_pago = $_POST['descripcionTipoPago'];
        $id_tipo_excepcion_new = $_POST['idTipoExcepcionNew'];
        $valor_pago = $_POST['valorPago'];
        $fecha_consulta = $_POST['fechaConsulta'];
        $fecha_atencion = $_POST['fechaAtencion'];
        $canal = $_POST['canal'];
        $rips = $_POST['rips'];

        switch ($id_tipo_excepcion_new) {
            case "PyP":
                $id_tipo_excepcion_new = 1;
                break;
            case "Tutela":
                $id_tipo_excepcion_new = 4;
                break;
            case "cuotaModeradora":
                $id_tipo_excepcion_new = 5;
                break;
            case "urgencias":
                $id_tipo_excepcion_new = 6;
                break;
            default:
                $id_tipo_excepcion_new = false;
        }

        switch ($categoria_pin) {
            case "NA":
                $categoria_pin = "";
                break;
            default:
                $categoria_pin = $categoria_pin;

        }

        switch ($estado_contrato) {
            case "ACTIVO":
                $estado_contrato = "1";
                break;
            case "CANCELADO":
                $estado_contrato = "1";
                break;
            case "LIQUIDADO":
                $estado_contrato = "1";
                break;
            default:
                $estado_contrato = "N/A";
        };

        switch ($tipo_documento) {
            case "CC":
                $tipo_documento = "1";
                break;
            case "CE":
                $tipo_documento = "2";
                break;
            case "MS":
                $tipo_documento = "3";
                break;
            case "NIT":
                $tipo_documento = "4";
                break;
            case "NIP":
                $tipo_documento = "5";
                break;
            case "PA":
                $tipo_documento = "6";
                break;
            case "RC":
                $tipo_documento = "7";
                break;
            case "TI":
                $tipo_documento = "8";
                break;
            case "CD":
                $tipo_documento = "9";
                break;
            case "CN":
                $tipo_documento = "10";
                break;
            case "SC":
                $tipo_documento = "11";
                break;
            case "PD":
                $tipo_documento = "12";
                break;
            case "PE":
                $tipo_documento = "13";
                break;
            case "PT":
                $tipo_documento = "15";
                break;
            default:
                $tipo_documento = $tipo_documento;
                break;
        };
        $nombre_usuario_separado = explode('.', $nombre_usuario);
        $token = $this->getTokenWs($app, false);
        if (!$valor_convenio) {
            $valor_convenio = 0;
        }
        if (!$valor_unitario) {
            $valor_unitario = 1;
        }
        if (!$valor_servicio) {
            $valor_servicio = "null";
        }

        if ($compania == 30 || $compania == 31) {
            $existe_valor = "null";

        } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
            $existe_valor = "N";
        } else {
            $existe_valor = "S";
        }

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "paisNacimiento" => $paisNacimiento,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,

            "nombre_prestador" => $nombre_prestador,
            "nombrePrestadoresDelegados" => $nombrePrestadoresDelegados,
            "apellidoPrestadoresDelegados" => $apellidoPrestadoresDelegados,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,

            "codigo_servicio" => $codigo_servicio,
            "descripcion_servicio" => $descripcion_servicio,
            "numero_solicitud" => $numero_solicitud,
            "tipo_volante" => $tipo_volante,
            "tipo_atencion" => $tipo_atencion,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "valor_unitario" => $valor_unitario,
            "sesiones" => $sesiones,
            "existe_valor" => $existe_valor,
            "codigo_diagnostico" => $codigo_diagnostico,
            "codigo_origen_autorizacion" => $codigo_origen_autorizacion,
            "valor_convenio" => $valor_convenio,
            "observaciones" => $observaciones,

            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "id_tipo_excepcion_new" => $id_tipo_excepcion_new,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "rips" => $rips,
            "token" => $token,
            "url" => $url,
        );

        $space_position = strpos($codigo_servicio, '-');

        if ($space_position) {
            $servicios = "";
            $codigoServicioArray = explode("-", $codigo_servicio);
            $descripcionServicioArray = explode("-", $descripcion_servicio);
            $uvrArray = explode("-", $uvr);
            $sesionesArray = explode("-", $sesiones);
            $valorDelServicioArray = explode("-", $valor_servicio);
            $contador = count($codigoServicioArray);

            for ($i = 0; $i < $contador; $i++) {
                $valor_convenio = $this->localAgreementValue($app, $params_error_report, $nameController, $chat_id, 1, $compania, $plan, $codigoServicioArray[$i], $tipo_atencion, $cod_sucursal, "");
                if ($i < ($contador - 1)) {
                    if ($compania == 30 || $compania == 31) {
                        $existe_valor = "null";

                    } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
                        $existe_valor = "N";
                    } else {
                        $existe_valor = "S";
                    }
                    $servicios = $servicios . '
        {
            "codigo":"' . $codigoServicioArray[$i] . '",
            "descripcion":"' . $descripcionServicioArray[$i] . '",
            "numeroSolicitud":"' . $numero_solicitud . '",
            "tipoVolante": "' . $tipo_volante . '",
            "tipoAtencion":"' . $tipo_atencion . '",
            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
            "fechaVencimiento":"' . $fecha_vencimiento . '",
            "observaciones":"' . $observaciones . '",
            "estado":' . $estado_servicio . ',
            "valor": ' . $valorDelServicioArray[$i] . ',
            "uvr": ' . $uvrArray[$i] . ',
            "viaIngreso": "' . $via_ingreso . '",
            "valorUnitario": ' . $valor_unitario . ',
            "sesiones": ' . $sesionesArray[$i] . ',
            "existeValorConvenio": "' . $existe_valor . '",
            "codigoDiagnostico":"' . $codigo_diagnostico . '",
            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
            "valorConvenio": ' . $valor_convenio . '
            },
            ';
                } else {
                    if ($compania == 30 || $compania == 31) {
                        $existe_valor = "null";

                    } elseif ($valor_convenio == "null" || $valor_convenio == "0" || $valor_convenio == 0) {
                        $existe_valor = "N";
                    } else {
                        $existe_valor = "S";
                    }
                    $servicios = $servicios . '
                        {
                            "codigo":"' . $codigoServicioArray[$i] . '",
                            "descripcion":"' . $descripcionServicioArray[$i] . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valorDelServicioArray[$i] . ',
                            "uvr": ' . $uvrArray[$i] . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesionesArray[$i] . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                            }
                            ';
                }
            }
        } else {
            $servicios = '
                        {
                            "codigo":"' . $codigo_servicio . '",
                            "descripcion":"' . $descripcion_servicio . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valor_servicio . ',
                            "uvr": ' . $uvr . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesiones . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                        }
                    ';
        }

        $request = '
                {
                    "usuario":{
                       "tipoDocumento":"' . $tipo_documento . '",
                       "numeroDocumento":"' . $num_documento . '",
                       "edad":' . $edad . ',
                       "fechaNacimiento":"' . $fecha_nacimiento . '",
                       "genero":"' . $genero . '",
                       "primerNombre":"' . $primer_nombre . '",
                       "segundoNombre":"' . $segundo_nombre . '",
                       "primerApellido":"' . $primer_apellido . '",
                       ' . ($rips == 1 ? '"paisNacimiento" : "' . $paisNacimiento . '",' : false) . '
                       "segundoApellido":"' . $segundo_apellido . '"
                    },
                    "contrato":{
                       "compania":' . $compania . ',
                       "plan":' . $plan . ',
                       "contrato":' . $contrato . ',
                       "familia":' . $familia . ',
                       "numeroUsuario":' . $numero_usuario . ',
                       "estadoContrato":' . $estado_contrato . '
                    },
                    "prestador":{
                       "nombrePrestador":"' . $cod_sucursal . "-" . $nombre_prestador . '",
                       "numeroDocumento":"' . $num_id_prestador . '",
                       "tipoDocumento":"' . $tipo_id_prestador . '",
                       "especialidad":"' . $especialidad . '",
                       "nombreUsuario":"' . $nombre_usuario_separado[0] . "_" . $nombrePrestadoresDelegados . " " . $apellidoPrestadoresDelegados . '",
                       "codigoSucursal":"' . $cod_sucursal . '",
                       "ciudad":"' . $ciudad . '"
                    },
                    "servicios": [
                    ' . $servicios . '
                    ],
                    "idTipoPago":' . $id_tipo_pago . ',
                    "descripcionTipoPago":"' . $descripcion_tipo_pago . '",
                    ' . ($id_tipo_excepcion_new ? '"idTipoExcepcion" : ' . $id_tipo_excepcion_new . ',' : false) . '
                    "valorPago":' . $valor_pago . ',
                    "fechaConsulta": "' . $fecha_consulta . '",
                    "fechaAtencion": "' . $fecha_atencion . '",
                    ' . ($rips == 1 ? '"generarRIPS" : ' . true . ',' : false) . '
                    "canal": "' . $canal . '"
                 }';

        $datos = array(
            "tipo_documento" => $tipo_documento,
            "num_documento" => $num_documento,
            "edad" => $edad,
            "fecha_nacimiento" => $fecha_nacimiento,
            "genero" => $genero,
            "primer_nombre" => $primer_nombre,
            "segundo_nombre" => $segundo_nombre,
            "primer_apellido" => $primer_apellido,
            "segundo_apellido" => $segundo_apellido,
            "compania" => $compania,
            "plan" => $plan,
            "contrato" => $contrato,
            "familia" => $familia,
            "numero_usuario" => $numero_usuario,
            "estado_contrato" => $estado_contrato,
            "nombre_prestador" => $nombre_prestador,
            "num_id_prestador" => $num_id_prestador,
            "tipo_id_prestador" => $tipo_id_prestador,
            "especialidad" => $especialidad,
            "nombre_usuario" => $nombre_usuario,
            "cod_sucursal" => $cod_sucursal,
            "ciudad" => $ciudad,
            "codigo_servicio" => $codigo_servicio,
            "descripcion_servicio" => $descripcion_servicio,
            "numero_solicitud" => $numero_solicitud,
            "tipo_volante" => $tipo_volante,
            "tipo_atencion" => $tipo_atencion,
            "fecha_expedicion" => $fecha_expedicion,
            "fecha_vencimiento" => $fecha_vencimiento,
            "estado_servicio" => $estado_servicio,
            "valor_servicio" => $valor_servicio,
            "uvr" => $uvr,
            "via_ingreso" => $via_ingreso,
            "valor_unitario" => $valor_unitario,
            "sesiones" => $sesiones,
            "existe_valor" => $existe_valor,
            "codigo_diagnostico" => $codigo_diagnostico,
            "codigo_origen_autorizacion" => $codigo_origen_autorizacion,
            "valor_convenio" => $valor_convenio,
            "id_tipo_pago" => $id_tipo_pago,
            "descripcion_tipo_pago" => $descripcion_tipo_pago,
            "valor_pago" => $valor_pago,
            "fecha_consulta" => $fecha_consulta,
            "fecha_atencion" => $fecha_atencion,
            "canal" => $canal,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $response = '{
                    "NumRa" : "' . $response_object . '"
                }';

        return $response;

    }

    private function CuadroMedico($app, $params_error_report, $nameController, $chat_id)
    {
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint"; // asmx URL of WSDL
        }

        $soapUser = "username"; //  username
        $soapPassword = "password"; // password
        $nameFunction = "cuadroMedico()";
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $numIdentificacion = $_POST['numeroIdentidad'];
        $tipoIdentificacion = $_POST['tipoIdentidad'];
        $numContrato = $_POST['numeroContrato'];
        $tipoConsulta = $_POST['tipoConsulta'];

        switch ($tipoIdentificacion) {
            case "1":
                $tipoIdentificacion = "CC";
                break;
            case "2":
                $tipoIdentificacion = "CE";
                break;
            case "3":
                $tipoIdentificacion = "MS";
                break;
            case "4":
                $tipoIdentificacion = "NI";
                break;
            case "5":
                $tipoIdentificacion = "NIP";
                break;
            case "6":
                $tipoIdentificacion = "PA";
                break;
            case "7":
                $tipoIdentificacion = "RC";
                break;
            case "8":
                $tipoIdentificacion = "TI";
                break;
            case "9":
                $tipoIdentificacion = "CD";
                break;
            case "10":
                $tipoIdentificacion = "CN";
                break;
            case "11":
                $tipoIdentificacion = "SC";
                break;
            case "12":
                $tipoIdentificacion = "PD";
                break;
            case "13":
                $tipoIdentificacion = "PE";
                break;
            case "15":
                $tipoIdentificacion = "PT";
                break;
            default:
                $tipoIdentificacion = $tipoIdentificacion;
                break;
        };
        //xml post structure

        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/PrestadoresServicio/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona" xmlns:pres1="http://colsanitas.com/osi/comun/prestadores" xmlns:ubic="http://colsanitas.com/osi/comun/ubicacion">
        <soapenv:Header>
               <pres:HeaderRqust>
                      <!--Optional:-->
                      <pres:header>
                             <!--Optional:-->
                             <nof:messageHeader>
                                <!--Optional:-->
                                <!--Optional:-->
                                <nof:messageInfo>
                                       <!--Optional:-->
                                       <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                                </nof:messageInfo>
                                <!--Optional:-->
                             </nof:messageHeader>
                             <!--Optional:-->
                             <nof:user>
                                <!--Optional:-->
                                <nof:userName></nof:userName>
                                <!--Optional:-->
                                <nof:userToken></nof:userToken>
                             </nof:user>
                      </pres:header>
               </pres:HeaderRqust>
        </soapenv:Header>
        <soapenv:Body>
               <pres:CuadroMedicoEnt>
                      <!--Optional:-->
                      <pres:cuadroMedicoEnt>
                             <!--Optional:-->
                             <srv:CuadroMedico>
                                <!--Optional:-->
                                <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                                <!--Optional:-->
                                <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                                <!--Optional:-->
                                <srv:identificacionPrestador>
                                       <!--Optional:-->
                                       <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                                       <!--Optional:-->
                                       <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                                       <!--Optional:-->
                                       <per:descTipoIdentificacion></per:descTipoIdentificacion>
                                </srv:identificacionPrestador>
                                <!--Optional:-->
                                <srv:nombrePrestador></srv:nombrePrestador>
                                <!--Optional:-->
                                <srv:nombreSede></srv:nombreSede>
                                <!--Optional:-->
                                <srv:codSucursalPrestador></srv:codSucursalPrestador>
                                <!--Optional:-->
                                <srv:nomSucursalPrestador></srv:nomSucursalPrestador>
                                <!--Optional:-->
                                <srv:codRegionalSucursal></srv:codRegionalSucursal>
                                <!--Optional:-->
                                <srv:fechaInicioConsultaVigencia></srv:fechaInicioConsultaVigencia>
                                <!--Optional:-->
                                <srv:fechaFinConsultaVigencia></srv:fechaFinConsultaVigencia>
                                <!--Optional:-->
                                <srv:ciudad></srv:ciudad>
                                <!--Optional:-->
                                <srv:codGrupoCuadroMedico></srv:codGrupoCuadroMedico>
                                <!--Zero or more repetitions:-->
                                <srv:ServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:codServicioCuadroMedico></pres1:codServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:nombreServicioCuadroMedico></pres1:nombreServicioCuadroMedico>
                                       <!--Optional:-->
                                       <pres1:direccionCompleta></pres1:direccionCompleta>
                                       <!--Optional:-->
                                       <pres1:latitud></pres1:latitud>
                                       <!--Optional:-->
                                       <pres1:longitud></pres1:longitud>
                                       <!--Optional:-->
                                       <pres1:nivel></pres1:nivel>
                                       <!--Zero or more repetitions:-->
                                       <pres1:telefono>
                                              <!--Optional:-->
                                              <ubic:codigo>0</ubic:codigo>
                                              <!--Optional:-->
                                              <ubic:numero></ubic:numero>
                                              <!--Optional:-->
                                              <ubic:ext></ubic:ext>
                                              <!--Optional:-->
                                              <ubic:indicativo>
                                                     <!--Optional:-->
                                                     <ubic:indicativoPais></ubic:indicativoPais>
                                                     <!--Optional:-->
                                                     <ubic:codigoArea></ubic:codigoArea>
                                              </ubic:indicativo>
                                       </pres1:telefono>
                                </srv:ServicioCuadroMedico>
                                <!--Optional:-->
                                <srv:longitudMin></srv:longitudMin>
                                <!--Optional:-->
                                <srv:longitudMax></srv:longitudMax>
                                <!--Optional:-->
                                <srv:latitudMin></srv:latitudMin>
                                <!--Optional:-->
                                <srv:latitudMax></srv:latitudMax>
                                <!--Optional:-->
                                <srv:numContrato>' . $numContrato . '</srv:numContrato>
                             </srv:CuadroMedico>
                      </pres:cuadroMedicoEnt>
               </pres:CuadroMedicoEnt>
        </soapenv:Body>
     </soapenv:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXML);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestadores/CuadroMedico"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);

        $parametros = array(
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "numIdentificacion" => $numIdentificacion,
            "tipoIdentificacion" => $tipoIdentificacion,
            "numContrato" => $numContrato,
            "tipoConsulta" => $tipoConsulta,
            "url" => $soapUrl,
        );
        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");

        $response1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response);
        $response2 = str_replace("<s:Header>", "<Header>", $response1);
        $response3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">',
            '<HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $response2);
        $response4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $response3);
        $response5 = str_replace('</s:Header>', '</Header>', $response4);
        $response6 = str_replace('<s:Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">',
            '<Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $response5);
        $response7 = str_replace('</s:Body>', '</Body>', $response6);
        $response8 = str_replace('</s:Envelope>', '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);

        $status = $parser->Header->HeaderRspns->header->responseStatus->businessException->errorDetails->errorCode;

        $var = '{
                        "convenioPlan": "' . $status . '"
                    }';

        return $var;
    }

    public function validarContratos($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "validarContratos()";
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $url = $urlIn . 'assurance/affiliations/affiliationsAndNewsManagements/contract/v1.0.0/cover';
        $token = $this->getTokenWs($app, false);
        $tipoId = substr($tipoId, 0, 2);
        $tipoId = strtoupper($tipoId);
        $numId = strtoupper($numId);
        $request = '{
                    "subject": {
                      "identifier": [
                        {
                          "type": "TIPO_IDENTIFICACION",
                          "value": "' . $tipoId . '"
                        },
                        {
                          "type": "NUMERO_IDENTIFICACION",
                          "value": "' . $numId . '"
                        }
                      ]
                    },
                    "coverage": {
                      "insurancePlan": {
                        "type": "CODIGO_PRODUCTO",
                        "value": "10"
                      },
                      "contract": [
                        {
                          "type": "PLAN",
                          "value": null
                        },
                        {
                          "type": "CONTRATO",
                          "value": null
                        },
                        {
                          "type": "FAMILIA",
                          "value": null
                        }
                      ]
                    },
                    "swFamily": true,
                    "lastValid": false,
                    "planType": ""
                  } ';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $longitud = count($response_object->coverFamilyResponse);

        $lista_opciones = array();
        $i = 0;

        $response = new \stdClass();

        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d\Th:i:s');

        for ($i == 0; $i < $longitud; $i++) {
            $cod_producto = $response_object->coverFamilyResponse[$i]->insurancePlan->identifier[0]->value;
            $nombre_contrato = $response_object->coverFamilyResponse[$i]->contract->identifier[3]->value;
            $numero_contrato = $response_object->coverFamilyResponse[$i]->contract->identifier[1]->value;
            $familia = $response_object->coverFamilyResponse[$i]->contract->identifier[2]->value;
            $fecha_final = $response_object->coverFamilyResponse[$i]->contract->applies->end;
            $user = $response_object->coverFamilyResponse[$i]->contract->subject->patient[0]->identifier[2]->value;
            if ($cod_producto != 30) {
                if ($date > $fecha_final) {

                    $estado = "No Habilitado";
                    $opcion = '-' . $nombre_contrato . ' - Contrato ' . $numero_contrato . ' - Familia ' . $familia . ' ' . $estado;
                    array_push($lista_opciones, $opcion);
                }
            }
        }

        $salida = implode('\n', $lista_opciones);

        if ($salida == null) {
            $estado = 1;
        } else {
            $estado = 0;
        }

        $var = '{
                    "salidaArreglo":"' . $salida . '",
                    "estadoContratos" : ' . $estado . '
                }';

        return $var;

    }

    public function verificarContratoHabilitado($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameFunction = "verificarContratoHabilitado()";
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipoId = $_POST['tipoIdentificacion'];
        $numId = $_POST['numeroIdentificacion'];
        $numeroAutorizacion = $_POST['numeroAutorizacion'];
        $url = $urlIn . 'assurance/affiliations/affiliationsAndNewsManagements/contract/v1.0.0/cover';
        $token = $this->getTokenWs($app, false);
        // $tipoId = substr($tipoId,0,2);
        // $tipoId = strtoupper($tipoId);
        $request = '{
                    "subject": {
                      "identifier": [
                        {
                          "type": "TIPO_IDENTIFICACION",
                          "value": "' . $tipoId . '"
                        },
                        {
                          "type": "NUMERO_IDENTIFICACION",
                          "value": "' . $numId . '"
                        }
                      ]
                    },
                    "coverage": {
                      "insurancePlan": {
                        "type": "CODIGO_PRODUCTO",
                        "value": ""
                      },
                      "contract": [
                        {
                          "type": "PLAN",
                          "value": null
                        },
                        {
                          "type": "CONTRATO",
                          "value": "' . $numeroAutorizacion . '"
                        },
                        {
                          "type": "FAMILIA",
                          "value": null
                        }
                      ]
                    },
                    "swFamily": true,
                    "lastValid": false,
                    "planType": ""
                  } ';

        $datos = array(
            "tipoId" => $tipoId,
            "numId" => $numId,
            "numeroAutorizacion" => $numeroAutorizacion,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $longitud = count($response_object->coverFamilyResponse);

        $lista_opciones = array();
        $i = 0;

        $response = new \stdClass();

        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d\Th:i:s');

        for ($i == 0; $i < $longitud; $i++) {

            $nombre_contrato = $response_object->coverFamilyResponse[$i]->contract->identifier[3]->value;
            $numero_contrato = $response_object->coverFamilyResponse[$i]->contract->identifier[1]->value;
            $familia = $response_object->coverFamilyResponse[$i]->contract->identifier[2]->value;
            $fecha_final = $response_object->coverFamilyResponse[$i]->contract->applies->end;
            $user = $response_object->coverFamilyResponse[$i]->contract->subject->patient[0]->identifier[2]->value;
            $estadoDelContrato = $response_object->coverFamilyResponse[$i]->contract->status;

            if ($date > $fecha_final) {
                return '{
                            "vigenciaContrato":"0"
                        }';

                // $estado = "No Habilitado";
                // $opcion = $nombre_contrato.' - '.$numero_contrato.' - '.$familia.' - '.$estado;
            }
            if ($estadoDelContrato == 'LIQUIDADO') {
                return '{
                            "statusContrato":"1"
                        }';
            } else {
                return '{
                            "statusContrato":"0"
                        }';
            }
        }

    }

    public function getDataRA($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $nameFunction = "getDataRA()";
        $codRegistro = $_POST['registroNumero'];
        $url = $urlIn . 'registroatencion-service/V1.0.0/RegistroAtencion/consultaRegistroAtencion';
        $token = $this->getTokenWs($app, false);
        $request = '{
                    "numRefRegistroAtencion": "' . $codRegistro . '"
                }';

        $datos = array(
            "codRegistro" => $codRegistro,
            "token" => $token,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $numero_id = $response_object->infoPrestador->infoAtencion[0]->numIdentUsuario;
        $tipo_id = $response_object->infoPrestador->infoAtencion[0]->tipoIdentUsuario;
        $codigo_producto = $response_object->infoPrestador->infoAtencion[0]->codProducto;
        $codigo_plan = $response_object->infoPrestador->infoAtencion[0]->codPlan;
        $prestador = $response_object->infoPrestador->nitPrest;

        $var = '{
                    "numeroIdentidad" : "' . $numero_id . '",
                    "tipoIdentidad" : "' . $tipo_id . '",
                    "codigoProductoVale" : "' . $codigo_producto . '",
                    "codigoPlanVale" : "' . $codigo_plan . '",
                    "nitPrestadorVale" : "' . $prestador . '"
                }';

        return $var;

    }

    public function consultarPrecio($app, $params_error_report, $nameController, $chat_id)
    {

        $nameFunction = "consultarPrecio()";
        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $codigoCompania = $_POST['codigoCompania'];
        $codigoPlan = $_POST['codigoPlan'];
        $numeroContrato = $_POST['numeroContrato'];
        $numeroFlia = $_POST['numeroFlia'];
        $Documento = $_POST['Documento'];
        $TipoDocumento = $_POST['TipoDocumento'];
        $codCiudad = $_POST['codCiudad'];
        $cantidad = $_POST['cantidad'];
        $categoria = $_POST['categoria'];

        switch ($TipoDocumento) {
            case "CC":
                $TipoDocumento = "1";
                break;
            case "CE":
                $TipoDocumento = "2";
                break;
            case "MS":
                $TipoDocumento = "3";
                break;
            case "NIT":
                $TipoDocumento = "4";
                break;
            case "NIP":
                $TipoDocumento = "5";
                break;
            case "PA":
                $TipoDocumento = "6";
                break;
            case "RC":
                $TipoDocumento = "7";
                break;
            case "TI":
                $TipoDocumento = "8";
                break;
            case "CD":
                $TipoDocumento = "09";
                break;
            case "CN":
                $TipoDocumento = "10";
                break;
            case "SC":
                $TipoDocumento = "11";
                break;
            case "PD":
                $TipoDocumento = "12";
                break;
            case "PE":
                $TipoDocumento = "13";
                break;
            case "PT":
                $TipoDocumento = "15";
                break;
            default:
                $TipoDocumento = $TipoDocumento;
                break;
        };

        if (strlen($TipoDocumento) == 1) {
            $TipoDocumento = str_pad($TipoDocumento, 2, '0', STR_PAD_LEFT);
        }

        if (!$categoria) {
            $categoria = "";
        }

        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        $datos = array(
            "userName" => $userName,
            "userToken" => $userToken,
            "codigoCompania" => $codigoCompania,
            "codigoPlan" => $codigoPlan,
            "numeroContrato" => $numeroContrato,
            "numeroFlia" => $numeroFlia,
            "Documento" => $Documento,
            "TipoDocumento" => $TipoDocumento,
            "codCiudad" => $codCiudad,
            "cantidad" => $cantidad,
            "categoria" => $categoria,
            "url" => $soapUrl,
        );
        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ges="http://www.colsanitas.com/GestionPines/" xmlns:com="http://www.colsanitas.com/schema/osi/comun" xmlns:srv="http://www.colsanitas.com/schema/osi/srv">
        <soapenv:Header>
           <ges:HeaderRqust>
              <header>
                   <com:user>
                    <!--Optional:-->
                    <com:userName>' . $userName . '</com:userName>
                    <!--Optional:-->
                    <com:userToken>' . $userToken . '</com:userToken>
                 </com:user>
              </header>
           </ges:HeaderRqust>
        </soapenv:Header>
        <soapenv:Body>
           <ges:ConsultaPrecioEnt>
              <precio>
                 <srv:consulta>
                    <srv:codigoCompania>' . $codigoCompania . '</srv:codigoCompania>
                    <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                    <srv:numeroContrato>' . $numeroContrato . '</srv:numeroContrato>
                 </srv:consulta>
                 <srv:numeroFamilia>' . $numeroFlia . '</srv:numeroFamilia>
                 <srv:documento>
                    <com:Documento>' . $Documento . '</com:Documento>
                    <com:TipoDocumento>' . $TipoDocumento . '</com:TipoDocumento>
                 </srv:documento>
                 <srv:codCiudad>' . $codCiudad . '</srv:codCiudad>
                 <!--Optional:-->
                 <srv:categoria>' . $categoria . '</srv:categoria>
                 <srv:cantidad>' . $cantidad . '</srv:cantidad>
              </precio>
           </ges:ConsultaPrecioEnt>
        </soapenv:Body>
     </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/GestionPines/ConsultarPrecio",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response1 = str_replace('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', $response);
        $response2 = str_replace("<soapenv:Body>", "<Body>", $response1);
        $response3 = str_replace('<ns4:ConsultaPrecioSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">',
            '<ConsultaPrecioSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">', $response2);
        $response4 = str_replace('<ns1:valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response3);
        $response5 = str_replace('</ns1:valorTotal>', '</valorTotal>', $response4);
        $response6 = str_replace('<ns1:valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response5);
        $response7 = str_replace('</ns1:valorIVA>', '</valorIVA>', $response6);

        $response8 = str_replace('<ns2:valorBase xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<valorBase xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response7);
        $response9 = str_replace('</ns2:valorBase>', '</valorBase>', $response8);
        $response10 = str_replace('<ns2:descuento xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<descuento xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response9);
        $response11 = str_replace('</ns2:descuento>', '</descuento>', $response10);
        $response12 = str_replace('<ns2:requierePin xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<requierePin xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response11);
        $response13 = str_replace('</ns2:requierePin>', '</requierePin>', $response12);
        $response14 = str_replace('</ns4:ConsultaPrecioSal>', '</ConsultaPrecioSal>', $response13);
        $response15 = str_replace('</soapenv:Body>', '</Body>', $response14);
        $response16 = str_replace('</soapenv:Envelope>', '</Envelope>', $response15);

        $parser = simplexml_load_string($response16);
        $response = json_encode($parser);
        $response = json_decode($response);
        $this->createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST");

        return '{
            "valorTotal":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
            "valorTotalRedBonoCero":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
            "valorIVA":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorIVA . '",
            "valorBase":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->valorBase . '",
            "descuento":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->descuento . '",
            "requierePin":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->requierePin . '"
        }';
    }

    public function valesDiferenciales($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "valesDiferenciales()";
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $contrato = $_POST['contrato'];
        $tipoIdPrestador = $_POST['tipoIdPrestador'];
        $numIdPrestador = $_POST['numIdPrestador'];
        $sucursal = $_POST['sucursal'];
        $ciudad = $_POST['ciudad'];
        $codigoTipoAtencion = $_POST['codigoTipoAtencion'];
        $SERVICIO = $_POST['SERVICIO'];
        $prestacion = $_POST['prestacion'];
        $token = $this->getTokenWs($app, false);

        if (substr($ciudad, 0, 1) === "0") {
            $ciudad = ltrim($ciudad, "0");
        }

        switch ($codigoTipoAtencion) {
            case "AMBULATORIO":
                $codigoTipoAtencion = "1";
                break;
            case "AMBULATORIA":
                $codigoTipoAtencion = "1";
                break;
            case "HOSPITALIZACION":
                $codigoTipoAtencion = "2";
                break;
            case "URGENCIAS":
                $codigoTipoAtencion = "3";
                break;
            case "DOMICILIO":
                $codigoTipoAtencion = "4";
                break;
            case "DOMICILIARIA":
                $codigoTipoAtencion = "4";
                break;
            default:
                $codigoTipoAtencion = $codigoTipoAtencion;
                break;

        }

        switch ($tipoIdPrestador) {
            case "1":
                $tipoIdPrestador = "CC";
                break;
            case "2":
                $tipoIdPrestador = "CE";
                break;
            case "3":
                $tipoIdPrestador = "MS";
                break;
            case "4":
                $tipoIdPrestador = "NIT";
                break;
            case "5":
                $tipoIdPrestador = "NIP";
                break;
            case "6":
                $tipoIdPrestador = "PA";
                break;
            case "7":
                $tipoIdPrestador = "RC";
                break;
            case "8":
                $tipoIdPrestador = "TI";
                break;
            case "9":
                $tipoIdPrestador = "CD";
                break;
            case "10":
                $tipoIdPrestador = "CN";
                break;
            case "11":
                $tipoIdPrestador = "SC";
                break;
            case "12":
                $tipoIdPrestador = "PD";
                break;
            case "13":
                $tipoIdPrestador = "PE";
                break;
            case "15":
                $tipoIdPrestador = "PT";
                break;
            default:
                $tipoIdPrestador = $tipoIdPrestador;
                break;
        };

        $url = $urlIn . "administracionRecursosFinancieros/recaudo/categoriaValesDiferenciales/v1.0.0/prestacion";

        $request = '{
            "codigoProducto": ' . $codigoProducto . ',
            "codigoPlan": ' . $codigoPlan . ',
            "contrato": ' . $contrato . ',
            "tipoIdPrestador": "' . $tipoIdPrestador . '",
            "numIdPrestador": "' . $numIdPrestador . '",
            "sucursal": ' . $sucursal . ',
            "ciudad": ' . $ciudad . ',
            "codigoTipoAtencion": ' . $codigoTipoAtencion . ',
            "SERVICIO": ' . $SERVICIO . ',
            "prestacion": "' . $prestacion . '"
          }';

        $datos = array(
            "codigoTipoAtencion" => $codigoTipoAtencion,
            "tipoIdPrestador" => $tipoIdPrestador,
            "numIdPrestador" => $numIdPrestador,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "contrato" => $contrato,
            "sucursal" => $codigoPlan,
            "ciudad" => $ciudad,
            "SERVICIO" => $SERVICIO,
            "prestacion" => $prestacion,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
        if ($response_object->configuracionValeDieferencial->codError) {
            return '{
                "errorValeDiferencial" : "1"
            }';
        }
        if ($response_object->configuracionValeDieferencial->categoria) {
            return '{
                "categoria" : "' . $response_object->configuracionValeDieferencial->categoria . '"
            }';
        }

        return json_encode($response_object);
    }

    public function consultarPin($app, $params_error_report, $nameController, $chat_id)
    {

        $nameFunction = "consultarPin()";
        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $codigoCompania = $_POST['codigoCompania'];
        $codigoPlan = $_POST['codigoPlan'];
        $numeroContrato = $_POST['numeroContrato'];
        $numeroFlia = $_POST['numeroFlia'];
        $numeroPin = $_POST['numeroPin'];
        $categoria = $_POST['categoria'];

        if (!$categoria) {
            $categoria = "";
        }
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        $datos = array(
            "userName" => $userName,
            "userToken" => $userToken,
            "codigoCompania" => $codigoCompania,
            "codigoPlan" => $codigoPlan,
            "numeroContrato" => $numeroContrato,
            "numeroPin" => $numeroPin,
            "categoria" => $categoria,
            "url" => $soapUrl,
        );
        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ges="http://www.colsanitas.com/GestionPines/" xmlns:com="http://www.colsanitas.com/schema/osi/comun" xmlns:srv="http://www.colsanitas.com/schema/osi/srv">
   <soapenv:Header>
      <ges:HeaderRqust>
         <header>
            <!--Optional:-->
            <com:messageHeader>
               <!--Optional:-->
               <com:messageKey>
                  <!--Optional:-->
                  <com:correlationId></com:correlationId>
                  <com:requestVersion></com:requestVersion>
                  <com:requestUUID></com:requestUUID>
               </com:messageKey>
               <!--Optional:-->
               <com:messageInfo>
                  <com:timeZone></com:timeZone>
                  <com:dateTime></com:dateTime>
                  <!--Optional:-->
                  <com:systemId></com:systemId>
               </com:messageInfo>
               <!--Optional:-->
               <com:trace>
                  <!--Optional:-->
                  <com:processId></com:processId>
                  <!--Optional:-->
                  <com:integrationId></com:integrationId>
                  <!--Optional:-->
                  <com:tracingId></com:tracingId>
               </com:trace>
            </com:messageHeader>
            <com:user>
               <com:userName>' . $userName . '</com:userName>
               <com:userToken>' . $userToken . '</com:userToken>
            </com:user>
         </header>
      </ges:HeaderRqust>
   </soapenv:Header>
   <soapenv:Body>
      <ges:ConsultaPinEnt>
         <consulta>
            <srv:consulta>
               <srv:codigoCompania>' . $codigoCompania . '</srv:codigoCompania>
               <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
               <srv:numeroContrato>' . $numeroContrato . '</srv:numeroContrato>
            </srv:consulta>
            <srv:numeroFlia>' . $numeroFlia . '</srv:numeroFlia>
            <srv:numeroPin>' . $numeroPin . '</srv:numeroPin>
            <!--Optional:-->
            <srv:categoria>' . $categoria . '</srv:categoria>
         </consulta>
      </ges:ConsultaPinEnt>
   </soapenv:Body>
</soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/GestionPines/ConsultarPin",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response1 = str_replace('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', $response);
        $response2 = str_replace("<soapenv:Body>", "<Body>", $response1);
        $response3 = str_replace('<ns4:ConsultaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">',
            '<ConsultaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">', $response2);
        $response4 = str_replace('<ns1:codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response3);
        $response5 = str_replace('</ns1:codPin>', '</codPin>', $response4);
        $response6 = str_replace('<ns1:fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response5);
        $response7 = str_replace('</ns1:fechaAsignacion>', '</fechaAsignacion>', $response6);
        $response8 = str_replace('<ns1:fechaUtilizacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUtilizacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response7);
        $response9 = str_replace('</ns1:fechaUtilizacion>', '</fechaUtilizacion>', $response8);
        $response10 = str_replace('<ns1:fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response9);
        $response11 = str_replace('</ns1:fechaUltimoEstado>', '</fechaUltimoEstado>', $response10);
        $response12 = str_replace('<ns2:codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response11);
        $response13 = str_replace('</ns2:codigo>', '</codigo>', $response12);
        $response14 = str_replace('<ns2:descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', '<descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response13);
        $response15 = str_replace('<ns1:familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response14);
        $response16 = str_replace('</ns1:familia>', '</familia>', $response15);
        $response17 = str_replace('<ns1:categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response16);
        $response18 = str_replace('</ns1:categoria>', '</categoria>', $response17);
        $response19 = str_replace('<ns1:estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response18);
        $response20 = str_replace('</ns1:estacion>', '</estacion>', $response19);
        $response21 = str_replace('<ns1:numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response20);
        $response22 = str_replace('</ns1:numeroTransaccion>', '</numeroTransaccion>', $response21);
        $response23 = str_replace('<ns1:valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response22);
        $response24 = str_replace('</ns1:valorTotal>', '</valorTotal>', $response23);
        $response25 = str_replace('<ns1:valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response24);
        $response26 = str_replace('</ns1:valorIVA>', '</valorIVA>', $response25);
        $response27 = str_replace('</ns4:ConsultaPinSal>', '</ConsultaPinSal>', $response26);
        $response28 = str_replace('</soapenv:Body>', '</Body>', $response27);
        $response29 = str_replace('</soapenv:Envelope>', '</Envelope>', $response28);
        $response30 = str_replace('</ns2:descripcion>', '</descripcion>', $response29);

        $parser = simplexml_load_string($response30);
        $response = json_encode($parser);
        $response = json_decode($response);
        $this->createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST");

        return json_encode($response);
        // '{
        //     "valorTotal":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
        //     "valorTotalRedBonoCero":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
        //     "valorIVA":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorIVA . '",
        //     "valorBase":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->valorBase . '",
        //     "descuento":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->descuento . '",
        //     "requierePin":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->requierePin . '"
        // }';
    }

    public function consultarPinPruebaProduccion($app, $params_error_report, $nameController, $chat_id)
    {

        $nameFunction = "consultarPin()";
        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $codigoCompania = $_POST['codigoCompania'];
        $codigoPlan = $_POST['codigoPlan'];
        $numeroContrato = $_POST['numeroContrato'];
        $numeroFlia = $_POST['numeroFlia'];
        $numeroPin = $_POST['numeroPin'];
        $categoria = $_POST['categoria'];

        if (!$categoria) {
            $categoria = "";
        }

        $soapUrl = "https://services01.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        $datos = array(
            "userName" => $userName,
            "userToken" => $userToken,
            "codigoCompania" => $codigoCompania,
            "codigoPlan" => $codigoPlan,
            "numeroContrato" => $numeroContrato,
            "numeroPin" => $numeroPin,
            "categoria" => $categoria,
            "url" => $soapUrl,
        );
        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ges="http://www.colsanitas.com/GestionPines/" xmlns:com="http://www.colsanitas.com/schema/osi/comun" xmlns:srv="http://www.colsanitas.com/schema/osi/srv">
   <soapenv:Header>
      <ges:HeaderRqust>
         <header>
            <!--Optional:-->
            <com:messageHeader>
               <!--Optional:-->
               <com:messageKey>
                  <!--Optional:-->
                  <com:correlationId></com:correlationId>
                  <com:requestVersion></com:requestVersion>
                  <com:requestUUID></com:requestUUID>
               </com:messageKey>
               <!--Optional:-->
               <com:messageInfo>
                  <com:timeZone></com:timeZone>
                  <com:dateTime></com:dateTime>
                  <!--Optional:-->
                  <com:systemId></com:systemId>
               </com:messageInfo>
               <!--Optional:-->
               <com:trace>
                  <!--Optional:-->
                  <com:processId></com:processId>
                  <!--Optional:-->
                  <com:integrationId></com:integrationId>
                  <!--Optional:-->
                  <com:tracingId></com:tracingId>
               </com:trace>
            </com:messageHeader>
            <com:user>
               <com:userName>' . $userName . '</com:userName>
               <com:userToken>' . $userToken . '</com:userToken>
            </com:user>
         </header>
      </ges:HeaderRqust>
   </soapenv:Header>
   <soapenv:Body>
      <ges:ConsultaPinEnt>
         <consulta>
            <srv:consulta>
               <srv:codigoCompania>' . $codigoCompania . '</srv:codigoCompania>
               <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
               <srv:numeroContrato>' . $numeroContrato . '</srv:numeroContrato>
            </srv:consulta>
            <srv:numeroFlia>' . $numeroFlia . '</srv:numeroFlia>
            <srv:numeroPin>' . $numeroPin . '</srv:numeroPin>
            <!--Optional:-->
            <srv:categoria>' . $categoria . '</srv:categoria>
         </consulta>
      </ges:ConsultaPinEnt>
   </soapenv:Body>
</soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/GestionPines/ConsultarPin",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response1 = str_replace('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', $response);
        $response2 = str_replace("<soapenv:Body>", "<Body>", $response1);
        $response3 = str_replace('<ns4:ConsultaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">',
            '<ConsultaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">', $response2);
        $response4 = str_replace('<ns1:codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response3);
        $response5 = str_replace('</ns1:codPin>', '</codPin>', $response4);
        $response6 = str_replace('<ns1:fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response5);
        $response7 = str_replace('</ns1:fechaAsignacion>', '</fechaAsignacion>', $response6);
        $response8 = str_replace('<ns1:fechaUtilizacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUtilizacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response7);
        $response9 = str_replace('</ns1:fechaUtilizacion>', '</fechaUtilizacion>', $response8);
        $response10 = str_replace('<ns1:fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response9);
        $response11 = str_replace('</ns1:fechaUltimoEstado>', '</fechaUltimoEstado>', $response10);
        $response12 = str_replace('<ns2:codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response11);
        $response13 = str_replace('</ns2:codigo>', '</codigo>', $response12);
        $response14 = str_replace('<ns2:descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', '<descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response13);
        $response15 = str_replace('<ns1:familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response14);
        $response16 = str_replace('</ns1:familia>', '</familia>', $response15);
        $response17 = str_replace('<ns1:categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response16);
        $response18 = str_replace('</ns1:categoria>', '</categoria>', $response17);
        $response19 = str_replace('<ns1:estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response18);
        $response20 = str_replace('</ns1:estacion>', '</estacion>', $response19);
        $response21 = str_replace('<ns1:numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response20);
        $response22 = str_replace('</ns1:numeroTransaccion>', '</numeroTransaccion>', $response21);
        $response23 = str_replace('<ns1:valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response22);
        $response24 = str_replace('</ns1:valorTotal>', '</valorTotal>', $response23);
        $response25 = str_replace('<ns1:valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response24);
        $response26 = str_replace('</ns1:valorIVA>', '</valorIVA>', $response25);
        $response27 = str_replace('</ns4:ConsultaPinSal>', '</ConsultaPinSal>', $response26);
        $response28 = str_replace('</soapenv:Body>', '</Body>', $response27);
        $response29 = str_replace('</soapenv:Envelope>', '</Envelope>', $response28);
        $response30 = str_replace('</ns2:descripcion>', '</descripcion>', $response29);

        $parser = simplexml_load_string($response30);
        $response = json_encode($parser);
        $response = json_decode($response);
        $this->createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST");

        return json_encode($response);
        // '{
        //     "valorTotal":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
        //     "valorTotalRedBonoCero":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
        //     "valorIVA":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorIVA . '",
        //     "valorBase":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->valorBase . '",
        //     "descuento":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->descuento . '",
        //     "requierePin":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->requierePin . '"
        // }';
    }

    public function localConsultarPin($app, $params_error_report, $nameController, $chat_id, $userName, $userToken, $codigoCompania, $codigoPlan, $numeroContrato, $numeroFlia, $numeroPin, $categoria)
    {

        if (!$categoria) {
            $categoria = "";
        }
        $nameFunction = 'localConsultarPin()';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        $datos = array(
            "userName" => $userName,
            "userToken" => $userToken,
            "codigoCompania" => $codigoCompania,
            "codigoPlan" => $codigoPlan,
            "numeroContrato" => $numeroContrato,
            "numeroPin" => $numeroPin,
            "categoria" => $categoria,
            "url" => $soapUrl,
        );
        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ges="http://www.colsanitas.com/GestionPines/" xmlns:com="http://www.colsanitas.com/schema/osi/comun" xmlns:srv="http://www.colsanitas.com/schema/osi/srv">
   <soapenv:Header>
      <ges:HeaderRqust>
         <header>
            <!--Optional:-->
            <com:messageHeader>
               <!--Optional:-->
               <com:messageKey>
                  <!--Optional:-->
                  <com:correlationId></com:correlationId>
                  <com:requestVersion></com:requestVersion>
                  <com:requestUUID></com:requestUUID>
               </com:messageKey>
               <!--Optional:-->
               <com:messageInfo>
                  <com:timeZone></com:timeZone>
                  <com:dateTime></com:dateTime>
                  <!--Optional:-->
                  <com:systemId></com:systemId>
               </com:messageInfo>
               <!--Optional:-->
               <com:trace>
                  <!--Optional:-->
                  <com:processId></com:processId>
                  <!--Optional:-->
                  <com:integrationId></com:integrationId>
                  <!--Optional:-->
                  <com:tracingId></com:tracingId>
               </com:trace>
            </com:messageHeader>
            <com:user>
               <com:userName>' . $userName . '</com:userName>
               <com:userToken>' . $userToken . '</com:userToken>
            </com:user>
         </header>
      </ges:HeaderRqust>
   </soapenv:Header>
   <soapenv:Body>
      <ges:ConsultaPinEnt>
         <consulta>
            <srv:consulta>
               <srv:codigoCompania>' . $codigoCompania . '</srv:codigoCompania>
               <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
               <srv:numeroContrato>' . $numeroContrato . '</srv:numeroContrato>
            </srv:consulta>
            <srv:numeroFlia>' . $numeroFlia . '</srv:numeroFlia>
            <srv:numeroPin>' . $numeroPin . '</srv:numeroPin>
            <!--Optional:-->
            <srv:categoria>' . $categoria . '</srv:categoria>
         </consulta>
      </ges:ConsultaPinEnt>
   </soapenv:Body>
</soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/GestionPines/ConsultarPin",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response1 = str_replace('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', $response);
        $response2 = str_replace("<soapenv:Body>", "<Body>", $response1);
        $response3 = str_replace('<ns4:ConsultaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">',
            '<ConsultaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">', $response2);
        $response4 = str_replace('<ns1:codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response3);
        $response5 = str_replace('</ns1:codPin>', '</codPin>', $response4);
        $response6 = str_replace('<ns1:fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response5);
        $response7 = str_replace('</ns1:fechaAsignacion>', '</fechaAsignacion>', $response6);
        $response8 = str_replace('<ns1:fechaUtilizacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUtilizacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response7);
        $response9 = str_replace('</ns1:fechaUtilizacion>', '</fechaUtilizacion>', $response8);
        $response10 = str_replace('<ns1:fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response9);
        $response11 = str_replace('</ns1:fechaUltimoEstado>', '</fechaUltimoEstado>', $response10);
        $response12 = str_replace('<ns2:codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response11);
        $response13 = str_replace('</ns2:codigo>', '</codigo>', $response12);
        $response14 = str_replace('<ns2:descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', '<descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response13);
        $response15 = str_replace('<ns1:familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response14);
        $response16 = str_replace('</ns1:familia>', '</familia>', $response15);
        $response17 = str_replace('<ns1:categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response16);
        $response18 = str_replace('</ns1:categoria>', '</categoria>', $response17);
        $response19 = str_replace('<ns1:estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response18);
        $response20 = str_replace('</ns1:estacion>', '</estacion>', $response19);
        $response21 = str_replace('<ns1:numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response20);
        $response22 = str_replace('</ns1:numeroTransaccion>', '</numeroTransaccion>', $response21);
        $response23 = str_replace('<ns1:valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response22);
        $response24 = str_replace('</ns1:valorTotal>', '</valorTotal>', $response23);
        $response25 = str_replace('<ns1:valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', '<valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response24);
        $response26 = str_replace('</ns1:valorIVA>', '</valorIVA>', $response25);
        $response27 = str_replace('</ns4:ConsultaPinSal>', '</ConsultaPinSal>', $response26);
        $response28 = str_replace('</soapenv:Body>', '</Body>', $response27);
        $response29 = str_replace('</soapenv:Envelope>', '</Envelope>', $response28);
        $response30 = str_replace('</ns2:descripcion>', '</descripcion>', $response29);

        $parser = simplexml_load_string($response30);
        $response = json_encode($parser);
        $response = json_decode($response);
        $this->createLog($response, $xml_post_string, $chat_id, $nameFunction, "POST");

        return count($response->Body->ConsultaPinSal);

        // '{
        //     "valorTotal":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
        //     "valorTotalRedBonoCero":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorTotal . '",
        //     "valorIVA":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->precio->valorIVA . '",
        //     "valorBase":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->valorBase . '",
        //     "descuento":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->descuento . '",
        //     "requierePin":"' . $response->Body->ConsultaPrecioSal->precioSal->precio->requierePin . '"
        // }';
    }

    public function puertaDeEntrada($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "puertaDeEntrada()";
        $prestacion = $_POST['prestacion'];
        $token = $this->getTokenWs($app, false);

        $url = $urlIn . "cuentaMedicavirtual-parametros-service/V1.0.0/Parametros/existeParamPuertaEntrada";

        $request = '[
            {
            "key": "codServicio' . $prestacion . '",
            "value": "' . $prestacion . '"
        }
        ]';

        $datos = array(
            "prestacion" => $prestacion,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return '{
                "puertaEntrada" : "' . $response_object->value . '"
            }';

    }

    public function reglasDelDia($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {
        $nameFunction = "reglasDelDia()";
        $company = $_POST['company'];
        $plan = $_POST['plan'];
        $contract = $_POST['contract'];
        $provider = $_POST['provider'];
        $service = $_POST['service'];
        $typeId = $_POST['typeId'];
        $numberId = $_POST['numberId'];
        $attentionDate = $_POST['attentionDate'];
        $authorized = $_POST['authorized'];
        $serviceName = $_POST['serviceName'];
        $token = $this->getTokenWs($app, false);

        if ($authorized == "False") {
            $authorized = "false";
        }
        if ($authorized == "True") {
            $authorized = "true";
        }

        if (!$attentionDate) {
            date_default_timezone_set('America/Bogota');
            $attentionDate = date('d/m/Y');
        } else {
            $attentionDate = strtotime($attentionDate);
            $attentionDate = date('d/m/Y', $attentionDate);
        }

        $url = $urlIn . "assurance/providersAgreements/medicalAccount/userValidate/rulesDay/v1.0.0/ruleDay/evaluate";

        switch ($typeId) {
            case "1":
                $typeId = "CC";
                break;
            case "2":
                $typeId = "CE";
                break;
            case "3":
                $typeId = "MS";
                break;
            case "4":
                $typeId = "NIT";
                break;
            case "5":
                $typeId = "NIP";
                break;
            case "6":
                $typeId = "PA";
                break;
            case "7":
                $typeId = "RC";
                break;
            case "8":
                $typeId = "TI";
                break;
            case "9":
                $typeId = "CD";
                break;
            case "10":
                $typeId = "CN";
                break;
            case "11":
                $typeId = "SC";
                break;
            case "12":
                $typeId = "PD";
                break;
            case "13":
                $typeId = "PE";
                break;
            case "15":
                $typeId = "PT";
                break;
            default:
                $typeId = $typeId;
                break;
        };

        $request = '{
            "company": ' . $company . ',
            "plan": ' . $plan . ',
            "contract": ' . $contract . ',
            "provider": ' . $provider . ',
            "service": "' . $service . '",
            "typeId": "' . $typeId . '",
            "numberId": "' . $numberId . '",
            "attentionDate": "' . $attentionDate . '",
            "authorized": ' . $authorized . ',
            "serviceName": "' . $serviceName . '"
          }';

        $datos = array(
            "company" => $company,
            "plan" => $plan,
            "contract" => $contract,
            "provider" => $provider,
            "service" => $service,
            "typeId" => $typeId,
            "numberId" => $numberId,
            "attentionDate" => $attentionDate,
            "authorized" => $authorized,
            "serviceName" => $serviceName,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos, 30);
        // \App\Utils\StaticExecuteService::createLog($response_object, $request, $chat_id, $nameFunction, "POST", "Prestadores", $headers, $datos);
        // $this->createLog( $response_object,$request,$chat_id,$nameFunction,"POST");

        if ($response_object == false) {
            http_response_code(500);
            return;
        }

        if ($response_object->provide == true) {
            return '{
                "provide": "1"
            }';
        } else {
            return '{
                "provide": "0"
            }';
        }
    }

    public function asignarPin($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "asignarPin()";
        $userName = $_POST['userName'];
        $userToken = $_POST['userToken'];
        $codigoCompania = $_POST['codigoCompania'];
        $codigoPlan = $_POST['codigoPlan'];
        $numeroContrato = $_POST['numeroContrato'];
        $numeroFlia = $_POST['numeroFlia'];
        $Documento = $_POST['Documento'];
        $TipoDocumento = $_POST['TipoDocumento'];
        $ciudad = $_POST['ciudad'];
        $cantidad = $_POST['cantidad'];
        $valorTrx = $_POST['valorTrx'];
        $estacion = $_POST['estacion'];
        $numTrxCanal = $_POST['numTrxCanal'];
        $categoria = $_POST['categoria'];

        if (!$categoria) {
            $categoria = "";
        }

        switch ($TipoDocumento) {
            case "CC":
                $TipoDocumento = "1";
                break;
            case "CE":
                $TipoDocumento = "2";
                break;
            case "MS":
                $TipoDocumento = "3";
                break;
            case "NIT":
                $TipoDocumento = "4";
                break;
            case "NIP":
                $TipoDocumento = "5";
                break;
            case "PA":
                $TipoDocumento = "6";
                break;
            case "RC":
                $TipoDocumento = "7";
                break;
            case "TI":
                $TipoDocumento = "8";
                break;
            case "CD":
                $TipoDocumento = "09";
                break;
            case "CN":
                $TipoDocumento = "10";
                break;
            case "SC":
                $TipoDocumento = "11";
                break;
            case "PD":
                $TipoDocumento = "12";
                break;
            case "PE":
                $TipoDocumento = "13";
                break;
            case "PT":
                $TipoDocumento = "15";
                break;
            default:
                $TipoDocumento = $TipoDocumento;
                break;
        };

        if (strlen($TipoDocumento) == 1) {
            $TipoDocumento = str_pad($TipoDocumento, 2, '0', STR_PAD_LEFT);
        }
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/GestionPines.GestionPinesHttpSoap11Endpoint"; // asmx URL of WSDL
        }
        $soapUser = "username"; //  username
        $soapPassword = "password"; // password

        // xml post structure

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ges="http://www.colsanitas.com/GestionPines/" xmlns:com="http://www.colsanitas.com/schema/osi/comun" xmlns:srv="http://www.colsanitas.com/schema/osi/srv">
        <soapenv:Header>
           <ges:HeaderRqust>
              <header>
                 <!--Optional:-->
                 <com:messageHeader>
                    <!--Optional:-->
                    <com:messageKey>
                       <!--Optional:-->
                       <com:correlationId></com:correlationId>
                       <com:requestVersion></com:requestVersion>
                       <com:requestUUID></com:requestUUID>
                    </com:messageKey>
                    <!--Optional:-->
                    <com:messageInfo>
                       <com:timeZone></com:timeZone>
                       <com:dateTime></com:dateTime>
                       <!--Optional:-->
                       <com:systemId></com:systemId>
                    </com:messageInfo>
                    <!--Optional:-->
                    <com:trace>
                       <!--Optional:-->
                       <com:processId></com:processId>
                       <!--Optional:-->
                       <com:integrationId></com:integrationId>
                       <!--Optional:-->
                       <com:tracingId></com:tracingId>
                    </com:trace>
                 </com:messageHeader>
                 <com:user>
                    <com:userName>' . $userName . '</com:userName>
                    <com:userToken>' . $userToken . '</com:userToken>
                 </com:user>
              </header>
           </ges:HeaderRqust>
        </soapenv:Header>
        <soapenv:Body>
           <ges:AsignaPinEnt>
              <asigna>
                 <srv:consulta>
                    <srv:codigoCompania>' . $codigoCompania . '</srv:codigoCompania>
                    <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                    <srv:numeroContrato>' . $numeroContrato . '</srv:numeroContrato>
                 </srv:consulta>
                 <srv:numeroFamilia>' . $numeroFlia . '</srv:numeroFamilia>
                 <srv:documento>
                    <com:Documento>' . $Documento . '</com:Documento>
                    <com:TipoDocumento>' . $TipoDocumento . '</com:TipoDocumento>
                 </srv:documento>
                 <srv:ciudadVenta>' . $ciudad . '</srv:ciudadVenta>
                 <srv:cantidad>' . $cantidad . '</srv:cantidad>
                 <!--Optional:-->
                 <srv:valorTrx>' . $valorTrx . '</srv:valorTrx>
                 <srv:estacion>' . $estacion . '</srv:estacion>
                 <srv:numTrxCanal>' . $numTrxCanal . '</srv:numTrxCanal>
                 <srv:categoria>' . $categoria . '</srv:categoria>
              </asigna>
           </ges:AsignaPinEnt>
        </soapenv:Body>
     </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "SOAPAction: http://www.colsanitas.com/GestionPines/AsignarPin",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        // PHP cURL  for https connection with auth
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $soapUser . ":" . $soapPassword); // username and password - declared at the top of the doc
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // converting
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $datos = array(
            "userName" => $userName,
            "userToken" => $userToken,
            "codigoCompania" => $codigoCompania,
            "codigoPlan" => $codigoPlan,
            "numeroContrato" => $numeroContrato,
            "numeroFlia" => $numeroFlia,
            "Documento" => $Documento,
            "TipoDocumento" => $TipoDocumento,
            "codCiudad" => $codCiudad,
            "cantidad" => $cantidad,
            "valorTrx" => $valorTrx,
            "estacion" => $estacion,
            "numTrxCanal" => $numTrxCanal,
            "categoria" => $categoria,
            "url" => $soapUrl,
        );
        // $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_id, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, "Prestadores", $datos, $params_error_report);
        $response1 = str_replace('<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soapenv:Body>',
            '<Body>', $response1);

        $response3 = str_replace('<ns4:AsignaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">',
            '<AsignaPinSal xmlns:ns4="http://www.colsanitas.com/GestionPines/">', $response2);

        $response4 = str_replace('<ns1:codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<codPin xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response3);

        $response5 = str_replace('</ns1:codPin>',
            '</codPin>', $response4);

        $response6 = str_replace('<ns1:fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaAsignacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response5);

        $response7 = str_replace('</ns1:fechaAsignacion>',
            '</fechaAsignacion>', $response6);

        $response8 = str_replace('<ns1:fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<fechaUltimoEstado xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response7);

        $response9 = str_replace('</ns1:fechaUltimoEstado>',
            '</fechaUltimoEstado>', $response8);

        $response10 = str_replace('<ns2:codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response9);

        $response11 = str_replace('</ns2:codigo>',
            '</codigo>', $response10);

        $response12 = str_replace('<ns2:descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response11);

        $response13 = str_replace('</ns2:descripcion>',
            '</descripcion>', $response12);

        $response14 = str_replace('<ns2:codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<codigo xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response13);

        $response15 = str_replace('</ns2:codigo>',
            '</codigo>', $response14);

        $response16 = str_replace('<ns2:descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">',
            '<descripcion xmlns:ns2="http://www.colsanitas.com/schema/osi/recaudo/pin">', $response15);

        $response17 = str_replace('</ns2:descripcion>',
            '</descripcion>', $response16);

        $response18 = str_replace('<ns1:familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<familia xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response17);

        $response19 = str_replace('</ns1:familia>',
            '</familia>', $response18);

        $response20 = str_replace('<ns1:categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun"/>',
            '<categoria xmlns:ns1="http://www.colsanitas.com/schema/osi/comun"/>', $response19);

        $response21 = str_replace('<ns1:estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<estacion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response20);

        $response22 = str_replace('</ns1:estacion>',
            '</estacion>', $response21);

        $response23 = str_replace('<ns1:numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<numeroTransaccion xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response22);

        $response24 = str_replace('</ns1:numeroTransaccion>',
            '</numeroTransaccion>', $response23);

        $response25 = str_replace('<ns1:valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<valorTotal xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response24);

        $response26 = str_replace('</ns1:valorTotal>',
            '</valorTotal>', $response25);

        $response27 = str_replace('<ns1:valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">',
            '<valorIVA xmlns:ns1="http://www.colsanitas.com/schema/osi/comun">', $response26);

        $response28 = str_replace('</ns1:valorIVA>',
            '</valorIVA>', $response27);

        $response29 = str_replace('<ns3:valorTrx xmlns:ns3="http://www.colsanitas.com/schema/osi/srv">',
            '<valorTrx xmlns:ns3="http://www.colsanitas.com/schema/osi/srv">', $response28);

        $response30 = str_replace('</ns3:valorTrx>',
            '</valorTrx>', $response29);

        $response31 = str_replace('</ns4:AsignaPinSal>',
            '</AsignaPinSal>', $response30);

        $response32 = str_replace('</soapenv:Body>',
            '</Body>', $response31);

        $response33 = str_replace('</soapenv:Envelope>',
            '</Envelope>', $response32);

        $parser = simplexml_load_string($response33);
        $this->createLog($parser, $xml_post_string, $chat_id, $nameFunction, "POST");

        $codigoPin = $parser->Body->AsignaPinSal->pinAsignado->pin->pin->codPin;

        $var = '{
            "codigoPin" : ' . $codigoPin . '
        }';

        return $var;
    }

    public function validatePinStatus2($app, $params_error_report, $nameController, $chat_id, $urlIn)
    {

        $nameFunction = "validatePinStatusAnular()";
        $codCia = $_POST['codCompania'];
        $numPin = $_POST['numPinVale'];
        $docType = $_POST['tipoDocumento'];
        $url = $urlIn . 'financialResourceManagement/payment/electronicVaucher/v1.0.0/consultar';
        $token = $this->getTokenWs($app, false);
        $request = '{
                "codigoCompania" : "' . $codCia . '",
                "numeroPinVale": "' . $numPin . '",
                "tipoDocumento": "' . $docType . '"
            }';

        $datos = array(
            "codCia" => $codCia,
            "numPin" => $numPin,
            "docType" => $docType,
            "url" => $url,
            "request" => $request,
            "token" => $token,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, "Prestadores", $datos);

        if ($response_object === false) {
            return;
        }

        $validPin = $response_object->consultarResponse->pinVale->estado;
        $numPin = $response_object->consultarResponse->pinVale->numeroPinVale;
        $valorPin = $response_object->consultarResponse->pinVale->precioPin->valorTotal;
        $contratoVale = $response_object->consultarResponse->pinVale->numeroContrato;
        $familiaVale = $response_object->consultarResponse->pinVale->numeroFamilia;
        $usuarioVale = $response_object->consultarResponse->pinVale->numeroUsuario;

        switch ($validPin) {
            case '1':
                $val = "Habilitado";
                break;
            case '2':
                $val = "Anulado";
                break;
            case '3':
                $val = "Utilizado";
                break;
            case '4':
                $val = "Utilizado Administrativo";
                break;
            case '5':
                $val = "Facturado";
                break;
            case '6':
                $val = "Anulado cortesía";
                break;
            default:
                $val = 'No Existe el Pin';
        };

        $salida = '{
            "estadoPin" : "' . $val . '",
            "numeroPin" : ' . $numPin . ',
            "valorPin" : ' . $valorPin . ',
            "contratoVale" : "' . $contratoVale . '",
            "familiaVale" : ' . $familiaVale . ',
            ' . ($usuarioVale ? '"usuarioVale" : "' . $usuarioVale . '"' : '"usuarioVale" : "null"') . '
        }';

        return $salida;

    }

    /** Método para consultar el servicio y obtener los datos: codServicio, codTipoAtencion y UVR */
    private function consultServiceInfo($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "consultServiceInfo()";
        // Como este valor, va siempre en 2 en este servicio, si no se le envía debería recibir el valor 2
        $tipoConsulta = isset($_POST['tipoConsulta']) ? $_POST['tipoConsulta'] : 2;
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $numContrato = $_POST['numeroContrato'];
        $numFamilia = $_POST['numeroFamilia'];
        $numIdentificacion = $_POST['numeroIdentidad'];
        $tipoIdentificacion = $_POST['tipoIdentidad'];
        $codPrestacionMedicamentoOSI = $_POST['codPrestacionMedicamentoOSI'];
        $nomPrestacionMedicamentoOSI = $_POST['nomPrestacionMedicamentoOSI'];
        $codSucursal = $_POST['codSucursal'];

        switch ($tipoIdentificacion) {
            case "1":
                $tipoIdentificacion = "CC";
                break;
            case "2":
                $tipoIdentificacion = "CE";
                break;
            case "3":
                $tipoIdentificacion = "MS";
                break;
            case "4":
                $tipoIdentificacion = "NI";
                break;
            case "5":
                $tipoIdentificacion = "NIP";
                break;
            case "6":
                $tipoIdentificacion = "PA";
                break;
            case "7":
                $tipoIdentificacion = "RC";
                break;
            case "8":
                $tipoIdentificacion = "TI";
                break;
            case "9":
                $tipoIdentificacion = "CD";
                break;
            case "10":
                $tipoIdentificacion = "CN";
                break;
            case "11":
                $tipoIdentificacion = "SC";
                break;
            case "12":
                $tipoIdentificacion = "PD";
                break;
            case "13":
                $tipoIdentificacion = "PE";
                break;
            case "15":
                $tipoIdentificacion = "PT";
                break;
            default:
                $tipoIdentificacion = $tipoIdentificacion;
                break;
        };
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = "https://osiapppre02.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint"; // asmx URL of WSDL
        }

        // Estructura XML para el consumo SOAP. Según el servicio el tipoConsulta siempre va en 2, por ahora se deja quemado
        $soapXMLRequest = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona">
            <soapenv:Header>
                <pres:HeaderRqust>
                    <pres:header>
                        <nof:messageHeader>
                            <nof:messageInfo>
                                <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                            </nof:messageInfo>
                        </nof:messageHeader>
                    </pres:header>
                </pres:HeaderRqust>
            </soapenv:Header>
            <soapenv:Body>
                <pres:ConsultarServicioEnt>
                    <pres:consultarServicioEnt>
                        <srv:ConsultarServicio>
                            <srv:Cobertura>
                                <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                                <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                            </srv:Cobertura>
                            <srv:Contrato>
                                <srv:numContrato>' . $numContrato . '</srv:numContrato>
                                <srv:numeroFamilia>' . $numFamilia . '</srv:numeroFamilia>
                                <srv:identificacionAfiliado>
                                    <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                                    <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                                </srv:identificacionAfiliado>
                            </srv:Contrato>
                            <srv:PrestacionMedicamento>
                                <srv:codPrestacionMedicamentoOSI>' . $codPrestacionMedicamentoOSI . '</srv:codPrestacionMedicamentoOSI>
                            </srv:PrestacionMedicamento>
                            <srv:nomPrestacionMedicamentoOSI>' . $nomPrestacionMedicamentoOSI . '</srv:nomPrestacionMedicamentoOSI>
                            <srv:PrestPracticaRemitente>
                                <srv:codSucursalPractica>' . $codSucursal . '</srv:codSucursalPractica>
                            </srv:PrestPracticaRemitente>
                        </srv:ConsultarServicio>
                    </pres:consultarServicioEnt>
                </pres:ConsultarServicioEnt>
            </soapenv:Body>
        </soapenv:Envelope>
        ';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXMLRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestaciones/ConsultarServicio"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);
        // Obtain response status
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        // Close the cURL request
        curl_close($ch);

        $parametros = array(
            "tipoConsulta" => $tipoConsulta,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "numContrato" => $numContrato,
            "numFamilia" => $numFamilia,
            "numIdentificacion" => $numIdentificacion,
            "tipoIdentificacion" => $tipoIdentificacion,
            "codPrestacionMedicamentoOSI" => $codPrestacionMedicamentoOSI,
            "nomPrestacionMedicamentoOSI" => $nomPrestacionMedicamentoOSI,
            "codSucursal" => $codSucursal,
            "url" => $soapUrl,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");

        if ($httpCode == 200) {
            $res1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response);
            $res2 = str_replace('<s:Header>', '<Header>', $res1);
            $res3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/Prestaciones/" xmlns="http://colsanitas.com/Prestaciones/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<HeaderRspns xmlns:h="http://colsanitas.com/Prestaciones/" xmlns="http://colsanitas.com/Prestaciones/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res2);
            $res4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $res3);
            $res5 = str_replace('</s:Header>', '</Header>', $res4);
            $res6 = str_replace('<s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', '<Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', $res5);
            $res7 = str_replace('</s:Body>', '</Body>', $res6);
            $res8 = str_replace('</s:Envelope>', '</Envelope>', $res7);

            $parser = simplexml_load_string($res8);

            $errorCode = $parser->Header->HeaderRspns->header->responseStatus->businessException->errorDetails->errorCode;

            if (strtolower($errorCode) == 'ok') {
                $atxnTypeCode = $parser->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->codTipoAtencion;
                $serviceCode = $parser->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->codServicio;
                $uvr = $parser->Body->ConsultarServicioSal->consultarServicioSal->InformacionPrestacionMedicamento->informacionConfCoberturas->convenioPrestador->numeroUVR;

                return '{
                    "message": "OK",
                    "codTipoAtencion": "' . $atxnTypeCode[0] . '",
                    "codServicio": "' . $serviceCode[0] . '",
                    "uvr": "' . $uvr[0] . '"
                }';
            } else {
                return '{
                    "message": "Error"
                }';
            }
        } else {
            $var = [
                "message" => "Error",
            ];
            return json_encode($var);
        }
    }

    /** Método para obtener el valor a pagar por el servicio */
    private function agreementValue($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "consultarValorConvenio()";
        // Como este valor, va siempre en 2 en este servicio, si no se le envía debería recibir el valor 1
        $tipoConsulta = isset($_POST['tipoConsulta']) ? $_POST['tipoConsulta'] : 1;
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $codPrestacionMedicamentoOSI = $_POST['codPrestacionMedicamentoOSI'];
        $codTipoAtencion = $_POST['codTipoAtencion'];
        $codSucursal = $_POST['codSucursal'];
        $agreementDate = $_POST['fechaConvenio'];
        if ($agreementDate) {
            $agreementTimestamp = strtotime($agreementDate);
            $agreementDate = date('Y-m-d', $agreementTimestamp);
        } else {
            $agreementDate = "";
        }

        $soapXMLRequest = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv">
            <soapenv:Header>
                <pres:HeaderRqust>
                    <pres:header>
                        <nof:messageHeader>
                        <nof:messageInfo>
                            <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                        </nof:messageInfo>
                        </nof:messageHeader>
                    </pres:header>
                </pres:HeaderRqust>
            </soapenv:Header>
            <soapenv:Body>
                <pres:ConsultarValorConvenioEnt>
                    <pres:consultarValorConvenio>
                        <srv:ConsultarValorConvenio>
                        <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                        <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                        <srv:codPrestacionMedicamentoOSI>' . $codPrestacionMedicamentoOSI . '</srv:codPrestacionMedicamentoOSI>
                        <srv:codTipoAtencion>' . $codTipoAtencion . '</srv:codTipoAtencion>
                        <srv:codSucursalPractica>' . $codSucursal . '</srv:codSucursalPractica>
                        <srv:fecConvenio>' . $agreementDate . '</srv:fecConvenio>
                        </srv:ConsultarValorConvenio>
                    </pres:consultarValorConvenio>
                </pres:ConsultarValorConvenioEnt>
            </soapenv:Body>
        </soapenv:Envelope>
        ';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = 'https://osiapppre02.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXMLRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestaciones/ConsultarValorConvenio"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);
        // Obtain response status
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        // Close the cURL request
        curl_close($ch);

        $parametros = array(
            "tipoConsulta" => $tipoConsulta,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "codPrestacionMedicamentoOSI" => $codPrestacionMedicamentoOSI,
            "codTipoAtencion" => $codTipoAtencion,
            "codSucursal" => $codSucursal,
            "agreementDate" => $agreementDate,
            "url" => $soapUrl,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");

        if ($httpCode == 200) {
            $res1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response);
            $res2 = str_replace('<s:Header>', '<Header>', $res1);
            $res3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/Prestaciones/" xmlns="http://colsanitas.com/Prestaciones/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<HeaderRspns xmlns:h="http://colsanitas.com/Prestaciones/" xmlns="http://colsanitas.com/Prestaciones/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res2);
            $res4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $res3);
            $res5 = str_replace('</s:Header>', '</Header>', $res4);
            $res6 = str_replace('<s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', '<Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', $res5);
            $res7 = str_replace('</s:Body>', '</Body>', $res6);
            $res8 = str_replace('</s:Envelope>', '</Envelope>', $res7);
            $parser = simplexml_load_string($res8);
            $errorCode = $parser->Header->HeaderRspns->header->responseStatus->businessException->errorDetails->errorCode;
            if (strtolower($errorCode) == 'ok') {
                $agreementValue = $parser->Body->ConsultarValorConvenioSal->consultarValorConvenio->PrestacionMedicamento->valorConvenio;
                return '{
                    "message": "OK",
                    "valorConvenio": "' . $agreementValue[0] . '"
                }';
            } else {
                $var = [
                    "message" => "Error",
                ];
                return json_encode($var);
            }
        } else {
            $var = [
                "message" => "Error",
            ];
            return json_encode($var);
        }
    }

    private function agreementValue2($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "consultarValorConvenio()";
        $compania = $_POST['compania'];
        $plan = $_POST['plan'];
        $codigo_servicio = $_POST['codigo_servicio'];
        $tipo_atencion = $_POST['tipo_atencion'];
        $cod_sucursal = $_POST['cod_sucursal'];
        $uvr = $_POST['uvr'];
        $sesiones = $_POST['sesiones'];
        $valor_servicio = $_POST['valor_servicio'];
        $descripcion_servicio = $_POST['descripcion_servicio'];

        $space_position = strpos($codigo_servicio, '-');

        if ($space_position) {
            $servicios = "";
            $codigoServicioArray = explode("-", $codigo_servicio);
            $descripcionServicioArray = explode("-", $descripcion_servicio);
            $uvrArray = explode("-", $uvr);
            $sesionesArray = explode("-", $sesiones);
            $valorDelServicioArray = explode("-", $valor_servicio);
            $contador = count($codigoServicioArray);
            for ($i = 0; $i < $contador; $i++) {
                $valor_convenio = $this->localAgreementValue($app, $params_error_report, $nameController, $chat_id, 1, $compania, $plan, $codigoServicioArray[$i], $tipo_atencion, $cod_sucursal, "");
                if ($i < ($contador - 1)) {

                    $servicios = $servicios . '
        {
            "codigo":"' . $codigoServicioArray[$i] . '",
            "descripcion":"' . $descripcionServicioArray[$i] . '",
            "numeroSolicitud":"' . $numero_solicitud . '",
            "tipoVolante": "' . $tipo_volante . '",
            "tipoAtencion":"' . $tipo_atencion . '",
            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
            "fechaVencimiento":"' . $fecha_vencimiento . '",
            "observaciones":"' . $observaciones . '",
            "estado":' . $estado_servicio . ',
            "valor": ' . $valorDelServicioArray[$i] . ',
            "uvr": ' . $uvrArray[$i] . ',
            "viaIngreso": "' . $via_ingreso . '",
            "valorUnitario": ' . $valor_unitario . ',
            "sesiones": ' . $sesionesArray[$i] . ',
            "existeValorConvenio": "' . $existe_valor . '",
            "codigoDiagnostico":"' . $codigo_diagnostico . '",
            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
            "valorConvenio": ' . $valor_convenio . '
            },
            ';
                } else {
                    $servicios = $servicios . '
                        {
                            "codigo":"' . $codigoServicioArray[$i] . '",
                            "descripcion":"' . $descripcionServicioArray[$i] . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valorDelServicioArray[$i] . ',
                            "uvr": ' . $uvrArray[$i] . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesionesArray[$i] . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                            }
                            ';
                }
            }
        } else {
            $servicios = '
                        {
                            "codigo":"' . $codigo_servicio . '",
                            "descripcion":"' . $descripcion_servicio . '",
                            "numeroSolicitud":"' . $numero_solicitud . '",
                            "tipoVolante": "' . $tipo_volante . '",
                            "tipoAtencion":"' . $tipo_atencion . '",
                            "fechaExpedicionRadicacion":"' . $fecha_expedicion . '",
                            "fechaVencimiento":"' . $fecha_vencimiento . '",
                            "observaciones":"' . $observaciones . '",
                            "estado":' . $estado_servicio . ',
                            "valor": ' . $valor_servicio . ',
                            "uvr": ' . $uvr . ',
                            "viaIngreso": "' . $via_ingreso . '",
                            "valorUnitario": ' . $valor_unitario . ',
                            "sesiones": ' . $sesiones . ',
                            "existeValorConvenio": "' . $existe_valor . '",
                            "codigoDiagnostico":"' . $codigo_diagnostico . '",
                            "codigoOrigenAutorizacion": ' . $codigo_origen_autorizacion . ',
                            "valorConvenio": ' . $valor_convenio . '
                        }
                    ';
        }

        print_r($servicios);
        print_r($valorDelServicio);
    }
    private function localAgreementValue($app, $params_error_report, $nameController, $chat_id, $tipoConsulta, $codigoProducto, $codigoPlan, $codPrestacionMedicamentoOSI, $codTipoAtencion, $codSucursal, $agreementDate)
    {
        $nameFunction = "localConsultarValorConvenio()";
        if ($agreementDate) {
            $agreementTimestamp = strtotime($agreementDate);
            $agreementDate = date('Y-m-d', $agreementTimestamp);
        } else {
            $agreementDate = "";
        }

        $soapXMLRequest = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/Prestaciones/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv">
            <soapenv:Header>
                <pres:HeaderRqust>
                    <pres:header>
                        <nof:messageHeader>
                        <nof:messageInfo>
                            <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                        </nof:messageInfo>
                        </nof:messageHeader>
                    </pres:header>
                </pres:HeaderRqust>
            </soapenv:Header>
            <soapenv:Body>
                <pres:ConsultarValorConvenioEnt>
                    <pres:consultarValorConvenio>
                        <srv:ConsultarValorConvenio>
                        <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                        <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                        <srv:codPrestacionMedicamentoOSI>' . $codPrestacionMedicamentoOSI . '</srv:codPrestacionMedicamentoOSI>
                        <srv:codTipoAtencion>' . $codTipoAtencion . '</srv:codTipoAtencion>
                        <srv:codSucursalPractica>' . $codSucursal . '</srv:codSucursalPractica>
                        <srv:fecConvenio>' . $agreementDate . '</srv:fecConvenio>
                        </srv:ConsultarValorConvenio>
                    </pres:consultarValorConvenio>
                </pres:ConsultarValorConvenioEnt>
            </soapenv:Body>
        </soapenv:Envelope>
        ';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $soapUrl = "https://services01.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $soapUrl = 'https://osiapppre02.colsanitas.com/services/ProxyPrestaciones.ProxyPrestacionesHttpSoap11Endpoint';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXMLRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestaciones/ConsultarValorConvenio"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);
        // Obtain response status
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        // Close the cURL request
        curl_close($ch);

        $parametros = array(
            "tipoConsulta" => $tipoConsulta,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "codPrestacionMedicamentoOSI" => $codPrestacionMedicamentoOSI,
            "codTipoAtencion" => $codTipoAtencion,
            "codSucursal" => $codSucursal,
            "agreementDate" => $agreementDate,
            "url" => $soapUrl,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");

        if ($httpCode == 200) {
            $res1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response);
            $res2 = str_replace('<s:Header>', '<Header>', $res1);
            $res3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/Prestaciones/" xmlns="http://colsanitas.com/Prestaciones/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<HeaderRspns xmlns:h="http://colsanitas.com/Prestaciones/" xmlns="http://colsanitas.com/Prestaciones/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res2);
            $res4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $res3);
            $res5 = str_replace('</s:Header>', '</Header>', $res4);
            $res6 = str_replace('<s:Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', '<Body xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">', $res5);
            $res7 = str_replace('</s:Body>', '</Body>', $res6);
            $res8 = str_replace('</s:Envelope>', '</Envelope>', $res7);

            $parser = simplexml_load_string($res8);
            $errorCode = $parser->Header->HeaderRspns->header->responseStatus->businessException->errorDetails->errorCode;
            if (strtolower($errorCode) == 'ok') {
                $agreementValue = $parser->Body->ConsultarValorConvenioSal->consultarValorConvenio->PrestacionMedicamento->valorConvenio;
                return $agreementValue[0];
            } else {
                return $var = 'Error';
            }
        } else {
            return $var = 'Error';
        }
    }

    /** Método para el cuadroMedico con especialidad frecuente */
    private function cmEspecialidadFrecuente($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "cuadroMedicoEspecialidadFrecuente()";
        // Como este valor, va siempre en 3 en este servicio, si no se le envía debería recibir el valor 2
        $tipoConsulta = isset($_POST['tipoConsulta']) ? $_POST['tipoConsulta'] : 3;
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $codSucursal = $_POST['codSucursal'];
        $numIdentificacion = $_POST['numeroIdentidad'];
        $tipoIdentificacion = $_POST['tipoIdentidad'];
        $numContrato = $_POST['numeroContrato'];

        switch ($tipoIdentificacion) {
            case "1":
                $tipoIdentificacion = "CC";
                break;
            case "2":
                $tipoIdentificacion = "CE";
                break;
            case "3":
                $tipoIdentificacion = "MS";
                break;
            case "4":
                $tipoIdentificacion = "NI";
                break;
            case "5":
                $tipoIdentificacion = "NIP";
                break;
            case "6":
                $tipoIdentificacion = "PA";
                break;
            case "7":
                $tipoIdentificacion = "RC";
                break;
            case "8":
                $tipoIdentificacion = "TI";
                break;
            case "9":
                $tipoIdentificacion = "CD";
                break;
            case "10":
                $tipoIdentificacion = "CN";
                break;
            case "11":
                $tipoIdentificacion = "SC";
                break;
            case "12":
                $tipoIdentificacion = "PD";
                break;
            case "13":
                $tipoIdentificacion = "PE";
                break;
            case "15":
                $tipoIdentificacion = "PT";
                break;
            default:
                $tipoIdentificacion = $tipoIdentificacion;
                break;
        };

        $soapXMLRequest = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/PrestadoresServicio/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona" xmlns:pres1="http://colsanitas.com/osi/comun/prestadores" xmlns:ubic="http://colsanitas.com/osi/comun/ubicacion">
           <soapenv:Header>
                  <pres:HeaderRqust>
                         <!--Optional:-->
                         <pres:header>
                                <!--Optional:-->
                                <nof:messageHeader>
                                   <!--Optional:-->

                                   <!--Optional:-->
                                   <nof:messageInfo>

                                          <!--Optional:-->
                                          <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                                   </nof:messageInfo>
                                   <!--Optional:-->
                                </nof:messageHeader>
                                <!--Optional:-->
                                <nof:user>
                                   <!--Optional:-->
                                   <nof:userName></nof:userName>
                                   <!--Optional:-->
                                   <nof:userToken></nof:userToken>
                                </nof:user>
                         </pres:header>
                  </pres:HeaderRqust>
           </soapenv:Header>
           <soapenv:Body>
                  <pres:CuadroMedicoEnt>
                         <!--Optional:-->
                         <pres:cuadroMedicoEnt>
                                <!--Optional:-->
                                <srv:CuadroMedico>
                                   <!--Optional:-->
                                   <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                                   <!--Optional:-->
                                   <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                                   <!--Optional:-->
                                   <srv:identificacionPrestador>
                                          <!--Optional:-->
                                          <per:numIdentificacion>' . $numIdentificacion . '</per:numIdentificacion>
                                          <!--Optional:-->
                                          <per:tipoIdentificacion>' . $tipoIdentificacion . '</per:tipoIdentificacion>
                                          <!--Optional:-->
                                          <per:descTipoIdentificacion></per:descTipoIdentificacion>
                                   </srv:identificacionPrestador>
                                   <!--Optional:-->
                                   <srv:nombrePrestador></srv:nombrePrestador>
                                   <!--Optional:-->
                                   <srv:nombreSede></srv:nombreSede>
                                   <!--Optional:-->
                                   <srv:codSucursalPrestador></srv:codSucursalPrestador>
                                   <!--Optional:-->
                                   <srv:nomSucursalPrestador></srv:nomSucursalPrestador>
                                   <!--Optional:-->
                                   <srv:codRegionalSucursal></srv:codRegionalSucursal>
                                   <!--Optional:-->
                                   <srv:fechaInicioConsultaVigencia></srv:fechaInicioConsultaVigencia>
                                   <!--Optional:-->
                                   <srv:fechaFinConsultaVigencia></srv:fechaFinConsultaVigencia>
                                   <!--Optional:-->
                                   <srv:ciudad></srv:ciudad>
                                   <!--Optional:-->
                                   <srv:codGrupoCuadroMedico></srv:codGrupoCuadroMedico>
                                   <!--Zero or more repetitions:-->
                                   <srv:ServicioCuadroMedico>
                                          <!--Optional:-->
                                          <pres1:codServicioCuadroMedico></pres1:codServicioCuadroMedico>
                                          <!--Optional:-->
                                          <pres1:nombreServicioCuadroMedico></pres1:nombreServicioCuadroMedico>
                                          <!--Optional:-->
                                          <pres1:direccionCompleta></pres1:direccionCompleta>
                                          <!--Optional:-->
                                          <pres1:latitud></pres1:latitud>
                                          <!--Optional:-->
                                          <pres1:longitud></pres1:longitud>
                                          <!--Optional:-->
                                          <pres1:nivel></pres1:nivel>
                                          <!--Zero or more repetitions:-->
                                          <pres1:telefono>
                                                 <!--Optional:-->
                                                 <ubic:codigo>0</ubic:codigo>
                                                 <!--Optional:-->
                                                 <ubic:numero></ubic:numero>
                                                 <!--Optional:-->
                                                 <ubic:ext></ubic:ext>
                                                 <!--Optional:-->
                                                 <ubic:indicativo>
                                                        <!--Optional:-->
                                                        <ubic:indicativoPais></ubic:indicativoPais>
                                                        <!--Optional:-->
                                                        <ubic:codigoArea></ubic:codigoArea>
                                                 </ubic:indicativo>
                                          </pres1:telefono>
                                   </srv:ServicioCuadroMedico>
                                   <!--Optional:-->
                                   <srv:longitudMin></srv:longitudMin>
                                   <!--Optional:-->
                                   <srv:longitudMax></srv:longitudMax>
                                   <!--Optional:-->
                                   <srv:latitudMin></srv:latitudMin>
                                   <!--Optional:-->
                                   <srv:latitudMax></srv:latitudMax>
                                   <!--Optional:-->
                                   <srv:numContrato>' . $numContrato . '</srv:numContrato>
                                </srv:CuadroMedico>
                         </pres:cuadroMedicoEnt>
                  </pres:CuadroMedicoEnt>
           </soapenv:Body>
        </soapenv:Envelope>
        ';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXMLRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestadores/CuadroMedico"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);
        // Obtain response status
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        // Close the cURL request
        curl_close($ch);
        $parametros = array(
            "tipoConsulta" => $tipoConsulta,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "codSucursal" => $codSucursal,
            "numIdentificacion" => $numIdentificacion,
            "tipoIdentificacion" => $tipoIdentificacion,
            "numContrato" => $numContrato,
            "url" => $url,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");
        if ($httpCode == 200) {
            $res1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response);
            $res2 = str_replace('<s:Header>', '<Header>', $res1);
            $res3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res2);
            $res4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $res3);
            $res5 = str_replace('</s:Header>', '</Header>', $res4);
            $res6 = str_replace('<s:Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res5);
            $res7 = str_replace('</s:Body>', '</Body>', $res6);
            $res8 = str_replace('</s:Envelope>', '</Envelope>', $res7);

            $parser = simplexml_load_string($res8);
            $frequentlySpecialty = $parser->Body->CuadroMedicoSal->cuadroMedicoSal->datosBasicosConvenio->datosBasicosPrestador->sucursales->especialidadFrecuente;
            return '{
                "message": "OK",
                "especialidadFrecuente": "' . $frequentlySpecialty[0] . '"
            }';
        } else {
            $var = [
                "message" => "Error",
            ];
            return json_encode($var);
        }
    }

    private function cmPrestadorPuertaDeEntrada($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "cmPrestadorPuertaDeEntrada()";
        // Como este valor, va siempre en 3 en este servicio, si no se le envía debería recibir el valor 2
        $tipoConsulta = isset($_POST['tipoConsulta']) ? $_POST['tipoConsulta'] : 3;
        $codigoProducto = $_POST['codigoProducto'];
        $codigoPlan = $_POST['codigoPlan'];
        $codSucursal = $_POST['codSucursal'];

        $soapXMLRequest = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pres="http://colsanitas.com/PrestadoresServicio/" xmlns:nof="http://colsanitas.com/osi/comun/nofuncionales" xmlns:srv="http://colsanitas.com/osi/srv" xmlns:per="http://colsanitas.com/osi/comun/persona" xmlns:pres1="http://colsanitas.com/osi/comun/prestadores" xmlns:ubic="http://colsanitas.com/osi/comun/ubicacion">
           <soapenv:Header>
                  <pres:HeaderRqust>
                         <!--Optional:-->
                         <pres:header>
                                <!--Optional:-->
                                <nof:messageHeader>
                                   <!--Optional:-->

                                   <!--Optional:-->
                                   <nof:messageInfo>

                                          <!--Optional:-->
                                          <nof:tipoConsulta>' . $tipoConsulta . '</nof:tipoConsulta>
                                   </nof:messageInfo>
                                   <!--Optional:-->
                                </nof:messageHeader>
                                <!--Optional:-->
                                <nof:user>
                                   <!--Optional:-->
                                   <nof:userName></nof:userName>
                                   <!--Optional:-->
                                   <nof:userToken></nof:userToken>
                                </nof:user>
                         </pres:header>
                  </pres:HeaderRqust>
           </soapenv:Header>
           <soapenv:Body>
                  <pres:CuadroMedicoEnt>
                         <!--Optional:-->
                         <pres:cuadroMedicoEnt>
                                <!--Optional:-->
                                <srv:CuadroMedico>
                                   <!--Optional:-->
                                   <srv:codigoProducto>' . $codigoProducto . '</srv:codigoProducto>
                                   <!--Optional:-->
                                   <srv:codigoPlan>' . $codigoPlan . '</srv:codigoPlan>
                                   <!--Optional:-->
                                   <srv:identificacionPrestador>
                                          <!--Optional:-->
                                          <per:numIdentificacion></per:numIdentificacion>
                                          <!--Optional:-->
                                          <per:tipoIdentificacion></per:tipoIdentificacion>
                                          <!--Optional:-->
                                          <per:descTipoIdentificacion></per:descTipoIdentificacion>
                                   </srv:identificacionPrestador>
                                   <!--Optional:-->
                                   <srv:nombrePrestador></srv:nombrePrestador>
                                   <!--Optional:-->
                                   <srv:nombreSede></srv:nombreSede>
                                   <!--Optional:-->
                                   <srv:codSucursalPrestador>' . $codSucursal . '</srv:codSucursalPrestador>
                                   <!--Optional:-->
                                   <srv:nomSucursalPrestador></srv:nomSucursalPrestador>
                                   <!--Optional:-->
                                   <srv:codRegionalSucursal></srv:codRegionalSucursal>
                                   <!--Optional:-->
                                   <srv:fechaInicioConsultaVigencia></srv:fechaInicioConsultaVigencia>
                                   <!--Optional:-->
                                   <srv:fechaFinConsultaVigencia></srv:fechaFinConsultaVigencia>
                                   <!--Optional:-->
                                   <srv:ciudad></srv:ciudad>
                                   <!--Optional:-->
                                   <srv:codGrupoCuadroMedico></srv:codGrupoCuadroMedico>
                                   <!--Zero or more repetitions:-->
                                   <srv:ServicioCuadroMedico>
                                          <!--Optional:-->
                                          <pres1:codServicioCuadroMedico></pres1:codServicioCuadroMedico>
                                          <!--Optional:-->
                                          <pres1:nombreServicioCuadroMedico></pres1:nombreServicioCuadroMedico>
                                          <!--Optional:-->
                                          <pres1:direccionCompleta></pres1:direccionCompleta>
                                          <!--Optional:-->
                                          <pres1:latitud></pres1:latitud>
                                          <!--Optional:-->
                                          <pres1:longitud></pres1:longitud>
                                          <!--Optional:-->
                                          <pres1:nivel></pres1:nivel>
                                          <!--Zero or more repetitions:-->
                                          <pres1:telefono>
                                                 <!--Optional:-->
                                                 <ubic:codigo>0</ubic:codigo>
                                                 <!--Optional:-->
                                                 <ubic:numero></ubic:numero>
                                                 <!--Optional:-->
                                                 <ubic:ext></ubic:ext>
                                                 <!--Optional:-->
                                                 <ubic:indicativo>
                                                        <!--Optional:-->
                                                        <ubic:indicativoPais></ubic:indicativoPais>
                                                        <!--Optional:-->
                                                        <ubic:codigoArea></ubic:codigoArea>
                                                 </ubic:indicativo>
                                          </pres1:telefono>
                                   </srv:ServicioCuadroMedico>
                                   <!--Optional:-->
                                   <srv:longitudMin></srv:longitudMin>
                                   <!--Optional:-->
                                   <srv:longitudMax></srv:longitudMax>
                                   <!--Optional:-->
                                   <srv:latitudMin></srv:latitudMin>
                                   <!--Optional:-->
                                   <srv:latitudMax></srv:latitudMax>
                                   <!--Optional:-->
                                   <srv:numContrato></srv:numContrato>
                                </srv:CuadroMedico>
                         </pres:cuadroMedicoEnt>
                  </pres:CuadroMedicoEnt>
           </soapenv:Body>
        </soapenv:Envelope>
        ';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/ProxyPrestadores.ProxyPrestadoresHttpSoap11Endpoint';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXMLRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestadores/CuadroMedico"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);
        // Obtain response status
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        // Close the cURL request
        curl_close($ch);
        $parametros = array(
            "tipoConsulta" => $tipoConsulta,
            "codigoProducto" => $codigoProducto,
            "codigoPlan" => $codigoPlan,
            "codSucursal" => $codSucursal,
            "url" => $soapUrl,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");
        if ($httpCode == 200) {
            $res1 = str_replace('<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', '<Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">', $response);
            $res2 = str_replace('<s:Header>', '<Header>', $res1);
            $res3 = str_replace('<h:HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<HeaderRspns xmlns:h="http://colsanitas.com/PrestadoresServicio/" xmlns="http://colsanitas.com/PrestadoresServicio/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res2);
            $res4 = str_replace('</h:HeaderRspns>', '</HeaderRspns>', $res3);
            $res5 = str_replace('</s:Header>', '</Header>', $res4);
            $res6 = str_replace('<s:Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', '<Body xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">', $res5);
            $res7 = str_replace('</s:Body>', '</Body>', $res6);
            $res8 = str_replace('</s:Envelope>', '</Envelope>', $res7);

            $parser = simplexml_load_string($res8);
            $arrayDatos = $parser->Body->CuadroMedicoSal->cuadroMedicoSal;
            $datosBasicosConvenio = $arrayDatos->datosBasicosConvenio;
            for ($i = 0; $i < count($datosBasicosConvenio); $i++) {
                $producto = $datosBasicosConvenio[$i]->codigoProducto;
                $plan = $datosBasicosConvenio[$i]->codPlan;
                if ($codigoProducto == $producto && $codigoPlan == $plan) {
                    if ($datosBasicosConvenio[$i]->datosBasicosPrestador->sucursales->InformacionAdicionalConvenio->codPuertaEntrada) {
                        return '{
                        "prestadorPuertaEntrada" : 1
                        }';
                    } else {
                        return '{
                                "prestadorPuertaEntrada" : 0
                                }';
                    }
                } else {
                    return '{
                        "prestadorPuertaEntrada" : 0
                        }';
                }
            }
        }

    }

    private function getRoleRips($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "getRoleRips()";
        $idUser = $_POST['idUser'];
        $sucursalId = $_POST['sucursalId'];

        $soapXMLRequest = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="http://ws.authorization.security.gaudi.osi.com/">
   <soapenv:Header/>
   <soapenv:Body>
      <ws:getPermissionsUserPrest>
         <idUser>' . $idUser . '</idUser>
         <shortNameDomain>RAM+</shortNameDomain>
         <sucursalId>' . $sucursalId . '</sucursalId>
      </ws:getPermissionsUserPrest>
   </soapenv:Body>
</soapenv:Envelope>
        ';
        $useProduction = $_POST['useProduction'];
        if ($useProduction == 1) {
            $url = "https://services01.colsanitas.com/services/Authorization.AuthorizationHttpSoap11Endpoint"; // asmx URL of WSDL
        } else {
            $url = 'https://osiapppre02.colsanitas.com/services/Authorization.AuthorizationHttpSoap11Endpoint';
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $soapXMLRequest);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: "http://www.colsanitas.com/Prestadores/CuadroMedico"',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the cURL request
        $response = curl_exec($ch);
        // Obtain response status
        $info = curl_getinfo($ch);
        $httpCode = $info['http_code'];
        // Close the cURL request
        curl_close($ch);
        $parametros = array(

            "idUser" => $idUser,
            "sucursalId" => $sucursalId,
            "Body" => $soapXMLRequest,
            "url" => $url,
        );

        $this->createLog($response, $parametros, $chat_id, $nameFunction, "POST");
        if ($httpCode == 200) {
            $res1 = str_replace("<env:Envelope xmlns:env='http://schemas.xmlsoap.org/soap/envelope/'>", "<Envelope xmlns:env='http://schemas.xmlsoap.org/soap/envelope/'>", $response);
            $res2 = str_replace('<env:Header/>', '<Header/>', $res1);
            $res3 = str_replace('<env:Body>', '<Body>', $res2);
            $res4 = str_replace("<ws:getPermissionsUserPrestResponse xmlns:ws='http://ws.authorization.security.gaudi.osi.com/'>", "<getPermissionsUserPrestResponse xmlns:ws='http://ws.authorization.security.gaudi.osi.com/'>", $res3);
            $res5 = str_replace('</ws:getPermissionsUserPrestResponse>', '</getPermissionsUserPrestResponse>', $res4);
            $res6 = str_replace('</env:Body>', '</Body>', $res5);
            $res7 = str_replace('</env:Envelope>', '</Envelope>', $res6);

            $parser = simplexml_load_string($res7);
            $itemArray = json_encode($parser->Body->getPermissionsUserPrestResponse->return);
            $item = json_decode($itemArray)->item;
            foreach ($item as $i) {
                if ($i->groupPermission->name == "RIPS" && $i->groupPermission->id == 1381) {
                    return $var = '{
                        "RipsPermission" : "1"
                    }';
                }
            }
            return $var = '{
                "RipsPermission" : "0"
            }';

        } else {
            return $var = '{
                "RipsPermission" : "0"
            }';
        }

    }

    private function validarPrestacionConsulta($app, $params_error_report, $nameController, $chat_id)
    {
        $nombreVar = $_POST['nombreDescripcion'];
        $str = strtoupper($nombreVar);
            
        if ($nombreVar) {
            if (preg_match('/(?<![^\s])CONSULTA(?![^\s])/', $str)) {
                return '{
                    "Respuesta" : "1"
                    }';
            } else {
                return '{
                    "Respuesta" : "0"
                    }';
            }
        }
    }

}

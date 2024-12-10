<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use Phalcon\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

/**
 * Description of CariController
 *
 * @author mtobar
 *
 */
class MtController {

    //put your code here

    public function process(\Phalcon\Mvc\Micro $app) {
        header('Access-Control-Allow-Origin: *');
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];
        if ($useProduction) {
            switch ($operation) {
                case "validarUsuario":
                    $response = $this->validarUsuario();
                    echo $response;
                    break;
                case "generarArray":
                    $response = $this->generarArray();
                    echo $response;
                    break;
                case "crearErrorLog":
                    $response = $this->crearErrorLog($app);
                    echo $response;
                    break;
                case "getToken":
                    $response = $this->getTokenWs($app, false);
                    echo $response;
                    break;
                case "getResponseToken":
                    $response = $this->getTokenWs($app, true);
                    echo $response;
                    break;
                case "recordarContra":
                    $response = $this->recordarContra();
                    echo $response;
                    break;
                default:
                    break;
            }
        } else {
            $response = "useProduction is mandatory!";
            echo $response;
        }
    }

    private function getTokenWs($app, $getResponseToken = false) {
        
        $botId = 1104;
        $token = \Store\Toys\PrestadoresApiToken::getToken($app, $botId);
        
        if ($token) {
            if ($getResponseToken === true) {
                $token = '{"access_token": "' . $token . '"}';
            }
            return $token;
        }
        try {
            if ($_POST['useProduction'] == true) {
                $url = "https://papi.colsanitas.com/token";
                $params = 'grant_type=password' .
                        '&username=userchatbotprest' .
                        '&password=4a7t7ZzF0KV7A1YRBqRB';
                $token = "ZFpKOENIQ1NpUTR2SUhQU0F0Y3BJY21oNUprYTpwNVlMdXBMSExNajNrMDN3OXZZWHNLS011M2Nh";
            } else {
                $url = "https://papi.colsanitas.com/token";
                $params = 'grant_type=password' .
                        '&username=userchatbotprest' .
                        '&password=4a7t7ZzF0KV7A1YRBqRB';
                $token = "ZFpKOENIQ1NpUTR2SUhQU0F0Y3BJY21oNUprYTpwNVlMdXBMSExNajNrMDN3OXZZWHNLS011M2Nh";
            }

            $uid = strtoupper(uniqid("CL_", true));
            $stdate = date('Y-m-d H:i:s');
            $serviceName = "getToken";
            $datalog = "\n\n";

            $datalog .= "[$stdate] ";
            $datalog .= "[$uid] ";
            $datalog .= "[$serviceName] ";

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
                $ctime = date("Y-m-d H:i:s", strtotime("+$expires_in seconds"));
                $saveToken = \Store\Toys\PrestadoresApiToken::saveToken($app, $token, $expires_in, $ctime, $botId);
                //JLog::debug("Saved token with id $tokobj->id, expires in $tokobj->expires_in seconds, $tokobj->ctime");
            } else {
                $token = false;
            }

            $datalog .= "\n Request $serviceName: " . $params;
            $datalog .= "\nURL1: " . $url;
            $date = date('Y-m-d H:i:s');
            $datalog .= "\n[$date] ";
            $datalog .= "[$uid] ";
            $datalog .= "Response $serviceName: " . $response_object;

            //file_put_contents("/var/log/defy/ColsanitasWebServices.log", $datalog, FILE_APPEND);
        } catch (Exception $e) {
            //error_log(print_r($e, true));
            $ret = new stdClass();
            $ret->error = true;
            $ret->http_result_service = "FAIL";
            $ret->http_result_type = "WEB";
            $ret->http_result_code = $e->getCode();
            $ret->http_result_msg = $e->getMessage();
            $ret->action = $method . $method;
            $ret->data1 = $params;

            $datalog .= "\n Request: " . $params;
            $datalog .= "\nURL2: " . $this->mainDomain . $method;
            $date = date('Y-m-d H:i:s');
            $datalog .= "\n[$date] ";
            $datalog .= "[$uid] ";
            $datalog .= "[ERROR]: " . json_encode($ret);
            //file_put_contents("/var/log/defy/ColsanitasWebServices.log", $datalog, FILE_APPEND);
        }

        if ($getResponseToken === true) {
            $token = '{"access_token": "' . $token . '"}';
        }

        return $token;
    }

    private function executeService($method, $params, $type, $token = null, $headers = null, $timeOut = null, $resetHeader = null) {
        //JLog::debug("executeService method: $method");
//         hacer un log antes del request y uno despues.
        //$app->getSharedService('logger')->info("LogDePrueba");
        if (!$timeOut) {
            $timeOut = 15;
        }

        $uid = strtoupper(uniqid("TP_", true));
        //$chatId = $this->session->chat_id;
        $datalog = "";
        try {
            $url = $method;
            $stdate = date('Y-m-d H:i:s');
            $serviceName = $method;
            $datalog = "\n\n";
            $datalog .= "[$stdate] ";
            $datalog .= "[$uid] ";
            $datalog .= "[$serviceName] ";

            $serviceName = $method;
            $nheaders = [];

            if ($resetHeader === null) {
                $nheaders['Content-Type'] = 'application/json';
            }

            if ($token) {
                $nheaders['Authorization'] = "Bearer $token";
            } else {
                if ($token === false) {
                    //$this->sendMsg("Lo sentimos. El sistema de información de citas no esta funcionando en este momento. Por favor intenta nuevamente en 10 minutos");
                    return false;
                }
            }

            if ($headers) {
                //JLog::debug("header  " . json_encode($headers));
                $nheaders = array_merge($nheaders, $headers);
            }

            //JLog::debug("nheaders" . json_encode($nheaders));

            $client = new Client(['verify' => false]);

            $options = [
                'timeout' => $timeOut,
                'headers' => $nheaders,
                'http_errors' => false
            ];

            if ($type == "POST") {
                $options['body'] = $params;
            }

            $startTime = time();

            $response = $client->request($type, $url, $options);

            /* @var $response GuzzleHttp\Psr7\Response */
            if ($response->getStatusCode() > 250) {
                $response_object = $response->getBody();
                echo $response_object;
                //$this->session->setIntoContext("errorConsult", 1);
                //$this->processWsError($response->getStatusCode(), "Error received in Web Service: " . $response->getBody(), $method, $params, $uid, $chatId, $datalog);
            } else {
                //$this->session->setIntoContext("errorConsult", 0);
                $response_object = $response->getBody();
                //JLog::debug("WS execution succes => $response_object");

                if (strpos($response_object, "Servicio No Disponible") !== false) {
                    //$this->session->setIntoContext("errorConsult", 1);
                    //$this->processWsError($response->getStatusCode(), "Error received in Web Service: " . $response->getBody(), $method, $params, $uid, $chatId, $datalog);
                    //JLog::debug("Found error in WS content");
                } else {

                    $endTime = time();
                    $diffSecs = $endTime - $startTime;

                    $datalog .= "\n Request $serviceName: " . $params;
                    $datalog .= "\nURL1: " . $method;
                    $date = date('Y-m-d H:i:s');
                    $datalog .= "\n[$date] ";
                    $datalog .= "[$uid] ";
                    $datalog .= "[{$this->session->chat_id}] ";
                    $datalog .= "Response $serviceName: " . $response_object;
                    //file_put_contents("/var/log/defy/ColsanitasWebServices.log", $datalog, FILE_APPEND);

                    $dataCDR = [];
                    $dataCDR[0] = $date;
                    $dataCDR[1] = $diffSecs;
                    //$dataCDR[2] = $this->session->chat_id;
                    $dataCDR[3] = "SUCCESS";
                    $dataCDR[4] = "$serviceName";
                    if (empty($response_object)) {
                        //Hubo un TimeOut
                        if ($diffSecs > ($timeOut - 1)) {
                            $dataCDR[3] = "TIMEOUT";
                        } else {
                            $dataCDR[3] = "EMPTY";
                        }
                        // file_put_contents("/var/log/defy/CDRColsanitas.csv", implode(";", $dataCDR) . "\n", FILE_APPEND);
                        $this->wsTrys++;
                        if ($this->wsTrys < 2) {
                            return $this->executeService($method, $params, $type, $token, $headers);
                        } else {
                            //$this->session->setIntoContext("error_ws", 1);
                            // $channel = $this->session->getFromContext("channel.channel");
                            // $this->handleResult(self::FAIL, self::WEB, "Colsanitas", "TIMEOUT", "Timeout en webservice", $method, "chat_id: ".$this->session->chat_id." bot_id: ".$this->session->bot_in_use, "Channel: ".$channel, "errorDate: ".date('Y-m-d H:i:s'));
                            //$this->sendMsg("Lo sentimos. El sistema de información de citas no esta funcionando en este momento. Por favor intenta nuevamente en 10 minutos");
                            return false;
                        }
                    } else {
                        //file_put_contents("/var/log/defy/CDRColsanitas.csv", implode(";", $dataCDR) . "\n", FILE_APPEND);
                    }
                }
            }
        } catch (Throwable $e) {
            if (strpos($e->getMessage(), "Operation timed out") !== false) {
                //JLog::debug("Got timeout");
                if (!$this->wsTrys) {
                    $this->wsTrys++;
                    //$channel = $this->session->getFromContext("channel.channel");
                    // $this->handleResult(self::FAIL, self::WEB, "Colsanitas", "TIMEOUT", $e->getMessage(), $method, "chat_id: ".$this->session->chat_id." bot_id: ".$this->session->bot_in_use, "Channel: ".$channel, "errorDate: ".date('Y-m-d H:i:s'));
                    // JLog::debug("Haven't retried yet, retrying....");
                    return $this->executeService($method, $params, $type, $token, $headers);
                }
            }
            //$this->processWsError($e->getCode(), $e->getMessage(), $method, $params, $uid, $chatId, $datalog);
            return false;
        }
        $response_object = str_replace('{"@nil":"true"}', 'NA', $response_object);
        $response = json_decode($response_object);
        return $response;
    }

    public function validarUsuario() {
        $edad = $_POST["edadUsuario"];



        if ($edad >= 18) {
            $valid = 1;
        } else {
            $valid = 0;
        }

        $var = '{
            "mayorEdad": "' . $valid . '"            
        }';

        return $var;
    }

    function generarArray() {

        $response = new \stdClass();

        $nombre = array("Milton", "Santiago", "Paulo");

        $response->dynamicArray[0]->mensaje = "Este es el mensaje para la opción 1 " . $nombre[0] . " " . $_POST["enterprise"];
        $response->dynamicArray[0]->nombre = $nombre[0];
        $response->dynamicArray[0]->email = "Email 1";
        $response->dynamicArray[1]->mensaje = "Este es el mensaje para la opción 2 " . $nombre[1];
        $response->dynamicArray[1]->nombre = $nombre[1];
        $response->dynamicArray[1]->email = "Email 2";
        $response->dynamicArray[2]->mensaje = "Este es el mensaje para la opción 3 " . $nombre[2];
        $response->dynamicArray[2]->nombre = $nombre[2];
        $response->dynamicArray[2]->email = "Email 3";

        return \GuzzleHttp\json_encode($response);
    }

    function crearErrorLog($app) {

        $client = new \App\Utils\CrudApiClient();
        $client->createToken($app, "cTlPZ2I4cTQ4SThSUy83WEpDaGlqekh6MWQrMlpnQ3lLRER0Q3dDelhiQnJKYzg9");
        $data = $client->executeOperation($app, 'create', [
            'model' => 'FluxErrorLog',
            'fields' => [
                [
                    'name' => 'enterprise_id',
                    'value' => $app->request->get('enterprise', 'string'),
                ],
                [
                    'name' => 'error_date',
                    'value' => date("Y-m-d H:i:s")
                ]
            ]
        ]);

        return "OK2";
    }

    function recordarContra() {

        //$tipoIdentificacion = $tipoIdentificacionBeneficiario;
        //$numeroIdentificacion = $IdentificacionBeneficiario;
        //$tipoIdentificacion="TI";
        //$numeroIdentificacion ="1046711415";
        $tipoConsulta = 1;
        $fechaPeticion = "2019-05-01T00:00:00";
        $codAplicacion = "SIE000000136";
        $token = $this->getTokenWs(false);
        //echo $token;
        // JLog::debug("ValidarBeneficiarios");
        //$params = "tipoidentificacion/$tipoIdentificacion/numidentificacion/$numeroIdentificacion/primernombre/null/segundonombre/null/primerapellido/null/segundoapellido/null/fechanacimiento/null/codlegalsucursal/null/nombresucursal/null/tipoempresa/null";

        if ($_POST['useProduction'] == "true") {
            $url = "https://api.colsanitas.com/osi/api/user/userManagement/gestorCredenciales/v1.0.0/recordarContrasena";
        } else {
            $url = "https://papi.colsanitas.com/osi/api/user/userManagement/gestorCredenciales/v1.0.0/recordarContrasena";
        }

        $headers = array("tipoConsulta" => $tipoConsulta, "fechaPeticion" => $fechaPeticion, "CodAplicacion" => $codAplicacion);

        $request = '{
            "usuario" : "1111111.prest"
        }';

        // echo $request;

        $response_object = $this->executeService($url, $request, "POST", $token, $headers);
        //echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return json_encode($response_object);
    }

}

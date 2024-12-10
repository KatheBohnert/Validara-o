<?php
namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception;
use SoapClient;
use SoapHeader;

class StaticExecuteService
{

    public static function createLog($response, $body, $chat_id, $nameFunction, $typeRequest, $nameLog, $headers = ' ', $datosEntrada,$status="N/A")
    {
        try {
            if (gettype($response) == "object") {
                $response = json_encode($response);
            }
            if (gettype($datosEntrada) == "array") {
                $datosEntrada = json_encode($datosEntrada);
            }
            if (gettype($headers) == "array") {
                $headers = json_encode($headers);
            }
            $bodyLog = "Funcion: " . $nameFunction;
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

            $bodyLog = "Type: " . $typeRequest;
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

            $bodyLog = "Headers enviados:" . str_replace(",", "\n", $headers);
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

            $bodyLog = "Datos de entrada: " . $datosEntrada;
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

            $bodyLog = "Body enviado: " . str_replace(" ", "", $body);
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

            $bodyLog = "Status recibido: " . str_replace(" ", "", $status);
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

            $bodyLog = "Respuesta del servicio:" . str_replace(",", "\n", $response);
            \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

        } catch (\Exception $e) {
            return $e;
        }
    }
    
    public static function executeService($chat_identification = null, $nameController = null, $nameFunction = null, $app, $url, $params, $type, $token = null, $headers = null, $params_error_report = null, $nameLog = null, $datosEntrada = null, $timeOut = 15, $resetHeader = null, $getXml = null, $formParams = null)
    {

        \App\Utils\CreateLogs::registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url);

        // $wsTrys  ++;
        $uid = strtoupper(uniqid("TP_", true));
        try {
            $stdate = date('Y-m-d H:i:s');
            $serviceName = $url;
            $nheaders = [];

            if ($resetHeader === null) {
                $nheaders['Content-Type'] = 'application/json';
            }

            if ($token != null) {
                $nheaders['Authorization'] = "Bearer $token";
            }

            if ($headers) {
                $nheaders = array_merge($nheaders, $headers);
            }

            $client = new Client(['verify' => false]);

            $options = [
                'timeout' => $timeOut,
                'headers' => $nheaders,
                'http_errors' => false,
            ];

            if ($type == "POST") {
                $options['body'] = $params;
            };

            if ($formParams && $type == "POST") {
                $options['form_params'] = $params;
                $options['body'] = "";
            };

            if ($type == "PUT") {
                $options['body'] = $params;
            };

            if ($formParams && $type == "PUT") {
                $options['form_params'] = $params;
                $options['body'] = "";
            };

            $startTime = time();

            $response = $client->request($type, $url, $options);

            $response_object = $response->getBody();
            $response_object = str_replace('{"@nil":"true"}', 'NA', $response_object);

            $respuesta = json_decode($response_object);
            $endTime = time();
            $diffSecs = $endTime - $startTime;
            $statusCode = $response->getStatusCode();
            \App\Utils\CreateLogs::registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $statusCode, $respuesta, $diffSecs);
            if ($nameFunction == 'ListVales()') {
                \App\Utils\StaticExecuteService::createLog($response_object, $params, $chat_identification, $nameFunction, $type, $nameLog, $nheaders, $datosEntrada,$statusCode);
            } else {
                \App\Utils\StaticExecuteService::createLog($respuesta, $params, $chat_identification, $nameFunction, $type, $nameLog, $nheaders, $datosEntrada,$statusCode);
            }
            http_response_code($statusCode);
            if ($statusCode < 300 && $statusCode > 199) {
                $response_object = $response->getBody();
                $response_object = str_replace('{"@nil":"true"}', 'NA', $response_object);
                if ($getXml) {
                    //$resXml = json_encode(simplexml_load_string($response_object,'SimpleXMLElement', LIBXML_NOWARNING));
                    $responseXml = simplexml_load_string($response_object);
                    $response = json_encode($responseXml);
                    //return $resXml;
                    return $response;
                }
                $response = json_decode($response_object);
                $response->status = $statusCode;
                return $response;
            } else {
                if ($params_error_report) {
                    $errorReport = [
                        'status' => $statusCode,
                        'url' => $url,
                        'response' => $response_object,
                        'timeResponse' => $diffSecs,
                        'typeService' => $type,
                        'enterprise_id' => $params_error_report["enterprise_id"],
                        'session_id' => $params_error_report["session_id"],
                        'bot_id' => $params_error_report["bot_id"],
                        'convesartion_id' => $params_error_report["convesartion_id"],
                    ];
                } else {
                    $errorReport = [
                        'status' => $statusCode,
                        'url' => $url,
                        'response' => $response_object,
                        'timeResponse' => $diffSecs,
                        'typeService' => $type,
                    ];

                }

                \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
                http_response_code($statusCode);
                return;
                //$this->crearErrorLog($app, $errorReport);
                // if (empty($response_object)) {
                //     if ($wsTrys < 2) {
                //         return executeService($app, $url, $params, $type, $token, $headers);
                //     }
                //     $wstrys = 0;
                // }

                // $badResponse = '{
                //   "status" : "'.$statusCode.'"
                // }';

                return $response_object;

            }

        } catch (\Throwable $e) {
            if ($params_error_report) {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response_object,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                    'enterprise_id' => $params_error_report["enterprise_id"],
                    'session_id' => $params_error_report["session_id"],
                    'bot_id' => $params_error_report["bot_id"],
                    'convesartion_id' => $params_error_report["convesartion_id"],
                ];
            } else {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response_object,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                ];

            }

            \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
            http_response_code(500);
            // echo 'entra al error catch';
            // if (strpos($e->getMessage(), "Operation timed out") !== false) {
            //     if ($wsTrys < 2) {
            //         return executeService($app, $url, $params, $type, $token, $headers);
            //     }
            //     $wstrys = 0;
            // }
            return;
        }
    }

    public static function executeServiceSOAP($chat_identification = null, $nameController = null, $nameFunction = null, $app, $url, array $params, string $type, string $option, $params_error_report = null, $token = null, $headers = null, $timeOut = 15, $resetHeader = '')
    {

        \App\Utils\CreateLogs::registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url);
        $wsTrys++;
        $uid = strtoupper(uniqid("TP_", true));
        try {
            $stdate = date('Y-m-d H:i:s');
            $serviceName = $url;
            $nheaders = [];

            if ($resetHeader === null) {
                $nheaders['Content-Type'] = 'application/soap';
            }

            if ($token != null) {
                $nheaders['Authorization'] = "Bearer $token";
            }

            if ($headers) {
                $nheaders = array_merge($nheaders, $headers);
            }
            $client = new SoapClient($url, ['trace' => 1,
                'stream_context' => stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true,
                    ],
                ]),
            ]);

            $header = new SoapHeader("parama", 'tipoConsulta', '3', false);
            $client->__setSoapHeaders(array($header));
            $options = [
                'timeout' => $timeOut,
                'headers' => $nheaders,
                'http_errors' => false,
            ];

            if ($type == "POST") {
                $options['body'] = $params;
            }

            $startTime = time();
            $result = $client->__soapCall($option, array($params));
            $data = json_encode($result);
            $jsonObject = json_decode($data);
            $endTime = time();
            $diffSecs = $endTime - $startTime;
            $responseHeader = $client->__getLastResponseHeaders();
            $requestHeader = $client->__getLastRequestHeaders();
            $statusCode = substr($responseHeader, 9, 3);
            \App\Utils\CreateLogs::registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $statusCode, $jsonObject, $diffSecs);

            if ($statusCode < 300 && $statusCode > 199) {
                $data = json_encode($result);
                $jsonObject = json_decode($data);
                return $jsonObject;
                //return $response_object;
            } else {
                if ($params_error_report) {
                    $errorReport = [
                        'status' => $statusCode,
                        'url' => $url,
                        'response' => $responseHeader,
                        'timeResponse' => $diffSecs,
                        'typeService' => $type,
                        'enterprise_id' => $params_error_report["enterprise_id"],
                        'session_id' => $params_error_report["session_id"],
                        'bot_id' => $params_error_report["bot_id"],
                        'convesartion_id' => $params_error_report["convesartion_id"],
                    ];
                } else {
                    $errorReport = [
                        'status' => $statusCode,
                        'url' => $url,
                        'response' => $responseHeader,
                        'timeResponse' => $diffSecs,
                        'typeService' => $type,
                    ];

                }

                \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
                if (empty($responseHeader)) {
                    if ($wsTrys < 2) {
                        \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
                    }
                    $wstrys = 0;
                }
                return false;

            }

        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        } catch (Exception $e) {
            trigger_error("Otras fallas Fault: (faultcode: {$e})", E_USER_ERROR);
        }

    }

    public static function executeCurlSOAP($chat_identification = null, $nameController = null, $nameFunction = null, $app, $url, $soap_user, $soap_password, $soap_request, $headers, $nameLog, $datosEntrada, $params_error_report)
    {
        \App\Utils\CreateLogs::registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url);

        $wsTrys++;
        $uid = strtoupper(uniqid("TP_", true));
        try {

            $type = 'SOAP POST';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $soap_user . ":" . $soap_password); // username and password - declared at the top of the doc
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request); // the SOAP request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $response_code = http_response_code($httpcode);
            $info = curl_getinfo($ch);

            if ($response_code < 300 && $response_code > 199) {
                $startTime = time();
                $endTime = time();
                $diffSecs = $endTime - $startTime;

                \App\Utils\CreateLogs::registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $response, $diffSecs);
                \App\Utils\StaticExecuteService::createLog($response, $soap_request, $chat_identification, $nameFunction, $type = "POST", $nameLog, $headers, $datosEntrada,$$response_code);

                curl_close($ch);

                return $response;

            } else {
                $startTime = time();
                $endTime = time();
                $diffSecs = $endTime - $startTime;
                if ($params_error_report) {
                    $errorReport = [
                        'status' => $response_code,
                        'url' => $url,
                        'response' => $response,
                        'timeResponse' => $diffSecs,
                        'typeService' => $type,
                        'enterprise_id' => $params_error_report["enterprise_id"],
                        'session_id' => $params_error_report["session_id"],
                        'bot_id' => $params_error_report["bot_id"],
                        'convesartion_id' => $params_error_report["convesartion_id"],
                    ];
                } else {
                    $errorReport = [
                        'status' => $response_code,
                        'url' => $url,
                        'response' => $response,
                        'timeResponse' => $diffSecs,
                        'typeService' => $type,
                    ];

                }

                \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
                http_response_code($statusCode);
                return;
            }

        } catch (\Throwable $e) {
            $type = "SOAP";
            if ($params_error_report) {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                    'enterprise_id' => $params_error_report["enterprise_id"],
                    'session_id' => $params_error_report["session_id"],
                    'bot_id' => $params_error_report["bot_id"],
                    'convesartion_id' => $params_error_report["convesartion_id"],
                ];
            } else {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                ];

            }

            \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
            http_response_code(500);
            return;
        }

    }


    public static function ErrorReportCari($app, $statusCode = null, $url = null, $response_object = null, $type = null, $params_error_report = null)
    {
        $errorReport = [
            'status' => $statusCode,
            'url' => $url,
            'response' => $response_object,
            'timeResponse' => '0',
            'typeService' => $type,
            'enterprise_id' => $params_error_report["enterprise_id"],
            'session_id' => $params_error_report["session_id"],
            'bot_id' => $params_error_report["bot_id"],
            'convesartion_id' => $params_error_report["convesartion_id"],
        ];
        \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
    }

    public static function executeCurlRest($chat_identification = null, $nameController = null, $nameFunction = null, $app, $url, $headers, $type, $request = null, $nameLog, $datosEntrada)
    {
        \App\Utils\CreateLogs::registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url);

        $wsTrys++;
        $uid = strtoupper(uniqid("TP_", true));
        try {

            $ch = curl_init();

            if ($type == 'GET') {

                $request = $url;

                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_RETURNTRANSFER => true,
                ));

                $response = curl_exec($ch);
            } elseif ($type == 'POST') {

                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => true,
                ));

                $response = curl_exec($ch);
            } elseif ($type == 'PUT') {

                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_CUSTOMREQUEST => 'PUT',
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => true,
                ));

                $response = curl_exec($ch);
            }

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $response_code = http_response_code($httpcode);
            curl_close($ch);

            $startTime = time();
            $endTime = time();
            $diffSecs = $endTime - $startTime;

            \App\Utils\CreateLogs::registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $response, $diffSecs);
            \App\Utils\StaticExecuteService::createLog($response, $request, $chat_identification, $nameFunction, $type, $nameLog, $headers, $datosEntrada,$response_code);

            // curl_close($ch);

            return $response;
        } catch (\Throwable $e) {
            $type = "GET";
            if ($params_error_report) {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                    'enterprise_id' => $params_error_report["enterprise_id"],
                    'session_id' => $params_error_report["session_id"],
                    'bot_id' => $params_error_report["bot_id"],
                    'convesartion_id' => $params_error_report["convesartion_id"],
                ];
            } else {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                ];

            }

            \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
            http_response_code(500);
            return;
        }

    }

    public static function createBancoBogotaLog($response, $body, $chat_id, $nameFunction, $typeRequest, $nameLog, $headers, $datosEntrada, $rqUID)
    {
        try {
            if(gettype($response)=="object"){
                $response = json_encode($response);
            }
                if(gettype($datosEntrada)=="array"){
                    $datosEntrada = json_encode($datosEntrada);
                }
                if(gettype($headers)=="array"){
                    $headers = json_encode($headers);
                }
                $bodyLog= "Funcion: " .$nameFunction;
                \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);
    
                $bodyLog= "Type: " .$typeRequest;
                \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);
    
                $bodyLog= "Headers enviados:".str_replace(",", "\n", $headers);
                \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

                $bodyLog= "Datos de entrada: " .$datosEntrada;
                \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

                $bodyLog= "Body enviado: ".str_replace(" ", "", $body);
                \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);
    
                $nameFunction = str_replace("()", "", $nameFunction);
                
                if ($nameFunction == "getCustomerInfo") {
                    $bancoBogotaFormattedRes = json_decode($response, true);
                    $logArray = [
                        "RqUID" => $rqUID,
                        "Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['StatusCode'],
                        "Severity" => $bancoBogotaFormattedRes['IfxStatus']['Severity'],
                        "Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['StatusDesc'],
                        "Server_Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['ServerStatusDesc'],
                        "Ciiu" => $bancoBogotaFormattedRes["Ciiu"]
                    ];
                } elseif ($nameFunction == "getAuthTokenInfo") {
                    $bancoBogotaFormattedRes = json_decode($response, true);
                    $logArray = [
                        "RqUID" => $rqUID,
                        "Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['StatusCode'],
                        "Severity" => $bancoBogotaFormattedRes['IfxStatus']['Severity'],
                        "Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['StatusDesc'],
                        "Server_Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['ServerStatusDesc'],
                        "Max_Rec" => $bancoBogotaFormattedRes["MaxRec"],
                        "Num_Rec" => $bancoBogotaFormattedRes["NumRec"]
                    ];
                } elseif ($nameFunction == "verifyLine" || $nameFunction == "getCreditCards" || $nameFunction == "getDebitCards" || $nameFunction == "modifyCreditCards") {
                    $bancoBogotaFormattedRes = json_decode($response, true);
                    $logArray = [
                        "RqUID" => $rqUID,
                        "Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['StatusCode'],
                        "Severity" => $bancoBogotaFormattedRes['IfxStatus']['Severity'],
                        "Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['StatusDesc'],
                        "Server_Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['ServerStatusDesc']
                    ];
                } elseif ($nameFunction == 'verifyLine') {
                    $bancoBogotaFormattedRes = json_decode($response, true);
                    $logArray = [
                        "RqUID" => $rqUID,
                        "Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['StatusCode'],
                        "Server_Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['ServerStatusCode'],
                        "Severity" => $bancoBogotaFormattedRes['IfxStatus']['Severity'],
                        "Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['StatusDesc'],
                        "Server_Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['ServerStatusDesc']
                    ];
                } elseif ($nameFunction == "getBalances") {
                    $bancoBogotaFormattedRes = json_decode($response, true);
                    $logArray = [
                        "Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['StatusCode'],
                        "Severity" => $bancoBogotaFormattedRes['IfxStatus']['Severity'],
                        "Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['StatusDesc']
                    ];
                } elseif ($nameFunction == "validateActiveAccounts" || $nameFunction == "accountsFilter" || $nameFunction == "accountsFilter2") {
                    $bancoBogotaFormattedRes = json_decode($response, true);
                    $logArray = [
                        "RqUID" => $rqUID,
                        "Status_Code" => $bancoBogotaFormattedRes['IfxStatus']['StatusCode'],
                        "Severity" => $bancoBogotaFormattedRes['IfxStatus']['Severity'],
                        "Status_Desc" => $bancoBogotaFormattedRes['IfxStatus']['StatusDesc']
                    ];
                }

                 $bodyLog= "Respuesta del servicio: ". json_encode($logArray);
                 \App\Utils\SetLogsPreproduccion::customLogPreproduccion($nameLog, $bodyLog, $chat_id);

    
    
        } catch (\Exception $e) {
            return $e;
        }
    }

    public static function executeCurlRestV2($chat_identification = null, $nameController = null, $nameFunction = null, $app, $url, $headers, $type, $request = null, $nameLog, $datosEntrada, $rqUID)
    {
        \App\Utils\CreateLogs::registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url);

        $wsTrys++;
        $uid = strtoupper(uniqid("TP_", true));
        try {

            $ch = curl_init();

            if ($type == 'GET') {

                $request = $url;

                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_RETURNTRANSFER => true,
                ));

                $response = curl_exec($ch);
            } elseif ($type == 'POST') {

                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => true,
                ));

                $response = curl_exec($ch);
            } elseif ($type == 'PUT') {

                curl_setopt_array($ch, array(
                    CURLOPT_URL => $url,
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_CUSTOMREQUEST => 'PUT',
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => true,
                ));

                $response = curl_exec($ch);
            }

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $response_code = http_response_code($httpcode);
            curl_close($ch);

            $startTime = time();
            $endTime = time();
            $diffSecs = $endTime - $startTime;

            \App\Utils\CreateLogs::registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $response, $diffSecs);
            \App\Utils\StaticExecuteService::createBancoBogotaLog($response, $request, $chat_identification, $nameFunction, $type, $nameLog, $headers, $datosEntrada, $rqUID);
            
            // curl_close($ch);

            return $response;
        } catch (\Throwable $e) {
            $startTime = time();
            $endTime = time();
            $diffSecs = $endTime - $startTime;
            $type = "GET";
            if ($params_error_report) {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                    'enterprise_id' => $params_error_report["enterprise_id"],
                    'session_id' => $params_error_report["session_id"],
                    'bot_id' => $params_error_report["bot_id"],
                    'convesartion_id' => $params_error_report["convesartion_id"],
                ];
            } else {
                $errorReport = [
                    'status' => 500,
                    'url' => $url,
                    'response' => $response,
                    'timeResponse' => $diffSecs,
                    'typeService' => $type,
                ];

            }

            \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);
            http_response_code(500);
            return;
        }

    }
}
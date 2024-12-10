<?php
namespace App\Controllers;

use GuzzleHttp\Exception;
use Utils\SetLogs;

require_once '/var/www/app/controllers/lib/nusoap.php';

class EpmController
{
	public $nameLog = "Epm";
    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $chat_identification = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'convesartion_id' => $_POST['convesartion_id'],
        ];
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];
        $token = $_POST['token'];
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) { //operation
                case "tokenEPM":
                    $response = $this->getTokenEPM($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "consultByCel":
                    $response = $this->consultByCel($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "consultByAcount":
                    $response = $this->consultByAcount($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "consultByDocument":
                    $response = $this->consultByDocument($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "guardar_niu":
                    $response = $this->guardar_niu($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "reportar":
                    $response = $this->reportar($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "tokenSmsEPM":
                    $response = $this->getTokenSmsEPM($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "sendSms":
                    $response = $this->sedSms($app, $params_error_report,$chat_identification);
                    echo $response;
                    break;
                case "getNumber":
                    $response = $this->getNumber($app);
                    echo $response;
                    break;
                case "cleanNums":
                    $response = $this->cleanNums($app);
                    echo $response;
                    break;
                case "getNumberDiv":
                    $response = $this->getNumberDiv($app);
                    echo $response;
                    break;
                case "splitNumberCount":
                    $response = $this->splitNumberCount($app);
                    echo $response;
                    break;
                case "splitNumberIdentificaction":
                    $response = $this->splitNumberIdentificaction($app);
                    echo $response;
                    break;
                case "splitNumberSettled":
                    $response = $this->splitNumberSettled($app);
                    echo $response;
                    break;
                case "splitNumberTel":
                    $response = $this->splitNumberTel($app);
                    echo $response;
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
            $datosEntrada = json_encode($datosEntrada);
            $bodyLog = 'Funcion: ' . $nameFunction . ' ---------Type: ' . $typeRequest . ' ----------Datos de Entrada: ' . $datosEntrada . ' ----------Respuesta del servicio:' . $response;

            \App\Utils\SetLogs::customLog($this->nameLog, $bodyLog, $chat_id);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getNumber($app)
    {
        $numero = $_POST['numeroCel'];
        if (strpos($numero, ' ')) {
            $rest = str_replace(' ', '', $numero);
            if ($rest[0] == 5) {
                $rest = substr($rest, 2, 10);
            }
        } else {
            if ($numero[0] == 5) {
                $rest = substr($numero, 2, 10);
            } else {
                $rest = $numero;
            }
        }
        return $rest;
    }

    public function splitNumberSettled($app)
    {

        $num = $_POST['numSettled'];

        $n = (string) $num;
        $flag;
        if (strlen($n) % 3 == 0) {
            $flag = 1;
        } elseif ((strlen($n) - 1) % 3 == 0) {
            $flag = 2;
        } elseif ((strlen($n) - 2) % 3 == 0) {
            $flag = 3;
        }
        $numDiv = '';
        $numDivR = '';
        $sepDiv = '';
        $flg = 0;
        switch ($flag) {
            case 1:
                ///////
                for ($i = 0; $i <= ((strlen((string) $num)) / 3) - 1; $i++) {
                    if ($i <= 2) {
                        if ($i == 0) {
                            $flg = 0;
                        } else if ($i == 1) {
                            $flg = $i + 2;
                        } else {
                            $flg = $i + 4;
                        }
                        $numDiv = $numDiv . $n[$flg] . ' ' . $n[$flg + 1] . $n[$flg + 2] . ' ';
                    }
                }
                for ($i = 0; $i <= strlen($numDiv); $i++) {
                    if ($i != strlen($numDiv)) {
                        if ($numDiv[$i] == "0" && $numDiv[$i + 1] == "0") {
                            $sepDiv = ' ';
                        }
                        $numDivR = $numDivR . $numDiv[$i] . $sepDiv;
                        $sepDiv = '';
                    }
                }
                //////
                break;
            case 2:
                ///////
                for ($i = 0; $i <= ((strlen((string) $num)) / 3) - 1; $i++) {
                    if ($i <= 2) {
                        if ($i == 0) {
                            $flg = 0;
                        } else if ($i == 1) {
                            $flg = $i + 2;
                        } else {
                            $flg = $i + 4;
                        }
                        $numDiv = $numDiv . $n[$flg + 1] . ' ' . $n[$flg + 2] . $n[$flg + 3] . ' ';
                    }
                }
                for ($i = 0; $i <= strlen($numDiv); $i++) {
                    if ($i != strlen($numDiv)) {
                        if ($numDiv[$i] == "0" && $numDiv[$i + 1] == "0") {
                            $sepDiv = ' ';
                        }
                        $numDivR = $numDivR . $numDiv[$i] . $sepDiv;
                        $sepDiv = '';
                    }
                }
                $numDivR = $n[0] . ' ' . $numDivR;
                //////
                break;
            case 3:
                ///////
                for ($i = 0; $i <= ((strlen((string) $num)) / 3) - 1; $i++) {
                    if ($i <= 2) {
                        if ($i == 0) {
                            $flg = 0;
                        } else if ($i == 1) {
                            $flg = $i + 2;
                        } else {
                            $flg = $i + 4;
                        }
                        $numDiv = $numDiv . $n[$flg + 2] . ' ' . $n[$flg + 3] . $n[$flg + 4] . ' ';
                    }
                }
                for ($i = 0; $i <= strlen($numDiv); $i++) {
                    if ($i != strlen($numDiv)) {
                        if ($numDiv[$i] == "0" && $numDiv[$i + 1] == "0") {
                            $sepDiv = ' ';
                        }
                        $numDivR = $numDivR . $numDiv[$i] . $sepDiv;
                        $sepDiv = '';
                    }
                }
                $numDivR = $n[0] . $n[1] . ' ' . $numDivR;
                //////
                break;
            default:
                break;
        }

        return '{"numDivR" : "' . $numDivR . '"}';

    }

    public function splitNumberIdentificaction($app)
    {
        $num = $_POST['numIdentification'];
        $n = (string) $num;
        $flag;
        if (strlen($n) % 3 == 0) {
            $flag = 1;
        } elseif ((strlen($n) - 1) % 3 == 0) {
            $flag = 2;
        } elseif ((strlen($n) - 2) % 3 == 0) {
            $flag = 3;
        }

        $numDiv = '';
        $flg = 0;
        switch ($flag) {
            case 1:
                for ($i = 0; $i <= ((strlen((string) $num)) / 3) - 1; $i++) {
                    if ($i <= 2) {
                        if ($i == 0) {
                            $flg = 0;
                        } else if ($i == 1) {
                            $flg = $i + 2;
                        } else {
                            $flg = $i + 4;
                        }
                        $numDiv = $numDiv . $n[$flg] . ' ' . $n[$flg + 1] . $n[$flg + 2] . ' ';
                    }
                }
                break;
            case 2:
                for ($i = 0; $i <= ((strlen((string) $num)) / 3) - 1; $i++) {
                    if ($i <= 2) {
                        if ($i == 0) {
                            $flg = 0;
                        } else if ($i == 1) {
                            $flg = $i + 2;
                        } else {
                            $flg = $i + 4;
                        }
                        $numDiv = $numDiv . $n[$flg + 1] . ' ' . $n[$flg + 2] . $n[$flg + 3] . ' ';
                    }
                }
                $numDiv = $n[0] . ' ' . $numDiv;
                break;
            case 3:
                for ($i = 0; $i <= ((strlen((string) $num)) / 3) - 1; $i++) {
                    if ($i <= 2) {
                        if ($i == 0) {
                            $flg = 0;
                        } else if ($i == 1) {
                            $flg = $i + 2;
                        } else {
                            $flg = $i + 4;
                        }
                        $numDiv = $numDiv . $n[$flg + 2] . ' ' . $n[$flg + 3] . $n[$flg + 4] . ' ';
                    }
                }
                $numDiv = $n[0] . $n[1] . ' ' . $numDiv;
                break;

            default:
                break;
        }
        return '{"numDiv" : "' . $numDiv . '"}';

    }

    public function splitNumberCount($app)
    {
        $num = $_POST['numCount'];

        $n = (string) $num;
        $numDiv = '';
        $numDivR = '';
        $sepDiv = '';
        $flg = 0;

        for ($i = 0; $i <= strlen($n); $i++) {
            if ($i <= 2) {
                if ($i == 0) {
                    $flg = 0;
                } else if ($i == 1) {
                    $flg = $i + 2;
                } else {
                    $flg = $i + 4;
                }
                $numDiv = $numDiv . $n[$flg] . ' ' . $n[$flg + 1] . $n[$flg + 2] . ' ';
            }
        }
        for ($i = 0; $i <= strlen($numDiv); $i++) {
            if ($i != strlen($numDiv)) {
                if ($numDiv[$i] == "0" && $numDiv[$i + 1] == "0") {
                    $sepDiv = ' ';
                }
                $numDivR = $numDivR . $numDiv[$i] . $sepDiv;
                $sepDiv = '';
            }
        }
        return '{"numDivR" : "' . $numDivR . '"}';

    }

    public function splitNumberTel($app)
    {

        $num = $_POST['numCel'];
        $n = (string) $num;
        $numDiv = '';
        $numDivR = '';
        $sepDiv = '';

        $numDiv = $n[0] . ' ' . $n[1] . $n[2] . ' ' . $n[3] . ' ' . $n[4] . $n[5] . ' ' . $n[6] . $n[7] . ' ' . $n[8] . $n[9];

        for ($i = 0; $i <= strlen($numDiv); $i++) {
            if ($i != strlen($numDiv)) {
                if ($numDiv[$i] == "0" && $numDiv[$i + 1] == "0") {
                    $sepDiv = ' ';
                }
                $numDivR = $numDivR . $numDiv[$i] . $sepDiv;
                $sepDiv = '';
            }
        }
        return '{"numDivR" : "' . $numDivR . '"}';

    }

    public function getNumberDiv($app)
    {
        $numeroEdit = $_POST['$numeroEdit'];
        $pos = strpos($numeroEdit, '*');

        if ($pos) {
            return '{"numDiv" : "5"}';
        } else {
            $numDiv = ' ';
            $arrayNums = str_split($numeroEdit);

            for ($i = 0; $i < count($arrayNums); $i++) {
                if (($i % 2) == 0) {
                    $numDiv = $numDiv . $arrayNums[$i];
                } else {
                    $numDiv = $numDiv . $arrayNums[$i] . ' ';
                }
            }
            return '{"numDiv" : "' . $numDiv . '"}';
        }
    }

    public function cleanNums($app)
    {
        $numero = $_POST['numeroC'];
        if (strpos($numero, ' ')) {
            $rest = str_replace(' ', '', $numero);
        } else {
            $rest = $numero;
        }
        return $rest;
    }

    public function getTokenEPM($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $nameFunction = "getTokenEPM()";
        $userPass = $_POST['usuario'];
        $passwordEPM = $_POST['contrasena'];

        if ($_POST['useProduction'] == "true") {
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/token";
        } else {
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/token";
        }

        $request = '{
            "usuario" : "' . $userPass . '",
	    "contrasena" : "' . $passwordEPM . '"
        }';

        // echo $request;
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm");

		//$response_object = $this->executeService($app, $url, $request, "POST", $token, $headers);
        //echo json_encode($response_object);

        if ($response_object->status !== 200) {
            //Ws Caidos! saliendo
            return '{"status" :"' . $response_object->status . '"}';
        }
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return '{"status" :"' . $response_object->status . '"}';
        }

        return json_encode($response_object);
    }

    public function consultByCel($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $celular = $_POST['celular'];
        $tokenAut = $_POST['tokenAut'];
        $nameFunction = "consultByCel()";
        $nameController = "EpmController";

        if ($_POST['useProduction'] == "true") {

            $url = "https://portalos.outsourcing.com.co:9317/ConsultarCelular";
            $request = '{
	    		"usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
			"contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
		    	"celular" : "' . $celular . '"
			}';
        } else if ($_POST['useProduction'] == "1") {

             $url = "https://portalos.outsourcing.com.co:9317/ConsultarCelular";
            $request = '{
	    		"usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
			"contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
		    	"celular" : "' . $celular . '"
			}';
        } else {
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/celular";
            $headers = array("Authorization" => $tokenAut);
            $request = '{
		    "celular" : "' . $celular . '"
		}';
        }

//         $response_object = $this->executeService($app, $url, $request, "POST", $token, $headers);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm");

		if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        $ListadoCuentas = array();

        if (count($response_object->direcciones) == '0') {
            return json_encode($response_object);
        } else {
            $longitud = count($response_object->direcciones);
            for ($i = 0; $i < $longitud; $i++) {
                if ($response_object->direcciones[$i]->direccion !== '') {
                    array_push($ListadoCuentas, $response_object->direcciones[$i]);
                }
            }
        }

        $longitudCuentas = sizeof($ListadoCuentas);
        $response = new \stdClass();
        $response->codigo_cel = $response_object->codigo;
        $response->cantidadDir = count($response_object->direcciones);

        for ($i = 0; $i < $longitudCuentas; $i++) {
            $initials = array(
                'CRA', 'CR', 'CLL', ' C ', ' CAS ', 'VDA', 'MNZ',
                ' M ', 'MNA', ' AV ', 'PSO', ' P ', 'PIS', 'PS',
                'BRR', 'INT', 'ALT', 'SUB', 'APT', 'ESQ', 'SEC',
                'LOC', 'PARQ', 'GAR', 'TV');
            $meaning = array(
                'carrera', 'carrera', 'calle', ' casa ', ' casa ',
                'Vereda', ' Manzana ', ' Manzana ', ' Manzana ',
                'Avenida', ' Piso ', ' Piso ', ' Piso ', ' Piso ',
                'Barrio', 'Interior', 'Alto', 'Bajos', 'Apartamento',
                'Esquina', 'Sector', 'Local', 'Parqueadero', 'Garage', 'transversal');
            $msg = $ListadoCuentas[$i]->direccion;
            $output = str_replace($initials, $meaning, $msg);
            $position = $i + 1;
            if ($ListadoCuentas[$i]->direccion === 'NINGUNA') {
                $response->dynamicArray[$i]->mensaje_cel = "Seleccione opción " . $position . ". Repetir el menú.  ";
            } else {
                $dirDiv = str_replace(' ', '. ', $ListadoCuentas[$i]->direccion);
                $response->dynamicArray[$i]->mensaje_cel = "Seleccione opción " . $position . " .$output. ";
            }
            $response->dynamicArray[$i]->direccion_cel = $output;
            $response->dynamicArray[$i]->cuenta_cel = $ListadoCuentas[$i]->cuenta;
        };

        if (count($response_object->direcciones) == '2') {
            $opcionAsesor = $position;
        } else {
            $opcionAsesor = $position + 1;
        }
        $response->dynamicArray[$i]->mensaje_cel = "Seleccione opción " . $opcionAsesor . ". Ninguna de las anteriores. ";
        $response->dynamicArray[$i]->direccion_cel = ' ';
        $response->dynamicArray[$i]->cuenta_cel = '1';

        if (count($response_object->direcciones) == '2') {
            unset($response->dynamicArray[1]);
        }

        $object = json_encode($response);
        return \GuzzleHttp\json_encode($response);

    }

    public function reportar($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $cuenta = $_POST['cuenta'];
        $codigo = $_POST['codigo'];
        $user_name = $_POST['nombre_usuario'];
        $description = $_POST['descripcion_evento'];
        $celular_radicado = $_POST['celular_radicado'];
        $tokenAut = $_POST['tokenAut'];
        $idLlamada = $_POST['idLlamada'];
        $nameFunction = "reportar()";

        if ($_POST['useProduction'] == "true") {
            $url = "https://portalos.outsourcing.com.co:9317/GenerarReporte";
            $request = '{
		  "usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
		  "contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
		  "cuenta" : "' . $cuenta . '",
		  "codigo" : "' . $codigo . '",
		  "nombre_usuario" : "' . $user_name . '",
		  "descripcion_evento" : "' . $description . '",
		  "celular_radicado" : "' . $celular_radicado . '",
		  "idLlamada": "' . $idLlamada . '"
		}';
        } else {
            $headers = array("Authorization" => $tokenAut);
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/reportar";
            $request = '{
		    "cuenta" : "' . $cuenta . '",
		    "codigo" : "' . $codigo . '",
		    "nombre_usuario" : "' . $user_name . '",
		    "descripcion_evento" : "' . $celular_radicado . '",
		    "celular_radicado" : "' . $celular_radicado . '"
		}';
        }

        $app->getSharedService('logger')->info("request:" . $request);

        //$response_object = $this->executeService($app, $url, $request, "POST", $token, $headers);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm", $timeOut = 30, $resetHeader = null, $getXml = null);
       
		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
        //return '{"radicado" : "'.$numDiv.'"}';

        if ($response_object->radicado) {
            return '{
		"radicado" : "' . $response_object->radicado . '"
		}';
        } else {
            return '{
		"radicado" : "0"
		}';
        }

    }

    public function consultByAcount($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $cuenta = $_POST['cuenta'];
        $tokenAut = $_POST['tokenAut'];
        $headers = array("Authorization" => $tokenAut);
		$nameFunction = "consultByAcount()";
        if ($_POST['useProduction'] == "true") {
            $url = "https://portalos.outsourcing.com.co:9317/ConsultarCuenta";
            $request = '{
		"usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
		"contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
            	"cuenta" : "' . $cuenta . '"
        	}';
        } else if ($_POST['useProduction'] == "1") {

            $url = "https://portalos.outsourcing.com.co:9317/ConsultarCuenta";
            $request = '{
	    		"usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
			"contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
		    	"cuenta" : "' . $cuenta . '"
			}';
        } else {
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/cuenta";
            $request = '{
            	"cuenta" : "' . $cuenta . '"
        	}';
        }

        // echo $request;

        //$response_object = $this->executeService($app, $url, $request, "POST", $token, $headers);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm");


		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        if ($response_object->status) {
            $object = json_encode($response_object);
            if ($response_object->corte) {
                return '{
				"tipoError" : "1"
			}';
            } else {
                return $object;
            }
        } else {
            $object = json_decode($response_object);

            if ($object->errors[0]->msg === 'This user already made a report in the last twenty-four hours') {
                return '{
				"tipoError" : "1"
			}';

            }

            if ($object->errors[0]->msg === 'Account not found') {
                return '{
				"tipoError" : "2"
			}';
            }

            if ($object->errors[0]->msg === 'The account must has nine digits') {
                return '{
				"tipoError" : "3"
			}';
            }

//         return $response_object;
        }
    }

    public function consultByDocument($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $nameFunction = "consultByDocument()";
        $documento = $_POST['documento'];
        $tokenAut = $_POST['tokenAut'];
        $headers = array("Authorization" => $tokenAut);

        if ($_POST['useProduction'] == "true") {
            $url = "https://portalos.outsourcing.com.co:9317/ConsultarDocumento";
            $request = '{
		"usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
		"contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
            	"documento" : "' . $documento . '"
        	}';
        } else {
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/documento";
            $request = '{
           	"documento" : "' . $documento . '"
        	}';
        }

//         $response_object = $this->executeService($app, $url, $request, "POST", $token, $headers);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm");

		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        $ListadoCuentas = array();

        if (count($response_object->direcciones) == '0') {
            return "1";
        } else {
            $longitud = count($response_object->direcciones);
            for ($i = 0; $i < $longitud; $i++) {
                if ($response_object->direcciones[$i]->direccion !== '') {
                    array_push($ListadoCuentas, $response_object->direcciones[$i]);
                }
            }
        }

        $longitudCuentas = sizeof($ListadoCuentas);
        $response = new \stdClass();
        $response->codigo_doc = $response_object->codigo;
        for ($i = 0; $i < $longitudCuentas; $i++) {
            $initials = array(
                'CRA', 'CR', 'CLL', ' C ', ' CAS ', 'VDA', 'MNZ',
                ' M ', 'MNA', ' AV ', 'PSO', ' P ', 'PIS', 'PS',
                'BRR', 'INT', 'ALT', 'SUB', 'APT', 'ESQ', 'SEC',
                'LOC', 'PARQ', 'GAR', 'TV');
            $meaning = array(
                'carrera', 'carrera', 'calle', ' casa ', ' casa ',
                'Vereda', ' Manzana ', ' Manzana ', ' Manzana ',
                'Avenida', ' Piso ', ' Piso ', ' Piso ', ' Piso ',
                'Barrio', 'Interior', 'Alto', 'Bajos', 'Apartamento',
                'Esquina', 'Sector', 'Local', 'Parqueadero', 'Garage', 'transversal');
            $msg = $ListadoCuentas[$i]->direccion;
            $output = str_replace($initials, $meaning, $msg);
            $position = $i + 1;
            if ($ListadoCuentas[$i]->direccion === 'NINGUNA') {
                $response->dynamicArray[$i]->mensaje_doc = "Seleccione opción " . $position . ". Repetir el menú.";
            } else {
                $dirDiv = str_replace(' ', '. ', $ListadoCuentas[$i]->direccion);
                $response->dynamicArray[$i]->mensaje_doc = "Seleccione opción " . $position . " .$output.";
            }
            $response->dynamicArray[$i]->direccion_doc = $output;
            $response->dynamicArray[$i]->cuenta_doc = $ListadoCuentas[$i]->cuenta;

        };
        if (count($response_object->direcciones) == '2') {
            $opcionAsesor = $position;
        } else {
            $opcionAsesor = $position + 1;
        }
        $response->dynamicArray[$i]->mensaje_doc = "Seleccione opción " . $opcionAsesor . ". Ninguna de las anteriores. ";
        $response->dynamicArray[$i]->direccion_doc = ' ';
        $response->dynamicArray[$i]->cuenta_doc = '1';

        if (count($response_object->direcciones) == '2') {
            unset($response->dynamicArray[1]);
        }

        return \GuzzleHttp\json_encode($response);
    }

    public function guardar_niu($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $nameFunction = "guardar_niu()";
        $cuenta = $_POST['cuenta'];
        $codigo = $_POST['codigo'];
        $tokenAut = $_POST['tokenAut'];
        $headers = array("Authorization" => $tokenAut);

        if ($_POST['useProduction'] == "true") {
            $url = "https://portalos.outsourcing.com.co:9317/GuardarCuenta";
            $request = '{
		"usuario":"cmVwb3J0ZXNfY29udGFjdF91bWFuaXphbGVz",
		"contrasena":"YzBudDdjdF91bTduaXo3bDNzKg==",
            	"cuenta" : "' . $cuenta . '",
            	"codigo" : "' . $codigo . '"
        	}';
        } else {
            $url = "https://chatbotchecserver.com:4443/contact-reportes/api/guardar_niu";
            $request = '{
            	"cuenta" : "' . $cuenta . '",
            	"codigo" : "' . $codigo . '"
        	}';
        }

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm");


		if ($response_object->errors[0]->msg === "This user already made a report in the last twenty-four hours") {
            return '{
		 	"statusF" : "0"
		 }';
        } else {
            if ($response_object->status) {
                if ($response_object->corte) {
                    return $respuesta = '{
				"status" : "' . $response_object->status . '",
				"codigo" : "' . $response_object->codigo . '",
				"corte" : "1",
				"indisponibilidad" : "' . $response_object->indisponibilidad . '",
				"mensaje" : "' . $response_object->mensaje . '"
			}';
                } else {
                    return $respuesta = '{
				"status" : "' . $response_object->status . '",
				"codigo" : "' . $response_object->codigo . '",
				"corte" : "0",
				"indisponibilidad" : "' . $response_object->indisponibilidad . '",
				"mensaje" : "' . $response_object->mensaje . '"
			}';
                }
            } else if (($object->errors[0]->msg === 'This user already made a report in the last twenty-four hours')) {

                return '{
		 	"statusF" : "0"
		 }';
            }
        }

    }

    public function getTokenSmsEPM($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $nameFunction = "getTokenSmsEPM()";
        $userPass = $_POST['usuario'];
        $passwordEPM = $_POST['contrasena'];

        if ($_POST['useProduction'] == "true") {
            $url = "https://videochat.outsourcing.com.co:487/api/login/authenticate";
        } else {
            $url = "https://videochat.outsourcing.com.co:487/api/login/authenticate";
        }

        $request = '{
        "Username" : "' . $userPass . '",
	    "Password" : "' . $passwordEPM . '"
        }';

        // echo $request;

//         $response_object = $this->executeService($app, $url, $request, "POST", $token, $headers);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report,"Epm");

		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }
        $res = substr($response_object, 1, -1);

        $response = '{
        "token_sms":"' . $response_object . '"
        }';

        return $response;
    }

    public function sedSms($app, $params_error_report,$chat_identification)
    {
        $nameController = 'EpmController';
        $nameFunction = "sedSms()";
        $idCampana = $_POST['idCampana'];
        $Celular = $_POST['Celular'];
        $Mensaje = $_POST['Mensaje'];
        $tokenSms = $_POST['tokenSms'];

        if ($_POST['useProduction'] == "true") {
            $url = "https://videochat.outsourcing.com.co:487/api/SMS?idCampana=" . $idCampana . "&Celular=" . $Celular . "&Mensaje=" . $Mensaje;
        } else {
            $url = "https://videochat.outsourcing.com.co:487/api/SMS?idCampana=" . $idCampana . "&Celular=" . $Celular . "&Mensaje=" . $Mensaje;
        }
        $headers = [
            "Authorization" => $tokenSms,
        ];

//         $response_object = $this->executeService($app,$url, '', "GET", $token, $headers, $params_error_report);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_identification, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report,"Epm");
		
		//echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return json_encode($response_object);
    }

}

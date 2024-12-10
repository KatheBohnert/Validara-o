<?php

namespace App\Controllers;

use Controllers\lib;
use Phalcon\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use SoapClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class DpsController
{

	public function process(\Phalcon\Mvc\Micro $app)
	{

		header('Access-Control-Allow-Origin: *');
		$chat_identification = $_POST['chat_identification'];
		$params_error_report = [
			'enterprise_id' => $_POST['enterprise_id'],
			'session_id' => $_POST['session_id'],
			'bot_id' => $_POST['bot_id'],
			'convesartion_id' => $_POST['convesartion_id']
		];
		$operation = $_POST['operation'];
		$useProduction = $_POST['useProduction'];
		$token = $_POST['token'];
		if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
			switch ($operation) { //operation
				case "uploadImg":
					$response = $this->uploadImg($app);
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

	function uploadImg($app)
	{
		$url_img = $_POST['urlimg'];
		$interaccion_id = $_POST['interaccion_id'];
		$interaccion_fecha = $_POST['interaccion_fecha'];
		$remitente = $_POST['remitente'];
		$cliente_identificacion = $_POST['cliente_identificacion'];
		$cliente_nombre = $_POST['cliente_nombre'];
		$titular_cedula = $_POST['titular_cedula'];
		$titular_fecha_expedicion = $_POST['titular_fecha_expedicion'];
		$beneficiario_identificacion = $_POST['beneficiario_identificacion'];
		$departamento = $_POST['departamento'];
		$municipio = $_POST['municipio'];
		$direccion = $_POST['direccion'];

		$apiTk = $_POST['apiTk'];

		$curl = curl_init();

		$fileNameArray = explode("/", $url_img);
		$positionName = count($fileNameArray) - 1;
		$fileName = $fileNameArray[$positionName];
		$testPut = file_put_contents($fileName, file_get_contents($url_img));

		$cfile =  new \CURLFile('/var/www/app/' . $fileName);


		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://dps.iq-online.net.co/api/trasladoiva',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => array(
				'interaccion_id' => $interaccion_id,
				'interaccion_fecha' => $interaccion_fecha,
				'remitente' => $remitente,
				'cliente_identificacion' => $cliente_identificacion,
				'cliente_nombre' => $cliente_nombre,
				'titular_cedula' => $titular_cedula,
				'titular_fecha_expedicion' => $titular_fecha_expedicion,
				'beneficiario_identificacion' => $beneficiario_identificacion,
				'departamento' => $departamento,
				'municipio' => $municipio,
				'direccion' => $direccion,
				'file_name' => $cfile
			),
			CURLOPT_HTTPHEADER => array(
				'API-TK: ' . $apiTk . ''
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
}

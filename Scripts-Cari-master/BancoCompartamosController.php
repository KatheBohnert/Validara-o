<?php
namespace App\Controllers;

require_once '/var/www/app/controllers/lib/nusoap.php';
use App\Controllers\SoundlutionsUtilsController;

class BancoCompartamosController
{
  private $nameLog = "BancoCompartamosController";
    public function process(\Phalcon\Mvc\Micro$app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "BancoCompartamosController";
        $chat_id = $_POST['chat_identification'];
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
                case "rescateForm":
                   $response = $this->rescateForm($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
		case "testFunction":
                   $response = $this->testFunction($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
		case "rescateFormCurl":
                   $response = $this->rescateFormCurl($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
		case "generateRfc":
                   $response = $this->generateRfc($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
		case "nameValid":
                   $response = $this->nameValid($app, $params_error_report, $nameController, $chat_id);
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


    public function rescateForm($app, $params_error_report, $nameController, $chat_id)
    {
	$response_object ="1";
        return $response_object;
    }
    public function testFunction($app, $params_error_report, $nameController, $chat_id){
	$nameFunction = "getToken";

	 return $nameFunction;
    }
    public function nameValid($app, $params_error_report, $nameController, $chat_id){
	$nameUser = $_POST['nameUser'];
	$arrayNombre = explode(" ", $nameUser); 
	$lengthArray = count($arrayNombre);
	$nameFunction = "nameValid";
	    
	$validReturn=0;
	    if($lengthArray<3){
		    $validReturn=0;
	    }else{
		    $validReturn=1;
	    }
	 return $validReturn;
    }
    public function generateRfc($app, $params_error_report, $nameController, $chat_id): string
    {
        $nameFunction = "generateRfc";
        $name = $_POST['name'];
        $date = $_POST['date'];

        $date = str_replace('/', '-', $date);
        $rfcYear = SoundlutionsUtilsController::getYear($date);
        $rfcMonth = SoundlutionsUtilsController::getMonth($date);
        $rfcDay = SoundlutionsUtilsController::getDay($date);

        $datosArray = '{
            "name":"' .$name. '",
            "date":"' .$date. '",
            "añoRfc":"'.$rfcYear.'",
            "mesRfc":"'.$rfcMonth.'",
            "diaRfc":"'.$rfcDay.'",
        }';

        $arrayNombre = explode(" ", $name);
        $primera = strtoupper(substr($arrayNombre[1], 0, 2));
        $segunda = strtoupper(substr($arrayNombre[2], 0, 1));
        $tercera = strtoupper(substr($arrayNombre[0], 0, 1));
        $rfc = "$primera$segunda$tercera$rfcYear$rfcMonth$rfcDay";
        $createLog = \App\Utils\StaticExecuteService::createLog($rfc, $datosArray, "111", $nameFunction, "Controller", "BancoCompartamos", $headers = ' ', $datosArray);
        return $rfc;
    }

    public function quitarTildes($texto) {
	    $texto_sin_tildes = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
	    $caracteres_a_reemplazar = array(',', '`', '-', '/', ';', ':', '?', '¿', '!', '¡');
	    $texto_sin_caracteres = str_replace($caracteres_a_reemplazar, ' ', $texto_sin_tildes);
	    return $texto_sin_caracteres;   
	}
	
    public function rescateFormCurl($app, $params_error_report, $nameController, $chat_id){
	$nameFunction = "rescateFormCurl";
	$nullVar = "null";
	    
	$id_unico = $_POST['id_unico'];
        $canal = stripos($_POST['canal'], '[') !== false ? $nullVar : $_POST['canal'];
        $cliente_actual = stripos($_POST['cliente_actual'], '[') !== false ? $nullVar : $_POST['cliente_actual'];
	$nombre = stripos($_POST['nombre'], '[') !== false ? $nullVar : $_POST['nombre'];
	$telefono =  stripos($_POST['telefono'], '[') !== false ? $nullVar : $_POST['telefono'];
	$genero = stripos($_POST['genero'], '[') !== false ? $nullVar : $_POST['genero'];
	$fecha_nacimiento = stripos($_POST['fecha_nacimiento'], '[') !== false ? $nullVar : $_POST['fecha_nacimiento'];
	$rfc = stripos($_POST['rfc'], '[') !== false ? $nullVar : $_POST['rfc'];
	$domicilio = stripos($_POST['domicilio'], '[') !== false ? $nullVar : $_POST['domicilio'];
	$score_exitoso= stripos($_POST['score_exitoso'], '[') !== false ? $nullVar : $_POST['score_exitoso'];
	$monto = stripos($_POST['monto'], '[') !== false ? $nullVar : $_POST['monto'];
	$tipo_negocio = stripos($_POST['tipo_negocio'], '[') !== false ? $nullVar : $_POST['tipo_negocio'];
	$anti_negocio = stripos($_POST['anti_negocio'], '[') !== false ? $nullVar : $_POST['anti_negocio'];
	$cp = stripos( $_POST['cp'], '[') !== false ? $nullVar : $_POST['cp'];
	$giro_negocio = stripos($_POST['giro_negocio'], '[') !== false ? $nullVar : $_POST['giro_negocio'];
	$casa_mismo_domicilio_negocio = stripos($_POST['casa_mismo_domicilio_negocio'], '[') !== false ? $nullVar : $_POST['casa_mismo_domicilio_negocio'];
	$direccion_negocio = stripos($_POST['direccion_negocio'], '[') !== false ? $nullVar : $_POST['direccion_negocio'];
	$acepto_oferta = "null";
	$folio = stripos($_POST['folio'], '[') !== false ? $nullVar : $_POST['folio'];
	$medio = stripos($_POST['medio'], '[') !== false ? $nullVar : $_POST['medio'];
	$campana = stripos($_POST['campana'], '[') !== false ? $nullVar : $_POST['campana'];
	$formato = stripos($_POST['formato'], '[') !== false ? $nullVar : $_POST['formato'];
	$curl = curl_init();
	    
	$fechaFormat  = date('Y-m-d', strtotime($fecha_nacimiento));

	$dataArrayServ = '{
	 "PARAMETERS": {
	 "id_unico":"' .$id_unico. '",
	 "canal":"' .$canal. '",
	 "cliente_actual":"' .$cliente_actual. '",
	 "nombre":"'. $this->quitarTildes($nombre) . '",
	 "telefono":"' .$telefono. '",
	 "genero":"' .$genero. '",
	 "fecha_nacimiento":"' .$fechaFormat. '",
	 "rfc":"' .$rfc. '",
	 "domicilio":"' .$domicilio. '",
	 "score_exitoso":"' .$score_exitoso. '",
	 "monto":"' .$monto. '",
	 "tipo_negocio":"' .$tipo_negocio. '",
	 "antigüedad_negocio":"' .$anti_negocio. '",
	 "cp":"' .$cp. '",
	 "giro_negocio":"' .$giro_negocio. '",
	 "casa_mismo_domicilio_negocio":"' .$casa_mismo_domicilio_negocio. '",
	 "direccion_negocio":"' .$direccion_negocio. '",
	 "acepto_oferta":"' .$acepto_oferta. '",
	 "folio":"' .$folio. '",
	 "medio":"' .$medio. '",
	 "campana":"' .$campana. '",
	 "formato":"' .$formato. '"
	 }
	 } 
	';

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://187.248.67.118:8052/db/srv/CompartamosCHB',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>$dataArrayServ,
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json'
	  ),
	));
	
	$response = curl_exec($curl);
	$info = curl_getinfo($curl);
	$codeHtpp= $info[http_code];
	$createLog = \App\Utils\StaticExecuteService::createLog($response, $dataArrayServ, $id_unico, $nameFunction, "POST", "BancoCompartamos", $headers = ' ', $dataArrayServ);
	curl_close($curl);

	if($codeHtpp !== 200){
		$response = "Error Servicio";
	}
	return $response;

    }


}

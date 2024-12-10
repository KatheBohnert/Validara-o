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
class JuanviController
{

    public $nameLog = "JuanviController";
    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "JuanviController";
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
        $hashKey = '1PzZk9z5WXaBX7xdTBTE';
        $partnerCode = 'CARIAI';
        $tokenUrl = 'https://dev.34-149-116-245.nip.io/token';
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) { //operation
                case "getEndpoints":
                    $response = $this->getEndpoints($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;

                case 'getPatientData':
                    $response = $this->getPatientDataTest($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getCitiesTest':
                    $response = $this->getCitiesTest($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getBranchesTest':
                    $response = $this->getBranchesTest($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;

                case 'getCityNameTest':
                    $response = $this->getNameByCodeTest($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;

                case 'getBranchNameTest':
                    $response = $this->getNameByCodeTest($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;

                case 'getBookingsTest':
                    $response = $this->getBookingsTest($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;

                case 'apigeeGetBookings':
                    $response = $this->apigeeGetBookings($app, $params_error_report, $nameController, $chat_id, $tokenUrl);
                    echo $response;
                    break;

                case 'testingMethod':
                    $response = 'Método disponible para pruebas';
                    echo $response;
                    break;

                case 'consultPatient':
                    $response = $this->consultPatient($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;

                case 'obtainDataTemp':
                    $response = $this->tempGetData();
                    echo $response;
                    break;

                case "fakeData":
                    $response = $this->fakeDataArray();
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

    public function getEndpoints($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'JuanviController';
        $nameFunction = "getEndpoints()";
        $url = "https://rickandmortyapi.com/api";
        $headers = array("Content-Type" => "application/json");

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, '', "GET", null, $headers, $params_error_report, "JuanviController");

        return json_encode($response_object);
    }


  //practicas-Kathe
  public function getProgramData(){
    $nameController = 'JuanviController';
    $nameFunction = 'getProgramData';
    $url = "https://api.sampleapis.com/simpsons/episodes" ;
    $headers = array("Content-Type" => "application/json");
    $response_object =  \App\Utils\StaticExecuteService::executeService($nameController, $nameFunction, $url, $headers, "", "GET", null,"JuanviController");
    return json_encode($response_object);
}



    public function getPatientDataTest($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "getPatientDataTest()";

        $baseUrl = $_POST['baseUrl'];
        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];

        $datos = [
            'chat_id' => $chat_id,
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'idType' => $idType,
            'idNumber' => $idNumber
        ];

        $headers = [
            "Cache-Control" => "no-cache"
        ];

        $url = $baseUrl . 'getPatientData?hashKey=' . $hashKey . '&partnerCode=' . $partnerCode . '&tipoIdentificacion=' . $idType . '&numeroIdentificacion=' . $idNumber;

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
            $chat_id, $nameController, $nameFunction, $app, $url, $headers, 'GET',
            null, $this->nameLog, $datos
        );

        $data = json_decode($response_object, true);

        return "Este es el nombre: " . $data['nombre'];
    }

    public function getCitiesTest($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "getCitiesTest()";

        $baseUrl = $_POST['baseUrl'];

        $datos = [
            'chat_id' => $chat_id,
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
        ];

        $headers = [
            "Cache-Control" => "no-cache"
        ];

        $url = $baseUrl . 'getCities?hashKey=' . $hashKey . '&partnerCode=' . $partnerCode;

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);
        $cities = $data['cities'];

        $citiesSelector = "";

        foreach ($cities as $city) {
            $formattedString = "@" . $city['code'] . "@i@" . $city['name'];
            $citiesSelector .= $formattedString . "@,";
        }

        $citiesSelector = substr($citiesSelector, 1);
        $citiesSelector = rtrim($citiesSelector, "@,");

        return '{
            "cities": "'.$citiesSelector.'"
        }';
    }

    public function getBranchesTest($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "getBranchesTest()";

        $baseUrl = $_POST['baseUrl'];
        $hashKey = $_POST['hashKey'];
        $partnerCode = $_POST['partnerCode'];
        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $companyCode = $_POST['codigoCia'];
        $planCode = $_POST['planCode'];
        $cityCode = $_POST['codigoCiudad'];
        $attentionType = $_POST['tipoAtencion'];
        $regionCode = $_POST['codigoRegion'];

        $datos = [
            'urlBase' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'tipoIdentificacion' => $idType,
            'numeroIdentificacion' => $idNumber,
            'codigoCia' => $companyCode,
            'codigoPlan' => $planCode,
            'codigoCiudad' => $cityCode,
            'tipoAtencion' => $attentionType,
            'codigoRegion' => $regionCode
        ];

        $headers = [
            'Cache-Control' => 'no-cache'
        ];

        $url = $baseUrl
            . 'getBranches?hashKey=' . $hashKey
            . '&partnerCode=' . $partnerCode
            . '&tipoIdentificacion=' . $idType
            . '&numeroIdentificacion=' . $idNumber
            . '&codigoCia=' . $companyCode
            . '&codigoPlan=' . $planCode
            . '&codigoCiudad=' . $cityCode
            . '&tipoDeAtencion=' . $attentionType;

        if ($regionCode) {
            $url = $url . '&codigoRegion=' . $regionCode;
        }

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
            $chat_id, $nameController, $nameFunction, $app, $url, $headers,
            'GET', null, $this->nameLog, $datos
        );
        $data = json_decode($response_object, true);

        $branches = $data['branches'];
        $branchesSelector = '';

        foreach ($branches as $branch) {
            $addressInit = $branch['address'];
            $pattern = '/,.*$/';
            $address = preg_replace($pattern, '', $addressInit);
            $address = trim($address);

            $formattedString = "@" . $branch['code'] . "@i@" . $branch['name'] . ': ' . $address;
            $branchesSelector .= $formattedString . "@,";
        }

        $branchesSelector = substr($branchesSelector, 1);
        $res = rtrim($branchesSelector, "@,");

        return '{
            "branches": "' . $res . '"
        }';
    }

    public function getNameByCodeTest($app, $params_error_report, $nameController, $chat_id, $operation): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";

        if ($operation == 'getCityNameTest') {
            $nameFunction = "getCityNameTest()";

            $baseUrl = $_POST['baseUrl'];
            $hashKey = $_POST['hashKey'];
            $partnerCode = $_POST['partnerCode'];
            $cityCode = $_POST['codigoCiudad'];

            $datos = [
                'chat_id' => $chat_id,
                'baseUrl' => $baseUrl,
                'hashKey' => $hashKey,
                'partnerCode' => $partnerCode,
            ];

            $headers = [
                "Cache-Control" => "no-cache"
            ];


            $url = $baseUrl . 'getCities?hashKey=' . $hashKey . '&partnerCode=' . $partnerCode;

            $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

            $data = json_decode($response_object, true);
            $cities = $data['cities'];

            $cityName = '';

            foreach ($cities as $city) {
                if ($cityCode == $city['code']) {
                    $cityName = $city['name'];
                    break;
                }
            }

            // $cityName = 'No existe una ciudad con el código ingresado. Por favor verifica el código de la ciudad';

            return '{
            "nombre": "'. $cityName .'"
        }';

        } elseif ($operation == 'getBranchNameTest') {
            $nameFunction = "getBranchNameTest()";

            $baseUrl = $_POST['baseUrl'];
            $hashKey = $_POST['hashKey'];
            $partnerCode = $_POST['partnerCode'];
            $idType = $_POST['tipoIdentificacion'];
            $idNumber = $_POST['numeroIdentificacion'];
            $companyCode = $_POST['codigoCia'];
            $planCode = $_POST['planCode'];
            $cityCode = $_POST['codigoCiudad'];
            $attentionType = $_POST['tipoAtencion'];
            $regionCode = $_POST['codigoRegion'];
            $branchCode = $_POST['codigoSede'];

            $datos = [
                'urlBase' => $baseUrl,
                'hashKey' => $hashKey,
                'partnerCode' => $partnerCode,
                'tipoIdentificacion' => $idType,
                'numeroIdentificacion' => $idNumber,
                'codigoCia' => $companyCode,
                'codigoPlan' => $planCode,
                'codigoCiudad' => $cityCode,
                'tipoAtencion' => $attentionType,
                'codigoRegion' => $regionCode
            ];

            $headers = [
                "Cache-Control" => "no-cache"
            ];

            $url = $baseUrl
                . 'getBranches?hashKey=' . $hashKey
                . '&partnerCode=' . $partnerCode
                . '&tipoIdentificacion=' . $idType
                . '&numeroIdentificacion=' . $idNumber
                . '&codigoCia=' . $companyCode
                . '&codigoPlan=' . $planCode
                . '&codigoCiudad=' . $cityCode
                . '&tipoDeAtencion=' . $attentionType;

            if ($regionCode) {
                $url = $url . '&codigoRegion=' . $regionCode;
            }

            $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
                $chat_id, $nameController, $nameFunction, $app, $url, $headers,
                'GET', null, $this->nameLog, $datos
            );
            $data = json_decode($response_object, true);
            $branches = $data['branches'];
            $branchName = '';

            foreach ($branches as $branch) {
                if (!$branchCode) {
                    $branchName = 'El parámetro codigoSede es requerido';
                } else {
                    if ($branchCode == $branch['code']) {
                        $branchName = $branch['name'];
                        break;
                    }
                }
            }

            return '{
              "nombre": "'. $branchName .'"
            }';
        }

        return 'Este método requiere una de estas dos operations getCityName o getBranchName';
    }

    public function addDays($date, $days): string {
        $timestamp = strtotime($date . '+' . $days . 'days');

        return date('Y-m-d', $timestamp);
    }

    public function getBookingsTest($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "getBookingsTest()";

        $baseUrl = $_POST['baseUrl'];
        $hashKey = $_POST['hashKey'];
        $partnerCode = $_POST['partnerCode'];
        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $state = $_POST['estado'];
        $specialityCode = $_POST['codigoEspecialidad'];
        $startDate = $_POST['fechaDesde'];

        if (!$startDate) {
            $startDate = date('d-m-Y');
        }

        $finishDate = $this->addDays($startDate, 30);

        $datos = [
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'tipoIdentificacion' => $idType,
            'numeroIdentificacion' => $idNumber,
            'estado' => $state,
            'codigoEspecialidad' => $specialityCode,
            'fechaDesde' => $startDate,
            'fechaHasta' => $finishDate
        ];

        $url = $baseUrl
            . 'getBookings?hashKey=' . $hashKey
            . '&partnerCode=' . $partnerCode . '&tipoIdentificacion=' . $idType
            . '&numeroIdentificacion=' . $idNumber
            . '&estado=' . $state
            . '&codigoEspecialidad=' . $specialityCode
            . '&fechaDesde=' . $startDate
            . '&fechaHasta=' . $finishDate;

        $headers = [
            "Cache-Control" => "no-cache"
        ];

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
            $chat_id, $nameController, $nameFunction, $app, $url, $headers,
            'GET', null, $this->nameLog, $datos
        );

        $data = json_decode($response_object, true);
        $bookings = $data['bookings'];
        $appointmentDate = '';
        $appointmentHour = '';
        $appointmentCode = '';
        $specialityCode = '';
        $specialityName = '';
        $doctorName = '';
        $facilityCode = '';
        $facilityName = '';

        if (count($bookings) <= 0) {
            return '{
                "citasProgramadas": "0"  
            }';
        } else {
            foreach ($bookings as $booking) {
                if ($booking['codigoDeLaEspecialidad'] == 500
                    || $booking['codigoDeLaEspecialidad'] == 500_1
                    || $booking['codigoDeLaEspecialidad'] == 503
                    || $booking['codigoDeLaEspecialidad'] == 505
                ) {
                    $appointmentDate = $booking['fechaDeLaCita'];
                    $appointmentHour = $booking['horaDeLaCita'] . ':' . $booking['minutoDeLaCita'];
                    $appointmentCode = $booking['codigoDeLaCita'];
                    $specialityCode = $booking['codigoDeLaEspecialidad'];
                    $specialityName = $booking['tipoDeEspecialidad'];
                    $doctorName = $booking['nombreCompletoDelMedico'];
                    $facilityCode = $booking['identificacionDeLaInstitucion'];
                    $facilityName = $booking['nombreDeLaInstitucion'];
                }
            }
        }


        return '{
             "citasProgramadas": "' . true . '",
             "fechaCita": "' . SoundlutionsUtilsController::formatDateToWords($appointmentDate) . '",
             "horaCita": "' . $appointmentHour .'",
             "codigoCita": "' . $appointmentCode . '",
             "codigoEspecialidad": "' . $specialityCode . '",
             "nombreEspecialidad": "'. $specialityName . '",
             "nombreDoctor": "' . $doctorName . '",
             "codigoCentroMedico": "' . $facilityCode .'",
             "nombreCentroMedico": "' . $facilityName . '"
        }';
    }

    public function apigeeGetBookings($app, $params_error_report, $nameController, $chat_id, $tokenUrl): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "apigeeGetBookings()";

        $baseUrl = $_POST['baseUrl'];
        $hashKey = $_POST['hashKey'];
        $partnerCode = $_POST['partnerCode'];
        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $specialityCode = $_POST['codigoEspecialidad'];
        $startDate = $_POST['fechaDesde'];
        $auth = $this->generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $tokenUrl);

        if (!$startDate) {
            $startDate = date('Y-m-d');
        }

        $finishDate = $this->addDays($startDate, 30);

        $datos = [
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'tipoIdentificacion' => $idType,
            'numeroIdentificacion' => $idNumber,
            'codigoEspecialidad' => $specialityCode,
            'fechaDesde' => $startDate,
            'fechaHasta' => $finishDate,
            'tokenAuth' => $auth
        ];

        $headers = array(
            'Authorization: Bearer ' . $auth,
            'UUID: ' . uniqid('', false),
            'partnerCode: ' . $partnerCode,
            'hashKey: ' . $hashKey,
            'Cookie: XB-TRANSACTION=7fbd5485cbf0',
            'Content-Type: application/json'
        );


        // "Appointment?_filter=patient.identifier%3Aof-type%20eq%20Bukeala%7CCC%7C1072649681&date=gt2023-11-10&date=lt2023-11-15&specialty=Bukeala%C500"
        $bodyUrl = 'Appointment?_filter=patient.identifier%3Aof-type%20eq%20Bukeala%7C'. $idType
            . '%7C' . $idNumber . '&date=gt' . $startDate . '&date=lt' . $finishDate . '&specialty=Bukeala%7C' . $specialityCode;

        $body = '{
            "resourceType": "Bundle",
            "id": "bundle-request-appointment",
            "type": "batch",
            "entry": [
                {
                    "request": {
                        "method": "GET",
                        "url": "' . $bodyUrl .'"
                    }
                }
            ]
        }';

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $baseUrl, $headers, 'POST', $body, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $date = $data['entry'][0]['resource']['entry'][0]['resource']['start'];
        $timestamp = strtotime($date);
        $formattedDate = SoundlutionsUtilsController::formatDateToWords($date);
        $formattedHour = date('H:i', $timestamp);
        $appointmentId = $data['entry'][0]['resource']['entry'][0]['resource']['id'];
        $specialtyCode = $data['entry'][0]['resource']['entry'][0]['resource']['specialty'][0]['coding'][0]['code'];
        $specialtyName = $data['entry'][0]['resource']['entry'][0]['resource']['specialty'][0]['text'];
        $doctorName = $data['entry'][0]['resource']['entry'][2]['resource']['name'][0]['text'];
        $branchCode = $data['entry'][0]['resource']['entry'][3]['resource']['id'];

        if (count($data['entry'][0]['resource']['entry']) <= 0) {
            return '{
                "citasProgramadas": "0"
            }';
        } else {
            return '{
                "citasProgramadas": "' . true . '",
                "fechaCita": "' . $formattedDate . '",
                "horaCita": "' . $formattedHour . '",
                "codigoCita": "' . $appointmentId . '",
                "codigoEspecialidad": "' . $specialtyCode . '",
                "nombreEspecialidad": "' . $specialtyName . '",
                "nombreDoctor": "' . $doctorName . '",
                "codigoSede": "' . $branchCode . '"
            }';
        }
    }

    private function generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $url): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "generateToken()";

        $headers = array(
            'grant_type: client_credentials',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic czZ3YlFyb1hReVU4MllFMlJHZk9yWDlGYjg3RmNNZm1kMHFiQWNiQW5UWVRwZlZ1OllCTGJPVWlOVVJ4V0VDTDhURVhNUDdTQU1HVE9MZXhNbmNCMWxsQndBV09rWGFtUk43WDBrVG14ZDRBOUE4V1E='
        );

        $request = 'grant_type=client_credentials';
        $datos = [
            'auth' => $url
        ];

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos);

        $data = json_decode($response_object, true);
        return $data['access_token'];
    }

    private function generateTokenColsanitas($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "generateTokenColsanitas()";

        $headers = [
            'Authorization: Bearer eGxUVTFMQ0Y0XzVGTmlneXNKRVZuaFhwcktvYTo1OTM5ZnQxdlRZTjlfNnJBVW5xdlFmSkhUVklh',
            'Content-Type: application/x-www-form-urlencoded'
        ];

        $body = "grant_type=password&username=CO11VG60AMPPORTALCLINICA&password=QQE7udt1r6yZvMEm2mTeY";

        $url = 'https://papi.colsanitas.com/token';

        $datos = [
            'authUrl' => $url
        ];

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);

        $data = json_decode($response_object, true);
        return $data['access_token'];
    }

    public function consultPatient($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "JuanviController";
        $nameFunction = "consultPatientColsanitas()";

        $idType = $_POST['type_doc'];
        $idNumber = $_POST['num_doc'];
        $url = $_POST['url'];
        $auth = $this->generateTokenColsanitas($app, $params_error_report, $nameController, $chat_id);

        $headers = [
            'Authorization: Bearer ' . $auth,
            'Content-Type: application/json',
            'codAplicacion: SII000000462',
            'fechaPeticion: 02-03-2023 11:45:00',
            'sistemaFacturador: Sophia',
            'funcionNegocio: Consultar ultima estancia de pacientes'
        ];

        $body = [
            'tipDoc' => $idType,
            'numDoc' => $idNumber,
            'origenConsulta' => 1
        ];
        $body = json_encode($body);

        $datos = [
            'tipoDocumento' => $idType,
            'numeroDocumento' => $idNumber,
            'urlBase' => $url,
            'tokenAutenticacion' => $auth
        ];

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
        $data = json_decode($response_object, true);

        $array['data'] = $data;

        return json_encode($array);
    }

    private function tempGetData(): string
    {
        $id = $_POST['idDocumento'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://qa.cariai.com/hospital/datawebview',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('idDocumento' => '2270600972024-02-2815:00:50'),
        CURLOPT_HTTPHEADER => array(
            'TYPEREQUEST: POSTGET',
            'Cookie: PHPSESSID=bvepfoa33ug47a3tuj0tbikb56'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    function fakeDataArray() {
        $document = $_POST["document"];
        $array = [];

        switch ($document) {
            case "1234567890":
                $array = [
                    "numCitas" => 4,
                    'citas' => [
                        [
                            "tramite" => "Levantamiento",
                            "numComparendo" => "34567",
                            "fecha" => "27/06/24",
                            "hora" => "09:00 am",
                            "modalidad" => "Presencial"
                        ],
                        [
                            "tramite" => "Pago",
                            "numComparendo" => "90876",
                            "fecha" => "22/06/24",
                            "hora" => "01:00 pm",
                            "modalidad" => "Virtual"
                        ],
                        [
                            "tramite" => "Pago",
                            "numComparendo" => "34212",
                            "fecha" => "30/06/24",
                            "hora" => "11:00 am",
                            "modalidad" => "Presencial"
                        ],
                        [
                            "tramite" => "Levantamiento",
                            "numComparendo" => "56786",
                            "fecha" => "25/06/24",
                            "hora" => "08:00 am",
                            "modalidad" => "Presencial"
                        ]
                    ]
                ];
                break;

            case "1072649681":
                $array = [
                    "numCitas" => 2,
                    'citas' => [
                        [
                            "tramite" => "Levantamiento",
                            "numComparendo" => "34567",
                            "fecha" => "27/06/24",
                            "hora" => "09:00 am",
                            "modalidad" => "Presencial"
                        ],
                        [
                            "tramite" => "Pago",
                            "numComparendo" => "90876",
                            "fecha" => "22/06/24",
                            "hora" => "01:00 pm",
                            "modalidad" => "Virtual"
                        ]
                    ]
                ];
                break;

            default:
                $array = [
                    "numCitas" => 0,
                    "message" => "No se encontraron citas para el documento proporcionado"
                ];
                break;
        }

        return json_encode($array);
    }
}
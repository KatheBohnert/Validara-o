<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Utils\StaticExecuteService;
use App\Utils\StaticExecuteServicePreproduccion;
use \App\Controllers\SoundlutionsUtilsController;

/**
 * Description of CariController
 *
 * @author soundlutions
 */
class KeraltyOpticaController
{
    public string $nameLog = "KeraltyOpticaController";

    public function process(\Phalcon\Mvc\Micro $app)
    {
        header('Access-Control-Allow-Origin: *');
        $nameController = "KeraltyOpticaController";
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
        $hashKey = '1PzZk9z5WXaBX7xdTBTE';
        $partnerCode = 'CARIAI';
        $authUrl = 'https://dev.34-149-116-245.nip.io/token';
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) {
                case 'PruebaController':
                    $response = 'Hola mundo';
                    echo $response;
                    break;
                
                case 'getPatientData':
                    $response = $this->getPatientData($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;
                
                case 'getPlanData':
                    $response = $this->getPlanData($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getCities':
                    $response = $this->getCities($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getRegions':
                    $response = $this->getRegions($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getBranches':
                    $response = $this->getBranches($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getCityName':
                    $response = $this->getCityName($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getBranchName':
                    $response = $this->getBranchName($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode);
                    echo $response;
                    break;

                case 'getAvailability':
                    $response = $this->getAvailabilityApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $authUrl);
                    echo $response;
                    break;

                case 'getBookings':
                    $response = $this->getBookingsApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $authUrl);
                    echo $response;
                    break;

                case 'postBooking':
                    $response = $this->postBookingApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $authUrl);
                    echo $response;
                    break;

                case 'cancelBooking':
                    $response = $this->cancelBookingApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $authUrl);
                    echo $response;
                    break;
                
                default:
                    $response = 'Es necesario indicar la operation';
                    echo $response;
                    break;
            }
        }
    }

    public function getPatientData($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode)
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyOpticaController";
        $nameFunction = "getPatientData()";

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

        $response_object = StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $genero = $data['genero'];
        $estado = $data['estado'];
        $fechaNacimiento = $data['fechaNacimiento'];
        $nombreUnidadAtencion = $data['nombreUnidadAtencion'];
        $codigoUnidadAtencion = $data['codigoUnidadAtencion'];

        $var = '{
                "genero": "' . $genero . '",
                "estado": "' . $estado . '",
                "fechaNacimiento": "' . $fechaNacimiento . '",
                "nombreUnidadAtencion": "' . $nombreUnidadAtencion . '",
                "codigoUnidadAtencion": "' . $codigoUnidadAtencion . '"
            }';

        return $var;
    }

    public function getPlanData($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyOpticaController";
        $nameFunction = "getPlanData()";

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

        $response_object = StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $planes = $data['planes'];

        $newPlanes = "";

        foreach ($planes as $plan) {
            $formattedString = "@" . $plan['codPlan'] . "@i@" . $plan['descripcion'];
            $newPlanes .= $formattedString . "@,";
        }

        $newPlanes = substr($newPlanes, 1);
        $result = rtrim($newPlanes, '@,');

        return '{
            "planes": "'.$result.'"
        }';

    }

    public function getCities($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getCities()";

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

    public function getRegions($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getRegions()";

        $baseUrl = $_POST['baseUrl'];
        $cityCode = $_POST['cityCode'];

        $datos = [
            'chat_id' => $chat_id,
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'cityCode' => $cityCode
        ];

        $headers = [
            "Cache-Control" => "no-cache"
        ];

        $url = $baseUrl
            . '/getRegions?hashKey=' . $hashKey
            . '&partnerCode=' . $partnerCode
            . '&codigoCiudad=' . $cityCode;

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id,
            $nameController, $nameFunction, $app, $url, $headers, 'GET',
            null, $this->nameLog, $datos);
        $data = json_decode($response_object, true);
        $regions = $data['regions'];

        $regionsSelector = "";

        foreach ($regions as $region) {
            $formattedString = "@" . $region['code'] . "@i@" . $region['name'];
            $regionsSelector .= $formattedString . "@,";
        }

        $regionsSelector = substr($regionsSelector, 1);
        $response = rtrim($regionsSelector, "@,");
        return '{
            "regions": "' . $response . '"
        }';
    }

    /*Este método retorna las sedes con dirección disponibles en la ciudad seleccionada por el usuario*/
    public function getBranches($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getBranches()";

        $baseUrl = $_POST['baseUrl'];

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

        if (count($branches) == 0) {
            $res = 'Esta ciudad no tiene sedes disponibles para esta especialidad';
        } else {
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
        }

        return '{
            "branches": "' . $res . '"
        }';
    }

    /**
     * Este método se utiliza para obtener el nombre de la ciudad a partir del código 
     * retornado por el selector del formulario de Cariai para la parte de reportería
     */
    public function getCityName($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getCityName()";

        $baseUrl = $_POST['baseUrl'];
        $cityCode = $_POST['codigoCiudad'];

        $headers = [
            "Cache-Control" => "no-cache"
        ];

        $datos = [
            'chat_id' => $chat_id,
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
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

        return '{
            "nombre": "'.$cityName.'"
        }';
    }

    public function getBranchName($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getBranchNameTest()";

        $baseUrl = $_POST['baseUrl'];

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
                    $addressInit = $branch['address'];
                    $pattern = '/,.*$/';
                    $address = preg_replace($pattern, '', $addressInit);
                    $address = trim($address);
                    $branchName = $branch['name'] . ' ' . $address;
                    break;
                }
            }
        }

        return '{
           "nombre": "'. $branchName .'"
        }';
    }

    /* Este método obtendrá la disponibilidad de citas para una sede o para una especialidad*/
    public function getAvailability($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getBranchNameTest()";

        $baseUrl = $_POST['baseUrl'];

        $clinicCode = $_POST['codigoClinica'];
        $specialityCode = $_POST['codigoEspecialidad'];
        $startDate = $_POST['fechaDesde'];
        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $ciaCode = $_POST['codigoCia'];
        $planCode = $_POST['codigoPlan'];
        $onSite = $_POST['esPresencial'];
        $attentionType = $_POST['tipoAtencion'];
        $cityCode = $_POST['codigoCiudad'];
        $limit = $_POST['limit'];
        $startTime = $_POST['codigoHoraInicio'];
        $endTime = $_POST['codigoHoraFin'];

        $datos = [
            'urlBase' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'codigoClinica' => $clinicCode,
            'codigoEspecialidad' => $specialityCode,
            'fechaInicio' => $startDate,
            'tipoIdentificacion' => $idType,
            'numeroIdentificacion' => $idNumber,
            'codigoCia' => $ciaCode,
            'codigoPlan' => $planCode,
            'esPresencial' => $onSite,
            'tipoDeAtencion' => $attentionType,
            'codigoCiudad' => $cityCode,
            'limite' => $limit,
            'horaInicio' => $startTime,
            'horaFin' => $endTime
        ];

        $headers = [
            "Cache-Control" => "no-cache"
        ];

        $url = $baseUrl . 'getAvailability?hashKey='
            . $hashKey . '&partnerCode=' . $partnerCode
            . '&limit=' . $limit
            . '&codigoHoraInicio=' . $startTime
            . '&codigoHoraFin=' . $endTime;
        if ($clinicCode && $specialityCode) {
            $url = $url . '&codigoClinica=' . $clinicCode
                . '&codigoEspecialidad=' . $specialityCode
                . '&fechaDesde=' . $startDate
                . '&tipoIdentificacion=' . $idType
                . '&numeroIdentificacion=' . $idNumber
                . '&codigoCia=' . $ciaCode
                . '&codigoPlan=' . $planCode
                . '&esPresencial=' . $onSite
                . '&tipoDeAtencion=' . $attentionType
                . '&codigoCiudad=' . $cityCode;

            return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
                $chat_id, $nameController, $nameFunction, $app, $url, $headers,
                'GET', null, $this->nameLog, $datos
            );
        } elseif ($clinicCode) {
            $url = $url . '&codigoClinica=' . $clinicCode
                . '&fechaDesde=' . $startDate
                . '&tipoIdentificacion=' . $idType
                . '&numeroIdentificacion=' . $idNumber
                . '&codigoCia=' . $ciaCode
                . '&codigoPlan=' . $planCode
                . '&esPresencial=' . $onSite
                . '&tipoDeAtencion=' . $attentionType
                . '&codigoCiudad=' . $cityCode;

            return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
                $chat_id, $nameController, $nameFunction, $app, $url, $headers,
                'GET', null, $this->nameLog, $datos
            );
        } elseif ($specialityCode) {
            $url = $url . '&codigoEspecialidad=' . $specialityCode
                . '&fechaDesde=' . $startDate
                . '&tipoIdentificacion=' . $idType
                . '&numeroIdentificacion=' . $idNumber
                . '&codigoCia=' . $ciaCode
                . '&codigoPlan=' . $planCode
                . '&esPresencial=' . $onSite
                . '&tipoDeAtencion=' . $attentionType
                . '&codigoCiudad=' . $cityCode;

            return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion(
                $chat_id, $nameController, $nameFunction, $app, $url, $headers,
                'GET', null, $this->nameLog, $datos
            );
        } else {
            return 'Debes incluir al menos uno de estos dos parámetros, "codigoClinica" o "codigoEspecialidad"';
        }
    }

    /*Este método retorna una fecha con 30 días sumados a la fecha ingresada*/
    public function addDays($date, $days, string $format): string {
        $timestamp = strtotime($date . '+' . $days . 'days');

        return date($format, $timestamp);
    }

    /* Este método obtiene las citas de un paciente y valida si tiene alguna de optometría. Si la tiene saca los datos
    de la cita y los retorna para que puedan ser utilizados en el bot*/
    public function getBookings($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getBookings()";

        $baseUrl = $_POST['baseUrl'];

        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $state = $_POST['estado'];
        $specialityCode = $_POST['codigoEspecialidad'];
        $startDate = $_POST['fechaDesde'];

        if (!$startDate) {
            $startDate = date('d-m-Y');
        }

        $finishDate = $this->addDays($startDate, 30, 'd-m-Y');

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

    /* Este método genera el token para hacer los consumos de Apigee */
    private function generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $url): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "generateTokenApigee()";

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

    /* Este método obtiene las citas de los usuarios a través de apigee */
    public function getBookingsApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $tokenUrl): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getBookingsApigee()";

        $baseUrl = $_POST['baseUrl'];

        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $specialityCode = $_POST['codigoEspecialidad'];
        $startDate = $_POST['fechaDesde'];
        $auth = $this->generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $tokenUrl);

        if (!$startDate) {
            $startDate = date('Y-m-d');
        }

        $finishDate = $this->addDays($startDate, 30, 'Y-m-d');

        $headers = array(
            'Authorization: Bearer ' . $auth,
            'UUID: ' . uniqid('', false),
            'partnerCode: ' . $partnerCode,
            'hashKey: ' . $hashKey,
            'Cookie: XB-TRANSACTION=7fbd5485cbf0',
            'Content-Type: application/json'
        );

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

        $bodyUrl = 'Appointment?_filter=patient.identifier%3Aof-type%20eq%20Bukeala%7C'. $idType
            . '%7C' . $idNumber
            . '&date=gt' . $startDate
            . '&date=lt' . $finishDate
            . '&specialty=Bukeala%7C' . $specialityCode;

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

        $url = $baseUrl . '/v1/appointments/getBookings';

        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $date = $data['entry'][0]['resource']['entry'][0]['resource']['start'];
        $timestamp = strtotime($date);
        $formattedDate = SoundlutionsUtilsController::formatDateToWords($date);
        $formattedHour = substr($date, strpos($date, 'T') + 1, 8);
        $appointmentId = $data['entry'][0]['resource']['entry'][0]['resource']['id'];
        $specialtyCode = $data['entry'][0]['resource']['entry'][0]['resource']['specialty'][0]['coding'][0]['code'];
        $specialtyName = $data['entry'][0]['resource']['entry'][0]['resource']['specialty'][0]['text'];
        $doctorName = $data['entry'][0]['resource']['entry'][2]['resource']['name'][0]['text'];
        $branchCode = $data['entry'][0]['resource']['entry'][3]['resource']['id'];
        $appointmetStatus = $data['entry'][0]['resource']['entry'][0]['resource']['status'];

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
                "codigoSede": "' . $branchCode . '",
                "estadoCita": "' . $appointmetStatus . '"
            }';
        }
    }

    public function getAvailabilityApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $tokenUrl): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "getAvailabilityApigee()";

        $baseUrl = $_POST['baseUrl'];
        $auth = $this->generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $tokenUrl);

        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $startDate = $_POST['fechaDesde'];
        $finishDate = $_POST['fechaHasta'];
        $branchCode = $_POST['codigoClinica'];
        $cityCode = $_POST['codigoCiudad'];
        $attentionType = $_POST['tipoAtencion'];
        $specialtyCode = $_POST['codigoEspecialidad'];
        $count = $_POST['numeroCitas'];
        $productCode = $_POST['codigoProducto'];
        $planCode = $_POST['codigoPlan'];

        if (!$branchCode) {
            $branchCode = null;
        }

        if (!$count) {
            $count = 15;
        }

        $headers = array(
            'Authorization: Bearer ' . $auth,
            'UUID: ' . uniqid('', false),
            'partnerCode: ' . $partnerCode,
            'hashKey: ' . $hashKey,
            'Cookie: XB-TRANSACTION=7fbd5485cbf0',
            'Content-Type: application/json'
        );

        $datos = [
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'tipoIdentificacion' => $idType,
            'numeroIdentificacion' => $idNumber,
            'codigoEspecialidad' => $specialtyCode,
            'fechaDesde' => $startDate,
            'fechaHasta' => $finishDate,
            'tipoAtencion' => $attentionType,
            'codigoCiudad' => $cityCode,
            'codigoSede' => $branchCode,
            'limit' => $count,
            'tokenAuth' => $auth
        ];

        $bodyUrl = 'Appointment?_count=' . $count
            . '&_filter=location.identifier%20eq%20Bukeala%2Fsede%7C' . $branchCode
            . '%20and%20patient.identifier%3Aof-type%20eq%20Bukeala%7C' . $idType
            .'%7C' . $idNumber
            . '&_include=Appointment%3Apractitioner&_include=Appointment%3Alocation&appointment-type%3Atext=true&date=ge' . $startDate
            . '&date=le' . $finishDate
            . '&location.address-city=' . $cityCode
            . '&service-type=Bukeala%2FTipoAtencion%7C' . $attentionType
            . '&specialty=Bukeala%7C' . $specialtyCode
            . '&status=proposed&supporting-info.identifier=Bukeala%2FProducto%7C' . $productCode
            . '&supporting-info.identifier=Bukeala%2FPlan%7C' . $planCode;

        $body = '{
            "resourceType": "Bundle",
            "id": "bundle-request-appointment",
            "type": "batch",
            "entry": [
                {
                    "request": {
                        "method": "GET",
                        "url": "'. $bodyUrl . '"
                    }
                }
            ]
        }';

        $url = $baseUrl . '/v1/appointments/getAvailability';

        return StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
    }

    public function postBookingApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $tokenUrl): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "postBookingApigee()";

        $baseUrl = $_POST['baseUrl'];
        $auth = $this->generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $tokenUrl);

        /**Datos del paciente */
        $idType = $_POST['tipoIdentificacion'];
        $idNumber = $_POST['numeroIdentificacion'];
        $phoneNumber = $_POST['telefonoContacto'];
        $email = $_POST['emailContacto'];
        $productCode = $_POST['codigoCia'];
        $planCode = $_POST['codigoPlan'];

        /**Datos del médico */
        $doctorId = $_POST['codigoMedico'];

        /**Datos cita */
        $selectedDate = $_POST['fechaSeleccionada'];
        $branchCode = $_POST['codigoClinica'];
        $specialtyCode = $_POST['codigoEspecialidad'];
        $countryCode = $_POST['codigoPais'];
        $codeId = rand(0000000, 9999999);

        $headers = array(
            'Authorization: Bearer ' . $auth,
            'UUID: ' . uniqid('', false),
            'partnerCode: ' . $partnerCode,
            'hashKey: ' . $hashKey,
            'Cookie: XB-TRANSACTION=7fbd5485cbf0',
            'Content-Type: application/json'
        );

        $datos = [
            'baseUrl' => $baseUrl,
            'hashKey' => $hashKey,
            'partnerCode' => $partnerCode,
            'tipoIdentificacion' => $idType,
            'numeroIdentificacion' => $idNumber,
            'numeroTelefono' => $phoneNumber,
            'correoElectronico' => $email,
            'codigoProducto' => $productCode,
            'codigoPlan' => $planCode,
            'idDoctor' => $doctorId,
            'codigoEspecialidad' => $specialtyCode,
            'fechaCita' => $selectedDate,
            'codigoPais' => $countryCode,
            'codigoSede' => $branchCode,
            'tokenAuth' => $auth
        ];

        $body = '{
            "resourceType": "Bundle",
            "id": "bundle-update-appointment",
            "type": "batch",
            "entry": [
              {
                "request": {
                  "method": "GET",
                  "url": "Location/' . $branchCode . '"
                }
              },
              {
                "request": {
                  "method": "PUT",
                  "url": "Appointment/' . $codeId . '" 
                },
                "resource": {
                  "resourceType": "Appointment",
                  "id": "' . rand(00000000, 99999999) . '",
                  "status": "booked",
                  "start": "' . $selectedDate . '",
                  "end": "' . $selectedDate . '",
                  "participant": [
                    {
                      "type": [
                        {
                          "text": "Patient"
                        }
                      ],
                      "status": "accepted",
                      "actor": {
                        "reference": "Patient/' . $idType . '-' . $idNumber . '",
                        "extension": [
                          {
                            "url": "telefono",
                            "valueString": "' . $phoneNumber . '"
                          },
                          {
                            "url": "email",
                            "valueString": "' . $email . '"
                          }
                        ]
                      }
                    },
                    {
                      "actor": {
                        "reference": "Practitioner/' . $doctorId . '"
                      },
                      "type": [
                        {
                          "text": "Practitioner"
                        }
                      ],
                      "status": "accepted"
                    },
                    {
                      "actor": {
                        "reference": "Location/' . $branchCode . '"
                      },
                      "type": [
                        {
                          "text": "Location"
                        }
                      ],
                      "status": "accepted"
                    }
                  ],
                  "specialty": [
                    {
                      "coding": [
                        {
                          "system": "Bukeala",
                          "code": "' . $specialtyCode . '"
                        }
                      ]
                    }
                  ],
                  "appointmentType": {
                    "coding": [
                      {
                        "code": "Presencial"
                      }
                    ],
                    "text": "true"
                  },
                  "extension": [
                    {
                      "url": "attachmentUrl",
                      "valueUrl": "http://misdocumentos/ordenmedica.pdf"
                    }
                  ],
                  "basedOn": [
                    {
                      "reference": "ServiceRequest/7034059"
                    }
                  ],
                  "supportingInformation": [
                    {
                      "identifier": [
                        {
                          "value": "' . $productCode . '",
                          "system": "Bukeala/Producto"
                        }
                      ]
                    },
                    {
                      "identifier": [
                        {
                          "value": "' . $planCode . '",
                          "system": "Bukeala/Plan"
                        }
                      ]
                    },
                    {
                      "identifier": [
                        {
                          "system": "Bukeala/codigoPais",
                          "value": "' . $countryCode . '"
                        }
                      ]
                    }
                  ]
                }
              },
              {
                "request": {
                  "method": "PUT",
                  "url": "Patient/' . $idType . '-' . $idNumber . '"
                },
                "resource": {
                  "resourceType": "Patient",
                  "id": "' . $idType . '-' . $idNumber . '",
                  "contact": [
                    {
                      "address": {
                        "city": "",
                        "text": "",
                        "extension": [
                          {
                            "url": "",
                            "valueString": ""
                          }
                        ]
                      }
                    }
                  ]
                }
              }
            ]
        }';

        $url = $baseUrl . '/v1/appointments/postBooking';
        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
        $data = json_decode($response_object, true);
        $entry = $data['entry'];
        $error = $entry[0]['text']['status'];

        if (isset($error)) {
            $diagnostics = $entry[0]['issue'][0]['diagnostics'];
            return '{ "mensaje": "' . $diagnostics . '" }';
        } else {
            $clinicName = $entry[0]['resource']['name'];
            $clinicAddress = $entry[0]['resource']['address']['text'];
            $appointmentId = str_replace('Appointment/', '', $entry[1]['response']['location']);

            return '{
                "idCita": "' . $appointmentId . '",
                "nombreClinica": "' . $clinicName . '",
                "direccionClinica": "' . $clinicAddress . '",
                "etiqueta": "' . $clinicName . ' ' . $clinicAddress . '"
            }';
        }
    }

    public function cancelBookingApigee($app, $params_error_report, $nameController, $chat_id, $hashKey, $partnerCode, $tokenUrl): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "KeraltyController";
        $nameFunction = "cancelBookingApigee()";

        $baseUrl = $_POST['baseUrl'];
        $auth = $this->generateTokenApigee($app, $params_error_report, $nameController, $chat_id, $tokenUrl);

        $email = $_POST['correoElectronico'] ?? null;
        $appointmetId = $_POST['codigoCita'] ?? null;
        /** Datos adicionales */
        $cancelComment = $_POST['motivoCancelacion'] ?? '';

        if (!$email || !$appointmetId) {
            return '{ "mensaje": "Datos incompletos" }';
        }

        $headers = array(
            'Authorization: Bearer ' . $auth,
            'UUID: ' . uniqid('', false),
            'partnerCode: ' . $partnerCode,
            'hashKey: ' . $hashKey,
            'Cookie: XB-TRANSACTION=7fbd5485cbf0',
            'Content-Type: application/json'
        );

        $datos = [
            'baseUrl' => $baseUrl,
            'emailUsuario' => $email,
            'comentariosCancelacion' => $cancelComment,
            'tokenAutorizacion' => $auth
        ];

        $body = '{
            "resourceType": "Appointment",
            "id": "' . $appointmetId . '",
            "status": "cancelled",
            "participant": [
              {
                "type": [
                  {
                    "text": "Patient"
                  }
                ],
                "actor": {
                  "reference": "Patient/12345",
                  "extension": [
                    {
                      "url": "CorreoElectronico",
                      "valueString": "' . $email . '"
                    }
                  ]
                },
                "status": "accepted"
              }
            ],
            "cancelationReason": {
              "text": "' . $cancelComment . '"
            }
        }';

        $url = $baseUrl . '/v1/appointments/postCancelBooking';
        $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);
        $data = json_decode($response_object, true);

        return $response_object;
    }
}
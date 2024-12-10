<?php

namespace App\Controllers;
use Utils\SetLogs;
use SimpleXMLElement;
use DateTime;
use DateTimeZone;

class ZurichFordController
{
    private $nameLog = "ZurichFord";

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "ZurichController";
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
            switch ($operation) {
                case "consultarPoliza":
                    $response = $this->consultarPoliza($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "consultarSiniestro":
                    $response = $this->consultarSiniestro($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "enviarCorreo":
                    $response = $this->enviarCorreo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "consultarActividad":
                    $response = $this->consultarActividad($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "crearActividad":
                    $response = $this->crearActividad($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "enviarDocumento":
                    $response = $this->enviarDocumento($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "crearCorreo":
                    $response = $this->crearCorreo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validarMontoPago":
                    $response = $this->validarMontoPago($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validarHora":
                    $response = $this->validarHora($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validarHora2":
                    $response = $this->validarHora2($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getRequisitosParaTramiteDePagoSiniestro":
                    $response = $this->getRequisitosParaTramiteDePagoSiniestro($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getRequisitosParaIngresoHospitalario":
                    $response = $this->getRequisitosParaIngresoHospitalario($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getValuacionReparacionVehiculo":
                    $response = $this->getValuacionReparacionVehiculo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getInfoGeneral":
                    $response = $this->getInfoGeneral($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getAsistenciaAutos":
                    $response = $this->getAsistenciaAutos($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getAsistenciaMedica":
                    $response = $this->getAsistenciaMedica($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getQuejasAclaraciones":
                    $response = $this->getQuejasAclaraciones($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getListDocuments":
                    $response = $this->getListDocuments($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getAttributes":
                    $response = $this->getAttributes($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getDate":
                    $response = $this->getDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getAnalistTramitador":
                    $response = $this->getAnalistTramitador($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getExpertPerson":
                    $response = $this->getExpertPerson($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getListDocuments2":
                    $response = $this->getListDocuments2($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "separateNames":
                    $response = $this->separateNames($app, $params_error_report, $nameController, $chat_id);
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

    private function consultarPoliza($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "consultarPoliza()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $numPoliza = $_POST['numPoliza'];
        $numInciso = $_POST['numInciso'];
        $url = $_POST['url'];
        $soapUser = $_POST['soapUser'];
        $soapPass = $_POST['soapPass'];

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $datos = array(
            "numPoliza" => $numPoliza,
            "url" => $url,
            "soapUser" => $soapUser,
            "soapPassword" => $soapPass
        );

        $xml_post_string = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://guidewire.com/ws/soapheaders" xmlns:com="http://zurich.com.mx/cmp/integration/webservice/mobile/api/common/CommonWebServiceAPI" xmlns:req="http://zurich.com.mx/cmp/integration/webservice/chatbot/to/request">
            <soapenv:Header>
                <soap:locale>es</soap:locale>
                <soap:authentication>
                    <soap:username>'.$soapUser.'</soap:username>
                    <soap:password>'.$soapPass.'</soap:password>
                </soap:authentication>
            </soapenv:Header>
            <soapenv:Body>
                <com:ConsultarPoliza>
                    <com:policyRequest>
                        <req:item>'.$numInciso.'</req:item>
                        <req:policyNumber>'.$numPoliza.'</req:policyNumber>
                    </com:policyRequest>
                </com:ConsultarPoliza>
            </soapenv:Body>
        </soapenv:Envelope>';

        $headers = array(
            "Content-Type: application/xml",
            "Accept: */*",
            "Cache-Control: no-cache",
            "Cookie: incap_ses_9129_1958903=/qBjZ+WYfQEm7K9Nq7mwfi7rEWUAAAAAvcvWjtoRqaGatgA6HPEetA==; visid_incap_1958903=5Q+NViYPTQKpKx/81wELKy3rEWUAAAAAQUIPAAAAAADA68Rx/kayksJdxUFfVTKN",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); 

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);

        $xml = new SimpleXMLElement($response);

        $xml->registerXPathNamespace('tns', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('pogo', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/response/policy');
        $xml->registerXPathNamespace('pogo2', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/common');

        $claimDate = $xml->xpath('//pogo:listPolicy/pogo:Entry/pogo:claimDate');
        $claimNumber = $xml->xpath('//pogo:listPolicy/pogo:Entry/pogo:claimNumber');
        $claimStatus = $xml->xpath('//pogo:listPolicy/pogo:Entry//pogo:claimStatus');

        $fechaProceso = $xml->xpath('//pogo2:fechaProceso');
        $idMessage = $xml->xpath('//pogo2:idMessage');
        $message = $xml->xpath('//pogo2:message');

        foreach ($claimDate as $element) {
            $claimDateValue = (string)$element;
            $claimDateValues[] = $claimDateValue;
        }

        foreach ($claimNumber as $element) {
            $claimNumberValue = (string)$element;
            $claimNumberValues[] = $claimNumberValue;
        }

        foreach ($claimStatus as $element) {
            $claimStatusValue = (string)$element;
            $claimStatusValues[] = $claimStatusValue;
        }

        $firstAbiertoIndex = array_search("Abierto", $claimStatusValues);

        $fechaProceso = (string)$fechaProceso[0];
        $idMessage = (string)$idMessage[0];
        $message = (string)$message[0];

        if ($message === "Póliza sin Siniestros") {
            $infoFound = "0";
        } else {
            $infoFound = "1";
        }

        $polizaClass = new \stdClass();

        $polizaClass->fechaSiniestro = $claimDateValues[$firstAbiertoIndex];
        $polizaClass->numeroSiniestro = $claimNumberValues[$firstAbiertoIndex];
        $polizaClass->estadoSiniestro = $claimStatusValues[$firstAbiertoIndex];

        $polizaClass->fechaProceso = $fechaProceso;
        $polizaClass->idMensaje = $idMessage;
        $polizaClass->mensaje = $message;
        $polizaClass->infoFound = $infoFound;

        return \GuzzleHttp\json_encode($polizaClass);

    }

    private function consultarSiniestro($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "consultarSiniestro()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $numSiniestro = $_POST['numSiniestro'];
        $url = $_POST['url'];
        $soapUser = $_POST['soapUser'];
        $soapPass = $_POST['soapPass'];

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $datos = array(
            "numSiniestro" => $numSiniestro,
            "url" => $url,
            "soapUser" => $soapUser,
            "soapPassword" => $soapPass
        );

        $xml_post_string = '
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://guidewire.com/ws/soapheaders" xmlns:com="http://zurich.com.mx/cmp/integration/webservice/mobile/api/common/CommonWebServiceAPI" xmlns:req="http://zurich.com.mx/cmp/integration/webservice/chatbot/to/request">
            <soapenv:Header>
                <soap:locale>es</soap:locale>
                <soap:authentication>
                    <soap:username>'.$soapUser.'</soap:username>
                    <soap:password>'.$soapPass.'</soap:password>
                </soap:authentication>
            </soapenv:Header>
            <soapenv:Body>
                <com:ConsultarSiniestro>
                    <!--Optional:-->
                    <com:claimRequest>
                        <!--Optional:-->
                        <req:claimId>'.$numSiniestro.'</req:claimId>
                    </com:claimRequest>
                </com:ConsultarSiniestro>
            </soapenv:Body>
        </soapenv:Envelope>';

        $headers = array(
            "Content-Type: application/xml",
            "Accept: */*",
            "Cache-Control: no-cache",
            "Cookie: incap_ses_9129_1958903=/qBjZ+WYfQEm7K9Nq7mwfi7rEWUAAAAAvcvWjtoRqaGatgA6HPEetA==; visid_incap_1958903=5Q+NViYPTQKpKx/81wELKy3rEWUAAAAAQUIPAAAAAADA68Rx/kayksJdxUFfVTKN",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); 

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);

        $xml = new SimpleXMLElement($response);

        // Define namespaces
        $xml->registerXPathNamespace('tns', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('pogo', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/response/claim');
        $xml->registerXPathNamespace('pogo2', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/common');
        
        // Access specific elements
        $analistEmail = $xml->xpath('//pogo:analistPerson/pogo:email');
        $analistFirstName = $xml->xpath('//pogo:analistPerson/pogo:firstName');
        $analistLastName = $xml->xpath('//pogo:analistPerson/pogo:lastName');
        $analistSecondLastName = $xml->xpath('//pogo:analistPerson/pogo:secondLastName');
        $analistUserId = $xml->xpath('//pogo:analistPerson/pogo:userId');

        $claimEvaluationStage = $xml->xpath('//pogo:claimEvaluationStage');
        $claimDeductibleMount = $xml->xpath('//pogo:claimDeductibleMount');
        $claimIndicatorApplyOfDeductible = $xml->xpath('//pogo:claimIndicatorApplyOfDeductible');
        $claimStatus = $xml->xpath('//pogo:claimStatus');
        $claimType = $xml->xpath('//pogo:claimType');
        $claimSubType = $xml->xpath('//pogo:claimSubType');
        $deliveryDate = $xml->xpath('//pogo:deliveryDate');

        $expertEmail = $xml->xpath('//pogo:expertPerson/pogo:email');
        $expertFirstName = $xml->xpath('//pogo:expertPerson/pogo:firstName');
        $expertLastName = $xml->xpath('//pogo:expertPerson/pogo:lastName');
        $expertSecondLastName = $xml->xpath('//pogo:expertPerson/pogo:secondLastName');
        $expertUserId = $xml->xpath('//pogo:expertPerson/pogo:userId');

        $injuredCertificateNumber = $xml->xpath('//pogo:injuredPersonList/pogo:Entry/pogo:certificatedNumber');
        $injuredFirstName = $xml->xpath('//pogo:injuredPersonList/pogo:Entry/pogo:firstName');
        $injuredLastName = $xml->xpath('//pogo:injuredPersonList/pogo:Entry/pogo:lastName');
        $injuredSecondLastName = $xml->xpath('//pogo:injuredPersonList/pogo:Entry/pogo:secondLastName');

        $insuredPersonCompany = $xml->xpath('//pogo:insuredPerson/pogo:companyName');
        $insuredPersonFirstName = $xml->xpath('//pogo:insuredPerson/pogo:firstName');
        $insuredPersonEmail = $xml->xpath('//pogo:insuredPerson/pogo:email');
        $insuredPersonLastName = $xml->xpath('//pogo:insuredPerson/pogo:lastName');
        $insuredPersonPhoneNumber = $xml->xpath('//pogo:insuredPerson/pogo:phoneNumber');
        $insuredPersonSecondLastName = $xml->xpath('//pogo:insuredPerson/pogo:secondLastName');

        $insuredVehicleLicensePlate = $xml->xpath('//pogo:insuredVehicle/pogo:licensePlate');
        $insuredVehicleMake = $xml->xpath('//pogo:insuredVehicle/pogo:make');
        $insuredVehicleModel = $xml->xpath('//pogo:insuredVehicle/pogo:model');
        $insuredVehicleSerialNumber = $xml->xpath('//pogo:insuredVehicle/pogo:serialNumber');
        $insuredVehicleStyle = $xml->xpath('//pogo:insuredVehicle/pogo:style');
        $insuredVehicleSubMake = $xml->xpath('//pogo:insuredVehicle/pogo:subMake');

        $thirdsPeopleFirstName = $xml->xpath('//pogo:thirdsPeopleList/pogo:Entry/pogo:firstName');
        $thirdsPeopleLastName = $xml->xpath('//pogo:thirdsPeopleList/pogo:Entry/pogo:lastName');
        $thirdsPeoplePhoneNumber = $xml->xpath('//pogo:thirdsPeopleList/pogo:Entry/pogo:phoneNumber');
        $thirdsPeopleSecondLastName = $xml->xpath('//pogo:thirdsPeopleList/pogo:Entry/pogo:secondLastName');

        $thirdsVehicleLicensePlate = $xml->xpath('//pogo:thirdsVehiclesList/pogo:Entry/pogo:licensePlate');
        $thirdsVehicleMake = $xml->xpath('//pogo:thirdsVehiclesList/pogo:Entry/pogo:make');
        $thirdsVehicleModel = $xml->xpath('//pogo:thirdsVehiclesList/pogo:Entry/pogo:model');
        $thirdsVehicleSerialNumber = $xml->xpath('//pogo:thirdsVehiclesList/pogo:Entry/pogo:serialNumber');
        $thirdsVehicleStyle = $xml->xpath('//pogo:thirdsVehiclesList/pogo:Entry/pogo:style');
        $thirdsVehicleSubMake = $xml->xpath('//pogo:thirdsVehiclesList/pogo:Entry/pogo:subMake');

        $fechaProceso = $xml->xpath('//pogo2:fechaProceso');
        $idMessage = $xml->xpath('//pogo2:idMessage');
        $message = $xml->xpath('//pogo2:message');

        $supplierDescription = $xml->xpath('//pogo:supplierDescription');
        $supplierID = $xml->xpath('//pogo:supplierID');

        $analistEmail = (string)$analistEmail[0];
        $analistFirstName = (string)$analistFirstName[0];
        $analistLastName = (string)$analistLastName[0];
        $analistSecondLastName = (string)$analistSecondLastName[0];
        $analistUserId = (string)$analistUserId[0];

        $claimEvaluationStage = (string)$claimEvaluationStage[0];
        $claimIndicatorApplyOfDeductible = (string)$claimIndicatorApplyOfDeductible[0];
        $claimStatus = (string)$claimStatus[0];
        $claimType = (string)$claimType[0];
        $claimDeductibleMount = (string)$claimDeductibleMount[0];
        $deliveryDate = (string)$deliveryDate[0];

        $expertEmail = (string)$expertEmail[0];
        $expertFirstName = (string)$expertFirstName[0];
        $expertLastName = (string)$expertLastName[0];
        $expertSecondLastName = (string)$expertSecondLastName[0];
        $expertUserId = (string)$expertUserId[0];


        foreach ($injuredCertificateNumber as $element) {
            $injuredCertificateNumberValue = (string)$element;
            $injuredCertificateNumbers[] = $injuredCertificateNumberValue;
        }

        foreach ($injuredFirstName as $element) {
            $injuredFirstNameValue = (string)$element;
            $injuredFirstNames[] = $injuredFirstNameValue;
        }

        foreach ($injuredLastName as $element) {
            $injuredLastNameValue = (string)$element;
            $injuredLastNames[] = $injuredLastNameValue;
        }

        foreach ($injuredSecondLastName as $element) {
            $injuredSecondLastNameValue = (string)$element;
            $injuredSecondLastNames[] = $injuredSecondLastNameValue;
        }

        $insuredPersonCompany = (string)$insuredPersonCompany[0];
        $insuredPersonFirstName = (string)$insuredPersonFirstName[0];
        $insuredPersonLastName = (string)$insuredPersonLastName[0];
        $insuredPersonSecondLastName = (string)$insuredPersonLastName[0];
        $insuredPersonPhoneNumber = (string)$insuredPersonPhoneNumber[0];

        $insuredVehicleLicensePlate = (string)$insuredVehicleLicensePlate[0];
        $insuredVehicleMake = (string)$insuredVehicleMake[0];
        $insuredVehicleModel = (string)$insuredVehicleModel[0];
        $insuredVehicleSerialNumber = (string)$insuredVehicleSerialNumber[0];
        $insuredVehicleStyle = (string)$insuredVehicleStyle[0];
        $insuredVehicleSubMake = (string)$insuredVehicleSubMake[0];

        foreach ($thirdsPeopleFirstName as $element) {
            $thirdsPeopleFirstNameValue = (string)$element;
            $thirdsPeopleFirstNames[] = $thirdsPeopleFirstNameValue;
        }

        foreach ($thirdsPeopleLastName as $element) {
            $thirdsPeopleLastNameValue = (string)$element;
            $thirdsPeopleLastNames[] = $thirdsPeopleLastNameValue;
        }

        foreach ($thirdsPeoplePhoneNumber as $element) {
            $thirdsPeoplePhoneNumberValue = (string)$element;
            $thirdsPeoplePhoneNumbers[] = $thirdsPeoplePhoneNumberValue;
        }

        foreach ($thirdsPeopleSecondLastName as $element) {
            $thirdsPeopleSecondLastNameValue = (string)$element;
            $thirdsPeopleSecondLastNames[] = $thirdsPeopleSecondLastNameValue;
        }

        foreach ($thirdsVehicleLicensePlate as $element) {
            $thirdsVehicleLicensePlateValue = (string)$element;
            $thirdsVehicleLicensePlates[] = $thirdsVehicleLicensePlateValue;
        }
        
        foreach ($thirdsVehicleMake as $element) {
            $thirdsVehicleMakeValue = (string)$element;
            $thirdsVehicleMakes[] = $thirdsVehicleMakeValue;
        }

        foreach ($thirdsVehicleModel as $element) {
            $thirdsVehicleModelValue = (string)$element;
            $thirdsVehicleModels[] = $thirdsVehicleModelValue;
        }

        foreach ($thirdsVehicleSerialNumber as $element) {
            $thirdsVehicleSerialNumberValue = (string)$element;
            $thirdsVehicleSerialNumbers[] = $thirdsVehicleSerialNumberValue;
        }

        foreach ($thirdsVehicleStyle as $element) {
            $thirdsVehicleStyleValue = (string)$element;
            $thirdsVehicleStyles[] = $thirdsVehicleStyleValue;
        }

        foreach ($thirdsVehicleSubMake as $element) {
            $thirdsVehicleSubMakeValue = (string)$element;
            $thirdsVehicleSubMakes[] = $thirdsVehicleSubMakeValue;
        }

        $fechaProceso = (string)$fechaProceso[0];
        $idMessage = (string)$idMessage[0];
        $message = (string)$message[0];

        $supplierDescription = (string)$supplierDescription[0];
        $supplierID = (string)$supplierID[0];

        if ($idMessage === "00") {
            $infoFound = "1";
        } else {
            $infoFound = "0";
        }

        $siniestroClass = new \stdClass();

        $siniestroClass->emailAnalista = $analistEmail;
        $siniestroClass->primerNombreAnalista = $analistFirstName;
        $siniestroClass->primerApellidoAnalista = $analistLastName;
        $siniestroClass->segundoApellidoAnalista = $analistSecondLastName;
        $siniestroClass->idUsuarioAnalista = $analistUserId;

        $siniestroClass->etapaReclamo = $claimEvaluationStage;
        $siniestroClass->aplicaDeducibleReclamo = $claimIndicatorApplyOfDeductible;
        $siniestroClass->estadoReclamo = $claimStatus;
        $siniestroClass->tipoReclamo = $claimType;
        $siniestroClass->subTipoReclamo = (string)$claimSubType[0];
        $siniestroClass->montoDeducibleReclamo = $claimDeductibleMount;
        $siniestroClass->fechaEnvioReclamo = $deliveryDate;

        $siniestroClass->emailExperto = $expertEmail;
        $siniestroClass->primerNombreExperto = $expertFirstName;
        $siniestroClass->primerApellidoExperto = $expertLastName;
        $siniestroClass->segundoApellidoExperto = $expertSecondLastName;
        $siniestroClass->idUsuarioExperto = $expertUserId;

        $siniestroClass->companiaAsegurado = $insuredPersonCompany;
        $siniestroClass->primerNombreAsegurado = $insuredPersonFirstName;
        $siniestroClass->primerApellidoAsegurado = $insuredPersonLastName;
        $siniestroClass->segundoApellidoAsegurado = $insuredPersonSecondLastName;
        $siniestroClass->numeroCelularAsegurado = $insuredPersonPhoneNumber;
        
        $siniestroClass->placaVehiculoAsegurado = $insuredVehicleLicensePlate;
        $siniestroClass->marcaVehiculoAsegurado = $insuredVehicleMake;
        $siniestroClass->modeloVehiculoAsegurado = $insuredVehicleModel;
        $siniestroClass->numeroSerialVehiculoAsegurado = $insuredVehicleSerialNumber;
        $siniestroClass->estiloVehiculoAsegurado = $insuredVehicleStyle;
        $siniestroClass->subMarcaVehiculoAsegurado = $insuredVehicleSubMake;

        $siniestroClass->fechaProceso = $fechaProceso;
        $siniestroClass->idMessage = $idMessage;
        $siniestroClass->message = $message;

        $siniestroClass->descripcionProveedor = $supplierDescription;
        $siniestroClass->idProveedor = $supplierID;

        $siniestroClass->infoFound = $infoFound;

        for ($i = 0; $i <= count($injuredCertificateNumbers)-1; $i++) {

            $siniestroClass->injuredPersonList[$i]->numeroCertificadoHerido = $injuredCertificateNumbers[$i];
            $siniestroClass->injuredPersonList[$i]->primerNombreHerido = $injuredFirstNames[$i];
            $siniestroClass->injuredPersonList[$i]->primerApellidoHerido = $injuredLastNames[$i];
            $siniestroClass->injuredPersonList[$i]->segundoApellidoHerido = $injuredSecondLastNames[$i];
            
        }


        for ($i = 0; $i <= count($thirdPersonList); $i++) {

            $siniestroClass->thirdPersonList[$i]->primerNombreTercero = $thirdsPeopleFirstNames[$i];
            $siniestroClass->thirdPersonList[$i]->primerApellidoTercero = $thirdsPeopleLastNames[$i];
            $siniestroClass->thirdPersonList[$i]->numeroTelefonoTercero = $thirdsPeoplePhoneNumbers[$i];
            $siniestroClass->thirdPersonList[$i]->segundoApellidoTercero = $thirdsPeopleSecondLastNames[$i];
        }

        for ($i = 0; $i <= count($thirdVehicleList); $i++) {

            $siniestroClass->thirdVehicleList[$i]->placaVehiculoTercero = $thirdsVehicleLicensePlates[$i];
            $siniestroClass->thirdVehicleList[$i]->marcaVehiculoTercero = $thirdsVehicleMakes[$i];
            $siniestroClass->thirdVehicleList[$i]->marcaVehiculoTercero = $thirdsVehicleModels[$i];
            $siniestroClass->thirdVehicleList[$i]->numeroSerialVehiculoTercero = $thirdsVehicleSerialNumbers[$i];
            $siniestroClass->thirdVehicleList[$i]->estiloVehiculoTercero = $thirdsVehicleStyles[$i];
            $siniestroClass->thirdVehicleList[$i]->subMarcaVehiculoTercero = $thirdsVehicleSubMakes[$i];
        
        }

        return \GuzzleHttp\json_encode($siniestroClass);

    }

    private function enviarCorreo($app, $params_error_report, $nameController, $chat_id)
    {

        $nameFunction = "enviarCorreo()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $receivers = $_POST['receivers'];
        $cc_receivers = $_POST['cc_receivers'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        $url = $_POST['url'];
        $soapUser = $_POST['soapUser'];
        $soapPass = $_POST['soapPass'];

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $datos = array(
            "receivers" => $receivers,
            "cc_receivers" => $cc_receivers,
            "url" => $url,
            "soapUser" => $soapUser,
            "soapPassword" => $soapPass
        );

        $filePath = '/var/www/app/controllers/Zurich_Documents/logo.txt';
        $fileContents = file_get_contents($filePath);

        $emailAddresses = explode(',', $receivers);
        $xml = '<com1:receivers>';
        
        foreach ($emailAddresses as $email) {
            $email = trim($email);
            $xml .= "\n\t<com1:Entry>$email</com1:Entry>";
        }
        
        $xml .= "\n</com1:receivers>";


        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://guidewire.com/ws/soapheaders" xmlns:com="http://zurich.com.mx/cmp/integration/webservice/mobile/api/common/CommonWebServiceAPI" xmlns:com1="http://zurich.com.mx/cmp/integration/webservice/mobile/customrequest/common">
        <soapenv:Header>
           <soap:locale>es</soap:locale>
           <soap:authentication>
              <soap:username>'.$soapUser.'</soap:username>
              <soap:password>'.$soapPass.'</soap:password>
           </soap:authentication>
        </soapenv:Header>
        <soapenv:Body>
           <com:EnviaCorreo>
              <com:emailRequest>            
                 <com1:ccReceivers>
                    <com1:Entry>'.$cc_receivers.'</com1:Entry>
                 </com1:ccReceivers>
                 <com1:htmlBody><![CDATA[
                 <div>
                   <h2>'.$subject.'</h2>
                   '.$body.'
                   <p>Saludos!!!!!</p>
                   <img src="cid:zurichLogo" width="100" height="100" alt="Logo Zurich"/>
                 </div>
                 ]]></com1:htmlBody>
                 <com1:images>
                    <com1:Entry>
                       <!--https://www.base64encode.org/-->
                       <com1:binaryData>'.$fileContents.'</com1:binaryData>
                       <com1:cid>zurichLogo</com1:cid>
                    </com1:Entry>
                 </com1:images>
                 '.$xml.'
                 <com1:subject>'.$subject.'</com1:subject>
                 <com1:userId>'.$soapUser.'</com1:userId>
              </com:emailRequest>
           </com:EnviaCorreo>
        </soapenv:Body>
     </soapenv:Envelope>';
    
        $headers = array(
            "Content-Type: application/xml",
            "Accept: */*",
            "Cache-Control: no-cache",
            "Cookie: incap_ses_9129_1958903=/qBjZ+WYfQEm7K9Nq7mwfi7rEWUAAAAAvcvWjtoRqaGatgA6HPEetA==; visid_incap_1958903=5Q+NViYPTQKpKx/81wELKy3rEWUAAAAAQUIPAAAAAADA68Rx/kayksJdxUFfVTKN",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); 
    
        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);

        $xml = new SimpleXMLElement($response);

        $xml->registerXPathNamespace('tns', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('pogo', 'http://zurich.com.mx/cmp/integration/webservice/common');

        $responseCode = $xml->xpath('//pogo:code');
        $responseStatus = $xml->xpath('//pogo:status');

        $responseCode = (string)$responseCode[0];
        $responseStatus = (string)$responseStatus[0];

        $emailSenderClass = new \stdClass();

        $emailSenderClass->codigoRespuesta = $responseCode;
        $emailSenderClass->estadoRespuesta = $responseStatus;


        return \GuzzleHttp\json_encode($emailSenderClass);
        

    }

    private function consultarActividad($app, $params_error_report, $nameController, $chat_id)
    {

        $nameFunction = "consultarActividad()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $activity_id = $_POST['activityId'];
        $claim_number = $_POST['claimNumber'];
        $url = $_POST['url'];
        $soapUser = $_POST['soapUser'];
        $soapPass = $_POST['soapPass'];

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $datos = array(
            "activity_id" => $activity_id,
            "claim_number" => $claim_number,
            "url" => $url,
            "soapUser" => $soapUser,
            "soapPassword" => $soapPass
        );

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://guidewire.com/ws/soapheaders" xmlns:com="http://zurich.com.mx/cmp/integration/webservice/mobile/api/common/CommonWebServiceAPI" xmlns:req="http://zurich.com.mx/cmp/integration/webservice/chatbot/to/request">
                                <soapenv:Header>
                                   <soap:locale>es</soap:locale>
                                   <soap:authentication>
                                      <soap:username>'.$soapUser.'</soap:username>
                                      <soap:password>'.$soapPass.'</soap:password>
                                   </soap:authentication>
                                </soapenv:Header>
                                <soapenv:Body>
                                   <com:ConsultarActividad>
                                      <!--Optional:-->
                                      <com:activityServiceRequest>
                                         <!--Optional:-->
                                         <req:activityId>'.$activity_id.'</req:activityId>
                                         <!--Optional:-->
                                         <req:claimNumber>'.$claim_number.'</req:claimNumber>
                                      </com:activityServiceRequest>
                                   </com:ConsultarActividad>
                                </soapenv:Body>
                            </soapenv:Envelope>';

        $headers = array(
            "Content-Type: application/xml",
            "Accept: */*",
            "Cache-Control: no-cache",
            "Cookie: incap_ses_9129_1958903=/qBjZ+WYfQEm7K9Nq7mwfi7rEWUAAAAAvcvWjtoRqaGatgA6HPEetA==; visid_incap_1958903=5Q+NViYPTQKpKx/81wELKy3rEWUAAAAAQUIPAAAAAADA68Rx/kayksJdxUFfVTKN",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); 
    
        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);

        $xml = new SimpleXMLElement($response);

        $xml->registerXPathNamespace('tns', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('pogo', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/response/activity');
        $xml->registerXPathNamespace('pogo2', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/common');

        $activityComments = $xml->xpath('//pogo:activityComments');
        $activityEstatus = $xml->xpath('//pogo:activityEstatus');
        $activityId = $xml->xpath('//pogo:activityId');
        $fechaProceso = $xml->xpath('//pogo2:fechaProceso');
        $idMessage = $xml->xpath('//pogo2:idMessage');
        $message = $xml->xpath('//pogo2:message');

        $activityComments = (string)$activityComments[0];
        $activityEstatus = (string)$activityEstatus[0];
        $activityId = (string)$activityId[0];
        $fechaProceso = (string)$fechaProceso[0];
        $idMessage = (string)$idMessage[0];
        $message = (string)$message[0];

        $activityClass = new \stdClass();

        $activityClass->comentariosActividad = $activityComments;
        $activityClass->estadoActividad = $activityEstatus;
        $activityClass->idActividad = $activityId;
        $activityClass->fechaProceso = $fechaProceso;
        $activityClass->idMensaje = $idMessage;
        $activityClass->mensaje = $message;


        return \GuzzleHttp\json_encode($activityClass);

    }

    private function crearActividad($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "crearActividad()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $activity_pattern_id = $_POST['activityPatternId'];
        $user_id = $_POST['userId'];
        $claim_number = $_POST['claimNumber'];
        $url = $_POST['url'];
        $soapUser = $_POST['soapUser'];
        $soapPass = $_POST['soapPass'];

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $datos = array(
            "activity_pattern_id" => $activity_pattern_id,
            "claim_number" => $claim_number,
            "user_id" => $user_id,
            "url" => $url,
            "soapUser" => $soapUser,
            "soapPassword" => $soapPass
        );

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://guidewire.com/ws/soapheaders" xmlns:com="http://zurich.com.mx/cmp/integration/webservice/mobile/api/common/CommonWebServiceAPI" xmlns:req="http://zurich.com.mx/cmp/integration/webservice/chatbot/to/request">
        <soapenv:Header>
           <soap:locale>es</soap:locale>
           <soap:authentication>
              <soap:username>'.$soapUser.'</soap:username>
              <soap:password>'.$soapPass.'</soap:password>
           </soap:authentication>
        </soapenv:Header>
        <soapenv:Body>
           <com:CrearActividad>
              <!--Optional:-->
              <com:createActivityRequest>
                 <!--Optional:-->
                 <req:activityPatternId>'.$activity_pattern_id.'</req:activityPatternId>
                 <!--Optional:-->
                 <req:claimNumber>'.$claim_number.'</req:claimNumber>
                 <!--Optional:-->
                 <req:userId>'.$user_id.'</req:userId>
              </com:createActivityRequest>
           </com:CrearActividad>
        </soapenv:Body>
     </soapenv:Envelope>';

        $headers = array(
            "Content-Type: application/xml",
            "Accept: */*",
            "Cache-Control: no-cache",
            "Cookie: incap_ses_9129_1958903=/qBjZ+WYfQEm7K9Nq7mwfi7rEWUAAAAAvcvWjtoRqaGatgA6HPEetA==; visid_incap_1958903=5Q+NViYPTQKpKx/81wELKy3rEWUAAAAAQUIPAAAAAADA68Rx/kayksJdxUFfVTKN",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); 
    
        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);

        $xml = new SimpleXMLElement($response);

        $xml->registerXPathNamespace('tns', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('pogo', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/response/activity');
        $xml->registerXPathNamespace('pogo2', 'http://zurich.com.mx/cmp/integration/webservice/chatbot/to/common');

        
        $activityId = $xml->xpath('//pogo:activityId');
        $fechaProceso = $xml->xpath('//pogo2:fechaProceso');
        $idMessage = $xml->xpath('//pogo2:idMessage');
        $message = $xml->xpath('//pogo2:message');

        $activityId = (string)$activityId[0];
        $fechaProceso = (string)$fechaProceso[0];
        $idMessage = (string)$idMessage[0];
        $message = (string)$message[0];

        $activityClass = new \stdClass();

        $activityClass->idActividad = $activityId;
        $activityClass->fechaProceso = $fechaProceso;
        $activityClass->idMensaje = $idMessage;
        $activityClass->mensaje = $message;

        return \GuzzleHttp\json_encode($activityClass);

    }

    private function enviarDocumento($app, $params_error_report, $nameController, $chat_id)
    {
        $nameFunction = "enviarDocumento()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $area = $_POST['area'];
        $claimId = $_POST['claimId'];
        $attrName = $_POST['attrName'];
        $attrValue = $_POST['attrValue'];
        $attrName2 = $_POST['attrName2'];
        $attrValue2 = $_POST['attrValue2'];
        $attrName3 = $_POST['attrName3'];
        $attrValue3 = $_POST['attrValue3'];
        $documentName = $_POST['documentName'];
        $documentSubtype = $_POST['documentSubtype'];
        $isInsuredDocument = $_POST['isInsuredDocument'];
        $isThirdPartyDocument = $_POST['isThirdPartyDocument'];
        $url = $_POST['url'];
        $soapUser = $_POST['soapUser'];
        $soapPass = $_POST['soapPass'];
        $document_link = $_POST['document_link'];
        date_default_timezone_set('America/Mexico_City');
        $current_time = new DateTime();
        $time_in_mexico_city = $current_time->format('Y-m-d\TH:i:s.u\Z');
        
        if ($documentSubtype === "docSub_016") {
            $ext_body = "<com1:Entry>
                            <com2:attrName>'.$attrName.'</com2:attrName>
                            <com2:attrValue>'.$attrValue.'</com2:attrValue>
                        </com1:Entry>
                        <com1:Entry>
                            <com2:attrName>'.$attrName2.'</com2:attrName>
                            <com2:attrValue>'.$attrValue2.'</com2:attrValue>
                        </com1:Entry>
                        <com1:Entry>
                            <com2:attrName>'.$attrName3.'</com2:attrName>
                            <com2:attrValue>'.$attrValue3.'</com2:attrValue>
                        </com1:Entry>";
        } else {
            $attrValue = $time_in_mexico_city;
            $ext_body = "<com1:Entry>
                            <com2:attrName>'.$attrName.'</com2:attrName>
                            <com2:attrValue>'.$attrValue.'</com2:attrValue>
                        </com1:Entry>
                        <com1:Entry>
                            <com2:attrName>'.$attrName2.'</com2:attrName>
                            <com2:attrValue>'.$attrValue2.'</com2:attrValue>
                        </com1:Entry>";
        }
        

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];

        $datos = array(
            "area" => $area,
            "claimId" => $claimId,
            "attrName" => $attrName,
            "attrValue" => $attrValue,
            "attrName2" => $attrName2,
            "attrValue2" => $attrValue2,
            "documentName" => $documentName,
            "documentSubtype" => $documentSubtype,
            "isInsuredDocument" => $isInsuredDocument,
            "isThirdPartyDocument" => $isThirdPartyDocument,
            "url" => $url,
            "soapUser" => $soapUser,
            "soapPassword" => $soapPass
        );

        $archivo_pdf = file_get_contents($document_link);
        $fileName = $fileName = basename($document_link);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        
        if ($archivo_pdf !== false) {
            $archivo_base64 = base64_encode($archivo_pdf);
        } else {
            $documentClass->codigoRespuesta = "400";
            $documentClass->estadoRespuesta = "No se puede convertir el archivo a base64";
        }

        $fileContents = $archivo_base64;

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soap="http://guidewire.com/ws/soapheaders" xmlns:com="http://zurich.com.mx/cmp/integration/webservice/mobile/api/common/CommonWebServiceAPI" xmlns:com1="http://zurich.com.mx/cmp/integration/webservice/mobile/customrequest/common" xmlns:com2="http://zurich.com.mx/cmp/integration/webservice/mobile/common">
        <soapenv:Header>
           <soap:locale>es</soap:locale>
           <soap:authentication>
              <soap:username>'.$soapUser.'</soap:username>
              <soap:password>'.$soapPass.'</soap:password>
           </soap:authentication>
        </soapenv:Header>
        <soapenv:Body>
           <com:EnviaDocumento>
              <com:documentSendingRequest>
                 <com1:ContentStream>'.$fileContents.'</com1:ContentStream>
                 <com1:area>'.$area.'</com1:area>
                 <com1:claimId>'.$claimId.'</com1:claimId>
                 <com1:docAttributes>'.$ext_body.'</com1:docAttributes>
                 <com1:docCreateDate>'.$time_in_mexico_city.'</com1:docCreateDate>
                 <com1:documentName>'.$documentName.'.'.$extension.'</com1:documentName>
                 <com1:documentSubtype>'.$documentSubtype.'</com1:documentSubtype>
                 <com1:isInsuredDocument>'.$isInsuredDocument.'</com1:isInsuredDocument>
                 <com1:isThirdPartyDocument>'.$isThirdPartyDocument.'</com1:isThirdPartyDocument>
                 <com1:serviceId></com1:serviceId>
                 <com1:thirdId></com1:thirdId>
                 <com1:userId>'.$soapUser.'</com1:userId>
              </com:documentSendingRequest>
           </com:EnviaDocumento>
        </soapenv:Body>
     </soapenv:Envelope>
     ';

        $headers = array(
            "Content-Type: application/xml",
            "Accept: */*",
            "Cache-Control: no-cache",
            "Cookie: incap_ses_9129_1958903=/qBjZ+WYfQEm7K9Nq7mwfi7rEWUAAAAAvcvWjtoRqaGatgA6HPEetA==; visid_incap_1958903=5Q+NViYPTQKpKx/81wELKy3rEWUAAAAAQUIPAAAAAADA68Rx/kayksJdxUFfVTKN",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); 
    
        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);

        $xml = new SimpleXMLElement($response);

        $xml->registerXPathNamespace('tns', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('pogo', 'http://zurich.com.mx/cmp/integration/webservice/mobile/customresponse/common');
        $xml->registerXPathNamespace('pogo2', 'http://zurich.com.mx/cmp/integration/webservice/common');

        $responseCode = $xml->xpath('//pogo2:code');
        $responseStatus = $xml->xpath('//pogo2:status');

        $responseCode = (string)$responseCode[0];
        $responseStatus = (string)$responseStatus[0];

        $documentClass = new \stdClass();

        $documentClass->codigoRespuesta = $responseCode;
        $documentClass->estadoRespuesta = $responseStatus;

        return \GuzzleHttp\json_encode($documentClass);

    }

    private function crearCorreo($app, $params_error_report, $nameController, $chat_id){


        $nameFunction = "crearCorreo()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipo_correo = $_POST['tipo_reporte'];
        $nombre_tramitador = $_POST['nombre_tramitador'];
        $tipo_pago = $_POST['tipo_pago'];
        $numero_siniestro = $_POST['numero_siniestro'];
        $tipo_reembolso = $_POST['tipo_reembolso'];
        $nombre_asegurado = $_POST['nombre_asegurado'];
        $nombre_valuador = $_POST['nombre_valuador'];
        $duda = $_POST['duda'];
        $email_asegurado = $_POST['email_asegurado'];
        $tipo_tramite = $_POST['tipo_tramite'];
        $nombre_lesionado = $_POST['nombre_lesionado'];
        $certificado = $_POST['certificado'];
        $email_solicitante = $_POST['email_solicitante'];
        $cellphone_solicitante = $_POST['cellphone_solicitante'];
        $cellphone_asegurado = $_POST['cellphone_asegurado'];
        $horas_atencion = $_POST['horas_atencion'];
        $tipo_siniestro = $_POST['tipo_siniestro'];

        switch ($tipo_correo) {
            case 1:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_1.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Tipo Pago>', $tipo_pago, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 2:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_2.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Tipo Pago>', $tipo_pago, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 3:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_3.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Tipo Pago>', $tipo_pago, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 4:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_4.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Tipo de Reembolso>', $tipo_reembolso, $asunto);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Tipo Pago>', $tipo_pago, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 5:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_5.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Tipo Pago>', $tipo_pago, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 6:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_6.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Nombre Valuador>', $nombre_valuador, $cuerpo);
                $cuerpo = str_replace('<Nombre Asegurado>', $nombre_asegurado, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 7:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_7.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Duda>', $duda, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 8:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_8.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Nombre Valuador>', $nombre_valuador, $cuerpo);
                $cuerpo = str_replace('<Nombre Asegurado>', $nombre_asegurado, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 9:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_9.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Tipo Siniestro>', $tipo_siniestro, $asunto);
                $cuerpo = str_replace('<Nombre Tramitador>', $nombre_tramitador, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 10:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_10.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Numero Siniestro>.', $numero_siniestro.'.', $cuerpo);
                $cuerpo = str_replace('<Cuenta Correo Electronico Asegurado>', $email_asegurado, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 11:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_11.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Nombre Lesionado>', $nombre_lesionado, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $cuerpo = str_replace('<Numero de Certificado>', $certificado, $cuerpo);
                $cuerpo = str_replace('<Correo Electronico Solicitante>', $email_solicitante, $cuerpo);
                $cuerpo = str_replace('<Numero Telefonico Solicitante>', $cellphone_solicitante, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 12:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_12.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $cuerpo = str_replace('<Nombre Lesionado>', $nombre_lesionado, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $cuerpo = str_replace('<Numero de Certificado>', $certificado, $cuerpo);
                $cuerpo = str_replace('<Correo Electronico Solicitante>', $email_solicitante, $cuerpo);
                $cuerpo = str_replace('<Numero Telefonico Solicitante>', $cellphone_solicitante, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 13:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_13.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $cuerpo = str_replace('<Nombre Asegurado>', $nombre_asegurado, $cuerpo);
                $cuerpo = str_replace('<Correo Electronico del Asegurado>', $email_asegurado, $cuerpo);
                $cuerpo = str_replace('<Numero Telefonico del Asegurado>', $cellphone_asegurado, $cuerpo);
                $cuerpo = str_replace('<Numero Siniestro>', $numero_siniestro, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 14:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_14.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Nombre Valuador>', $nombre_valuador, $cuerpo);
                $cuerpo = str_replace('<Nombre Asegurado>', $nombre_asegurado, $cuerpo);
                $cuerpo = str_replace('<Correo Electronico Asegurado>', $email_asegurado, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 15:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_15.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 16:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_16.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 17:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_17.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 18:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_18.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $cuerpo = str_replace('<Numero Hode Atencion>', $horas_atencion, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 19:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_19.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $cuerpo = str_replace('<Numero Horas de Aion>', $horas_atencion, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 20:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_20.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $cuerpo = str_replace('<Numero Horas de Aton>', $horas_atencion, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 21:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_21.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 22:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_22.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 23:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_23.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 24:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_24.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            case 25:
                $text = file_get_contents('/var/www/app/controllers/Zurich_Documents/template_25.txt');
                list($asunto, $cuerpo) = explode("Cuerpo del Correo:", $text, 2);
                $asunto = str_replace('<Numero Siniestro>', $numero_siniestro, $asunto);
                $cuerpo = str_replace('<Tipo Tramite>', $tipo_tramite, $cuerpo);
                $asunto = str_replace("Asunto: ", "", $asunto);
                break;
            default:
                $asunto = "N/A";
                $cuerpo = "N/A";

        }

        $asunto = trim($asunto);
        $cuerpo = trim($cuerpo);

        $cuerpo = str_replace("\n\nSaludos!!!!", "", $cuerpo);
        $cuerpo = str_replace("\n\nSaludos!!!", "", $cuerpo);

        $cuerpo = "<p>" . str_replace("\n", "</p><p>", $cuerpo) . "</p>";

        $var = '{
            "asuntoCorreo" : "'.$asunto.'",
            "cuerpoCorreo" : "'.$cuerpo.'"
        }';

        return $var;

    }

    private function validarMontoPago($app, $params_error_report, $nameController, $chat_id){


        $nameFunction = "validarMontoPago()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $monto_total = $_POST['montoTotal'];
        $monto_verdadero = $_POST['montoVerdadero'];

        $monto_total = explode(",", $monto_total);
        $sum = 0.0;
        
        foreach ($monto_total as $value) {
            $floatValue = floatval(str_replace(',', '', $value));
            $sum += $floatValue;
        }
        
        if ($sum == $monto_verdadero) {
            $monto_valido = '1';
        } else {
            $monto_valido = '0';
        }

        $var = '{
            "montoValido" : "'.$monto_valido.'"
        }';

        return $var;

    }


    private function validarHora($app, $params_error_report, $nameController, $chat_id){

        $fecha_evento = $_POST['fechaEvento'];
        $hora_evento = $_POST['horaEvento'];
        date_default_timezone_set('America/Mexico_City');
        $currentDatetime = new DateTime();

        $inputData = [
            "FechaEvento" => $fecha_evento,
            "HoraEvento" => $hora_evento
        ];

        $fechaEvento = DateTime::createFromFormat("Y-m-d", $inputData["FechaEvento"]);
        $horaEvento = DateTime::createFromFormat("H:i:s", $inputData["HoraEvento"]);

        $eventoDatetime = new DateTime();

        $eventoDatetime->setDate(
            $fechaEvento->format("Y"),
            $fechaEvento->format("m"),
            $fechaEvento->format("d")
        );

        $eventoDatetime->setTime(
            $horaEvento->format("H"),
            $horaEvento->format("i"),
            $horaEvento->format("s")
        );

        $interval = $currentDatetime->diff($eventoDatetime);
        $hoursDifference = $interval->h + ($interval->days * 24);

        if ($hoursDifference < 12) {
            $var = '{
                "diferenciaHoras" : "1"
            }';
        } elseif ($hoursDifference > 12 && $hoursDifference < 24) {
            $var = '{
                "diferenciaHoras" : "2"
            }';
        } else {
            $var = '{
                "diferenciaHoras" : "0"
            }';
        }

        return $var;

    }

    private function validarHora2($app, $params_error_report, $nameController, $chat_id){

        $fecha_evento = $_POST['fechaEvento'];
        $hora_evento = $_POST['horaEvento'];
        date_default_timezone_set('America/Mexico_City');
        $currentDatetime = new DateTime();

        $inputData = [
            "FechaEvento" => $fecha_evento,
            "HoraEvento" => $hora_evento
        ];

        $fechaEvento = DateTime::createFromFormat("Y-m-d", $inputData["FechaEvento"]);
        $horaEvento = DateTime::createFromFormat("H:i:s", $inputData["HoraEvento"]);

        $eventoDatetime = new DateTime();

        $eventoDatetime->setDate(
            $fechaEvento->format("Y"),
            $fechaEvento->format("m"),
            $fechaEvento->format("d")
        );

        $eventoDatetime->setTime(
            $horaEvento->format("H"),
            $horaEvento->format("i"),
            $horaEvento->format("s")
        );

        $interval = $currentDatetime->diff($eventoDatetime);
        $hoursDifference = $interval->h + ($interval->days * 24);

        if ($hoursDifference < 2) {
            $var = '{
                "diferenciaHoras" : "1"
            }';
        } elseif ($hoursDifference > 2 && $hoursDifference == 3) {
            $var = '{
                "diferenciaHoras" : "2"
            }';
        } else {
            $var = '{
                "diferenciaHoras" : "0"
            }';
        }

        return $var;
    }


    private function getRequisitosParaTramiteDePagoSiniestro($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
            21, 22, 23, 24, 25, 26, 27
        );
        
        $optionComments = array(
            "¿Qué documentación requiero para solicitar el pago de daños de pérdida parcial si soy Persona Física?",
            "¿Qué documentación requiero para solicitar el pago de daños de pérdida parcial si soy Persona Moral?",
            "¿Qué documentación requiero para solicitar el pago por pérdida total si soy Persona Física?",
            "¿Qué documentación requiero para solicitar el pago por pérdida total si soy Persona Moral?",
            "¿Qué documentación requiero para solicitar el pago por robo parcial o total sí soy Persona Física?",
            "¿Qué documentación requiero para solicitar el pago por robo parcial o total sí soy Persona Moral?",
            "¿Qué documentación se requiere para el reembolso de grúas por asistencia?",
            "¿Qué documentación se requiere para el reembolso de extravío de llaves?",
            "¿Qué documentación se requiere para el reembolso de apoyo al transporte?",
            "¿Qué documentación se requiere para el reembolso de multas y corralones?",
            "¿Qué documentación se requiere para el pago de muerte al conductor?",
            "¿Qué documentación se requiere para el pago de los gastos funerarios?",
            "¿Qué documentación se requiere para el pago de gastos médicos?",
            "¿Qué documentación se requiere para el reembolso de llantas y rines?",
            "¿Cómo puedo solicitar un pago de daños?",
            "Me dijeron que mi auto es pérdida total, ¿qué tengo que hacer ahora?",
            "Ya mandé mi documentación y no he recibido respuesta",
            "¿En dónde puedo entregar personalmente documentos?",
            "¿Por qué motivo me están solicitando documentos que no aparecen en el listado de documentos requeridos?",
            "¿Cuál es el tiempo de respuesta para mi solicitud de reembolso?",
            "¿A qué correo debo enviar mi documentación para reembolso?",
            "Para el Artículo 492 ¿cómo identifico el nuevo formato?",
            "¿Cuál es el emisor de ID que piden en el Artículo 492?",
            "¿Por qué es obligatoria la factura en formato XML?",
            "¿Por qué el formato Artículo 492 deber ser a nombre del titular de la cuenta?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );
        
        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);
    }


    private function getRequisitosParaIngresoHospitalario($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17
        );
        
        $optionComments = array(
            "¿Cuáles son los documentos que debo llenar y entregar en caso de un ingreso hospitalario que no está programado?",
            "¿Qué hago si perdí mi pase de admisión?",
            "¿Cómo solicito otro pase médico?",
            "¿Cuánto tiempo de vigencia tiene el pase de admisión?",
            "Necesito terapia de rehabilitación, ¿dónde puedo solicitarla?",
            "No han autorizado mi cirugía.",
            "¿Dónde puedo consultar la red hospitalaria?",
            "El Médico o el Hospital no tienen convenio con Zurich",
            "¿Dónde puedo descargar los formatos que debo llenar para Gastos Médicos y a quién se los debo entregar?",
            "¿Cuál es el tiempo de respuesta de la aseguradora una vez que ingreso al hospital y entrego mi documentación?",
            "¿Cuál es el tiempo de respuesta de mi alta hospitalaria?",
            "¿Cuáles son los gastos personales no cubiertos?",
            "¿Dónde puedo obtener el listado de documentos para reembolso de Gastos Médicos?",
            "¿Una vez que tengo mi carta de autorización, qué hago?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );

        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);
    }

    private function getValuacionReparacionVehiculo($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
            21, 22, 23, 24, 25, 26, 27
        );
        
        $optionComments = array(
            "¿Cuándo me entregan mi auto?",
            "¿Cuándo autorizan la reparación de mi auto?",
            "¿Quién es mi Perito Valuador?",
            "¿En qué Centro de Reparación o Taller se encuentra mi auto?",
            "¿Cuándo llegan las refacciones de mi auto?",
            "¿Cuándo llega mi auto al Centro de Reparación/Agencia/taller?",
            "¿Qué le van a hacer a mi auto?",
            "¿Cómo puedo cambiar de taller mi auto?",
            "Mi auto ya lleva tiempo en el taller y aún no se inicia la valuación.",
            "No quiero que mi auto se convierta en pérdida total.",
            "No estoy de acuerdo con el pago de daños.",
            "¿Cómo puedo solicitar una revaloración de daños?",
            "No estoy de acuerdo con el monto del deducible a pagar.",
            "¿Quién es mi Ajustador?",
            "¿Cómo puedo reclamar piezas faltantes en mi auto?",
            "Ya me entregaron mi auto, pero no quedó bien la reparación.",
            "El Perito no contesta, ¿quién más puede ayudarme?",
            "¿Por qué debo pagar un deducible si yo no fui responsable?",
            "¿Qué documentos necesito llevar para la entrega de mi auto?",
            "¿Cómo hago para aplicar mi garantía de reparación?",
            "¿Cuánto tiempo tarda una reparación?",
            "¿Qué estatus tiene mi auto?",
            "¿Dónde puedo consultar la ubicación del taller donde se encuentra mi auto?",
            "¿Cómo puedo recoger mis pertenencias del auto determinado como pérdida total?",
            "¿Cuál es el proceso completo de reparación de un auto?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );

        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);

    }

    private function getInfoGeneral($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
            21, 22, 23, 24, 25, 26
        );
        
        $optionComments = array(
            "¿Cómo puedo saber el porcentaje de mi deducible?",
            "¿Quiero saber el monto de mi deducible?",
            "¿Cómo puedo ver mi tema legal?",
            "¿Cómo puedo pagar mi deducible?",
            "¿Con qué datos fiscales debo facturar mi deducible?",
            "¿Con qué datos fiscales debo facturar mi recuperación?",
            "¿Cómo debo refacturar por pérdida total o robo?",
            "¿Quién es mi Tramitador asignado?",
            "El Ajustador dijo que me pagaban en X días y no me han pagado",
            "¿Cuánto tiempo se tardan en pagar una indemnización?",
            "¿Cómo puedo cancelar mi póliza?",
            "¿Cómo puedo renovar mi póliza?",
            "¿Cómo puedo pagar mi póliza?",
            "¿Cómo puedo solicitar la carátula de mi póliza?",
            "¿Dónde puedo consultar las condiciones generales de mi póliza?",
            "¿Cuáles son las coberturas de mi póliza?",
            "¿Cómo puedo contactar a mi Asesor de robo?",
            "¿Dónde puedo consultar mi número de Siniestro?",
            "¿Cómo reporto un siniestro?",
            "¿Cómo consulto el estatus de mi trámite o robo?",
            "Mi póliza está cancelada por falta de pago, ¿qué hago?",
            "¿Zurich cuenta con algún número telefónico a donde puedo llamar en caso de tener dudas sobre mi cobertura o para saber el estado de mi trámite?",
            "¿A qué nombre debo generar mis facturas?",
            "Si pago mis gastos médicos utilizando mi tarjeta de crédito ¿Zurich puede pagar esos gastos a la institución bancaria?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );

        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);
        
    }

    private function getAsistenciaAutos($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5
        );
        
        $optionComments = array(
            "¿Dónde puedo solicitar una grúa?",
            "Quiero afectar mi cobertura de auto sustituto, ¿Qué debo hacer?",
            "¿A dónde puedo comunicarme para reportar un robo de auto?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );

        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);

    }

    
    private function getAsistenciaMedica($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
            11, 12, 13
        );
        
        $optionComments = array(
            "¿Cuál es el tiempo de respuesta en evento programado?",
            "¿La carta autorización inicial incluye ya toda la suma que tengo?",
            "En Paciente Zurich ¿voy a cubrir yo el envío de mis medicamentos a domicilio?",
            "¿Si acepto formar parte de Paciente Zurich se restringe el pago de reembolsos?",
            "¿Cuál es el tiempo de entrega de los medicamentos?",
            "Sí ingreso a Paciente Zurich ¿ya se elimina o condona automáticamente mi deducible y coaseguro?",
            "Si mi médico no acepta el tabulador y le pago los honorarios y después tramito por reembolso ¿me cobraran coaseguro?",
            "¿Las consultas de Psicología tiene algún costo?",
            "¿Puedo tomar las sesiones de Psicología con otra Psicóloga?",
            "¿Por qué debo detallar el mecanismo de lesión?",
            "¿Es obligatorio indicar el sitio de atención de tratamiento?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );

        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);

    }

    private function getQuejasAclaraciones($app, $params_error_report, $nameController, $chat_id){

        $optionNumbers = array(
            1, 2, 3, 4, 5
        );
        
        $optionComments = array(
            "¿Con quién puedo levantar una queja?",
            "No me pagaron toda mi factura",
            "¿Dónde puedo solicitar una aclaración?",
            "Menú preguntas siniestros",
            "Menú Principal"
        );

        $dynamicQuestion = new \stdClass();

        for ($i=0; $i <= count($optionNumbers) - 1; $i++) {

            $dynamicQuestion->requisitosTramites[$i]->preguntaOpcion = $optionNumbers[$i];
            $dynamicQuestion->requisitosTramites[$i]->preguntaTexto = $optionComments[$i];

        }

        return \GuzzleHttp\json_encode($dynamicQuestion);

    }


    private function getListDocuments($app, $params_error_report, $nameController, $chat_id){

        $tipo_documento = $_POST['tipo_documento'];

        switch ($tipo_documento) {
            case 1:
                $documentNames = array(
                    "facturaBien",
                    "solicitudAfectacion",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 2:
                $documentNames = array(
                    "facturaBien",
                    "solicitudAfectacion",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 3:
                $documentNames = array(
                    "facturaEndosada",
                    "bajaPlacas",
                    "identificacionOficialNA_TE",
                    "identificacionOficialNA_TE",
                    "articulo492",
                    "comprobanteDomicilio",
                    "estadoCuentaCLABE",
                    "oficioLiberacionVehiculo",
                    "acreditacionPropiedadCertificadaAutoridad",
                    "averiguacionPreviaCertificada"
                );
                break;
            case 4:
                $documentNames = array(
                    "facturaEndosada",
                    "bajaPlacas",
                    "identificacionOficialNA_TE",
                    "identificacionOficialNA_TE",
                    "articulo492",
                    "comprobanteDomicilio",
                    "estadoCuentaCLABE",
                    "oficioLiberacionVehiculo",
                    "acreditacionPropiedadCertificadaAutoridad",
                    "averiguacionPreviaCertificada"
                );
                break;
            case 5:
                $documentNames = array(
                    "facturaEndosada",
                    "bajaPlacas",
                    "identificacionOficialNA_TE",
                    "identificacionOficialNA_TE",
                    "articulo492",
                    "comprobanteDomicilio",
                    "estadoCuentaCLABE",
                    "oficioLiberacionVehiculo",
                    "acreditacionPropiedadCertificadaAutoridad",
                    "averiguacionPreviaCertificada"
                );
                break;
            case 6:
                $documentNames = array(
                    "facturaEndosada",
                    "bajaPlacas",
                    "identificacionOficialNA_TE",
                    "identificacionOficialNA_TE",
                    "articulo492",
                    "comprobanteDomicilio",
                    "estadoCuentaCLABE",
                    "oficioLiberacionVehiculo",
                    "acreditacionPropiedadCertificadaAutoridad",
                    "averiguacionPreviaCertificada"
                );
                break;
            case 7:
                $documentNames = array(
                    "tarjetaCirculacion",
                    "ordenPagoDanos",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 8:
                $documentNames = array(
                    "tarjetaCirculacion",
                    "ordenPagoDanos",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "poderNotarial",
                    "actaConstitutiva",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 9:
                $documentNames = array(
                    "facturaEndosada",
                    "etiquetaSesionDerechos",
                    "bajaPlacas",
                    "identificacionOficialNA_TE",
                    "identificacionOficialNA_TE",
                    "articulo492",
                    "comprobanteDomicilio",
                    "estadoCuentaCLABE"
                );
                break;
            case 10:
                $documentNames = array(
                    "facturaEndosada",
                    "bajaPlacas",
                    "poderNotarial",
                    "identificacionOficialNA_TE",
                    "identificacionOficialNA_TE",
                    "articulo492",
                    "comprobanteDomicilio",
                    "estadoCuentaCLABE",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 11:
                $documentNames = array(
                    "facturaBien",
                    "solicitudAfectacion",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 12:
                $documentNames = array(
                    "facturaBien",
                    "tarjetaCirculacion",
                    "solicitudAfectacion",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 13:
                $documentNames = array(
                    "tarjetaCirculacion",
                    "facturaBien",
                    "solicitudAfectacion",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 14:
                $documentNames = array(
                    "tarjetaCirculacion",
                    "facturaBien",
                    "articulo492",
                    "identificacionOficialNA_TE",
                    "estadoCuentaCLABE",
                    "comprobanteDomicilio",
                    "finiquitoFirmado",
                    "tarjetonRegistroFederalVehiculos"
                );
                break;
            case 15:
                $documentNames = array(
                    "paseServicioMedico",
                    "facturaGastosMedicos"
                );
                break;
            case 16:
                $documentNames = array(
                    "paseServicioMedico"
                );
                break;
            default:
                $documentNames = array (
                    "N/A"
                );
                break;

        }

        $documentClass = new \stdClass();

        for ($i=0; $i <= count($documentNames) - 1; $i++) {

            $documentClass->documentArray[$i]->documentoEncontrado = $documentNames[$i];

        }

        return \GuzzleHttp\json_encode($documentClass);
        
    }

    private function getAttributes($app, $params_error_report, $nameController, $chat_id){

        $document_name = $_POST['document_name'];

        $documentList = array(
            "tarjetaCirculacion" => array("fechaComprobante", "tipoComprobante", "Tarjeta de Circulación"),
            "ordenPagoDanos" => array("fechaPago", "tipoOrden", "Orden Pago de Daños"),
            "articulo492" => array("fechaFormato", "tipoFormato", "Artículo 492"),
            "identificacionOficialNA_TE" => array("fechaIdentificacion", "tipoIdentificacion", "Identificación Oficial NA/TE"),
            "estadoCuentaCLABE" => array("fechaComprobante", "tipoComprobante", "Estado de cuenta con cuenta clabe"),
            "comprobanteDomicilio" => array("fechaComprobante", "tipoComprobante", "Comprobante de domicilio"),
            "finiquitoFirmado" => array("fechaPago", "tipoOrden", "Finiquito Firmado"),
            "tarjetonRegistroFederalVehiculos" => array("fechaComprobante", "tipoComprobante", "Tarjetón de Registro Federal de Vehículos unidades 1990 y anteriores"),
            "facturaBien" => array("fechaFactura", "tipoFactura", "Factura del Bién"),
            "solicitudAfectacion" => array("fechaCorrespondencia", "tipoCorrespondencia", "Carta Email Solicitud"),
            "poderNotarial" => array("fechaExpedicion", "tipoActa", "Poder notarial"),
            "actaConstitutiva" => array("fechaExpedicion", "razonSocial", "Acta constitutiva"),
            "etiquetaSesionDerechos" => array("fechaFactura", "tipoFactura", "Etiqueta Sesion de Derechos"),
            "facturaEndosada" => array("fechaFactura", "tipoFactura", "Factura Endosada"),
            "bajaPlacas" => array("fechaComprobante", "tipoComprobante", "Recibo Baja de Placas"),
            "acreditacionPropiedadCertificadaAutoridad" => array("fechaExpedicion", "tipoActa", "Acreditación de Propiedad Certificada Autoridad"),
            "oficioLiberacionVehiculo" => array("fechaExpedicion", "tipoActa", "Oficio liberación del vehículo"),
            "averiguacionPreviaCertificada" => array("fechaExpedicion", "tipoActa", "Averiguación Previa Certificada"),
            "paseServicioMedico" => array("tipoLesionado","nombreLesionado","tipoFormato", "Pase de servicio médico"),
            "facturaGastosMedicos" => array("fechaFactura", "tipoFactura", "Factura de Gastos Medicos")

        );
        
        $cc_list = array(
            "docSub_049",
            "docSub_067",
            "docSub_244",
            "docSub_254",
            "docSub_216",
            "docSub_010",
            "docSub_256",
            "docSub_220",
            "docSub_238",
            "docSub_227",
            "docSub_048",
            "docSub_064",
            "docSub_141",
            "docSub_141",
            "docSub_211",
            "docSub_200",
            "docSub_151",
            "docSub_204",
            "docSub_016",
            "docSub_241"
        );

        $attributeClass = new \stdClass();

        if (array_key_exists($document_name, $documentList)) {
            $info = $documentList[$document_name];
            $index = array_search($document_name, array_keys($documentList));
            if (isset($cc_list[$index])) {
                $cc_info = $cc_list[$index];
            }
            if ($document_name === "paseServicioMedico"){
                $attributeClass->atributosEncontrados = "1";
                $attributeClass->ccDocumento = $cc_info;
                $attributeClass->atributoLesionado = $info[0];
                $attributeClass->atributoNombre = $info[1];
                $attributeClass->atributoTipo = $info[2];
                $attributeClass->valorTipo = $info[3];
            } else {
                $attributeClass->atributosEncontrados = "1";
                $attributeClass->ccDocumento = $cc_info;
                $attributeClass->atributoFecha = $info[0];
                $attributeClass->atributoTipo = $info[1];
                $attributeClass->valorTipo = $info[2];
            }
        } else {
            $attributeClass->atributosEncontrados = "N/A";
        }

        return \GuzzleHttp\json_encode($attributeClass);

    }


    private function getDate($app, $params_error_report, $nameController, $chat_id){

        $fecha_inicial = $_POST['fechaInicial'];
        date_default_timezone_set('America/Mexico_City');
        if ($fecha_inicial == null) {
            $dateTime = new DateTime('now',new DateTimeZone('America/Mexico_City'));
        } else {
            $dateTime = new DateTime($fecha_inicial);
        }

        $date = $dateTime->format('Y-m-d');
        $time = $dateTime->format('H:i:s');

        $var = '{
            "fechaGenerada" : "'.$date.'",
            "horaGenerada" : "'.$time.'"
        }';

        return $var;

    }

    private function getAnalistTramitador($app, $params_error_report, $nameController, $chat_id){

        $id_analista = $_POST['idAnalista'];
        $id_analista = strtolower($id_analista);

        $list_analist_1 = array(
            'abril.barrios',
            'diana.rangel1',
            'diana.gomez1',
            'joseline.martinez',
            'judith.duarte',
            'laura.galvan',
            'lucero.gonzales3',
            'm.herrera1',
            'rocio.garcia1',
            'tanyamitzi.fonseca',
            'viridiana.loera'
        );

        $list_analist_2 = array(
            'yolanda.valencia1',
            'david.radilla',
            'mauricio.ruiz',
            'juan.rodriguez7',
            'luis.diaz3',
            'moises.manriquez',
            'laura.jimenez1'
        );

        if (in_array($id_analista, $list_analist_1)) {
            $jefe_nombre = 'Fernando Montiel Estrada';
            $jefe_email = 'fernando.montiel@mx.zurich.com';
            $jefe_numero = '5541412017';
        } elseif (in_array($id_analista, $list_analist_2)) {
            $jefe_nombre = 'César Alberto Martinez Hinojosa';
            $jefe_email = 'cesar.martinez@mx.zurich.com';
            $jefe_numero = '5534030944';
        }

        $var = '{
            "nombreJefeAnalista" : "'.$jefe_nombre.'",
            "emailJefeAnalista" : "'.$jefe_email.'",
            "numeroJefeAnalista" : "'.$jefe_numero.'"
        }';

        return $var;


    }

    private function getExpertPerson($app, $params_error_report, $nameController, $chat_id){

        $id_expert = $_POST['idExpert'];

        $list_analist_1 = array(
            'JORGE.MONDRAGON',
            'OTrejoV',
            'DAVID.RADILLA',
            'RAUL.IBARRA',
            'LAURA.JIMENEZ1',
            'ARTURO.MARTINEZ3',
            'REYNALDO.ORTIZ1'
        );

        $list_analist_2 = array(
            'BRAYAN.CORTES',
            'FERNANDO.SIXTOS',
            'FLOR.AGUILAR1',
            'JEsparzaM',
            'JESUSMIGUEL.LOPEZ',
            'JGomezC',
            'GUSTAVO.MARROQUIN',
            'TERESA.PEDRAZA'
        );

        if (in_array($id_expert, $list_analist_1)) {
            $jefe_nombre = 'Julio Cesar Carrasco Hernandez';
            $jefe_email = 'julio.carrasco1@mx.zurich.com';
            $jefe_numero = '5561943110';
        } elseif (in_array($id_expert, $list_analist_2)) {
            $jefe_nombre = 'Salvador Martinez Camarena';
            $jefe_email = 'salvador.1.martinez@mx.zurich.com';
            $jefe_numero = '5519026211';
        }

        $var = '{
            "nombreJefeExpert" : "'.$jefe_nombre.'",
            "emailJefeExpert" : "'.$jefe_email.'",
            "numeroJefeExpert" : "'.$jefe_numero.'"
        }';

        return $var;


    }

    private function getListDocuments2($app, $params_error_report, $nameController, $chat_id){

        $tipo_documento = $_POST['tipoDocumento'];
        $tipo_gasto_medico = $_POST['tipoGastoMedico'];

        switch ($tipo_documento) {
            case 1:
                $listado_msj = "Factura del Servicio de la grúa XML y PDF, Solicitud de afectación por parte del Asegurado de la Cobertura de Cristales 
                                Formato Articulo 492 llenado,
                                Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                                Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                                Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                                Finiquito firmado,
                                Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Cristales";
                break;
            case 2:
                $listado_msj = "Factura del Servicio de la grúa XML y PDF,
                            Solicitud de afectación por parte del Asegurado de la Cobertura de extravío de llaves,
                            Formato Articulo 492 llenado,
                            Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                            Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                            Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                            Finiquito firmado,
                            Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Extravio de llaves";
                break;
            case 3:
                $listado_msj = "Factura endosada a Zurich Aseguradora Mexicana S.A de C.V con consecutividad de endosos, si existen refacturas presentar todas las facturas hasta la de origen, en vehículos financiados Carta Factura vigente.
                            Etiqueta de sesión de derechos,
                            Baja de placas con recibo de pago,
                            Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                            CURP,
                            Artículo 492,
                            Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                            Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                            Copia Certificada de la Carpeta de Investigación,
                            Copia Certificada de la Acreditación de Propiedad,
                            Copia Certificada del Oficio de Liberación en caso de ser recuperado.";
                $listado_titulo = "Robo total física";
                break;
            case 4:
                $listado_msj = "Refactura a Zurich Aseguradora Mexicana S.A de C.V, si existen refacturas anteriores presentar todas las facturas hasta la de origen, en vehiculos financiados,
                            Carta Factura vigente,
                            Baja de placas con recibo de pago,
                            poderNotarial,
                            Identificación oficial vigente del Representante Legal (INE, Pasaporte, Cédula Profesional),
                            CURP del Representante Legal,
                            Artículo 492 Persona Moral,
                            Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                            Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                            Constancia de Situación Fiscal de la Empresa(RFC),
                            Copia Certificada de la Carpeta de Investigación,
                            Copia Certificada de la Acreditación de Propiedad,
                            Copia Certificada del Oficio de Liberación en caso de ser recuperado.
                ";
                $listado_titulo = "Robo total moral";
                break;
            case 5:
                $listado_msj = "Factura a nombre de Zurich Aseguradora Mexicana SA de CV con XML y PDF,
                            Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                            Orden de pago de daños firmada,
                            Formato Articulo 492 llenado y firmado,
                            Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                            Estado de cuenta con clabe interbacaria vigencia no mayor a 3 meses de aniguedad,
                            Comprobante de domicilio no mayor a 3 meses de antigüedad,
                            Finiquito firmado,
                            RFC,
                            Denuncia ante la autoridad correspondiente.";
                $listado_titulo = "Robo parcial física";
                break;
            case 6:
                $listado_msj = "Factura a nombre de Zurich Aseguradora Mexicana SA de CV con XML y PDF,
                             Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                             Orden de pago de daños firmada por el Representante Legal,
                             Formato Articulo 492 llenado y firmado por el Representante Legal,
                             Identificación Oficial Vigente del Apoderado Legal (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta con clabe interbacaria vigencia no mayor a 3 meses de aniguedad,
                             Comprobante de domicilio no mayor a 3 meses de antigüedad,
                             poderNotarial con actos de dominio,
                             Acta Constitutiva,
                             Finiquito firmado,
                             RFC,
                             Denuncia ante la autoridad correspondiente.";
                $listado_titulo = "Robo parcial moral";
                break;
            case 7:
                $listado_msj = "Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                             Orden de pago de daños firmada,
                             Formato Articulo 492 llenado y firmado,
                             Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Finiquito firmado,
                             Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Pago de daños perdida parcial física";
                break;
            case 8:
                $listado_msj = "Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                             Orden de pago de daños firmada por el Representante Legal,
                             Formato Articulo 492 llenado y firmado por el Representante Legal,
                             Identificación Oficial Vigente del Apoderado Legal (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             poderNotarial,
                             Acta Constitutiva,
                             Finiquito firmado,
                             Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Pago de daños perdida parcial moral";
                break;
            case 9:
                $listado_msj = "Factura endosada a Zurich Aseguradora Mexicana S.A de C.V con consecutividad de endosos, si existen refacturas presentar todas las facturas hasta la de origen, en vehículos financiados Carta Factura vigente,
                             Etiqueta de sesión de derechos,
                             Baja de placas con recibo de pago,
                             Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                             CURP,
                             Artículo 492,
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses).";
                $listado_titulo = "Pago de daños perdida total física";
                break;
            case 10:
                $listado_msj = "Refactura a Zurich Aseguradora Mexicana S.A de C.V, si existen refacturas anteriores presentar todas las facturas hasta la de origen, en vehiculos financiados,
                             Carta Factura vigente,
                             Baja de placas con recibo de pago,
                             poderNotarial,
                             Identificación oficial vigente del Representante Legal (INE, Pasaporte, Cédula Profesional),
                             CURP del Representante Legal,
                             Artículo 492 Persona Moral,
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Constancia de Situación Fiscal de la Empresa(RFC).";
                $listado_titulo = "Pago de daños perdida total moral";
                break;
            case 11:
                $listado_msj = "Factura del Servicio de la grúa XML y PDF,
                             Solicitud de afectación por parte del Asegurado,
                             Formato Articulo 492 llenado,
                             Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Finiquito firmado,
                             Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Grúas";
                break;
            case 12:
                $listado_msj = "Factura del Servicio de la multa y/o corralon XML y PDF,
                             Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                             Solicitud de afectación por parte del Asegurado,
                             Formato Articulo 492 llenado,
                             Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Finiquito firmado,
                             Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Multas y corralones";
                break;
            case 13:
                $listado_msj = "Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                             Factura del Servicio con su XML,
                             Solicitud de afectación de la cobertura de Auto Sustituto Pluz,
                             Formato Articulo 492 llenado y firmado,
                             Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Finiquito firmado,
                             Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Auto sustituto Pluz";
                break;
            case 14:
                $listado_msj = "Tarjeta de circulación o Factura por ambos lados en caso de presentar endosos,
                             Factura del Servicio con su XML,
                             Formato Articulo 492 llenado y firmado,
                             Identificación Oficial Vigente (INE, Pasaporte, Cédula Profesional),
                             Estado de cuenta bancario donde se muestre la Clabe Interbancaria, nombre del Banco y nombre del titular de la cuenta (la clabe consta de 18 dígitos y el documento no debe tener una antigüedad mayor a 3 meses),
                             Comprobante de domicilio (recibo de luz, agua, teléfono, predial, estado de cuenta bancario, servicios de televisión por cable e internet, con antigüedad no mayor a 3 meses),
                             Finiquito firmado,
                             Constancia de Situación Fiscal (RFC).";
                $listado_titulo = "Llantas y rines";
                break;
            case 15:
                $listado_msj = "Pase Médico,
                             Facturas o recibos originales de los gastos erogados";
                $listado_titulo = "Asistencia Médica - Reembolso";
                break;
            case 16:
                $listado_msj = "Pase Médico.";
                if ($tipo_gasto_medico == "Programación de Cirugía"){
                    $listado_titulo = "Asistencia Médica - Programación de Cirugía";
                } elseif ($tipo_gasto_medico == "Ingreso Hospitalario"){
                    $listado_titulo = "Asistencia Médica - Ingreso Hospitalario";
                }
                break;
            default:
                 $listado_msj = "N/A";
                $listado_titulo = "N/A";
                break;
        }

        $listado_msj = preg_replace('/\s+/', ' ', $listado_msj);

        $var = '{
            "mensajeListado" : "'.$listado_msj.'",
            "tituloListado" : "'.$listado_titulo.'"
        }';

        return $var;

    }

    private function separateNames($app, $params_error_report, $nameController, $chat_id){

        $full_name = $_POST['full_name'];
        $name_parts = explode(' ', $full_name);
        $last_name = $name_parts[0];
        $first_name = end($name_parts);

        $var = '{
            "primerNombreArmadoras" : "'.$first_name.'",
            "primerApellidoArmadoras" : "'.$last_name.'"
        }';

        return $var;
    }


}
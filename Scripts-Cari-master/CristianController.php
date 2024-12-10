<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use Utils\SetLogs;

/**
 * Description of CariController
 *
 * @author rmelo
 */
class CristianController {

    private $nameLog = "CristianController";

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "CristianController";
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
                case "validatePassword":
                    $response = $this->validatePasword($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "disponibilidad":
                    $response = $this->Disponibilidad($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "agenda":
                    $response = $this->Agenda($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "simulation":
                    $response = $this->Simulation($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "next_monday":
                    $response = $this->getNextMonday($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "disponibilidad2":
                    $response = $this->Disponibilidad2($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "arusController":
                    $response = $this->ArusController($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validarDerechos2":
                    $response = $this->ValidarDerechos2($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "decoderAES":
                    $response = $this->decoderAES($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getDataCodigo":
                    $response = $this->getDataCodigo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "generateToken":
                    $response = $this->generateToken($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "consultPatient":
                    $response = $this->consultPatient($app, $params_error_report, $nameController, $chat_id);
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
    public function validatePasword($app, $params_error_report, $nameController, $chat_id) {
        $body = '{}';
        $chat_identification = "573005624810";
        $nameFunction = "validatePasword";
        $password = $_POST['userPasword'];
        if ($password=='123456'){
            $validPasword = 1;
        } else {
            $validPasword = 0;
        }

        $datos = array(
            "user_pasword" => $password,
        );

        $var = '{
            "IngresoValido": "'.$validPasword.'"
        }';

        \App\Utils\StaticExecuteService::createLog($var,$body,$chat_identification,$nameFunction,$type="POST",$this->nameLog, $datos);

        return $var;
    }

    private function Disponibilidad($app, $params_error_report, $nameController, $chat_id)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn."/sap/bc/srt/rfc/sap/zivmf_disp/520/zivmf_disp/zivmf_disp"; // asmx URL of WSDL
        $nameFunction = "Disponibilidad()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $unidad_organizativa = $_POST['unidad_organizativa'];
        $especialidad = $_POST['especialidad'];
        $fecha_deseada = $_POST['fecha_deseada'];
        $tipo_cita = $_POST['tipo_cita'];
        $id_medico_cabecera = $_POST['id_medico_cabecera'];
        $tipo_paciente = $_POST['tipo_paciente'];
        $prestacion = $_POST['prestacion'];
        $num_paciente = $_POST['num_paciente'];
        $intento = $_POST['intento'];
        $intento = intval($intento);
        $validador = $_POST['validador'];

        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "unidad_organizativa" => $unidad_organizativa,
            "especialidad" => $especialidad,
            "fecha_deseada" => $fecha_deseada,
            "tipo_cita" => $tipo_cita,
            "tipo_paciente" => $tipo_paciente,
            "prestacion" => $prestacion
        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_DISP>
            <IT_DISPO>
               <!--Zero or more repetitions:-->
               <item>
                  <PERNR></PERNR>
                  <ENDYEAR></ENDYEAR>
                  <KWNO></KWNO>
                  <POBNR></POBNR>
                  <ORGZU></ORGZU>
                  <SYUZEIT_DT></SYUZEIT_DT>
                  <SYUZEIT_D1></SYUZEIT_D1>
                  <SYUZEIT_D2></SYUZEIT_D2>
                  <SYUZEIT_D3></SYUZEIT_D3>
                  <SYUZEIT_D4></SYUZEIT_D4>
                  <SYUZEIT_D5></SYUZEIT_D5>
                  <SYUZEIT_D6></SYUZEIT_D6>
                  <SYUZEIT_D7></SYUZEIT_D7>
               </item>
            </IT_DISPO>
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_FACHR>' . $especialidad . '</I_FACHR>
            <I_FECHA>' . $fecha_deseada . '</I_FECHA>
            <I_ORGID>' . $unidad_organizativa . '</I_ORGID>
            <I_PADEF>' . $num_paciente . '</I_PADEF>
            <!--Optional:-->
            <I_TARLS></I_TARLS>
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
            <I_VISTY></I_VISTY>
            <I_ZZMEDICOCAB>' . $id_medico_cabecera . '</I_ZZMEDICOCAB>
         </urn:ZIVMF_DISP>
      </soapenv:Body>
        </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        // $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_DISPResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_DISPResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_DISPResponse>',
            '</ZIVMF_DISPResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);

        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);

        $dispoClass = new \stdClass();

        $tipo_agenda = $parser->Body->ZIVMF_DISPResponse->E_MENS;
        $tipo_agenda = json_decode(json_encode($tipo_agenda), TRUE);

        if ($validador == 0 ) {
            if ($tipo_agenda[0] == 'No hay Agenda disponible') {
                $dispo_days = 0;
            } else {
                $dispo_days = 1;
            }
        } else {
            if ($tipo_agenda[0] == 'No hay Agenda disponible') {
                $dispo_days = 2;
            } else {
                $dispo_days = 1;
            }
            
        }

        if ($tipo_agenda[0] == 'No hay Agenda disponible') {
            $statusCode = 500;
            $type = 'SOAP POST';

            \App\Utils\StaticExecuteService::ErrorReportCari($app, $statusCode, $url, $response, $type, $params_error_report);

            $dispoClass->dispoDays = $dispo_days;

            return \GuzzleHttp\json_encode($dispoClass);

        }
        
        $calendario_sem = array();

        $c_dia1= $parser->Body->ZIVMF_DISPResponse->E_DIA1;
        $c_dia2= $parser->Body->ZIVMF_DISPResponse->E_DIA2;
        $c_dia3= $parser->Body->ZIVMF_DISPResponse->E_DIA3;
        $c_dia4= $parser->Body->ZIVMF_DISPResponse->E_DIA4;
        $c_dia5= $parser->Body->ZIVMF_DISPResponse->E_DIA5;
        $c_dia6= $parser->Body->ZIVMF_DISPResponse->E_DIA6;
        $c_dia7= $parser->Body->ZIVMF_DISPResponse->E_DIA7;

        array_push($calendario_sem, $c_dia1, $c_dia2, $c_dia3, $c_dia4, $c_dia5, $c_dia6, $c_dia7);

        for ($i=0; $i <= 6; $i++){
            if ($fecha_deseada == $calendario_sem[$i]){
                $valorDia = $i+1;
            }
        }
        

        $items = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item;
        
        $f_days = array();
        
        
        for ($i = 0; $i <= count($items); $i++) {
            for ($j = $valorDia; $j <=7; $j++) {
                $pos = "SYUZEIT_D".$j;

                // Check if the item exists and has the property
                if (isset($items[$i]->$pos)) {
                    $val = $items[$i]->$pos;
                    $val = $val->__toString();
                    
                    if ($val != null){
                        $val = $val;
                    } else {
                        $val = 'N/A';
                    }
                    
                    array_push($f_days,$val);
                    
                }
                
            }
        }

        $div = count($calendario_sem) - $valorDia + 1;

        $listDispo = array();

        for ($j = 0; $j <= $div - 1; $j++){
            $act_day = $valorDia + $j;
            $date_val = "E_DIA$act_day";
            for ($i = $j ; $i <= count($f_days) - 1; $i+= $div){
                if ($f_days[$i] != 'N/A' && substr($f_days[$i], 29, 6) == 'TMEDGR'){
                    $finalDisp = $f_days[$i];
                    array_push($listDispo,$finalDisp);
                }
            }

        }

        foreach ($listDispo as $element) {
            $key = substr($element, 0, strpos($element, '|', 5));
        
            if (!in_array($key, $processedKeys)) {
                $uniqueArray[] = $element;
                $processedKeys[] = $key;
            }
        }

        $doctorsDisp = array();

        for ($j = 0; $j <= 2; $j++){
            if (isset($uniqueArray[$j])) {
                $nombre_uniorg =  $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$j]->ORGZU;
                $new_name = $nombre_uniorg->__toString();
                $newDispo = $new_name."|".$uniqueArray[$j];
                array_push($doctorsDisp, $newDispo);
            }
        }

        $dispoClass->dispoDays = $dispo_days;

        $tipo_cita = $parser->Body->ZIVMF_DISPResponse->E_VISTY;
        $tipo_cita = json_decode(json_encode($tipo_cita), TRUE);

        for ($i = 0; $i <= 2; $i++){

            if (isset($doctorsDisp[$i])) {

                $values = explode('|', $doctorsDisp[$i]);

                $nombre_unidad = $values[0];
                $medico = $values[2];
                $objetivo_planeacion = $values[3];
                $unidad_organizativa = $values[4];
                $fecha_encontrada = $values[5];

                $formattedDate = substr($fecha_encontrada, 0, 4) . '-' . substr($fecha_encontrada, 4, 2) . '-' . substr($fecha_encontrada, 6, 2);
            
                $dispoClass->dispArray[$i]->nombreUnidadOganizativa = $nombre_unidad;
                $dispoClass->dispArray[$i]->medicoDisponible = $medico;
                $dispoClass->dispArray[$i]->objetivoPlanificacion2 = $objetivo_planeacion;
                $dispoClass->dispArray[$i]->unidadOrganizativaDisponible = $unidad_organizativa;
                $dispoClass->dispArray[$i]->fechaDisponibilidad = $formattedDate;
                $dispoClass->dispArray[$i]->tipoCita = $tipo_cita[0];
            }

        }

        return \GuzzleHttp\json_encode($dispoClass);

    }

    private function Agenda($app, $params_error_report, $nameController, $chat_id)
    {
        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn."/sap/bc/srt/rfc/sap/zivmf_agend/520/zivmf_agend/zivmf_agend"; // asmx URL of WSDL
        $nameFunction = "Agenda()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $medico = $_POST['medico'];
        $objetivo_planeacion = $_POST['objetivo_planeacion'];
        $unidad_organizativa = $_POST['unidad_organizativa'];
        $tipo_cita = $_POST['tipo_cita'];
        $fecha_deseada = $_POST['fecha_deseada'];
        $especialidad = $_POST['especialidad'];
        $tipo_paciente = $_POST['tipo_paciente'];
        $prestacion = $_POST['prestacion'];
        $nombre_unidad = $_POST['nombre_unidad'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $agenda_medico = $_POST['agenda_medico'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $tipo_horario = $_POST['tipo_horario'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "medico" => $medico,
            "obj_planeacion" => $objetivo_planeacion,
            "unidad_organizativa" => $unidad_organizativa,
            "tipo_cita" => $tipo_cita,
            "fecha_deseada" => $fecha_deseada,
            "especialidad" => $especialidad,
            "prestacion" => $prestacion,
            "nombre_unidad" => $nombre_unidad,
            "agenda_medico" => $agenda_medico
        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_AGEND>
            <IT_AGEND>
               <!--Zero or more repetitions:-->
               <item>
                  <PERNR></PERNR>
                  <ENDYEAR></ENDYEAR>
                  <KWNO></KWNO>
                  <POBNR></POBNR>
                  <ORGZU></ORGZU>
                  <SYUZEIT_DT></SYUZEIT_DT>
                  <SYUZEIT_D1></SYUZEIT_D1>
                  <SYUZEIT_D2></SYUZEIT_D2>
                  <SYUZEIT_D3></SYUZEIT_D3>
                  <SYUZEIT_D4></SYUZEIT_D4>
                  <SYUZEIT_D5></SYUZEIT_D5>
                  <SYUZEIT_D6></SYUZEIT_D6>
                  <SYUZEIT_D7></SYUZEIT_D7>
               </item>
            </IT_AGEND>
            <!--Optional:-->
            <I_FACHR>' . $especialidad . '</I_FACHR>
            <I_FECHA>' . $fecha_deseada . '</I_FECHA>
            <I_ORGID>' . $unidad_organizativa . '</I_ORGID>
            <I_PERNR>' . $medico . '</I_PERNR>
            <I_POBNR>' . $objetivo_planeacion . '</I_POBNR>
            <!--Optional:-->
            <I_TARLS></I_TARLS>
            <!--Optional:-->
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
            <I_VISTY>' . $tipo_cita . '</I_VISTY>
         </urn:ZIVMF_AGEND>
      </soapenv:Body>
   </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        if ($medico == "disponibilidadElement.medicoDisponible"){
            $statusCode = 500;
            $type = 'SOAP POST';

            \App\Utils\StaticExecuteService::ErrorReportCari($app, $statusCode, $url, $response, $type, $params_error_report);

            return;
        }

        $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_AGENDResponse>',
            '</ZIVMF_AGENDResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);

        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);
        
        $calendario_sem = array();

        $c_dia1= $parser->Body->ZIVMF_AGENDResponse->E_DIA1;
        $c_dia2= $parser->Body->ZIVMF_AGENDResponse->E_DIA2;
        $c_dia3= $parser->Body->ZIVMF_AGENDResponse->E_DIA3;
        $c_dia4= $parser->Body->ZIVMF_AGENDResponse->E_DIA4;
        $c_dia5= $parser->Body->ZIVMF_AGENDResponse->E_DIA5;
        $c_dia6= $parser->Body->ZIVMF_AGENDResponse->E_DIA6;
        $c_dia7= $parser->Body->ZIVMF_AGENDResponse->E_DIA7;

        array_push($calendario_sem, $c_dia1, $c_dia2, $c_dia3, $c_dia4, $c_dia5, $c_dia6, $c_dia7);

        for ($i=0; $i <= 6; $i++){
            if ($fecha_deseada == $calendario_sem[$i]){
                $valorDia = $i+1;
            }
        }
        

        $items = $parser->Body->ZIVMF_AGENDResponse->IT_AGEND->item;
        
        $f_days = array();
        
        
        for ($i = 0; $i <= count($items); $i++) {
            for ($j = $valorDia; $j <=7; $j++) {
                $pos = "SYUZEIT_D".$j;

                // Check if the item exists and has the property
                if (isset($items[$i]->$pos)) {
                    $val = $items[$i]->$pos;
                    $val = $val->__toString();
                    
                    if ($val != null){
                        $val = $val;
                    } else {
                        $val = 'N/A';
                    }
                    
                    array_push($f_days,$val);
                    
                }
                
            }
        }
        
        $div = count($calendario_sem) - $valorDia + 1;

        $listAgenda = array();

        for ($j = 0; $j <= $div - 1; $j++){
            $act_day = $valorDia + $j;
            $date_val = "E_DIA$act_day";
            for ($i = $j ; $i <= count($f_days) - 1; $i+= $div){
                $date2 = $parser->Body->ZIVMF_AGENDResponse->$date_val;
                if ($f_days[$i] != 'N/A'){
                    $finalAgenda = "$date2|$f_days[$i]";
                    array_push($listAgenda,$finalAgenda);
                }
            }

        }

        $listAgenda2 = array();

        for ($i = 0; $i <=count($listAgenda); $i++) {
            $string = $listAgenda[$i];
            $array = explode("|", $string);
            $value = intval($array[1]);
            if ($tipo_horario == '1'){
                if ($value >= 120000) {
                    array_push($listAgenda2,$string);
                }
            } else {
                if ($value < 120000) {
                    array_push($listAgenda2,$string);
                }
            }
        }

        $temporalArray = array();
            
        if ($final > (count($listAgenda2) - 1)) {
            for ($i = $inicio; $i < count($listAgenda2); $i++) {
                array_push($temporalArray, $listAgenda2[$i]);
            }
        } else {
            for ($i = $inicio; $i <= $final; $i++) {
                array_push($temporalArray, $listAgenda2[$i]);
            }
        }

        $agendaClass = new \stdClass();

        $agendaClass->numVerMas = ceil(count($listAgenda2) / $cantidad);
        
        for ($j = 0; $j < count($temporalArray); $j++) {

            $dayFinded = $temporalArray[$j];
            $values = explode('|', $dayFinded);
            $fecha_cita = $values[0];
            $hora_cita = $values[1];
            $duracion = $values[2];
            $tipo_planificacion =  $values[3];
            $unidad_organizativa = $values[4];
            $unidad_medica = $values[5];
            $sala = $values[6];

            if ($duracion == null) {
                $retornar_horario = 1;
            } else {
                $retornar_horario = 0;
            }

            $agendaClass->retornoHorario = $retornar_horario;

            $hour = substr($hora_cita, 0, 2);
            $minute = substr($hora_cita, 2, 2);
            $hora2 = $hour . ":" . $minute.":00";

            $opciones = 'Fecha : '.$fecha_cita.' Hora: '.$hora2.' IPS: '.$nombre_unidad.' Profesional: '.$agenda_medico.'';

            $agendaClass->arrayDinamico[$j]->fechaCita = $fecha_cita;
            $agendaClass->arrayDinamico[$j]->horaCita = $hora2;
            $agendaClass->arrayDinamico[$j]->duracion = $duracion;
            $agendaClass->arrayDinamico[$j]->tipoPlanificacion = $tipo_planificacion;
            $agendaClass->arrayDinamico[$j]->unidadOrganizativaAgenda = $unidad_organizativa;
            $agendaClass->arrayDinamico[$j]->unidadMedicaAgenda = $unidad_medica;
            $agendaClass->arrayDinamico[$j]->sala = $sala;
            $agendaClass->arrayDinamico[$j]->opciones = $opciones;
            
        }

        return \GuzzleHttp\json_encode($agendaClass);

    }

    private function Disponibilidad2($app, $params_error_report, $nameController, $chat_id)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_disp/520/zivmf_disp/zivmf_disp"; // asmx URL of WSDL
        $nameFunction = "Disponibilidad2()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $unidad_organizativa = $_POST['unidad_organizativa'];
        $especialidad = $_POST['especialidad'];
        $fecha_deseada = $_POST['fecha_deseada'];
        $tipo_cita = $_POST['tipo_cita'];
        $id_medico_cabecera = $_POST['id_medico_cabecera'];
        $tipo_paciente = $_POST['tipo_paciente'];
        $prestacion = $_POST['prestacion'];
        $num_paciente = $_POST['num_paciente'];
        $intento = $_POST['intento'];
        $intento = intval($intento);

        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "unidad_organizativa" => $unidad_organizativa,
            "especialidad" => $especialidad,
            "fecha_deseada" => $fecha_deseada,
            "tipo_cita" => $tipo_cita,
            "tipo_paciente" => $tipo_paciente,
            "prestacion" => $prestacion
        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_DISP>
            <IT_DISPO>
               <!--Zero or more repetitions:-->
               <item>
                  <PERNR></PERNR>
                  <ENDYEAR></ENDYEAR>
                  <KWNO></KWNO>
                  <POBNR></POBNR>
                  <ORGZU></ORGZU>
                  <SYUZEIT_DT></SYUZEIT_DT>
                  <SYUZEIT_D1></SYUZEIT_D1>
                  <SYUZEIT_D2></SYUZEIT_D2>
                  <SYUZEIT_D3></SYUZEIT_D3>
                  <SYUZEIT_D4></SYUZEIT_D4>
                  <SYUZEIT_D5></SYUZEIT_D5>
                  <SYUZEIT_D6></SYUZEIT_D6>
                  <SYUZEIT_D7></SYUZEIT_D7>
               </item>
            </IT_DISPO>
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_FACHR>' . $especialidad . '</I_FACHR>
            <I_FECHA>' . $fecha_deseada . '</I_FECHA>
            <I_ORGID>' . $unidad_organizativa . '</I_ORGID>
            <I_PADEF>' . $num_paciente . '</I_PADEF>
            <!--Optional:-->
            <I_TARLS></I_TARLS>
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
            <I_VISTY>' . $tipo_cita . '</I_VISTY>
            <I_ZZMEDICOCAB>' . $id_medico_cabecera . '</I_ZZMEDICOCAB>
         </urn:ZIVMF_DISP>
      </soapenv:Body>
        </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        // $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_DISPResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_DISPResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_DISPResponse>',
            '</ZIVMF_DISPResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);

        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);

        $dispoClass = new \stdClass();

        $tipo_agenda = $parser->Body->ZIVMF_DISPResponse->E_MENS;
        $tipo_agenda = json_decode(json_encode($tipo_agenda), TRUE);

        if ($tipo_agenda[0] == 'No hay Agenda disponible') {
            $statusCode = 500;
            $type = 'SOAP POST';

            $empty_array = array();

            $empty_array = json_encode($empty_array);

            $var = '{
                "dispArray" : "'.$empty_array.'",
                "value" : "1"
            }';

            return $var;
        }

        $calendario_sem = array();

        $c_dia1= $parser->Body->ZIVMF_DISPResponse->E_DIA1;
        $c_dia2= $parser->Body->ZIVMF_DISPResponse->E_DIA2;
        $c_dia3= $parser->Body->ZIVMF_DISPResponse->E_DIA3;
        $c_dia4= $parser->Body->ZIVMF_DISPResponse->E_DIA4;
        $c_dia5= $parser->Body->ZIVMF_DISPResponse->E_DIA5;
        $c_dia6= $parser->Body->ZIVMF_DISPResponse->E_DIA6;
        $c_dia7= $parser->Body->ZIVMF_DISPResponse->E_DIA7;

        array_push($calendario_sem, $c_dia1, $c_dia2, $c_dia3, $c_dia4, $c_dia5, $c_dia6, $c_dia7);

        for ($i=0; $i <= 6; $i++){
            if ($fecha_deseada == $calendario_sem[$i]){
                $valorDia = $i+1;
            }
        }

        $string_day = "SYUZEIT_D".$valorDia;

        $dispo = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item;

        $tipo_cita = $parser->Body->ZIVMF_DISPResponse->E_VISTY;

        $array_dispo_days = array();

        for ($j=0; $j <= (count($dispo)- 1); $j++){
                $day_selected = $dispo[$j]->$string_day;
                if (!empty((array) $day_selected)){
                        $unidad_selected = $dispo[$j]->ORGZU;
                        $day_selected = $day_selected->__toString();
                        $unidad_seleceted = $unidad_selected->__toString();
                        $final_info = $day_selected."|".$unidad_selected;
                        array_push($array_dispo_days,$final_info);
                }


        }

        if (empty($array_dispo_days)) {

            $empty_array = array();

            $empty_array = json_encode($empty_array);

            $var = '{
                "dispArray" : "'.$empty_array.'",
                "value" : "1"
            }';

            return $var;
        }

        $dispoClass->value = 0;

        for ($i=0; $i <= 2; $i++){
            if (isset($array_dispo_days[$i])){
                    $value =  explode("|", $array_dispo_days[$i]);

                    $medico_disponible = $value[1];
                    $objetivo_planificacion = $value[2];
                    $unidad_org = $value[3];
                    $nombre_unidad = $value[5];

                    $dispoClass->dispArray[$i]->medicoDisponible= $medico_disponible;
                    $dispoClass->dispArray[$i]->objetivoPlanificacion2 = $objetivo_planificacion;
                    $dispoClass->dispArray[$i]->unidadOrganizativaDisponible = $unidad_org;
                    $dispoClass->dispArray[$i]->nombreUnidadOganizativa = $nombre_unidad;
                    $dispoClass->dispArray[$i]->tipoCita = $tipo_cita;


            }
    }

    return \GuzzleHttp\json_encode($dispoClass);

    }

    private function getNextMonday($app, $params_error_report, $nameController, $chat_id){

        $fecha_ingresada = $_POST['fecha_ingresada'];
        $validador = $_POST['validador'];
        $exit = '0';

        if ($validador == '0') {
            // Calculate next week's Monday
            $currentDayOfWeek = date('N', strtotime($fecha_ingresada));
            $daysToAdd = 7 - $currentDayOfWeek + 1;
            $nextMonday = date('Y-m-d', strtotime($fecha_ingresada . ' +'.$daysToAdd.' days'));
            $validador = '1';
        } else {
            $exit = '1';
            $validador = '1';
            $nextMonday = 'N/A';
        }

        $var = '{
            "fechaNueva": "'.$nextMonday.'",
            "exitValue": "'.$exit.'",
            "validador": "'.$validador.'"
        }';

        return $var;

    }

    private function Simulation($app, $params_error_report, $nameController, $chat_id){

        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $fecha_deseada = '2023-06-06';
        $nombre_unidad = 'IPS COMFANDI';
        $agenda_medico = 'MEDICO COMFANDI';
        
        /*
        $response = '<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">
            <soap-env:Header></soap-env:Header>
            <soap-env:Body>
                <n0:ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">
                    <E_DIA1>2023-06-05</E_DIA1>
                    <E_DIA2>2023-06-06</E_DIA2>
                    <E_DIA3>2023-06-07</E_DIA3>
                    <E_DIA4>2023-06-08</E_DIA4>
                    <E_DIA5>2023-06-09</E_DIA5>
                    <E_DIA6>2023-06-10</E_DIA6>
                    <E_DIA7>2023-06-11</E_DIA7>
                    <E_MENS>Agenda disponible</E_MENS>
                    <E_TIPO>0</E_TIPO>
                    <IT_AGEND>
                        <item>
                            <PERNR>0004400686</PERNR>
                            <ENDYEAR>2023</ENDYEAR>
                            <KWNO>23</KWNO>
                            <POBNR>0000000324</POBNR>
                            <ORGZU></ORGZU>
                            <SYUZEIT_DT>06:40:00</SYUZEIT_DT>
                            <SYUZEIT_D1></SYUZEIT_D1>
                            <SYUZEIT_D2></SYUZEIT_D2>
                            <SYUZEIT_D3>064000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D3>
                            <SYUZEIT_D4>064000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D4>
                            <SYUZEIT_D5>064000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D5>
                            <SYUZEIT_D6></SYUZEIT_D6>
                            <SYUZEIT_D7></SYUZEIT_D7>
                        </item>
                        <item>
                            <PERNR>0004400686</PERNR>
                            <ENDYEAR>2023</ENDYEAR>
                            <KWNO>23</KWNO>
                            <POBNR>0000000324</POBNR>
                            <ORGZU></ORGZU>
                            <SYUZEIT_DT>07:10:00</SYUZEIT_DT>
                            <SYUZEIT_D1></SYUZEIT_D1>
                            <SYUZEIT_D2>071000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D2>
                            <SYUZEIT_D3>071000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D3>
                            <SYUZEIT_D4>071000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D4>
                            <SYUZEIT_D5>071000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D5>
                            <SYUZEIT_D6></SYUZEIT_D6>
                            <SYUZEIT_D7></SYUZEIT_D7>
                        </item>
                        <item>
                            <PERNR>0004400686</PERNR>
                            <ENDYEAR>2023</ENDYEAR>
                            <KWNO>23</KWNO>
                            <POBNR>0000000324</POBNR>
                            <ORGZU></ORGZU>
                            <SYUZEIT_DT>07:40:00</SYUZEIT_DT>
                            <SYUZEIT_D1></SYUZEIT_D1>
                            <SYUZEIT_D2></SYUZEIT_D2>
                            <SYUZEIT_D3>074000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D3>
                            <SYUZEIT_D4>074000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D4>
                            <SYUZEIT_D5>074000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D5>
                            <SYUZEIT_D6></SYUZEIT_D6>
                            <SYUZEIT_D7></SYUZEIT_D7>
                        </item>
                        <item>
                            <PERNR>0004400686</PERNR>
                            <ENDYEAR>2023</ENDYEAR>
                            <KWNO>23</KWNO>
                            <POBNR>0000000324</POBNR>
                            <ORGZU></ORGZU>
                            <SYUZEIT_DT>09:40:00</SYUZEIT_DT>
                            <SYUZEIT_D1>094000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D1>
                            <SYUZEIT_D2></SYUZEIT_D2>
                            <SYUZEIT_D3>094000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D3>
                            <SYUZEIT_D4></SYUZEIT_D4>
                            <SYUZEIT_D5>094000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D5>
                            <SYUZEIT_D6></SYUZEIT_D6>
                            <SYUZEIT_D7></SYUZEIT_D7>
                        </item>
                        <item>
                            <PERNR>0004400686</PERNR>
                            <ENDYEAR>2023</ENDYEAR>
                            <KWNO>23</KWNO>
                            <POBNR>0000000324</POBNR>
                            <ORGZU></ORGZU>
                            <SYUZEIT_DT>10:10:00</SYUZEIT_DT>
                            <SYUZEIT_D1></SYUZEIT_D1>
                            <SYUZEIT_D2></SYUZEIT_D2>
                            <SYUZEIT_D3>101000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D3>
                            <SYUZEIT_D4></SYUZEIT_D4>
                            <SYUZEIT_D5>101000|0020|CTMDGR6P|28TMEDGR|        |28COX203|</SYUZEIT_D5>
                            <SYUZEIT_D6></SYUZEIT_D6>
                            <SYUZEIT_D7></SYUZEIT_D7>
                        </item>
                        <item>
                            <PERNR>0004400686</PERNR>
                            <ENDYEAR>2023</ENDYEAR>
                            <KWNO>23</KWNO>
                            <POBNR>0000000324</POBNR>
                            <ORGZU></ORGZU>
                            <SYUZEIT_DT>10:40:00</SYUZEIT_DT>
                            <SYUZEIT_D1>104000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D1>
                            <SYUZEIT_D2>104000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D2>
                            <SYUZEIT_D3>104000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D3>
                            <SYUZEIT_D4></SYUZEIT_D4>
                            <SYUZEIT_D5>104000|0020|CTMDGR6P|28TMEDGR|        |        |</SYUZEIT_D5>
                            <SYUZEIT_D6></SYUZEIT_D6>
                            <SYUZEIT_D7></SYUZEIT_D7>
                        </item>
                    </IT_AGEND>
                </n0:ZIVMF_AGENDResponse>
            </soap-env:Body>
        </soap-env:Envelope>'; */

        $response = '<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">
        <soap-env:Header></soap-env:Header>
        <soap-env:Body>
            <n0:ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">
                <E_DIA1>2023-06-05</E_DIA1>
                <E_DIA2>2023-06-06</E_DIA2>
                <E_DIA3>2023-06-07</E_DIA3>
                <E_DIA4>2023-06-08</E_DIA4>
                <E_DIA5>2023-06-09</E_DIA5>
                <E_DIA6>2023-06-10</E_DIA6>
                <E_DIA7>2023-06-11</E_DIA7>
                <E_MENS>Agenda disponible</E_MENS>
                <E_TIPO>0</E_TIPO>
                <IT_AGEND>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>07:20:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>072000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>07:40:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>074000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>08:00:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>080000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>08:20:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>082000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>08:40:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>084000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>09:00:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>090000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>09:20:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>092000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>09:40:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>094000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>10:00:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>100000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>10:20:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4></SYUZEIT_D4>
                        <SYUZEIT_D5></SYUZEIT_D5>
                        <SYUZEIT_D6>102000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>17:00:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4>170000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D4>
                        <SYUZEIT_D5>170000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D5>
                        <SYUZEIT_D6></SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>17:20:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2>172000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4>172000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D4>
                        <SYUZEIT_D5>172000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D5>
                        <SYUZEIT_D6></SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>17:40:00</SYUZEIT_DT>
                        <SYUZEIT_D1></SYUZEIT_D1>
                        <SYUZEIT_D2>174000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4>174000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D4>
                        <SYUZEIT_D5>174000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D5>
                        <SYUZEIT_D6></SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                    <item>
                        <PERNR>0004400653</PERNR>
                        <ENDYEAR>2023</ENDYEAR>
                        <KWNO>23</KWNO>
                        <POBNR>0000000453</POBNR>
                        <ORGZU></ORGZU>
                        <SYUZEIT_DT>18:00:00</SYUZEIT_DT>
                        <SYUZEIT_D1>180000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D1>
                        <SYUZEIT_D2></SYUZEIT_D2>
                        <SYUZEIT_D3></SYUZEIT_D3>
                        <SYUZEIT_D4>180000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D4>
                        <SYUZEIT_D5>180000|0020|C6_MGENP|13TMEDGR|        |13COX110|</SYUZEIT_D5>
                        <SYUZEIT_D6></SYUZEIT_D6>
                        <SYUZEIT_D7></SYUZEIT_D7>
                    </item>
                </IT_AGEND>
            </n0:ZIVMF_AGENDResponse>
        </soap-env:Body>
    </soap-env:Envelope>';


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_AGENDResponse>',
            '</ZIVMF_AGENDResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);

        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);
        
        $calendario_sem = array();

        $c_dia1= $parser->Body->ZIVMF_AGENDResponse->E_DIA1;
        $c_dia2= $parser->Body->ZIVMF_AGENDResponse->E_DIA2;
        $c_dia3= $parser->Body->ZIVMF_AGENDResponse->E_DIA3;
        $c_dia4= $parser->Body->ZIVMF_AGENDResponse->E_DIA4;
        $c_dia5= $parser->Body->ZIVMF_AGENDResponse->E_DIA5;
        $c_dia6= $parser->Body->ZIVMF_AGENDResponse->E_DIA6;
        $c_dia7= $parser->Body->ZIVMF_AGENDResponse->E_DIA7;

        array_push($calendario_sem, $c_dia1, $c_dia2, $c_dia3, $c_dia4, $c_dia5, $c_dia6, $c_dia7);

        for ($i=0; $i <= 6; $i++){
            if ($fecha_deseada == $calendario_sem[$i]){
                $valorDia = $i+1;
            }
        }
        

        $items = $parser->Body->ZIVMF_AGENDResponse->IT_AGEND->item;
        
        $f_days = array();
        
        
        for ($i = 0; $i <= count($items); $i++) {
            for ($j = $valorDia; $j <=7; $j++) {
                $pos = "SYUZEIT_D".$j;

                // Check if the item exists and has the property
                if (isset($items[$i]->$pos)) {
                    $val = $items[$i]->$pos;
                    $val = $val->__toString();
                    
                    if ($val != null){
                        $val = $val;
                    } else {
                        $val = 'N/A';
                    }
                    
                    array_push($f_days,$val);
                    
                }
                
            }
        }
        
        $div = count($calendario_sem) - $valorDia + 1;
        
        $another_val = count($f_days) / $div;

        for ($j = 0; $j <= count($f_day); $j++){
            print_r($f_days[$j]);
        }

        
        $listAgenda = array();
        
        for ($j = 0; $j <= $another_val - 1; $j++){
            $act_day = $valorDia + $j;
            $date_val = "E_DIA$act_day";
            for ($i = $j ; $i <= count($f_days) - 1; $i+= $div){
                $date2 = $parser->Body->ZIVMF_AGENDResponse->$date_val;
                if ($f_days[$i] != 'N/A'){
                    $finalAgenda = "$date2|$f_days[$i]";
                    array_push($listAgenda,$finalAgenda);
                }
            }

        }

        $temporalArray = array();
            
        if ($final > (count($listAgenda) - 1)) {
            for ($i = $inicio; $i < count($listAgenda); $i++) {
                array_push($temporalArray, $listAgenda[$i]);
            }
        } else {
            for ($i = $inicio; $i <= $final; $i++) {
                array_push($temporalArray, $listAgenda[$i]);
            }
        }

        $response1 = new \stdClass();

        $response1->numVerMas = ceil(count($listAgenda) / $cantidad);
        
        for ($j = 0; $j < count($temporalArray); $j++) {

            $dayFinded = $temporalArray[$j];

            $values = explode('|', $dayFinded);

            $fecha_cita = $values[0];
            $hora_cita = $values[1];
            $duracion = $values[2];
            $tipo_planificacion =  $values[3];
            $sala = $values[6];

            $hour = substr($hora_cita, 0, 2);
            $minute = substr($hora_cita, 2, 2);
            $hora2 = $hour . ":" . $minute;

            $opciones = 'Fecha : '.$fecha_cita.' Hora: '.$hora2.' IPS: '.$nombre_unidad.' Profesional: '.$agenda_medico.'';
            
            $response1->arrayDinamico[$j]->fechaCita = $fecha_cita;
            $response1->arrayDinamico[$j]->horaCita = $hora_cita;
            $response1->arrayDinamico[$j]->duracion = $duracion;
            $response1->arrayDinamico[$j]->tipoPlanificacion = $tipo_planificacion;
            $response1->arrayDinamico[$j]->sala = $sala;
            $response1->arrayDinamico[$j]->opciones = $opciones;

        }

        return \GuzzleHttp\json_encode($response1);

    }

    private function ArusController($app, $params_error_report, $nameController, $chat_id) {

        $url = 'https://csmstaging.serviceaide.com/csmconnector/ServiceRequest';
        $headers = [
            'user_auth_token: YD8XkbWLIWGdJuYKexCj0YmIHyEeRDDaCwm4rVTGnLKVegtNg1',
            'slice_token: iTY1VSOl.nBirN_TA9!O!aRr1YA)HLVN',
            'csm_app_url: https://csmstaging.serviceaide.com',
            'webservice_user_name: webserviceomni@arus.com.co',
            'webservice_user_password: W3bS3rvic3omnicanalidad',
            'Content-Type: application/json',
        ];
        
        $data = [
            "RequesterID" => "1",
            "RequesterUserName" => "pruebas, cliente",
            "AsignedGroup" => "SET .MESA MARCO",
            "AffectedServiceID" => "73",
            "Source" => "Web",
            "TypeName" => "Service Request Cariai",
            "Description" => "Ticket Automatico desde postman - cariai prueba 2",
            "Categorization" => "NOC >> FALLA DE INTEGRACION",
            "DescriptionLong" => "- Prueba de integracion pos API REST WebServices 2 -",
            "CustomAttributes" => [
                "Nombre de contacto" => "testing"
            ]
        ];
        
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        echo $response;
    }

    private function ValidarDerechos2($app, $params_error_report, $nameController, $chat_id)
    {

    $urlIn = $_POST['main_url'];
    $soapUser = $_POST['soap_user']; //  username
    $soapPassword = $_POST['soap_pass']; // password
    $soapUrl = $urlIn."/sap/bc/srt/rfc/sap/zivmf_vsos/520/zivmf_vsos/zivmf_vsos"; // asmx URL of WSDL
    $nameFunction = "validaDerechos2()";
    $chat_identification = $_POST['chat_identification'];
    $enterprise_id = $_POST['enterprise_id'];
    $bot_id = $_POST['bot_id'];
    $session_id = $_POST['session_id'];
    $convesartion_id = $_POST['convesartion_id'];
    $centro_sanitario = $_POST['centroSanitario'];
    $tipo_paciente = $_POST['tipoPaciente'];
    $numero_id = $_POST['numeroIdentificacion'];
    $tipo_id = $_POST['tipoIdentificacion'];
    $especialidad = $_POST['especialidad'];
    // xml post structure

    $datos = array(
        "main_url" => $urlIn,
        "soap_user" => $soapUser,
        "soap_password" => $soapPassword,
        "centro_sanitario" => $centro_sanitario,
        "tipo_paciente" => $tipo_paciente,
        "numero_identificacion" => $numero_id,
        "tipo_identificacion" => $tipo_id,
        "especialidad" => $especialidad
    );

    $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
  <soapenv:Header/>
    <soapenv:Body>
     <urn:ZIVMF_VSOS>
        <IT_MCAB>
           <!--Zero or more repetitions:-->
           <item>
              <FACHR>?</FACHR>
              <VALMC>?</VALMC>
           </item>
        </IT_MCAB>
        <IT_MESPE_U>
           <!--Zero or more repetitions:-->
           <item>
              <FACHR>?</FACHR>
              <FATXT>?</FATXT>
           </item>
        </IT_MESPE_U>
        <IT_MIPS_U>
           <!--Zero or more repetitions:-->
           <item>
              <ORGID>?</ORGID>
              <ORGNA>?</ORGNA>
           </item>
        </IT_MIPS_U>
        <IT_MMEDI_U>
           <!--Zero or more repetitions:-->
           <item>
              <POBNR>?</POBNR>
              <NMEDI>?</NMEDI>
           </item>
        </IT_MMEDI_U>
        <IT_OTROS_U>
           <!--Zero or more repetitions:-->
           <item>
              <PLANE>?</PLANE>
              <TARLS>?</TARLS>
              <UNTRA>?</UNTRA>
              <NPERS>?</NPERS>
              <IPS>?</IPS>
              <NIPS>?</NIPS>
              <NUNTRA>?</NUNTRA>
           </item>
        </IT_OTROS_U>
        <IT_SUBES>
           <!--Zero or more repetitions:-->
           <item>
              <FACHR>?</FACHR>
              <NPERS>?</NPERS>
           </item>
        </IT_SUBES>
        <IT_TCON>
           <!--Zero or more repetitions:-->
           <item>
              <FACHR>?</FACHR>
              <VISTY>?</VISTY>
           </item>
        </IT_TCON>
        <!--Optional:-->
        <I_EINRI>' . $centro_sanitario . '</I_EINRI>
        <I_NIDEN>' . $numero_id . '</I_NIDEN>
        <I_TIDEN>' . $tipo_id . '</I_TIDEN>
        <I_TPACI>' . $tipo_paciente . '</I_TPACI>
     </urn:ZIVMF_VSOS>
    </soapenv:Body>
    </soapenv:Envelope>'; // data from the form, e.g. some ID number

    $headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "Content-length: " . strlen($xml_post_string),
    ); //SOAPAction: your op URL

    $url = $soapUrl;

    $diferencia = $info['total_time'];

    // $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

    $response = \App\Utils\StaticExecuteService::executeCurlSOAP($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $this->nameLog, $datos, $params_error_report);


    $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
        '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

    $response2 = str_replace('<soap-env:Header></soap-env:Header>',
        '<Header></Header>', $response1);

    $response3 = str_replace('<soap-env:Body>',
        '<Body>', $response2);

    $response4 = str_replace('<n0:ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
        '<ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response3);

    $response5 = str_replace('</n0:ZIVMF_VSOSResponse>',
        '</ZIVMF_VSOSResponse>', $response4);

    $response6 = str_replace('</soap-env:Body>',
        '</Body>', $response5);
    $response7 = str_replace('</soap-env:Envelope>',
        '</Envelope>', $response6);

    $parser = simplexml_load_string($response7);

    // $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

    // if (!($response_code < 300 && $response_code > 199)) {

    //     $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

    // }

    $longitudMedicos = sizeof($parser->Body->ZIVMF_VSOSResponse->IT_MIPS_U->item);
    $listadoMedicosEsp = array();

    $j = 1;

    for ($j = 1; $j <= $longitudMedicos; $j++) {

        $tabla_medicos = $parser->Body->ZIVMF_VSOSResponse->IT_MIPS_U->item[$j]->ORGID;
        array_push($listadoMedicosEsp, $tabla_medicos);

    }

    $longitudEspecialidades = sizeof($listadoMedicosEsp);

    $i = 0;

    for ($i = 0; $i <= $longitudEspecialidades; $i++) {

        $valorArray = $listadoMedicosEsp[$i];
        $valorArray2 = substr($valorArray, 0, 4);

        if ($valorArray2 == $especialidad) {

            $unidadEspecialidad = $valorArray;
            break;

        }
    }

    $unidadEspecialidad = substr($unidadEspecialidad, 5, 2);
    $unidadEspecialidad = $unidadEspecialidad."TMEDGR";

    $var = '{
     "unidadOrganizativa" : "' . $unidadEspecialidad . '"
    }';

    return $var;
    }


    private function decoderAES($app, $params_error_report, $nameController, $chat_id)
    {

        $ciphertext = $_POST['cypher_text']; //contrasenha retornada por el servicio cambiar contrasenha
        $hexKey = $_POST['hex_key']; //secretKey Documentacion ARUS;
        $ciphertext = base64_decode($ciphertext);
        $secretKey = hex2bin($hexKey); // Convert hex key to binary 
        $iv = str_repeat("\x00", 16);

        $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $secretKey, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $iv);

        if ($decrypted === false) {
            return 'falla';
        } else {
            return $decrypted;
        }

    }

    private function getDataCodigo($app, $params_error_report, $nameController, $chat_id){

        // The SOAP XML content
        $soapXML = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.ivrservices.osi.com/">
           <soapenv:Header/>
           <soapenv:Body>
              <ser:consultarRegistroAtencion>
                 <!--Optional:-->
                 <consultarRegistroAtencionEnt>
                    <!--Optional:-->
                    <registroAtencion>
                       <!--Optional:-->
                       <codigoRegistro>213669387776</codigoRegistro>
                    </registroAtencion>
                 </consultarRegistroAtencionEnt>
              </ser:consultarRegistroAtencion>
           </soapenv:Body>
        </soapenv:Envelope>';
        
        // URL for the SOAP web service
        $url = 'https://osiapppre02.colsanitas.com/services/IVRServices.IVRServicesHttpSoap11Endpoint';
        
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
        $response = curl_exec($ch);
        
        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        
        // Close cURL session
        curl_close($ch);
        
        // Handle the response
        if ($response) {
            // You can process the SOAP response here
            echo $response;
        } else {
            echo 'No response received.';
        }      

    }

    private function generateToken($app, $params_error_report, $nameController, $chat_id){

        $auth = $_POST['auth'];
        $grand_type = $_POST['grand_type'];
        $user_name = $_POST['user_name'];
        $user_pass = $_POST['user_pass'];
        $url = $_POST['url_in'];
        $nameFunction = 'generateToken()';

        $headers = [
            'Cookie: visid_incap_2178250=uE8x6nEeQgWvueRwcBwPmnKn7GQAAAAAQUIPAAAAAACZWcrFm7TSpilkw8fh7kO3; visid_incap_2197031=FjFq0CjpThiSmGslVDI8ZlKu52QAAAAAQUIPAAAAAABwy/6iOUYCDEprRiEG6Yew; visid_incap_2197032=C5d/BkEuS+6X17EeIEMfCyGt52QAAAAAQUIPAAAAAACfCOL9dI0lV295fi5ydebh',
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: */*',
            'Accept-Encoding: gzip, deflate, br',
            'Authorization: Bearer '.$auth.''
        ];

        $body = array(
            'grant_type' => $grand_type,
            'username' => $user_name,
            'password' => $user_pass
        );

        $datosEntrada = array(
            'grant_type' => $grand_type,
            'username' => $user_name,
            'password' => $user_pass,
            'auth' => $auth,
            'url' => $url
        );

        //$response_object = \App\Utils\StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_identification = null, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $nameLog ,$datosEntrada, $tipoControlador = null, $user_agent = null);

        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Execute cURL session and get the response
        $response = curl_exec($ch);
        curl_close($ch);

        $response = gzdecode($response);
        
        return $response;

    }


    private function consultPatient($app, $params_error_report, $nameController, $chat_id){

        $type_doc = $_POST['type_doc'];
        $num_doc = $_POST['num_doc'];
        $origin_consult = $_POST['origin_consult'];
        $auth_beartk = $_POST['auth_beartk'];
        $code_app = $_POST['code_app'];
        $petition_date = $_POST['petition_date'];
        $billing_system = $_POST['billing_system'];
        $business_function = $_POST['business_function'];
        $url = $_POST['url'];

        $nameFunction = 'consultPatient()';

        $headers = [
            'Cookie: visid_incap_2178250=uE8x6nEeQgWvueRwcBwPmnKn7GQAAAAAQUIPAAAAAACZWcrFm7TSpilkw8fh7kO3; visid_incap_2197031=FjFq0CjpThiSmGslVDI8ZlKu52QAAAAAQUIPAAAAAABwy/6iOUYCDEprRiEG6Yew; visid_incap_2197032=C5d/BkEuS+6X17EeIEMfCyGt52QAAAAAQUIPAAAAAACfCOL9dI0lV295fi5ydebh',
            'Content-Type: application/json',
            'Accept: */*',
            'Accept-Encoding: gzip, deflate, br',
            'Authorization: Bearer '.$auth_beartk.'',
            'codAplicacion: '.$code_app.'',
            'fechaPeticion: '.$petition_date.'',
            'sistemaFacturador: '.$billing_system.'',
            'funcionNegocio: '.$business_function.''
        ];

        $body = '{
            "tipDoc": "'.$type_doc.'",
            "numDoc": "'.$num_doc.'",
            "origenConsulta": '.$origin_consult.'
        }';

        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Set the headers
        
        // Execute cURL session and get the response
        $response = curl_exec($ch);

        curl_close($ch);
        $response = gzdecode($response);
        print_r($response);

    }

}

<?php

namespace App\Controllers;

class IvantiController
{
    private $nameLog = "IvantiDemo";

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "IvantiController";
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
                case "consultarempleado":
                    $response = $this->ConsultarEmpleado($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "listarIncidentes":
                    $response = $this->listarIncidentes($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "ConsultarIncidenteRecID":
                    $response = $this->ConsultarIncidenteRecID($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "listarRequerimientos":
                    $response = $this->ListarRequerimientos($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "requerimientoRecId":
                    $response = $this->RequerimientoRecId($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "ConsultarIncidenteRecID":
                    $response = $this->ConsultarIncidenteRecID($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "crearIncidente":
                    $response = $this->crearIncidente($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "ConsultarIncidenteRecID":
                    $response = $this->ConsultarIncidenteRecID($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "adjuntarArchivoIncidente":
                    $response = $this->adjuntarArchivoIncidente($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "adjuntarArchivoIncidenteTest":
                    $response = $this->adjuntarArchivoIncidenteTest($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "agregarNotaIncidente":
                    $response = $this->agregarNotaIncidente($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
            }

        } else {
            $response = "useProduction and token is mandatory!";
            echo $response;
        }
    }

    private function ConsultarEmpleado($app, $params_error_report, $nameController, $chat_id)
    {
        $userlogin = $_POST['loginId'];
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $nameFunction = "consultarEmpleados()";

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/employees?$" . "filter=LoginID eq '$userlogin'";

        $datos = array(
            "userlogin" => $userlogin,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        $name_user = $response_object->value[0]->DisplayName;
        $rec_id = $response_object->value[0]->RecId;

        $var = '{
            "nombreUsuario": "' . $name_user . '",
            "recId": "' . $rec_id . '"
        }';

        return $var;

    }

    private function listarIncidentes($app, $params_error_report, $nameController, $chat_id)
    {
        $ProfileLink_RecID = $_POST['ProfileLink_RecID'];
        $nameFunction = "listarIncidentes()";
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/incidents?$" . "filter=ProfileLink_RecID eq '$ProfileLink_RecID'";

        $datos = array(
            "ProfileLink_RecID" => $ProfileLink_RecID,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            $mensajeError = 'Ws Caidos! saliendo';
            return $mensajeError;
        }

        $listadoIncidentes = array();
        $temporalArray = array();
        $longitud = count($response_object->value);

        if (count($response_object->value) == '0') {
            return $msj = 'No tiene incidentes registrados';
        } else {
            for ($i = 0; $i < $longitud; $i++) {
                if ($response_object->value[$i]->Status !== "Closed") {
                    array_push($listadoIncidentes, $response_object->value[$i]);
                }
            }
            $longitud2 = count($listadoIncidentes);
            if ($final > ($longitud2 - 1)) {
                for ($i = $inicio; $i < $longitud2; $i++) {
                    array_push($temporalArray, $listadoIncidentes[$i]);
                }
            } else {
                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listadoIncidentes[$i]);
                }
            }
        }

        $longitudIncidentes = sizeof($temporalArray);
        $response = new \stdClass();
        $response->numVerMas = ceil($longitud2 / $cantidad);
        $response->longitudSalida = $longitud;
        for ($i = 0; $i < $longitudIncidentes; $i++) {
            $response->dynamicArray[$i]->mensaje_incidente = "Incidente: " . $temporalArray[$i]->IncidentNumber . ' \n Subject: ' . $temporalArray[$i]->Subject . ' \n Status: ' . $temporalArray[$i]->Status;
            $response->dynamicArray[$i]->IncidentNumber = $temporalArray[$i]->IncidentNumber;
            $response->dynamicArray[$i]->Subject = $temporalArray[$i]->Subject;
            $response->dynamicArray[$i]->Status = $temporalArray[$i]->Status;
            $response->dynamicArray[$i]->RecID = $temporalArray[$i]->RecId;
            $response->dynamicArray[$i]->Symptom = $temporalArray[$i]->Symptom;
            $response->dynamicArray[$i]->Service = $temporalArray[$i]->Service;
            $response->dynamicArray[$i]->Category = $temporalArray[$i]->Category;
            $response->dynamicArray[$i]->OwnerTeam = $temporalArray[$i]->OwnerTeam;
            $response->dynamicArray[$i]->Owner = $temporalArray[$i]->Owner;
        }

        // $object = json_encode($response);
        return \GuzzleHttp\json_encode($response);

    }

    private function ConsultarIncidenteRecID($app, $params_error_report, $nameController, $chat_id)
    {
        $RecID = $_POST['RecID'];
        $nameFunction = "ConsultarIncidenteRecID()";
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/incidents('$RecID')";

        $datos = array(
            "RecID" => $RecID,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            $mensajeError = 'Ws Caidos! saliendo';
            return $mensajeError;
        };
        return '{
            "IncidentNumber":"' . $response_object->IncidentNumber . '",
            "Subject":"' . $response_object->Subject . '",
            "Status":"' . $response_object->Status . '",
            "Symptom":"' . $response_object->Symptom . '",
            "Category":"' . $response_object->Category . '",
            "OwnerTeam":"' . $response_object->OwnerTeam . '",
            "Owner":"' . $response_object->Owner . '"
        }';
    }

    private function ListarRequerimientos($app, $params_error_report, $nameController, $chat_id)
    {
        $recId = $_POST['recId'];
        $nameFunction = "listarRequerimientos()";
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/servicereqs?$" . "filter=ProfileLink_RecID eq '$recId' and Status ne 'Closed'";

        $datos = array(
            "recId" => $recId,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            $mensajeError = 'Ws Caidos! saliendo';
            return $mensajeError;
        }

        $listadoRequerimientos = array();
        $temporalArray = array();
        $longitud = count($response_object->value);

        if (count($response_object->value) == '0') {
            return $msj = 'No tiene requerimientos registrados';
        } else {
            for ($i = 0; $i < $longitud; $i++) {
                if ($response_object->value[$i]->Status !== "Closed") {
                    array_push($listadoRequerimientos, $response_object->value[$i]);
                }
            }
            $longitud2 = count($listadoRequerimientos);
            if ($final > ($longitud2 - 1)) {
                for ($i = $inicio; $i < $longitud2; $i++) {
                    array_push($temporalArray, $listadoRequerimientos[$i]);
                }
            } else {
                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listadoRequerimientos[$i]);
                }
            }
        }

        $longitudRequerimientos = sizeof($temporalArray);
        $response = new \stdClass();
        $response->numVerMas = ceil($longitud2 / $cantidad);
        $response->longitudSalida = $longitud;
        for ($i = 0; $i < $longitudRequerimientos; $i++) {
            $response->dynamicArray[$i]->mensaje_incidente = "Requeremiento: " . $temporalArray[$i]->ServiceReqNumber . ' \n Subject: ' . $temporalArray[$i]->Subject . ' \n  Status: ' . $temporalArray[$i]->Status;
            $response->dynamicArray[$i]->IncidentNumber = $temporalArray[$i]->RecId;
            $response->dynamicArray[$i]->Subject = $temporalArray[$i]->Subject;
            $response->dynamicArray[$i]->Status = $temporalArray[$i]->Status;
            $response->dynamicArray[$i]->Service = $temporalArray[$i]->Service;
        };

        return \GuzzleHttp\json_encode($response);

    }

    private function RequerimientoRecId($app, $params_error_report, $nameController, $chat_id)
    {
        $req_id = $_POST['reqId'];
        $nameFunction = "requerimientoRecId()";
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/servicereqs('" . $req_id . "')";

        $datos = array(
            "req_id" => $req_id,
            "url" => $url,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        $subject = $response_object->Subject;
        $symptom = $response_object->Symptom;
        $category = $response_object->Category;
        $owner_team = $response_object->OwnerTeam;
        $owner = $response_object->Owner;
        $serviceReqNum = $response_object->ServiceReqNumber;

        $var = '{
            "Asunto": "' . $subject . '",
            "Indicio": "' . $symptom . '",
            "Categoria": "' . $category . '",
            "EquipoPropietario": "' . $owner_team . '",
            "Propietario" : "' . $owner . '",
            "NumeroReq": "' . $serviceReqNum . '"
        }';

        return $var;
    }

    private function crearIncidente($app, $params_error_report, $nameController, $chat_id)
    {
        $subject = $_POST['subject'];
        $symptom = $_POST['symptom'];
        $ProfileFullName = $_POST['ProfileFullName'];
        $ProfileLink_RecID = $_POST['ProfileLink_RecID'];
        $nameFunction = "crearIncidente()";
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/incidents";

        $datos = array(
            "subject" => $subject,
            "symptom" => $symptom,
            "ProfileFullName" => $ProfileFullName,
            "ProfileLink_RecID" => $ProfileLink_RecID,
            "url" => $url,
        );
// "Category": "Chatbot"
        $request = '{
            "Category": "Missing Item",
            "ProfileFullName":"' . $ProfileFullName . '",
            "ProfileLink_Category":"Employee",
            "ProfileLink_RecID":"' . $ProfileLink_RecID . '",
            "Service": "Facilities Management",
            "Status": "Logged",
            "Subject":"' . $subject . '",
            "Symptom":"' . $symptom . '",
            "OwnerTeam": "Service Desk" ,
            "Priority_Valid": "29CD5D78E16F4D82916C3E933A600096",
            "Priority": "3"
          }';

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if (!$response_object->RecId) {
            return '{
		"exitoso": "0"
            }';
        } else {

            return '{
                "RecIDIncidente": "' . $response_object->RecId . '",
		"IncidentNumber": "' . $response_object->IncidentNumber . '",
		"exitoso": "1"
            }';

        }
    }

    private function adjuntarArchivoIncidente($app, $params_error_report, $nameController, $chat_id)
    {
        $ObjectType = $_POST['ObjectType'];
        $ObjectID = $_POST['ObjectID'];
        $File = $_FILES['File'];
        print_r($File);
        $nameFunction = "adjuntarArchivoIncidente()";

        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];

        $headers = array("Authorization" => 'rest_api_key=C80DBF14D09541929B84BF2547820FE6');

        $url = "https://cesarcastillo2023.trysaasit.com/api/rest/Attachment";

        $params_error_report = [
            'enterprise_id' => $enterprise_id,
            'session_id' => $session_id,
            'bot_id' => $bot_id,
            'convesartion_id' => $convesartion_id,
        ];
        // "Category": "Chatbot"
        $request = '{
          "ObjectID":"' . $ObjectType . '",
          "ObjectType":"' . $ObjectType . '",
          "File":"' . $File . '"
        }';

        $datos = array(
            "ObjectID" => $ObjectID,
            "ObjectType" => $ObjectType,
            "File" => $File,
            "url" => $url,
        );

        $nheaders = array('Content-Type' => 'multipart/form-data; boundary=<calculated when request is sent>');

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos, 15, $nheaders);

        return json_encode($response_object);
        // if (!$response_object->RecId) {
        //     $mensajeError = 'Hubo un error';
        //     return $mensajeError;
        // }else{
        //     return '{
        //         "RecIDIncidente": "'.$response_object->RecId.'"
        //     }';

    }

//     private function adjuntarArchivoIncidente($app, $params_error_report, $nameController, $chat_id)
//     {

// $curl = curl_init();

//     $url_img = $_POST['url_img'];
//         $req_id = $_POST['req_id'];
//         $urlIn = $_POST['url'];
//         $apiKey = $_POST['apiKey'];

//         $ch = curl_init();

//         $fileNameArray = explode("/", $url_img);
//         $positionName = count($fileNameArray) - 1;
//         $fileName = $fileNameArray[$positionName];

//         $headers = array("Authorization" => 'rest_api_key='.$apiKey.'');

//         $testPut = file_put_contents($fileName, file_get_contents($url_img));

//         $cfile = new \CURLFile ('/var/www/app/' . $fileName);

//         $params = ['ObjectID' => $req_id, 'ObjectType' => 'incident#', 'File' => $cfile];

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://cesarcastillo2023.trysaasit.com/api/rest/Attachment',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => array('ObjectID' => $req_id, 'ObjectType' => 'incident#', 'File' => ''),
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Authorization: rest_api_key=C80DBF14D09541929B84BF2547820FE6'
//   ),
// ));

// $response = curl_exec($curl);
// print_r($response);
// curl_close($curl);
// echo $response;

//     }

    private function adjuntarArchivoIncidenteTest($app, $params_error_report, $nameController, $chat_id)
    {

        $url_img = $_POST['url_img'];
        $req_id = $_POST['req_id'];
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $ch = curl_init();

        $fileNameArray = explode("/", $url_img);
        $positionName = count($fileNameArray) - 1;
        $fileName = $fileNameArray[$positionName];

        $headers = array('Authorization:rest_api_key=C80DBF14D09541929B84BF2547820FE6');
        $testPut = file_put_contents($fileName, file_get_contents($url_img));

        $cfile = new \CURLFile('/var/www/app/' . $fileName);
        $params = ['ObjectID' => $req_id, 'ObjectType' => 'incident#', 'File' => $cfile];
        curl_setopt($ch, CURLOPT_URL, "https://cesarcastillo2023.trysaasit.com/api/rest/Attachment");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $response = json_decode($server_output);
        $dato = $response[0]->IsUploaded;
        if ($dato) {
            $request = '{
            "adjunto":"si"
            }';
        } else {
            $request = '{
            "adjunto":"no"
            }';
        }
        curl_close($ch);

        return $request;

    }

    private function agregarNotaIncidente($app, $params_error_report, $nameController, $chat_id)
    {
        $subject = $_POST['subject'];
        $NotesBody = $_POST['NotesBody'];
        $Source = $_POST['Source'];
        $TimeSpent = $_POST['TimeSpent'];
        $Category = $_POST['Category'];
        $CreatedBy = $_POST['CreatedBy'];
        $JournalType = $_POST['JournalType'];
        $ParentLink_Category = $_POST['ParentLink_Category'];
        $ParentLink_RecID = $_POST['ParentLink_RecID'];
        $PublishToWeb = $_POST['PublishToWeb'];
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];
        $nameFunction = "agregarNotaIncidente()";

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/Journal__Notess";

        $datos = array(
            "subject" => $subject,
            "NotesBody" => $NotesBody,
            "Source" => $Source,
            "TimeSpent" => $TimeSpent,
            "Category" => $Category,
            "CreatedBy" => $CreatedBy,
            "JournalType" => $JournalType,
            "ParentLink_Category" => $ParentLink_Category,
            "ParentLink_RecID" => $ParentLink_RecID,
            "PublishToWeb" => $PublishToWeb,
            "url" => $url,
        );

        $request = '{
		"Subject": "' . $subject . '",
		"NotesBody": "' . $NotesBody . '",
		"Source": "' . $Source . '",
		"TimeSpent": ' . $TimeSpent . ',
		"Category": "' . $Category . '",
		"CreatedBy": "' . $CreatedBy . '",
		"JournalType": "' . $JournalType . '",
		"ParentLink_Category": "' . $ParentLink_Category . '",
		"ParentLink_RecID": "' . $ParentLink_RecID . '",
		"PublishToWeb": ' . $PublishToWeb . '
		}';

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        return json_encode($response_object);

    }

}

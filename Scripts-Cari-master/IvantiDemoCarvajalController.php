<?php

namespace App\Controllers;

class IvantiDemoCarvajalController
{
    private $nameLog = "IvantiDemoCarvajal";

    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "IvantiDemoCarvajalController";
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
                case "crearIncidente":
                    $response = $this->crearIncidente($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "crearRequerimiento":
                    $response = $this->crearRequerimiento($app, $params_error_report, $nameController, $chat_id);
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
        $create_by = $response_object->value[0]->CreatedBy;

        $var = '{
            "nombreUsuario": "' . $name_user . '",
            "recId": "' . $rec_id . '",
            "createBy": "'.$create_by.'"
        }';

        return $var;

    }

    private function crearIncidente($app, $params_error_report, $nameController, $chat_id)
    {
        $subject = $_POST['subject'];
        $symptom = $_POST['symptom'];
        $ProfileLink_RecID = $_POST['ProfileLink_RecID'];
        $satisfaceNecesidad = $_POST['satisface_necesidad'];
        $createBy = $_POST['create_by'];
        $owner = $_POST['owner'];
        $nameFunction = "crearIncidente()";
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/odata/businessobject/incidents?$"."filter=ProfileLink_RecID eq '".$ProfileLink_RecID."' and Status ne 'Closed'";

        $datos = array(
            "subject" => $subject,
            "symptom" => $symptom,
            "ProfileLink_RecID" => $ProfileLink_RecID,
            "url" => $url,
        );

        $request = '{
            "Category": "Emisión",
            "ProfileLink_RecID":"'. $ProfileLink_RecID.'",
            "LAR_SatisfaceNecesidad":"'.$satisfaceNecesidad.'",
            "CreatedBy":"'.$createBy.'",
            "Service": "DOC LEGALES",
            "Status": "Logged",
            "Subject":"'.$subject.'",
            "Symptom":"'.$symptom.'",
            "Owner": "'.$owner.'",
            "OwnerTeam": "Accounting"
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


    private function crearRequerimiento($app, $params_error_report, $nameController, $chat_id){

        $login_id = $_POST['loginId'];
        $tipo_servicio = $_POST['tipoServicio'];
        $descripcion = $_POST['descipcion'];
        $nombre_usuario = $_POST['nombreUsuario'];
        $rec_id = $_POST['rec_id'];
        $satisface_necesidad = $_POST['satisfaceNecesidad'];
        $nameFunction = "crearRequerimiento()";
        $urlIn = $_POST['url'];
        $apiKey = $_POST['apiKey'];

        $headers = array("Authorization" => 'rest_api_key=' . $apiKey . '');

        $url = $urlIn . "/api/rest/ServiceRequest/new";

        $datos = array(
            "login_id" => $login_id,
            "tipo_servicio" => $tipo_servicio,
            "descripcion" => $descripcion,
            "nombre_usuario" => $nombre_usuario,
            "rec_id" => $rec_id,
            "url" => $url,
        );
        
        $request = '{
                "attachmentsToDelete": [],
                "attachmentsToUpload": [],
                "parameters": {
                "par-73740238B3E14CBC85BC376F1B01CD23": "ENTIDAD REGULATORIA",
                "par-73740238B3E14CBC85BC376F1B01CD23-recId": "A154AED139A248DE9118D28D95A2BE18",
                "par-94F93401F1DA4D6A9FF674B968AC2E56": "'.$nombre_usuario.'",
                "par-A310339DD9624D1C89DD7393E369F2C3": "'.$login_id.'",
                "par-C802ED81EBFA45CFA28DEAEF98454BB8": "'.$tipo_servicio.'",
                "par-C802ED81EBFA45CFA28DEAEF98454BB8-recId": "0DC0CCA3BA694642A258422CDBB3212F",
                "par-7C6DF36227834DD9B724D1859C72158C": "'.$descripcion.'"
                },
                "delayedFulfill": false,
                "formName": "ServiceReq.ResponsiveAnalyst.DefaultLayout",
                "saveReqState": false,
                "serviceReqData": {
                "Subject": "'.$tipo_servicio.'",
                "Symptom": "'.$descripcion.'",
                "LAR_SatisfaceNecesidad" : "'.$satisface_necesidad.'",
                "LAR_ProgramarLlamada" : "false"
                },
                "strCustomerLocation": "West",
                "strUserId": "'.$rec_id.'",
                "subscriptionId": "716F3C27338145EDAF80D3746B5DBEBA",
                "localOffset": -330
                }';

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object->IsSuccess != true) {
            return '{
		"exitoso": "0"
            }';
        } else {

            return '{
		        "RequestNumber": "' . $response_object->ServiceRequests[0]->strRequestNum . '",
		        "exitoso": "1"
            }';

        }

    }

}

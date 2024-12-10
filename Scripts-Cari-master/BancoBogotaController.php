<?php

namespace App\Controllers;

use Utils\SetLogs;

class BancoBogotaController
{
    public $nameLog = "BancoBogota";
    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "BancoBogotaController";
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
                case "tokenUsuario":
                    $response = $this->tokenBancoBogota($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getCustomerInfo":
                    $response = $this->getCustomerInfo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "listAccounts":
                    $response = $this->listAccounts($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "guid":
                    $response = $this->GUID($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getBalances":
                    $response = $this->getBalances($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getCreditCards":
                    $response = $this->getCreditCards($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getGoodStanding":
                    $response = $this->getGoodStanding($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "accountsFilter":
                    $response = $this->accountsFilter($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "sendGoodstanding":
                    $response = $this->sendGoodstanding($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validateActiveAccounts":
                    $response = $this->validateActiveAccounts($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "sendBankReference":
                    $response = $this->sendBankReference($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "sendTributeCertificate":
                    $response = $this->sendTributeCertificate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getDebitCards":
                    $response = $this->getDebitCards($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "blockDebitCard":
                    $response = $this->blockDebitCard($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getDates":
                    $response = $this->getDates($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "getAuthTokenInfo":
                    $response = $this->getAuthTokenInfo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "verifyLine":
                    $response = $this->verifyLine($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "sendOtp":
                    $response = $this->sendOtp($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "validateOtp":
                    $response = $this->validateOtp($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "modifyCreditCards":
                    $response = $this->modifyCreditCards($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "modifyBillingDate":
                    $response = $this->modifyBillingDate($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                case "accountsFilter2":
                    $response = $this->accountsFilter2($app, $params_error_report, $nameController, $chat_id);
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


    public function tokenBancoBogota($app, $params_error_report, $nameController, $chat_id)
    {
        /**
         * This function generates the auth token for be able to consume the rest of the services
         * @return string accessToken
         * @return string expiration
         */
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getBancoBogotaToken()";

        $datos = array(
            "chat_id" => $chat_identification
        );
        /**
         * Endpoint url
         */
        $url = "https://auth-wa.auth.us-east-1.amazoncognito.com/oauth2/token";
        /**
         * Required headers
         */
        $headers = [
            'Authorization' => 'Basic MTk2cmo3YTNyMWw5cHRsNzZyaDhsdG1ycDM6NG1ocGI1bm5sa2RucHVnN2hzaGRwYzV0b2s2bjN1NXFjbWd2NzhiZm9wdDZ2dmszYWts',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        /**
         * @var string scope is used for set the scope of the token. 
         * customers/read is for the most of the customer functions and creditcards/read for services that uses cards (list, block)
         */
        $scope = $_POST['scope'];
        /**
         * The body request with the scope var included
         */
        $request = [
            'grant_type' => 'client_credentials',
            'scope' => $scope
        ];
        /**
         * @var object response_object is used to consume the service. This function returns the response of the service with the respective status code.
         */
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", null, $headers, $params_error_report, $this->nameLog, 15, $datos, null, true);
        /**
         * Here we can manage the data with the response_object var
         */
        $datos = '{
            "accessToken":"' . $response_object->access_token . '",
            "expiration":"' . $response_object->expires_in . '"
        }';
        return $datos;
    }

    public function bearerToken($app, $params_error_report, $nameController, $chat_id, $scope)
    {
        /**
         * This function generates the auth token for be able to consume the rest of the services
         * @return string token that contains the auth bearer token 
         */
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "bearerTest()";
        /**
         * Endpoint url
         */
        // $url = "https://auth-wa.auth.us-east-1.amazoncognito.com/oauth2/token"; // Dev URL
        $url = "https://auth-wa-pr.auth.us-east-1.amazoncognito.com/oauth2/token";
        /**
         * Required headers
         */
        $headers = array(
            //  'Authorization: Basic MTk2cmo3YTNyMWw5cHRsNzZyaDhsdG1ycDM6NG1ocGI1bm5sa2RucHVnN2hzaGRwYzV0b2s2bjN1NXFjbWd2NzhiZm9wdDZ2dmszYWts', // Dev Auth Basic Header
            'Authorization: Basic MWwwaDhjMTF0MjBocnJiODAxMDVnZXFrcXE6MWRkNTljN2E5NnFjcW41aHBoYmVpYXUzZGhvNHNyZmhqbzRhNHRkajVyb2NkdmZodjNkbg==',
            'Content-Type: application/x-www-form-urlencoded'
        );
        /**
         * @var string scope is used for set the scope of the token. 
         * customers/read is for the most of the customer functions and creditcards/read for services that uses cards (list, block)
         */
        /**
         * The request body with the scope var included
         */
        $request = 'grant_type=client_credentials&scope='.$scope;
        /**
         * @var object response_object is used to consume the service. This function returns the response of the service with the respective status code.
         * It's used in every function
         */
        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, null);
        /**
         * Here we can manage the data with the response_object var
         */
        $data = json_decode($response_object, true);
        $token = $data['access_token'];

        return $token;
    }

    public function getCustomerInfo($app, $params_error_report, $nameController, $chat_id)
    {
        /**
         * This function retrieves the data for a Banco de Bogota customer
         * @return object var that containts the relevant data that needs to be used in the rest of the services (email, fullName).
         * Also validates if the user is a client of Banco de Bogota
         */
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getCustomerInfo()";
        /**
         * @var string idType receive the id type of the customer
         * @var string idNumber receive the id number of the customer
         * @var string tokenAWS is the auth token generated in tokenBancoBogota function
         * @var string guid is a register number for the tracking of the conversation
         * @var string baseUrl is a string containing the first part (base) of the endpoint URL
         * @var string url contains the endpoint of the service
         * @var string headers contains the required headers for the service. The array includes the token and guid variables inside it
         */
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['custUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        // $url = "https://cxgxdlwk2d.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."?basic=1&general=1&finantial=1&location=1&secure=1";
        $url = $baseUrl . $idType . '/' . $idNumber . '?basic=1&general=1&finantial=1&location=1&secure=1';

        $headers = array(
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: PB',
            'X-TerminalId : AWS1',
            'X-BankId: 001',
            'Authorization: ' . $tokenAWS
        );

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos,$guid);
        /** 
         * @var object data is used to decode the response_object from json so the data can be managed
         */
        $data = json_decode($response_object, true);
        /**
         * @var int statusCode is used for save a value inside the service that indicates that the proccess is successful
         * If the statusCode is diff from 0 the proccess wasn't successful and returns a client doesn't exist message
         */
        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $statusDetail = ['IfxStatus']['ServerStatusDesc'];

        if ($statusCode == '0') {
            $firstName = $data['CustInfo']['PersonName']['FirstName'];
            $lastName = $data['CustInfo']['PersonName']['LastName'][0];
            $fullName2 = $data['CustInfo']['PersonName']['FullName'];
            $typeCustomer = $data['CustInfo']['CustType'];
            $typeCustomerDesc = $data['CustInfo']['CustTypeDesc'];
            $customerStatus = $data['CustInfo']['CustStatus'];
            $email = $data['CustInfo']['ContactInfo']['EmailAddr'];
            $cellphone = $data['CustInfo']['ContactInfo']['PhoneNum'][0]['Phone'];
            $safePhone = $data['CustInfo']['SafeInfo']['SafePhone'];
            $safeEmail = $data['CustInfo']['SafeInfo']['SafeEmailAddr'];
            $fullName = $firstName . " " . $lastName;

            $var = '{
                "primerNombre" : "' . $firstName . '",
                "primerApellido" : "' . $lastName . '",
                "correoElectronico" : "' . $email . '",
                "numeroCelular" : "' . $cellphone . '",
                "tipoCliente" : "' . $typeCustomer . '",
                "tipoClienteDescp" : "' . $typeCustomerDesc . '",
                "statusCliente" : "' . $customerStatus . '",
                "safePhone" : "' . $safePhone . '",
                "safeEmail" : "' . $safeEmail . '",
                "fullName" : "' . $fullName . '",
                "nombreCompleto" : "' . str_replace(",", " ", $fullName2) . '",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        } elseif($statusCode == '100' && $statusDesc == 'Technical error occurred') {
            $var = '{
            "mssg" : "Hubo un error del servicio",
            "statusCode" : "'.$statusCode.'",
            "statusDesc" : "'.$statusDesc.'"
            }';
        } else {
            $var = '{
                "mssg" : "'.$statusDetail.'",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;
    }

    public function listAccounts($app, $params_error_report, $nameController, $chat_id)
    {
        /**
         * This function retrieves a list of the customer accounts from Banco de Bogotá database
         * @var string finalDate format the date into the string format "Y-m-dTH:i:s" that is required for the service in that way
         * @var string idType to send to the service the user Id type required by the service url
         * @var string idNumber to send to the service the user Id number required by the service url
         * @var string tokenAWS that receives the bearer token from the tokenBancoBogota function
         * @var string guid that receives a GUID number. There is a function to generate this number below
         * @var array headers is the headers array for the service. Includes the tokenAWS and guid variables
         * @return array arrayDinamico is an array with all the accounts that a customer could have in Banco de Bogotà
         */
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "listAccounts()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['listAccountsUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );


        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: IVR',
            'X-TerminalId: IVR001',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate . '',
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://q3fb0capza.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/accounts";
        $url = $baseUrl . $idType . '/' . $idNumber . '/accounts';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $acctArray = $data['AcctInfoRec'];
        $acctArraySize = count($acctArray);

        $cariDataArray = new \stdClass(); // Para las preguntas dinámicas se debe inicializar el arreglo de esta manera

        /*Aquí va el código de la lógica del arreglo (si viene con arreglos con arreglos internos se puede "volver a armar" para que todo esté en el mismo nivel)*/
        if ($statusCode == '0') {
            for ($i = 0; $i < $acctArraySize; $i++) {

                //response1->arrayDinamico[$j]->horaCita = $horaCita; --> Esta es la manera de extraer la data de la respuesta
                $cariDataArray->arrayDinamico[$i]->acctNumber = $acctArray[$i]["ProductNumEncryp"];
                $cariDataArray->arrayDinamico[$i]->acctPartNumb = $acctArray[$i]["ProductNumPart"];
                $cariDataArray->arrayDinamico[$i]->acctType = $acctArray[$i]["AcctType"];
                $cariDataArray->arrayDinamico[$i]->acctSubType = $acctArray[$i]["AcctSubType"];
                $cariDataArray->arrayDinamico[$i]->acctName = $acctArray[$i]["AcctName"];
                $cariDataArray->arrayDinamico[$i]->acctDomain = $acctArray[$i]["AcctDomain"];
                $cariDataArray->arrayDinamico[$i]->acctCurrency = $acctArray[$i]["AcctCur"];
                $cariDataArray->arrayDinamico[$i]->bnkBranch = $acctArray[$i]["BankInfo"]["BranchId"]; // Ejemplo de cuando el dato se encuentra en un objeto dentro del arreglo
                $cariDataArray->arrayDinamico[$i]->acctNumber = $acctArray[$i]["ProductNumEncryp"];
                $cariDataArray->arrayDinamico[$i]->clientName =  $acctArray[$i]["FullName"];
                $cariDataArray->arrayDinamico[$i]->acctStatusCode = $acctArray[$i]["AccountStatus"]["StatusCode"];
                $cariDataArray->arrayDinamico[$i]->LockId = $acctArray[$i]["AccountStatus"]["LockId"];
                $cariDataArray->arrayDinamico[$i]->effDate = $acctArray[$i]["AccountStatus"]["EffDt"];
                $cariDataArray->arrayDinamico[$i]->expDate = $acctArray[$i]["AccountStatus"]["ExpDt"];
                $cariDataArray->arrayDinamico[$i]->statusCode = $statusCode;
                $cariDataArray->arrayDinamico[$i]->statusDesc = $statusDesc;
            };

            return \GuzzleHttp\json_encode($cariDataArray); // Y de esta manera se retorna el arreglo que se va a pasar a los bots en Cariai

        } else {
            $error = '{
                    "mssg" : "El usuario con el documento "' . $idNumber . '" no tiene cuentas en Banco de Bogotá",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        }
    }


    public function GUID($app, $params_error_report, $nameController, $chat_id)
    {
        /**
         * This function generates a GUID number using the chat_identification and the timestamp based on the channel where the bot is running (web or whatsapp)
         * @var string chat_identification is a string input that contains the id number of the chat
         * @var string chat_channel is a string input that receives the channel of the bot
         * @return string var containing the generated GUID number that should be used in the other functions headers
         */

        date_default_timezone_set("America/Bogota");
        $chat_identification = $_POST['chat_identification'];
        $chat_channel = $_POST['chat_channel'];
        $opc = $_POST['opcionBancoBogota'];
        $nameController = 'BancoBogotaController';

        if ($chat_channel == 1){
            $chat_identification = str_replace("_", "", $chat_identification);
            $chat_identification = substr($chat_identification,6,10);
        }

        if (strlen($opc) == '5'){
            $adder = '34914';
        } else {
            $adder = '349141';
        }
        
        $new_id = ''.$opc.''.$adder.''.$chat_identification.'';
        
        switch (strlen($new_id)) {
            case '16':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12,4);
        
                $tm_stamp = date("Ymdhi");
        
                $rquid = $chat_identification1 . "-" . $chat_identification2 . "-" . $chat_identification3 . "-0000-" . $tm_stamp;
                
                break;
            case '17':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1){
                    $chat_identification4 = substr($new_id, 16, 2);
                } else {
                    $chat_identification4 = substr($new_id, 16, 1);
                }
                        
        
                $tm_stamp = date("Ymdhi");
        
                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-'.$chat_identification4.'000-'. $tm_stamp;
                
                break;
            case '18':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1){
                    $chat_identification4 = substr($new_id, 16, 3);
                } else {
                    $chat_identification4 = substr($new_id, 16, 2);
                }
                        
        
                $tm_stamp = date("Ymdhi");
        
                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-'.$chat_identification4.'00-'. $tm_stamp;

                break;
            case '19':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1){
                    $chat_identification4 = substr($new_id, 16, 4);
                } else {
                    $chat_identification4 = substr($new_id, 16, 3);
                }
                        
                $tm_stamp = date("Ymdhi");
        
                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-'.$chat_identification4.'0-'. $tm_stamp;
                
                break;
            case '20':
                
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1){
                    $chat_identification4 = substr($new_id, 16, 5);
                } else {
                    $chat_identification4 = substr($new_id, 16, 4);
                }
                        
                $tm_stamp = date("Ymdhi");
        
                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-'.$chat_identification4.'-'. $tm_stamp;
                
                break;
            case '21':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                $chat_identification4 = substr($new_id, 16, 5);
                        
                $tm_stamp = date("Ymdhi");
        
                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-'.$chat_identification4.'-'. $tm_stamp;
                
                break;
            default:
                $rquid = '00000000-0000-0000-0000-000000000000';
                break;
        }
           


        $var = '{
                "Rquid" : "' . $rquid . '"
            }';

        return $var;
    }

    public function getBalances($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getBalances()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $cardIdInit = $_POST['cardId'];
        $cardId = urlencode($cardIdInit);
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['getBalancesUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "cardId" => $cardIdInit,
            "encodedCardId" => $cardId,
            "baseUrl" => $baseUrl
        );


        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 0890',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'Authorization: ' . $tokenAWS
        );

        //$url = 'https://1mht8o6mnk.execute-api.us-east-1.amazonaws.com/qa/customers/'.$idType.'/'.$idNumber.'/creditcards/balances?AcctId='.$acctId;
        $url = $baseUrl . $idType . '/' . $idNumber . '/creditcards/balances?AcctId=' . $cardId;

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $acctDetail = $data['ClientAllRec'];

        $acctId = $acctDetail['AcctBasicInfo'];

        if ($statusCode == '0') {

            $acctId = $acctDetail[0]["AcctBasicInfo"]["AcctId"];
            $acctType = $acctDetail[0]["AcctBasicInfo"]["AcctType"];
            $acctPrincBal = $acctDetail[0]["AcctBal"][0]["CurAmt"]["Amt"];
            $acctAvailCredit = $acctDetail[0]["AcctBal"][2]["CurAmt"]["Amt"];
            $acctCreditLimit = $acctDetail[0]["AcctBal"][3]["CurAmt"]["Amt"];
            $acctPayoffAmt = $acctDetail[0]["AcctBal"][4]["CurAmt"]["Amt"];
            $dueDate = $acctDetail[0]["DueDt"];
            $minPmtAmt = $acctDetail[0]["MinPmtCurAmt"]["Amt"];

            $var = '{
                    "acctId" : "' . $acctId . '",
                    "acctType" : "' . $acctType . '",
                    "acctPrincBal" : "' . $acctPrincBal . '",
                    "acctAvailCredit" : "' . $acctAvailCredit . '",
                    "acctCreditLimit" : "' . $acctCreditLimit . '",
                    "acctPayoffAmt" : "' . $acctPayoffAmt . '",
                    "dueDate" : "' . $dueDate . '",
                    "minPmtAmt" : "' . $minPmtAmt . '",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
        } else {
            $var = '{
                "mssg" : "No hay datos de la tarjeta terminada seleccionada",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;
    }

    public function getCreditCards($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getCreditCards()";

        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['getCreditCardsUrl'];

        $datos = array(
            "userIdType" => $idType,
            "idNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: PPE_095',
            'X-TerminalId: 0890',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', // Preprod
            'Authorization: ' . $tokenAWS
        );

        //$url = "https://esge3b5uqj.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/rec";
        $url = $baseUrl . $idType . '/' . $idNumber . '/rec';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $creditCardInfoArr = $data['ClientAllRec'];
        $creditCardSize = count($creditCardInfoArr);

        $cariDataArray = new \stdClass();

        $actArray = array();
        $actArray1 = array();
        $actArray2 = array();
        $actArray3 = array();
        $actArray4 = array();
        $actArray5 = array();

        $nActArray = array();
        $nActArray1 = array();
        $nActArray2 = array();
        $nActArray3 = array();
        $nActArray4 = array();
        $nActArray5 = array();

        if ($statusCode == '0') {
            for ($i = 0; $i < $creditCardSize; $i ++) {
                array_push($actArray, $creditCardInfoArr[$i]['CardAcctId']['CardId']);
                array_push($actArray1, $creditCardInfoArr[$i]['CardAcctId']['ProductId']);
                array_push($actArray2, $creditCardInfoArr[$i]['CardAcctId']['LastNumCardId']);
                array_push($actArray3, $creditCardInfoArr[$i]['CardAcctId']['CardStatus']['StatusCode']);
                array_push($actArray4, $creditCardInfoArr[$i]['CardAcctId']['CardStatus']['LockId'][0]);
                array_push($actArray5, $creditCardInfoArr[$i]['CardAcctId']['BinCard']);
            }

            for ($i = 0; $i < sizeof($actArray4); $i++){
                if ($actArray4[$i] == ' '){
                    array_push($nActArray, $actArray[$i]);
                    array_push($nActArray1, $actArray1[$i]);
                    array_push($nActArray2, $actArray2[$i]);
                    array_push($nActArray3, $actArray3[$i]);
                    array_push($nActArray4, $actArray4[$i]);
                    array_push($nActArray5, $actArray5[$i]);

                } 
            }

            $lenArray = sizeof($nActArray);

            for ($j = 0; $j < $lenArray; $j++) {
                $cariDataArray->arrayDinamico[$j]->cardId = $nActArray[$j];
                $cariDataArray->arrayDinamico[$j]->productId = $nActArray1[$j];
                $cariDataArray->arrayDinamico[$j]->lastCardIdNum = $nActArray2[$j];
                $cariDataArray->arrayDinamico[$j]->cardStatus = $nActArray3[$j];
                $cariDataArray->arrayDinamico[$j]->cardBlocked = $nActArray4[$j];
                $cariDataArray->arrayDinamico[$j]->binCard = $nActArray5[$j];
                $cariDataArray->arrayDinamico[$j]->statusCode = $statusCode;
                $cariDataArray->arrayDinamico[$j]->statusDesc = $statusDesc;
            }

            return \GuzzleHttp\json_encode($cariDataArray);
        } else {
            $error = '{
                    "mssg" : "El usuario con el documento ' . $idNumber . ' no tiene tarjetas de crédito con Banco de Bogotá",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        }
    }

    public function getGoodStanding($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getGoodStanding()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['getGoodstandingUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        //$url = "https://l943whl9r7.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/goodStanding";
        $url = $baseUrl . $idType . '/' . $idNumber . '/goodStanding';

        $headers = array(
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId : NEXA',
            'X-BankId: 001',
            'Authorization: ' . $tokenAWS
        );

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $goodStandingInfo = $data['BankAcctInfo'];
        $gsSize = count($goodStandingInfo);

        $cariDataArray = new \stdClass();

        if ($statusCode == '0') {
            for ($i = 0; $i < $gsSize; $i++) {
                $cariDataArray->arrayDinamico[$i]->productCyp = $goodStandingInfo[$i]['ProductNumCyp'];
                $cariDataArray->arrayDinamico[$i]->acctType = $goodStandingInfo[0]['AcctType'];
                $cariDataArray->arrayDinamico[$i]->partNumber = $goodStandingInfo[0]['ProductNumPart'];
                $cariDataArray->arrayDinamico[$i]->statusCode = $statusCode;
                $cariDataArray->arrayDinamico[$i]->statusDesc = $statusDesc;
            };

            return \GuzzleHttp\json_encode($cariDataArray);
        } elseif ($statusCode == 100 && $statusDesc == "Technical error occurred") {
            $error = '{
                    "mssg" : "Por favor revisa los datos ingresados",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        } else {
            $error = '{
                    "mssg" : "Hubo un error desconocido",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        }
    }

    public function accountsFilter($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "accountsFilter()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $acType = $_POST['acctType'];
        $baseUrl = $_POST['listAccountsUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "accountType" => $acType,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: IVR',
            'X-TerminalId: IVR001',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate . '',
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://q3fb0capza.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/accounts";
        $url = $baseUrl . $idType . '/' . $idNumber . '/accounts';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $acctArray = $data['AcctInfoRec'];
        $acctArraySize = count($acctArray);

        $array1 = array();
        $array2 = array();
        $array3 = array();

        $cariDataArray = new \stdClass();

        if ($statusCode == '0') {

            for ($i = 0; $i < $acctArraySize; $i++) {
                if ($acType === "SDA" && $acctArray[$i]['AcctType'] === "SDA") {
                    if ($acctArray[$i]['AccountStatus']['StatusCode'] != "I") {
                        $acctType = $acctArray[$i]['AcctType'];
                        $acctNum = $acctArray[$i]['ProductNumEncryp'];
                        $acctPartNum = $acctArray[$i]['ProductNumPart'];
                        array_push($array1, $acctType);
                        array_push($array2, $acctNum);
                        array_push($array3, $acctPartNum);
                    }
                } elseif ($acType === "CCA" && $acctArray[$i]['AcctType'] === "CCA") {
                    if ($acctArray[$i]['AccountStatus']['StatusCode'] != "I") {
                        $acctType = $acctArray[$i]['AcctType'];
                        $acctNum = $acctArray[$i]['ProductNumEncryp'];
                        $acctPartNum = $acctArray[$i]['ProductNumPart'];
                        array_push($array1, $acctType);
                        array_push($array2, $acctNum);
                        array_push($array3, $acctPartNum);
                    }
                } elseif ($acType === "LOC" && $acctArray[$i]['AcctType'] === "LOC") {
                    if ($acctArray[$i]['AccountStatus']['StatusCode'] != "I") {
                        $acctType = $acctArray[$i]['AcctType'];
                        $acctNum = $acctArray[$i]['ProductNumEncryp'];
                        $acctPartNum = $acctArray[$i]['ProductNumPart'];
                        array_push($array1, $acctType);
                        array_push($array2, $acctNum);
                        array_push($array3, $acctPartNum);
                    }
                } elseif ($acType === "DDA" && $acctArray[$i]['AcctType'] === "DDA") {
                    if ($acctArray[$i]['AccountStatus']['StatusCode'] != "I") {
                        $acctType = $acctArray[$i]['AcctType'];
                        $acctNum = $acctArray[$i]['ProductNumEncryp'];
                        $acctPartNum = $acctArray[$i]['ProductNumPart'];
                        array_push($array1, $acctType);
                        array_push($array2, $acctNum);
                        array_push($array3, $acctPartNum);
                    }
                } elseif ($acType === "LON" && $acctArray[$i]['AcctType'] === "LON") {
                    if ($acctArray[$i]['AccountStatus']['StatusCode'] != "I") {
                        $acctType = $acctArray[$i]['AcctType'];
                        $acctNum = $acctArray[$i]['ProductNumEncryp'];
                        $acctPartNum = $acctArray[$i]['ProductNumPart'];
                        array_push($array1, $acctType);
                        array_push($array2, $acctNum);
                        array_push($array3, $acctPartNum);
                    }
                }
            };

            $array1Len = sizeof($array1);

            for ($j = 0; $j < $array1Len; $j++) {
                $cariDataArray->arrayDinamico[$j]->accType = $array1[$j];
                $cariDataArray->arrayDinamico[$j]->accNumber = $array2[$j];
                $cariDataArray->arrayDinamico[$j]->accPartNum = $array3[$j];
                $cariDataArray->arrayDinamico[$j]->statusCode = $statusCode;
                $cariDataArray->arrayDinamico[$j]->statusDesc = $statusDesc;
            };

            return \GuzzleHttp\json_encode($cariDataArray);
        } else {
            $error = '{
                    "mssg" : "Ingresa un tipo de cuenta válido",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        }
    }

    public function sendGoodstanding($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "sendGoodstanding()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['sendGoodstandingUrl'];

        $acType = $_POST['acctType'];
        $productCyp = $_POST['productCyp'];
        $emailAdd = $_POST['email'];
        $fullName = $_POST['fullName'];
        $subject = $_POST['subject'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl,
            "accountType" => $acType,
            "productCypNum" => $productCyp,
            "emailAddress" => $emailAdd,
            "userFullName" => $fullName,
            "subject" => $subject
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: LIV001',
            'X-TerminalId: NEXA',
            'X-BankId: 001',
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://l943whl9r7.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/".$acType."/certificates/paidInFull";
        $url = $baseUrl . $idType . '/' . $idNumber . '/' . $acType . '/certificates/paidInFull';

        $request = '{
                "ProductNumCyp": "' . $productCyp . '",
                "EmailAddr": "' . $emailAdd . '",
                "FullName": "' . $fullName . '",
                "AlertSubject": "' . $subject . '"
              }';
        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos);

        $data = json_decode($response_object);


        $statusCode = $data->IfxStatus->StatusCode;
        $statusDesc = $data->IfxStatus->StatusDesc;

        $var = '{
            "statusCode":"' . $statusCode . '",
            "statusDesc":"' . $statusDesc . '"
            }';

        return $var;
    }

    public function validateActiveAccounts($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "validateActiveAccounts()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['listAccountsUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: IVR',
            'X-TerminalId: IVR001',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate . '',
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://q3fb0capza.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/accounts";
        $url = $baseUrl . $idType . '/' . $idNumber . '/accounts';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $acctArray = $data['AcctInfoRec'];
        $acctArrSize = count($acctArray);

        $array1 = array();

        if($statusCode == '0') {
            for ($i = 0; $i < $acctArrSize; $i++) {
                $acctStatus = $acctArray[$i]['AccountStatus']['StatusCode'];
                if ($acctStatus === "A") {
                    array_push($array1,"A");
                }
            }

            if (count($array1) <= 0){
                $var = '{
                    "mssg" : "No tienes cuentas activas",
                    "acctStatusCode" : "0",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
                } else {
                $var = '{
                    "mssg" : "Tienes una o más cuentas activas",
                    "acctStatusCode" : "1",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            }     
        } else {
            $var = '{
                "mssg": "Hubo un error desconocido",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;
    }

    public function sendBankReference($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'JuanviController';
        $nameFunction = "sendBankReference()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $headerDate = $date1 . "T" . $date2;
        $baseUrl = $_POST['sendBankRefUrl'];

        $productEncryp = $_POST['productEncryp'];
        $emailAdd = $_POST['email'];
        $fullName = $_POST['name'];
        $balance = $_POST['balance'];
        $acctType = $_POST['acctType'];
        $finalDate = date("Y-m-d", strtotime("now"));
        $receiver = $_POST['destinatario'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl,
            "productEncrypNum" => $productEncryp,
            "emailAddress" => $emailAdd,
            "userFullName" => $fullName,
            "balance" => $balance,
            "accountType" => $acctType,
            "receiver" => $receiver
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: LIV001',
            'X-TerminalId: NEXA',
            'X-BankId: 001',
            'X-ClientDt: ' . $headerDate . '',
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://q3fb0capza.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/account/bankreferences";
        $url = $baseUrl . $idType . '/' . $idNumber . '/account/bankreferences';

        $request = '{
                "AcctInfo": {
                    "ProductNumEncryp": "' . $productEncryp . '",
                    "AcctType": "' . $acctType . '"
            },
              "BalanceInd": ' . $balance . ',
              "City": "Bogotá",
              "StartDt": "' . $finalDate . '",
              "PersonInfo": {
                "FullName": "' . $fullName . '",
                "Desc": "' . $receiver . '" 
              },
              "DeliveryInfo": {
                 "EmailAddr": "' . $emailAdd . '",
                 "Template": "Cert_refbancarias_liv",
                 "Parameter": [
                   {
                     "Name": "Emerson Franco",
                     "Value": "' . $fullName . '"
                   }
                 ]
               }
            }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos);

        $data = json_decode($response_object);

        $statusCode = $data->IfxStatus->StatusCode;
        $statusDesc = $data->IfxStatus->StatusDesc;

        if ($statusCode == '0') {
            $var = '{
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
        } else {
            $var = '{
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }
        return $var;
    }

    public function getDebitCards($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getDebitCards()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['getDebitCardUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: LIV001',
            'X-TerminalId: AWS001',
            'X-BankId: 001',
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://wvm5bk96uc.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/cards/debit";
        $url = $baseUrl . $idType . '/' . $idNumber . '/cards/debit';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];

        $cardArray = $data['CardAcctId'];
        $cardArraySize = count($cardArray);

        $cariDataArray = new \stdClass();

        if ($statusCode == 0) {
            for ($i = 0; $i < $cardArraySize; $i++) {
                $cariDataArray->arrayDinamico[$i]->cardCyp = $cardArray[$i]["CardIdCyp"];
                $cariDataArray->arrayDinamico[$i]->cardPartId = $cardArray[$i]["CardIdPart"];
                $cariDataArray->arrayDinamico[$i]->cardType = $cardArray[$i]["CardType"];
                $cariDataArray->arrayDinamico[$i]->acctType = $cardArray[$i]["AcctType"];
                $cariDataArray->arrayDinamico[$i]->acctIdPart = $cardArray[$i]["AcctIdPart"];
                $cariDataArray->arrayDinamico[$i]->acctIdCyp = $cardArray[$i]["AcctIdCyp"];
                $cariDataArray->arrayDinamico[$i]->secStatusCode = $cardArray[$i]["SecObjStatusCode"];
                $cariDataArray->arrayDinamico[$i]->statusCode = $statusCode;
                $cariDataArray->arrayDinamico[$i]->statusDesc = $statusDesc;
            };

            return \GuzzleHttp\json_encode($cariDataArray);
        } elseif ($statusCode == 1001) {
            $error = '{
                    "mssg" : "El cliente no tiene Tarjetas asociadas a las cuentas",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        }
    }

    public function blockDebitCard($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'JuanviController';
        $nameFunction = "blockDebitCard()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['blockDebitCardUrl'];

        $cardCyp = $_POST['cardCyp'];
        $blockStatusCode = $_POST['blockStatusCode'];
        $blockDesc = $_POST['blockDesc'];

        $datos = array(
            "userIdType" => $idType,
            "idNumber" => $idNumber,
            "baseUrl" => $baseUrl,
            "cardCypNum" => $cardCyp,
            "blockStatusCode" => $blockStatusCode,
            "blockDescription" => $blockDesc
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: LIV001',
            'X-TerminalId: AWS001',
            'X-BankId: 001',
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://wvm5bk96uc.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/cards/debit/status";
        $url = $baseUrl . $idType . '/' . $idNumber . '/cards/debit/status';

        $request = '{
                "CardIdCyp": "' . $cardCyp . '",
                "StatusCode": "' . $blockStatusCode . '",
                "StatusDesc": "' . $blockDesc . '",
                "LockId": "v"
            }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'PUT', $request, $this->nameLog, $datos);

        $data = json_decode($response_object);

        $statusCode = $data->IfxStatus->StatusCode;
        $statusDesc = $data->IfxStatus->StatusDesc;
        $var = '{
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
        return $var;
    }

    public function getDates($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "financialInfo()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $productIdInit = $_POST['productId'];
        $productId = urlencode($productIdInit);
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['getDatesUrl'];

        $datos = array(
            "productNumber" => $productIdInit,
            "encodedProdNum" => $productId,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 0890',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://1mht8o6mnk.execute-api.us-east-1.amazonaws.com/qa/creditcards/accounts/financialinfo?AccountId=".$productId;
        $url = $baseUrl . $productId;

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];

        if ($statusCode == 0) {

            $nextPaymentDay = $data['CardAcctId']['CardStatus']['EffDt'];
            $lastPaymentDay = $data['BillInfo']['CloseDt'];
            $totalPayment = $data['AcctBal']['MaxCurAmt']['Amt'];
            $billCycle = $data['Relation']['BillCycle'];

            $var = '{
                "nextPaymentDay" : "' . $nextPaymentDay . '",
                "lastPaymentDay" : "' . $lastPaymentDay . '",
                "totalPayment" : "' . $totalPayment . '",
                "actualBillCycle" : "'.$billCycle.'",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
                }';
        } else {
            $var = '{
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;
    }

    public function getAuthTokenInfo($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "getAuthTokenInfo()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['authTokenInfoUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: Entelgy',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS
        );

        //$url = 'https://l5phcegweh.execute-api.us-east-1.amazonaws.com/pr/Customers/'  . $idType . '/' . $idNumber . '/tokenInfo'; // Prod
        //$url = 'https://m5vocwqw95.execute-api.us-east-1.amazonaws.com/qa/Customers/' . $idType . '/' . $idNumber . '/tokenInfo'; /7 Dev
        $url = $baseUrl . $idType . '/' . $idNumber . '/tokenInfo';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];

        if ($statusCode == 0) {

            $tkProductId = $data['ProductInfo'][0]['ProductId'];
            $tkProductNum = $data['ProductInfo'][0]['ProductNum'];
            $tkProductStatusCode = $data['ProductInfo'][0]['StatusCode'];
            $tkPhoneNumber = $data['ContactInfo']['PhoneNum'][0]['phone'];
            $tkLastPhoneNumbers = substr($tkPhoneNumber, -4);
        }

        /**
         * This part verifies if the user has an app or needs to authenticate through cellphone OTP method
         */
        if ($tkProductId == 'None') {
            if ($tkProductNum == 'None' && $tkProductStatusCode == 'None') {

                $var = '{
                        "phoneNumber" : "' . $tkPhoneNumber . '",
                        "otp" : "Si",
                        "statusCodeOtp" : "1",
                        "productId" : "' . $tkProductId . '",
                        "productNum" : "' . $tkProductNum . '",
                        "prodStatusCode" : "' . $tkProductStatusCode . '",
                        "lastPhoneDigits" : "' . $tkLastPhoneNumbers . '",
                        "statusCode" : "'.$statusCode.'",
                        "statusDesc" : "'.$statusDesc.'"
                    }';
            }
        } else {
            $var = '{
                    "phoneNumber" : "' . $tkPhoneNumber . '",
                    "otp" : "No",
                    "statusCodeOtp" : "0",
                    "productId" : "' . $tkProductId . '",
                    "productNum" : "' . $tkProductNum . '",
                    "prodStatusCode" : "' . $tkProductStatusCode . '",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
        }

        return $var;
    }

    public function verifyLine($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "verifyLine()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $otp = $_POST['otpAllowed'];
        $phone = $_POST['phoneNumber'];
        $phoneDigits = substr($phone, -4);
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['verifyLineUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: AWS1',
            'X-BankId: 0010016',
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS
        );

        //$url = "https://hua0ewfqpj.execute-api.us-east-1.amazonaws.com/qa/customers/" . $idType . "/" . $idNumber . "/phone/" . $phone . "/simvalidation";
        $url = $baseUrl . $idType . '/' . $idNumber . '/phone/' . $phone . '/simvalidation';

        $request = '{
            "Addr": "127.0.0.1",
            "TrnType": "REG"
        }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $serverStatusCode = $data['IfxStatus']['ServerStatusCode'];

        if ($statusCode == '0') {
            if ($serverStatusCode == '1') {
                $var = '{
                    "verifiedLine" : "Si",
                    "verifiedLineCode" : "' . $serverStatusCode . '",
                    "phoneNumber" : "' . $phone . '",
                    "phoneLastDigits" : "' . $phoneDigits . '",
                    "otp" : "' . $otp . '",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            } else {
                $var = '{
                    "verifiedLine" : "No",
                    "verifiedLineCode" : "' . $serverStatusCode . '",
                    "otp" : "' . $otp . '",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'",
                    "serverStatusCode" : "'.$serverStatusCode.'"
                }';
            }
        } else {
            $var = '{
                "mssg" : "Hubo un error en el sistema",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;
        //return $phoneInit;
    }

    public function sendOtp($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "sendOtp()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['sendOtpUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 1',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS
        );

        //$url = 'https://m5vocwqw95.execute-api.us-east-1.amazonaws.com/qa/Customers/' . $idType . '/' . $idNumber . '/otp';
        $url = $baseUrl . $idType . '/' . $idNumber . '/otp';

        $request = '{
            "CustLoginId": "' . $idNumber . '",
            "RefInfo": {
              "RefType": "02",
              "Desc": [
                "Mensaje de Texto enviado para la OTP"
              ]
            },
            "SafePhone": "1"
          }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos);

        $data = json_decode($response_object);

        $statusCode = $data->IfxStatus->StatusCode;
        $statusDesc = $data->IfxStatus->StatusDesc;

        if ($statusCode == 0) {
            $var = '{
                      "statusCode" : "'.$statusCode.'",
                      "statusDesc" : "'.$statusDesc.'"
                  }';
        } else {
            $var = '{
                  "mssg" : "Hubo un error",
                  "statusCode" : "'.$statusCode.'",
                  "statusDesc" : "'.$statusDesc.'"
              }';
        }

        return $var;
    }

    public function validateOtp($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "validateOtp()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $tkInfoInit = $this->getAuthTokenInfo($app, $params_error_report, $nameController, $chat_id);
        $func_response = json_decode($tkInfoInit, true);
        $productNum = $func_response['productNum'];
        $prodStatusCode = $func_response['prodStatusCode'];
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $otp = $_POST['otp'];
        $baseUrl = $_POST['validateOtpUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "otp" => $otp,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 1',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS
        );

        //$url = 'https://m5vocwqw95.execute-api.us-east-1.amazonaws.com/qa/Customers/' . $idType . '/' . $idNumber . '/tokenValidate';
        $url = $baseUrl . $idType . '/' . $idNumber . '/tokenValidate';

        $request = '{
            "testProdNum" : "' . $productNum . '",
            "testProdStCode" : "' . $prodStatusCode . '",
            "OTP" : "' . $otp . '",
            "RefType" : "02"
        }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $authCode = $data['AuthCode'];

        if ($statusCode == 0 && $statusDesc == 'Transaccion Exitosa') {
            $var = '{
                "autenticacion" : "' . $statusDesc . '",
                "codigoAutenticacion" : "' . $authCode . '",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        } else {
            $var = '{
                "mssg" : "Hubo un error en la autenticación",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;
    }


    public function modifyCreditCards($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "modifyCreditCards()";

        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $binCard = $_POST['binCard'];
        $numCard = $_POST['numCard'];
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['modifyCreditCardsUrl'];

        $datos = array(
            "userIdType" => $idType,
            "idNumber" => $idNumber,
            "baseUrl" => $baseUrl,
            "binCard" => $binCard,
            "numCard" => $numCard
        );


        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: PPE_095',
            'X-TerminalId: 0890',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS
        );

        //$url = "https://esge3b5uqj.execute-api.us-east-1.amazonaws.com/qa/customers/:GovIssueIdentType/:IdentSerialNum/creditcards/?BinCard=St72%2FfujD9BZ83db1Q2PBg%3D%3D&LastNumCardId=4268";
        $url = $baseUrl . $idType . '/' . $idNumber . '/creditcards/?BinCard='.$binCard.'&LastNumCardId='.$numCard.'';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $cardProductId = $data['CardAcctId']['ProductId'];
        $accountProducId = $data['Account']['ProductId'];
        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];

        $var=  '{
            "cardProductId" : "'.$cardProductId.'",
            "accountProducId" : "'.$accountProducId.'",
            "statusCode" : "'.$statusCode.'",
            "statusDesc" : "'.$statusDesc.'"
        }';

        return $var;

    }

    //modifyBillingDate
    public function modifyBillingDate($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'modifyBillingDate';
        $nameFunction = "modifyBillingDate()";
        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['modifyBillingDateUrl'];

        $custLoginId = $_POST['custLoginId'];
        $cardId = $_POST['cardId'];
        $productId = $_POST['productId'];
        $billCycle = $_POST['billCycle'];

        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;


        $datos = array(
            "userIdNumber" => $custLoginId,
            "baseUrl" => $baseUrl,
            "custLoginId" => $custLoginId,
            "cardId" => $cardId,
            "productId" => $billCycle
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 0890',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate . '',
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://esge3b5uqj.execute-api.us-east-1.amazonaws.com/qa/creditcards/billingCycles";
        //$url = $baseUrl.'/qa/creditcards/billingCycles';
        $url = $baseUrl.'/pr/creditcards/billingCycles';

        $request = '{
            "CustLoginId": "'.$custLoginId.'",
            "CardId": "'.$cardId.'",
            "CardStatusCode": "1",
            "ProductId": "'.$productId.'",
            "BillCylce": "'.$billCycle.'",
            "Memo": "cambio ciclo"
          }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'POST', $request, $this->nameLog, $datos);

        $data = json_decode($response_object);


        $statusCode = $data->IfxStatus->StatusCode;
        $statusDesc = $data->IfxStatus->StatusDesc;

        $var = '{
            "statusCode" : "'.$statusCode.'",
            "statusDesc" : "'.$statusDesc.'"
        }';

        return $var;

    }

    // Send Tribute Certificate
    public function sendTributeCertificate($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "sendTributeCertificate()";
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['sendTributeCertUrl'];

        $datos = array(
            "chat_id" => $chat_identification,
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "RqUID" => $guid,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: PB',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            //'x-api-key: aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM', //Preprod
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS
        );

        //$url = 'https://agg9q3ms4h.execute-api.us-east-1.amazonaws.com/qa/customers/' . $idType . '/' . $idNumber . '/files';
        $url = $baseUrl . $idType . '/' . $idNumber . '/files';

        $request = '{
            "FileType": "PDF",
            "FileDesc": "MostRecent",
            "AuthCode": "' . $idNumber . '",
            "DocType": "CERT"
        }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos);

        $data = json_decode($response_object);

        $statusCode = $data->IfxStatus->StatusCode;
        $statusDesc = $data->IfxStatus->StatusDesc;
        $sentLabel = $data->FileStatus;
 
        $var = '{
            "statusCode" : "'.$statusCode.'",
            "statusDesc" : "'.$statusDesc.'",
            "fileStatus" : "'.$sentLabel.'"
        }';
        
        return $var;
    }

    public function accountsFilter2($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'BancoBogotaController';
        $nameFunction = "accountsFilter2()";
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope);
        $guid = $_POST['rquId'];
        $acType = $_POST['acctType'];
        $baseUrl = $_POST['listAccountsUrl'];

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "accountType" => $acType,
            "baseUrl" => $baseUrl
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid . '',
            'X-NetworkOwner: IVR',
            'X-TerminalId: IVR001',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate . '',
            'x-api-key: R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs', // Prod
            'Authorization: ' . $tokenAWS . ''
        );

        //$url = "https://q3fb0capza.execute-api.us-east-1.amazonaws.com/qa/customers/".$idType."/".$idNumber."/accounts";
        $url = $baseUrl . $idType . '/' . $idNumber . '/accounts';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRestV2($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos, $guid);

        $data = json_decode($response_object, true);

        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $acctArray = $data['AcctInfoRec'];
        $acctArraySize = count($acctArray);

        $array1 = array();
        $array2 = array();
        $array3 = array();
        $array4 = array();

        $cariDataArray = new \stdClass();

        if ($statusCode == '0') {

            for ($i = 0; $i < $acctArraySize; $i++){
                    if ($acctArray[$i]['AcctType'] === "SDA") {
                        if ($acctArray[$i]['AccountStatus']['StatusCode'] != 'I'){
                            array_push($array1, "Cuenta de Ahorro");
                            array_push($array3, "SDA");
                        }
                    } elseif ($acctArray[$i]['AcctType'] === "CCA") {
                        if ($acctArray[$i]['AccountStatus']['StatusCode'] != 'I'){
                            array_push($array1, "Tarjeta de crédito");
                            array_push($array3, "CCA");
                        }
                    } elseif ($acctArray[$i]['AcctType'] === "LOC") {
                        if ($acctArray[$i]['AccountStatus']['StatusCode'] != 'I'){
                            array_push($array1, "Cuenta LOC");
                            array_push($array3, "LOC");
                        }
                    } elseif ($acctArray[$i]['AcctType'] === "DDA") {
                        if ($acctArray[$i]['AccountStatus']['StatusCode'] != 'I'){
                            array_push($array1, "Cuenta Corriente");
                            array_push($array3, "DDA");
                        }
                    } elseif ($acctArray[$i]['AcctType'] === "LON") {
                        if ($acctArray[$i]['AccountStatus']['StatusCode'] != 'I'){
                            array_push($array1, "Creditos");
                            array_push($array3, "LON");
                        }
                    }
            } 

            $array1 = array_unique($array1);

            $array1Len = sizeof($array1)+1;

            for ($j = 0; $j < $array1Len; $j++) {
                if ($array1[$j] != null){
                    array_push($array2,$array1[$j]);
                    array_push($array4,$array3[$j]);
                }
            }
            
            $array2Len = sizeof($array2);

            for ($j = 0; $j < $array2Len; $j++) {
                $cariDataArray->arrayDinamico[$j]->accountOptions = $array2[$j];
                $cariDataArray->arrayDinamico[$j]->typeAccount = $array4[$j];
                $cariDataArray->arrayDinamico[$j]->statusCode = $statusCode;
                $cariDataArray->arrayDinamico[$j]->statusDesc = $statusDesc;
            };

            return \GuzzleHttp\json_encode($cariDataArray);
        } else {
            $error = '{
                    "mssg" : "Ingresa un tipo de cuenta válido",
                    "statusCode" : "'.$statusCode.'",
                    "statusDesc" : "'.$statusDesc.'"
                }';
            return $error;
        }
    }
}
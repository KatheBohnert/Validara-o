<?php

namespace App\Controllers;

use Utils\SetLogs;

class OracleResponsysController {

    public string $nameLog = 'OracleResponsys';

    public function process(\Phalcon\Mvc\Micro $app) {

        header('Access-Control-Allow-Origin: *');
        $nameController = "OracleResponsysController";
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
                case 'test':
                    $response = 'Hola mundo';
                    echo $response;
                    break;
                
                case 'guid':
                    $response = $this->GUID($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;

                case 'getAuthTokenInfo':
                    $response = $this->getAuthTokenInfo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                
                case 'validateCellphoneLine':
                    $response = $this->validateCellphoneLine($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;

                case 'sendOtp':
                    $response = $this->sendOtp($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                    
                case 'validateOtp':
                    $response = $this->validateOtp($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                
                case 'getCustomerInfo':
                    $response = $this->customerInfo($app, $params_error_report, $nameController, $chat_id);
                    echo $response;
                    break;
                    
                case "createProductRequest":
                    $response = $this->createProductRequest($app, $params_error_report, $nameController, $chat_id, $operation);
                    echo $response;
                    break;
                
                case "createProductRequestCreditCard":
                    $response = $this->createProductRequest($app, $params_error_report, $nameController, $chat_id, $operation);
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


    /**
     * Obtain Api Key for Production or keep it for QA environment
     */
    private function prodApiKey($prodApiKey): string
    {
        if ($prodApiKey == true) {
            $apiKey = "R2KEWkqid21f7oW6SUPV46578o7YXibP4t4cqPPs"; // Prod
        } else {
            $apiKey = "aWqKQ3GAqwafLeihPjAUC1FIhXmZgC674DDnWDXM"; // Test - QA
        }

        return $apiKey;
    }


    /**
     * Obtain Auth Basic for production or keep it for QA envvironment
     */
    private function prodAuthToken($prodApiKey): string
    {
        if ($prodApiKey == true) {
            $authBasic = 'MWwwaDhjMTF0MjBocnJiODAxMDVnZXFrcXE6MWRkNTljN2E5NnFjcW41aHBoYmVpYXUzZGhvNHNyZmhqbzRhNHRkajVyb2NkdmZodjNkbg=='; // Prod
        } else {
            $authBasic = 'MTk2cmo3YTNyMWw5cHRsNzZyaDhsdG1ycDM6NG1ocGI1bm5sa2RucHVnN2hzaGRwYzV0b2s2bjN1NXFjbWd2NzhiZm9wdDZ2dmszYWts'; // Test - QA
        }

        return $authBasic;
    }


    /**
     * Obtain prodUrl for token or keep it for QA environment
     */
    private function prodAuthTokenUrl($prodApiKey): string
    {
        if ($prodApiKey == true) {
            $tokenUrl = 'https://auth-wa-pr.auth.us-east-1.amazoncognito.com/oauth2/token'; // Prod
        } else {
            $tokenUrl = 'https://auth-wa.auth.us-east-1.amazoncognito.com/oauth2/token'; // Test - QA
        };

        return $tokenUrl;
    }


    /**
     * Get authorization token for QA environment. Basic Authorization is diferent in production and QA
     * Directory # 0 in the collection
     */
    private function bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey): string
    {
        /**
         * This function generates the auth token for be able to consume the rest of the services
         * @return string token that contains the auth bearer token
         */
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'OracleResponsysController';
        $nameFunction = "bearerToken()";


        /**
         * Endpoint url
         */
        // $url = "https://auth-wa-pr.auth.us-east-1.amazoncognito.com/oauth2/token"; // Prod
        // $url = "https://auth-wa.auth.us-east-1.amazoncognito.com/oauth2/token"; // Test
        $url = $this->prodAuthTokenUrl($prodApiKey);


        /**
         * Required headers
         */
        
        $basicAuth = $this->prodAuthToken($prodApiKey);
        $headers = array(
            // 'Authorization: Basic MWwwaDhjMTF0MjBocnJiODAxMDVnZXFrcXE6MWRkNTljN2E5NnFjcW41aHBoYmVpYXUzZGhvNHNyZmhqbzRhNHRkajVyb2NkdmZodjNkbg==', // Prod
            // 'Authorization: Basic MTk2cmo3YTNyMWw5cHRsNzZyaDhsdG1ycDM6NG1ocGI1bm5sa2RucHVnN2hzaGRwYzV0b2s2bjN1NXFjbWd2NzhiZm9wdDZ2dmszYWts', // Test
            'Authorization: Basic ' . $basicAuth,
            'Content-Type: application/x-www-form-urlencoded',
        );
        /**
         * @var string scope is used for set the scope of the token.
         * customers/read is for the most of the customer functions and creditcards/read for services that uses cards (list, block)
         */
        /**
         * The request body with the scope var included
         */
        $request = 'grant_type=client_credentials&scope=' . $scope;
        /**
         * @var object response_object is used to consume the service. This function returns the response of the service with the respective status code.
         * It's used in every function
         */
        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, 'JuanviController', null);
        /**
         * Here we can manage the data with the response_object var
         */
        $data = json_decode($response_object, true);
        $token = $data['access_token'];

        return $token;
    }


    /**
     * Method used to generate RqUID number for services. It's used in every function.
     * $app, $params_error_report, $nameController, $chat_id
     */
    public function GUID()
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
        $nameController = 'OracleResponsysController';

        if ($chat_channel == 1) {
            $chat_identification = str_replace("_", "", $chat_identification);
            $chat_identification = substr($chat_identification, 6, 10);
        }

        if (strlen($opc) == '5') {
            $adder = '34914';
        } else {
            $adder = '349141';
        }

        $new_id = '' . $opc . '' . $adder . '' . $chat_identification . '';

        switch (strlen($new_id)) {
            case '16':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);

                $tm_stamp = date("Ymdhi");

                $rquid = $chat_identification1 . "-" . $chat_identification2 . "-" . $chat_identification3 . "-0000-" . $tm_stamp;

                break;
            case '17':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1) {
                    $chat_identification4 = substr($new_id, 16, 2);
                } else {
                    $chat_identification4 = substr($new_id, 16, 1);
                }

                $tm_stamp = date("Ymdhi");

                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-' . $chat_identification4 . '000-' . $tm_stamp;

                break;
            case '18':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1) {
                    $chat_identification4 = substr($new_id, 16, 3);
                } else {
                    $chat_identification4 = substr($new_id, 16, 2);
                }

                $tm_stamp = date("Ymdhi");

                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-' . $chat_identification4 . '00-' . $tm_stamp;

                break;
            case '19':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1) {
                    $chat_identification4 = substr($new_id, 16, 4);
                } else {
                    $chat_identification4 = substr($new_id, 16, 3);
                }

                $tm_stamp = date("Ymdhi");

                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-' . $chat_identification4 . '0-' . $tm_stamp;

                break;
            case '20':

                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                if ($chat_channel == 1) {
                    $chat_identification4 = substr($new_id, 16, 5);
                } else {
                    $chat_identification4 = substr($new_id, 16, 4);
                }

                $tm_stamp = date("Ymdhi");

                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-' . $chat_identification4 . '-' . $tm_stamp;

                break;
            case '21':
                $chat_identification1 = substr($new_id, 0, 8);
                $chat_identification2 = substr($new_id, 8, 4);
                $chat_identification3 = substr($new_id, 12, 4);
                $chat_identification4 = substr($new_id, 16, 5);

                $tm_stamp = date("Ymdhi");

                $rquid = $chat_identification1 . '-' . $chat_identification2 . '-' . $chat_identification3 . '-' . $chat_identification4 . '-' . $tm_stamp;

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


    /**
     * Method used to obtain data from the BdB customer cellphone line
     * Directory Auth OTP in the collection
     * WS name: Token físico - Token Virtual (son el mismo WS)
     */
    public function getAuthTokenInfo($app, $params_error_report, $nameController, $chat_id): string 
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "OracleResponsysController";
        $nameFunction = "getAuthTokenInfo";

        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['authTokenInfoUrl'];

        $prodApiKey = $_POST['prodApiKey'];
        $apiKey = $this->prodApiKey($prodApiKey);

        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey);

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "apiKey" => $apiKey,
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: Entelgy',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: ' . $apiKey,
            'Authorization: ' . $tokenAWS,
        );

        $url = $baseUrl . $idType . '/' . $idNumber . '/tokenInfo';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        // return $response_object;
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
                        "statusCode" : "' . $statusCode . '",
                        "statusDesc" : "' . $statusDesc . '"
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
                    "statusCode" : "' . $statusCode . '",
                    "statusDesc" : "' . $statusDesc . '"
                }';
        }

        return $var;
    }



    /**
     * Method to validate if a cellphone line from a BdB customer is active
     * Directory Auth OTP in the collection
     * WS name: Validación Numéro Telefónico
     */
    public function validateCellphoneLine($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "OracleResponsysController";
        $nameFunction = "validateCellphoneLine";

        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $otp = $_POST['otpAllowed'];
        $phone = $_POST['phoneNumber'];
        $phoneDigits = substr($phone, -4);
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['verifyLineUrl'];

        $prodApiKey = $_POST['prodApiKey'];
        $apiKey = $this->prodApiKey($prodApiKey);

        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey);

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "apiKey" => $apiKey,
            "baseUrl" => $baseUrl,
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: AWS1',
            'X-BankId: 0010016',
            'x-api-key: ' . $apiKey,
            'Authorization: ' . $tokenAWS,
        );

        $url = $baseUrl . $idType . '/' . $idNumber . '/phone/' . $phone . '/simvalidation';

        $request = '{
            "Addr": "127.0.0.1",
            "TrnType": "REG"
        }';

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos);

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
                    "statusCode" : "' . $statusCode . '",
                    "statusDesc" : "' . $statusDesc . '"
                }';
            } else {
                $var = '{
                    "verifiedLine" : "No",
                    "verifiedLineCode" : "' . $serverStatusCode . '",
                    "otp" : "' . $otp . '",
                    "statusCode" : "' . $statusCode . '",
                    "statusDesc" : "' . $statusDesc . '",
                    "serverStatusCode" : "' . $serverStatusCode . '"
                }';
            }
        } else {
            $var = '{
                "mssg" : "Hubo un error en el sistema",
                "statusCode" : "' . $statusCode . '",
                "statusDesc" : "' . $statusDesc . '"
            }';
        }

        return $var;
    }


    /**
     * Method used to send OTP trought SMS to Banco de Bogota customer
     * Directory Auth OTP in the collection
     * WS name: Envío SMS OTP
     */
    public function sendOtp($app, $params_error_report, $nameController, $chat_id): string
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "OracleResponsysController";
        $nameFunction = "sendOtp";

        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['sendOtpUrl'];

        $prodApiKey = $_POST['prodApiKey'];
        $apiKey = $this->prodApiKey($prodApiKey);

        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey);
        

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "apiKey" => $apiKey,
            "baseUrl" => $baseUrl,
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 1',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: ' . $apiKey,
            'Authorization: ' . $tokenAWS,
        );

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
                      "statusCode" : "' . $statusCode . '",
                      "statusDesc" : "' . $statusDesc . '"
                  }';
        } else {
            $var = '{
                  "mssg" : "Hubo un error",
                  "statusCode" : "' . $statusCode . '",
                  "statusDesc" : "' . $statusDesc . '"
              }';
        }

        return $var;
    }



    
    public function validateOtp($app, $params_error_report, $nameController, $chat_id)
    {
        $chat_id = $_POST['chat_identification'];
        $nameController =  "OracleResponsysController";
        $nameFunction = "validateOtp";

        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $tkInfoInit = $this->getAuthTokenInfo($app, $params_error_report, $nameController, $chat_id);
        $func_response = json_decode($tkInfoInit, true);
        $productNum = $func_response['productNum'];
        $prodStatusCode = $func_response['prodStatusCode'];
        $date1 = date("Y-m-d", strtotime("now"));
        $date2 = date("H:i:s", strtotime("now"));
        $finalDate = $date1 . "T" . $date2;
        $guid = $_POST['rquId'];
        $otp = $_POST['otp'];
        $baseUrl = $_POST['validateOtpUrl'];

        $prodApiKey = $_POST['prodApiKey'];
        $apiKey = $this->prodApiKey($prodApiKey);

        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey);
        

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "otp" => $otp,
            "baseUrl" => $baseUrl,
            "apiKey" => $apiKey,
        );

        $headers = array(
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 1',
            'X-BankId: 001',
            'X-ClientDt: ' . $finalDate,
            'x-api-key: ' . $apiKey,
            'Authorization: ' . $tokenAWS,
        );

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
                "statusCode" : "' . $statusCode . '",
                "statusDesc" : "' . $statusDesc . '"
            }';
        } else {
            $var = '{
                "mssg" : "Hubo un error en la autenticación",
                "statusCode" : "' . $statusCode . '",
                "statusDesc" : "' . $statusDesc . '"
            }';
        }

        return $var;
    }



    /**
     * Method for obtain the customer data. Used inside Cariai to validate if the customer is a client of Banco de Bogota.
     * $this->process($app); -> Paste this line after the return of the methods so you can go back to process function easier.
     * Directory # 1 in the collection - WS name: customers - getCustBasicInfo
     */
    public function customerInfo($app, $params_error_report, $nameController, $chat_id)
    {
        /**
         * This function retrieves the data for a Banco de Bogota customer
         * @return object var that containts the relevant data that needs to be used in the rest of the services (email, fullName,safeCellphone).
         * Also validates if the user is a client of Banco de Bogota
         */
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'OracleResponsysController';
        $nameFunction = "customerInfo()";
        /**
         * @var string idType receive the id type of the customer
         * @var string idNumber receive the id number of the customer
         * @var string tokenAWS is the auth token generated in tokenBancoBogota function
         * @var string guid is a register number for the tracking of the conversation
         * @var string url contains the endpoint of the service
         * @var array headers contains the required headers for the service. The array includes the token and guid variables inside it
         */
        $idType = $_POST['userIdType'];
        $idNumber = $_POST['userIdNumber'];
        $guid = $_POST['rquId'];
        $baseUrl = $_POST['custUrl'];

        $prodApiKey = $_POST['prodApiKey'];
        $apiKey = $this->prodApiKey($prodApiKey);

        $scope = 'customers/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey);

        $datos = array(
            "userIdType" => $idType,
            "userIdNumber" => $idNumber,
            "baseUrl" => $baseUrl,
        );

        //$url = "https://cxgxdlwk2d.execute-api.us-east-1.amazonaws.com/qa/customers/" . $idType . "/" . $idNumber . "?basic=1&general=1&finantial=1&location=1&secure=1";
        $url = $baseUrl . $idType . "/" . $idNumber . "?basic=1&general=1&finantial=1&location=1&secure=1";

        $headers = array(
            'x-api-key: ' . $apiKey,
            'Content-Type: application/json',
            'X-RqUID: ' . $guid,
            'X-NetworkOwner: PB',
            'X-TerminalId : AWS1',
            'X-BankId: 001',
            'Authorization: ' . $tokenAWS,
        );

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_identification, $nameController, $nameFunction, $app, $url, $headers, 'GET', null, $this->nameLog, $datos);

        /**
         * @var object data is used to decode the response_object from json so the data can be managed
         */
        $data = json_decode($response_object, true);
        /**
         * @var string stautsCode is extracted from the service and is used to handle the internal error control in the Web Service
         * The error control handler is managed with if statements
         * statusCode == 0 -> The service response is 200 - OK and the service retrieved the correct information
         * statusCode != 0 --> Could be a bussiness error or a technical error. The specific error control was not shared with development team for security issues
         */
        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $statusDetail = ['IfxStatus']['ServerStatusDesc'];
        if ($statusCode == '0') {
            /**
             * @var string firstName obtains the first name of the client from the service response
             * @var string lastName obtains the last name of the cliente from the service response
             * @var string typeCustomer obtains the code for the bank of the customer type from the service response
             * @var string typeCustomerDesc obtains the description label for the customer type code from the service response
             * @var string customerStatus obtains the actual status of the customer in the bank from the service response
             * @var string email obtains the customer email from the service response
             * @var string cellphone obtains the customer cellphone from the service response
             * @var string safePhone obtains a secure customer cellphone from the service response
             * @var string safeEmail obtains a secure customer email from the service response
             * @var string fullName concatenate first and last names to get a full name that is required in other services
             * */
            $firstName = $data['CustInfo']['PersonName']['FirstName'];
            $lastName = $data['CustInfo']['PersonName']['LastName'][0];
            $typeCustomer = $data['CustInfo']['CustType'];
            $typeCustomerDesc = $data['CustInfo']['CustTypeDesc'];
            $customerStatus = $data['CustInfo']['CustStatus'];
            $email = $data['CustInfo']['ContactInfo']['EmailAddr'];
            $cellphone = $data['CustInfo']['ContactInfo']['PhoneNum'][0]['Phone'];
            $safePhone = $data['CustInfo']['SafeInfo']['SafePhone'];
            $safeEmail = $data['CustInfo']['SafeInfo']['SafeEmailAddr'];
            $fullName = $firstName . " " . $lastName;
            $id_type = $data['CustInfo']['GovIssueIdentType'];
            $id_number = $data['CustInfo']['IdentSerialNum'];

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
                "tipoIdentificacion" : "' . $id_type . '",
                "numeroIdentificacion" : "' . $id_number . '",
                "statusCode" : "'. $statusCode . '",
                "statusDesc" : "' .$statusDesc . '"
            }';
        } else {
            $var = '{
                "mssg" : "'.$statusDetail.'",
                "statusCode" : "'.$statusCode.'",
                "statusDesc" : "'.$statusDesc.'"
            }';
        }

        return $var;

        $this->process($app);
    }

    public function createProductRequest($app, $params_error_report, $nameController, $chat_id, $operation)
    {
        $chat_identification = $_POST['chat_identification'];
        $nameController = 'OracleResponsysController';
        $nameFunction = "createProductRequest";
        
        $guid = $_POST['rquId'];
        $prodApiKey = $_POST['prodApiKey'];
        $apiKey = $this->prodApiKey($prodApiKey);

        $scope = 'creditcards/read';
        $tokenAWS = $this->bearerToken($app, $params_error_report, $nameController, $chat_id, $scope, $prodApiKey);

        $docType = $_POST['docType'];
        $idNum = $_POST['idNum'];
        $lastName = $_POST['primerApellido'];
        $firstName = $_POST['primerNombre'];
        $productLine = $_POST['bin_line'];
        $campaingId = $_POST['campaing_id'];
        $term = $_POST['plazoTermino'];
        $nmRateInit = $_POST['nm_rate'];
        $amInit = $_POST['aproved_value'];
        $billingCycle = $_POST['billingCycle'];
        $baseUrl = $_POST['productRequestUrl'];

        //$campaingId = str_replace(['-', '_'], '', $campaingIdInit);
        $nmRate = floatval(str_replace(',', '.', $nmRateInit));
        $nmRate = number_format($nmRate, 2);
        $amt = filter_var($amInit, FILTER_SANITIZE_NUMBER_INT);

        // $url = 'https://k91zkwrc65.execute-api.us-east-1.amazonaws.com/qa/customers/products/request'; // QA
        // $url = 'https://wxkeuft6rj.execute-api.us-east-1.amazonaws.com/pr/customers/products/request'; // Prod
        $url = $baseUrl . '/customers/products/request';

        $datos = array(
            'Authorization' => $tokenAWS,
            'rquId' => $guid,
            'prodApiKey' => $apiKey,
            'docType' => $docType,
            'idNum' => $idNum,
            'primerApellido' => $lastName,
            'primerNombre' => $firstName,
            'bin_line' => $productLine,
            'campaign_id' => $campaingId,
            'plazoTermino' => $term,
            'nm_rate' => $nmRate,
            'aproved_value' => $amt,
            'url' => $url,
            'operation' => $operation
        );

        $initialDate1 = date('Y-m-d', strtotime('now'));
        $initialDate2 = date('H:i:s', strtotime('now'));
        $finalDate = $initialDate1. 'T'.$initialDate2;

        $headers = [
            'Authorization: '.$tokenAWS,
            'X-RqUID: '.$guid,
            'X-NetworkOwner: LIV001',
            'X-TerminalId: 127.0.0.1',
            'X-BankId: 001',
            'X-ClientDt:'.$finalDate,
            'Content-Type: application/json',
            'x-api-key:'.$apiKey,
        ];

        if ($operation == 'createProductRequest') {
            $request = '{
                "PersonInfo": {
                  "GovIssueIdentType": "'.$docType.'",
                  "IdentSerialNum": "'.$idNum.'",
                  "PersonName": {
                    "LastName": "'.$lastName.'",
                    "FirstName": "'.$firstName.'"
                  }
                },
                "ProductDetail": {
                  "ProductLineId": "'.$productLine.'",
                  "CampaignId": "'.$campaingId.'",
                  "Term": "'.$term.'",
                  "Rate": "'.$nmRate.'",
                  "Amt": "'.$amt.'"
                }
              }';
        } elseif ($operation == 'createProductRequestCreditCard') {
            $request = '{
                "PersonInfo": {
                  "GovIssueIdentType": "'.$docType.'",
                  "IdentSerialNum": "'.$idNum.'",
                  "PersonName": {
                    "LastName": "'.$lastName.'",
                    "FirstName": "'.$firstName.'"
                  }
                },
                "ProductDetail": {
                  "ProductLineId": "'.$productLine.'",
                  "CampaignId": "'.$campaingId.'",
                  "Term": "'.$term.'",
                  "Rate": "'.$nmRate.'",
                  "Amt": "'.$amt.'",
                  "BillinCycle": "'.$billingCycle.'"
                }
              }';
        }

        $response_object = \App\Utils\StaticExecuteService::executeCurlRest($chat_id, $nameController, $nameFunction, $app, $url, $headers, "POST", $request, $this->nameLog, $datos);  
        
        $data = json_decode($response_object, true);
  
        $statusCode = $data['IfxStatus']['StatusCode'];
        $statusDesc = $data['IfxStatus']['StatusDesc'];
        $codeRequest = $data['CodeRequest'];
  
        $var = '{
              "statusCode":"'.$statusCode.'",
              "statusDesc":"'.$statusDesc.'",
              "codeRequest":"'.$codeRequest.'"
        }';
  
        return $var;  

    }
}
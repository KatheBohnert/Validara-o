<?php
namespace App\Controllers;

use DateTime;

class ComfandiCarritoController
{
    public $nameLog = "ComfandiCarrito";
    public function process(\Phalcon\Mvc\Micro $app)
    {

        header('Access-Control-Allow-Origin: *');
        $nameController = "ComfandiCarritoController";
        $chat_id = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'convesartion_id' => $_POST['convesartion_id'],
        ];
        $operation = $_POST['operation'];

        $useProduction = $_POST['useProduction'];

        //$urlIn="https://comfandi-test.felinux.co/marketplace/api/";
        //$tokenSms = "Basic V1I2TUk3NzhWMkozN04zSkI2RVNSRVFRVUlYTkszWVE6";
        if ($useProduction == 1) {
            $urlIn = "https://comfandivirtual.com.co/api/";
            $tokenSms = "Basic OFFaWlpQTktCNTJUSEEzQUJMSFU0OUpNMjFBVlhIQjE6";
        } else {
            $urlIn = "https://test.comfandivirtual.com.co/api/";
            $tokenSms = "Basic OFFaWlpQTktCNTJUSEEzQUJMSFU0OUpNMjFBVlhIQjE6";
        }

        $token = $_POST['token'];
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) {
                case "costumerInfo":
                    $response = $this->costumerInfo($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "listAddresses":
                    $response = $this->listAddresses($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "deleteAddress":
                    $response = $this->deleteAddress($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "cartById":
                    $response = $this->cartById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "productById":
                    $response = $this->productById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "allCategories":
                    $response = $this->allCategories($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "orderHistories":
                    $response = $this->orderHistories($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "checkCustomer":
                    $response = $this->checkCustomer($app, $params_error_report, $nameController, $chat_id, $emailParameter, $customerIdentification, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "ordersById":
                    $response = $this->ordersById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "orderState":
                    $response = $this->orderState($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "searchByProduct":
                    $response = $this->searchByProduct($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "createCustomer":
                    $response = $this->createCustomer($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "createAddress":
                    $response = $this->createAddress($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "imgProduct":
                    $response = $this->imgProduct($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "customerInfoById":
                    $response = $this->customerInfoById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "ordersByCustomerId":
                    $response = $this->ordersByCustomerId($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "consultOrderById":
                    $response = $this->consultOrderById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "consultAddressById":
                    $response = $this->consultAddressById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "consultCustomerById":
                    $response = $this->consultCustomerById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "updateCart":
                    $response = $this->updateCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "searchServ":
                    $response = $this->searchServ($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "createCart":
                    $response = $this->createCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "createOrder":
                    $response = $this->createOrder($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "createOrderPagoEnLinea":
                    $response = $this->createOrderPagoEnLinea($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "addProductsCart":
                    $response = $this->addProductsCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "product_option_values":
                    $response = $this->product_option_values($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "orderId":
                    $response = $this->orderId($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "delProductsCart":
                    $response = $this->delProductsCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "errorReportCari":
                    $response = $this->errorReportCari($app, $params_error_report);
                    echo $response;
                    break;
                case "getProductStock":
                    $response = $this->getProductStock($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "specific_prices":
                    $response = $this->specific_prices($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "taxes":
                    $response = $this->taxes($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "sumDelivery":
                    $response = $this->sumDelivery($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "getNameByProductId":
                    $response = $this->getNameByProductId($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "validateOrderRange":
                    $response = $this->validateOrderRange($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "id_customer_thread":
                    $response = $this->customerThread($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
                    echo $response;
                    break;
                case "setOrderMessage":
                    $response = $this->setOrderMessage($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms);
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
    public function errorReportCari($app, $params_error_report)
    {
        $statusCode = $_POST['statusCode'];
        $url = $_POST['url'];
        $response_object = $_POST['response_object'];
        $type = $_POST['type'];

        $response_object = \App\Utils\StaticExecuteService::errorReportCari($app, $statusCode, $url, $response_object, $type, $params_error_report);
    }

    public function specific_prices($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "specific_prices";
        $idPro = $_POST['idPro'];
        $url = $urlIn . "specific_prices/?filter[id_product]=" . $idPro . "&filter[id_group]=0&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idPro" => $idPro,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);
        if ($response_object === false) {
            return;
        }

        return json_encode($response_object);
    }
    public function taxes($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "taxes";
        $idTaxs = $_POST['idTaxs'];
        $url = $urlIn . "taxes/" . $idTaxs . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idTaxs" => $idTaxs,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);
        if ($response_object === false) {
            return;
        }

        return json_encode($response_object);
    }
    public function costumerInfo($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "costumerInfo";
        $idCat = $_POST['idCat'];
        $url = $urlIn . "categories/" . $idCat . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idCat" => $idCat,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        //echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return json_encode($response_object);
    }

    public function listAddresses($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "listAddresses";
        $customerId = $_POST['customerId'];
        $url = $urlIn . "addresses/?filter[id_customer]=[" . $customerId . "]&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "customerId" => $customerId,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $longitudAddresses = sizeof($response_object->addresses);
        $listValidAddress = array();
        for ($i = 0; $i < $longitudAddresses; $i++) {
            if ($response_object->addresses[$i]->deleted == 0) {
                array_push($listValidAddress, $response_object->addresses[$i]);
            }
        }
        $response = new \stdClass();
        $longitud = sizeof($listValidAddress);
        for ($i = 0; $i < $longitud; $i++) {
            $response->dynamicArray[$i] = $listValidAddress[$i];
            $response->dynamicArray[$i]->opcion = $listValidAddress[$i]->alias . " - " . $listValidAddress[$i]->address1;
        }

        if ($response_object->addresses) {
            return \GuzzleHttp\json_encode($response);
        } else {
            return '{
                "addressExist" = "0"
            }';
        };
    }

    public function deleteAddress($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "deleteAddress";
        $address_id = $_POST['address_id'];
        $url = $urlIn . "addresses/" . $idCart . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "address_id" => $address_id,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlIn . 'addresses/' . $address_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $tokenSms,
                'Cookie: PrestaShop-fc5c417ebbd2a4fb0d55c1c014cc1aaa=def50200ba173f5d73f30511cf94fc1d0ca5a2a5051b77dd53dba21960e614ed77819ed8d3e02750f36ba25e83d720eb8d467644f3e8b4b4b1d9ae718259859c2ef997ae50bc0bb21b9bccf4d5c4562fffb4d495d4cbb7117c97eb13fb9d30f819050a64ab67077ba3f86d3770f50d5d5a17002c65b3158dff952020bf407b397462982a81fa4ac9900e18a9919f3cde1fcb72b590e8e7e3d6a876cf8e99be59758b4ce3c386bab9c9d4b6a9e27c1c21a2706e57a4b191fc4a09eb1eea080bc40b80334470c8',
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        http_response_code($http_code);
        \App\Utils\StaticExecuteService::createLog($response, $urlIn . 'addresses/' . $address_id, $chat_id, $nameFunction, $type = "Delete", $this->nameLog, $headers, $datos);
        // $this->createLog($response, "https://comfandi-test.felinux.co/marketplace/api/addresses/" . $address_id, $chat_id, $nameFunction, "Delete");
        return $response;

    }

    public function cartById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "cartById";
        $idCat = $_POST['idCat'];
        $url = $urlIn . "carts/" . $idCat . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idCat" => $idCat,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        return json_encode($response_object);
    }

    public function productById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "productById";
        $idCat = $_POST['idCat'];
        $op = $_POST['op'];
        if ($op == 1) {
            $url = $urlIn . "products/" . $idCat . "?output_format=JSON";
        } else if ($op == 2) {
            $url = $urlIn . "products/" . $idCat . "&output_format=JSON";
        }
        
        $headers = array("Authorization" => $tokenSms);

        $datos = array(
            "idCat" => $idCat,
            "op" => $op,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        return json_encode($response_object);
    }

    public function sumDelivery($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "sumDelivery";
        $totolProducts = $_POST['totolProducts'];
        $costDelivery = $_POST['costDelivery'];
        $nombreUsuario = $_POST['nombreUsuario'];
        $address1 = $_POST['address1'];
        
        $partesNombreUsuario = explode(" ", $nombreUsuario, 2);
        $primerNombreUsuario = $partesNombreUsuario[0];
        if($partesNombreUsuario[1]){
            $apellidoNombreUsuario = $partesNombreUsuario[1];
        }else{
            $apellidoNombreUsuario = "null";
        }
        $address1 = str_replace(' ', '%20', $address1);
        $apellidoNombreUsuario = str_replace(' ', '%20', $apellidoNombreUsuario);
        $totalPaid = (int) $totolProducts + (int) $costDelivery;
        $var = '{
            "totalPaidTuCompra" : "' . $totalPaid . '",
            "address1" : "' . $address1 . '",
            "primerNombreUsuario" : "' . $primerNombreUsuario . '",
            "apellidoNombreUsuario" : "' . $apellidoNombreUsuario . '"
        }';
        return $var;

    }

    public function getNameByProductId($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "getNameByProductId";

        $idCart = $_POST['idCart'];

        $url = $urlIn . "carts/" . $idCart . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idCart" => $idCart,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        $arrayProducts = $response_object->cart->associations->cart_rows;
        $arraySize = sizeof($arrayProducts);
        $productNames = "";
        for ($i = 0; $i < $arraySize; $i++) {
            $idproduct = $arrayProducts[$i]->id_product;
            $url = $urlIn . "products/" . $idproduct . "?output_format=JSON";
            $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);
            if ($i == 0) {
                $productNames = $response_object->product->link_rewrite;
            } else {
                $productNames = $productNames . "," . $response_object->product->link_rewrite;
            }
        }
        $var = '{
            "productNames" : "' . $productNames . '"
        }';
        return $var;
    }

    public function getProductStock($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "getProductStock";
        $idCat = $_POST['idCat'];
        $op = $_POST['op'];
        if ($op == 1) {
            $url = $urlIn . "stock_availables/" . $idCat . "?output_format=JSON";
        } else if ($op == 2) {
            $url = $urlIn . "stock_availables/" . $idCat . "&output_format=JSON";
        }
        
        $headers = array("Authorization" => $tokenSms);

        $datos = array(
            "idCat" => $idCat,
            "op" => $op,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        //echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        return json_encode($response_object);
    }

    public function imgProduct($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "imgProduct";
        $idCat = $_POST['idCat'];
        $url = $urlIn . "images/products/";
        $urlTest = "https://comfandi-test.felinux.co/marketplace/api/images/products/379/1871";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idCat" => $idCat,
            "idCat" => $url,
            "idCat" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        print_r($response_object);

        return $urlTest;
    }

    public function allCategories($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "allCategories";
        $idCat = $_POST['idCat'];
        $op = $_POST['op'];
        if ($op == 1) {
            $url = $urlIn . "categories/" . $idCat . "?output_format=JSON";
        } else if ($op == 2) {
            $url = $urlIn . "categories/?" . $idCat . "&output_format=JSON";
        }
        
        $headers = array("Authorization" => $tokenSms);

        $datos = array(
            "idCat" => $idCat,
            "op" => $op,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        return json_encode($response_object);
    }

    public function ordersByCustomerIdLocal($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms, $idCustomer)
    {
        $nameFunction = "ordersByCustomerIdLocal";
        // $idCustomer = $_POST['id_customer'];
        $ciclo = 1;
        $cantidad = 100;
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $url = $urlIn . "orders?filter[id_customer]=" . $idCustomer . "&sort=[delivery_date_DESC]&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idCustomer" => $idCustomer,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        $response = new \stdClass();

        $validationArray = array();

        for ($i = 0; $i < (sizeof($response_object->orders)); $i++) {
            if ($response_object->orders[$i]->valid == 1) {
                array_push($validationArray, $response_object->orders[$i]);
            }

        }

        $response->numVerMas = ceil((sizeof($validationArray)) / $cantidad);

        $temporalArray = array();

        if ($final > sizeof($validationArray)) {

            for ($i = $inicio; $i < (sizeof($validationArray)); $i++) {
                array_push($temporalArray, $validationArray[$i]);
            }
        } else {

            for ($i = $inicio; $i <= $final; $i++) {
                array_push($temporalArray, $validationArray[$i]);
            }
        }

        $temporalArray2 = array();

        for ($i = 0; $i < sizeof($temporalArray); $i++) {
            if (gettype($temporalArray[$i]) == object) {
                array_push($temporalArray2, $temporalArray[$i]);
            }
        }

        for ($i = 0; $i < sizeof($temporalArray2); $i++) {
            $response->dynamicArray[$i]->mensaje_opc = "Pedido #REF: " . $temporalArray2[$i]->reference;
            $response->dynamicArray[$i]->referenciaCompra = $temporalArray2[$i]->reference;
            $response->dynamicArray[$i]->idCompra = $temporalArray2[$i]->id;
            $response->dynamicArray[$i]->totalPrice = $temporalArray2[$i]->total_paid;
            $response->dynamicArray[$i]->addressId = $temporalArray2[$i]->id_address_delivery;
        }

        return \GuzzleHttp\json_encode($response);

    }

    public function orderHistories($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "orderHistories";
        $idOrder = $_POST['idOrder'];
        $url = $urlIn . "order_histories/?filter[id_order]=" . $idOrder . "&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idOrder" => $idOrder,
            "url" => $url,
            "headers" => $tokenSms,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        //echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        $longitudOrder = sizeof($response_object->order_histories);

        $status = $response_object->status;
        $orderState = $response_object->order_histories[$longitudOrder - 1]->id_order_state;
        $orderDate = $response_object->order_histories[$longitudOrder - 1]->date_add;

        $var = '{
            "statusWS" : "' . $status . '",
            "orderState" : "' . $orderState . '",
            "orderDate" : "' . $orderDate . '"
        }';

        return $var;
    }

    public function orderHistoriesLocal($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms, $idOrder)
    {
        $nameFunction = "orderHistories";
        // $idOrder = $_POST['idOrder'];
        $url = $urlIn . "order_histories/?filter[id_order]=" . $idOrder . "&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idOrder" => $idOrder,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        //echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        $longitudOrder = sizeof($response_object->order_histories);

        $status = $response_object->status;
        $orderState = $response_object->order_histories[$longitudOrder - 1]->id_order_state;
        $orderDate = $response_object->order_histories[$longitudOrder - 1]->date_add;

        $var = '{
            "statusWS" : "' . $status . '",
            "orderState" : "' . $orderState . '",
            "orderDate" : "' . $orderDate . '"
        }';

        return $var;
    }

    public function orderStateLocal($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms, $orderStatus)
    {
        $nameFunction = "orderState";
        // $orderStatus = $_POST['orderStatus'];
        $url = $urlIn . "order_states/" . $orderStatus . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "orderStatus" => $orderStatus,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $name_status = $response_object->order_state->name;

        if (preg_match('~[0-9]+~', $name_status)) {
            $name_status = substr($name_status, 2);
        }

        $status = $response_object->status;

        $var = '{
            "nameStatus" : "' . $name_status . '",
            "statusWS" : "' . $status . '"
        }';

        return $var;
    }

    public function validateOrderRange($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "validateOrderRange";
        // $idOrder = $_POST['idOrder'];
        $idCustomer = $_POST['id_customer'];
        $datos = array(
            "id_customer" => $idCustomer,
        );
        $ordersByCustomerIdLocal = $this->ordersByCustomerIdLocal($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms, $idCustomer);
        $tamanoDynamicArray = sizeof(json_decode($ordersByCustomerIdLocal)->dynamicArray);
        if ($tamanoDynamicArray > 0) {

            $idOrder = json_decode($ordersByCustomerIdLocal)->dynamicArray[$tamanoDynamicArray-1]->idCompra;
            $referenciaCompra = json_decode($ordersByCustomerIdLocal)->dynamicArray[$tamanoDynamicArray-1]->referenciaCompra;
            $orderHistoriesLocal = $this->orderHistoriesLocal($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms, $idOrder);
            $orderDate = json_decode($orderHistoriesLocal)->orderDate;
            $orderStatus = json_decode($orderHistoriesLocal)->orderState;
            $orderStateLocal = $this->orderStateLocal($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms, $orderStatus);
            $nameStatus = json_decode($orderStateLocal)->nameStatus;

            $fecha_actual = new DateTime();
            $fecha_objetivo = new DateTime($orderDate);
            $fecha_actual->modify('-30 minutes');
            if ($fecha_actual > $fecha_objetivo) {

                $var = '{
                    "nuevoPedido" : "1",
                    "estadoPedido":"' . $nameStatus . '",
                    "referencia":"' . $referenciaCompra . '"
                }';
            } else {
                $var = '{
                    "nuevoPedido" : "0",
                    "estadoPedido":"' . $nameStatus . '",
                    "referencia":"' . $referenciaCompra . '"
                }';
            }
        } else {
            $var = '{
                "nuevoPedido" : "1",
                "estadoPedido":"' . $nameStatus . '",
                "referencia":"' . $referenciaCompra . '"
            }';
        }

        return $var;
    }

    public function checkCustomer($app, $params_error_report, $nameController, $chat_id, $emailParameter, $customerIdentification, $urlIn, $tokenSms)
    {
        /**
         * @author Andrés Cubillos
         * This function get for parameter an email and number identification to know if exist a customer with that credentials
         * @return response to know if customer exist or not
         * this function is used too when have to create a new customer for validate a don't exist another count with the same email or identification number
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var customerEmail get the email type for the user in bot
         * @var customerIdentificationNumber get the identification number type for the user in bot
         * @var tokenSms saves the token that gives access to the consumption of this service
         */
        $nameFunction = "checkCustomer";
        $customerEmail = $_POST['customerEmail'];
        $customerIdentificationNumber = $_POST['customerIdentificationNumber'];
        $headers = array("Authorization" => $tokenSms);
        if ($emailParameter) {
            $urlEmail = $urlIn . "customers?filter[email]=" . $emailParameter . "&display=[id,passwd,lastname,firstname,email,identification_number,phone_number]&output_format=JSON";
            $urlCustomerId = $urlIn . "customers?filter[identification_number]=" . $customerIdentification . "&display=[id,passwd,lastname,firstname,email,identification_number,phone_number]&output_format=JSON";
            
        } else {
            $urlEmail = $urlIn . "customers?filter[email]=" . $customerEmail . "&display=[id,passwd,lastname,firstname,email,identification_number,phone_number]&output_format=JSON";
            $urlCustomerId = $urlIn . "customers?filter[identification_number]=" . $customerIdentificationNumber . "&display=[id,passwd,lastname,firstname,email,identification_number,phone_number]&output_format=JSON";
        }
        
        $datos = array(
            "customerEmail" => $customerEmail,
            "customerIdentificationNumber" => $customerIdentificationNumber,
            "urlEmail" => $urlEmail,
            "urlCustomerId" => $urlCustomerId,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $urlEmail, $urlEmail, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);
        $response_object2 = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $urlCustomerId, $urlCustomerId, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        /**
         * This function calls in 2 times executeService because the customer have to be validate for email and identification customer
         * @var $response_object save the return response of the request with url with the email parameter
         * @var $response_object2 save the return response of the request with url with the identification customer parameter
         */
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        if ($response_object->customers) {
            $infoCustomer = $response_object->customers[0];
            return '{
                "customerId":"' . $infoCustomer->id . '",
                "customerLastname":"' . str_replace(" ", "-", $infoCustomer->lastname) . '",
                "customerFirstname":"' . str_replace(" ", "-", $infoCustomer->firstname) . '",
                "customer_email":"' . $infoCustomer->email . '",
                "identification_number": "' . $infoCustomer->identification_number . '",
                "telefonoCustomer": "' . $infoCustomer->phone_number . '",
                "mssg":"Este correo ya se encuentra registrado",
                "customerExist":"1"
            }';
        } elseif ($response_object2->customers) {
            $infoCustomer = $response_object2->customers[0];
            // "passwd":"' . $infoCustomer->passwd . '",
            return '{
                "customerId":"' . $infoCustomer->id . '",
                "customerLastname":"' . str_replace(" ", "-", $infoCustomer->lastname) . '",
                "customerFirstname":"' . str_replace(" ", "-", $infoCustomer->firstname) . '",
                "customer_email":"' . $infoCustomer->email . '",
                "identification_number": "' . $infoCustomer->identification_number . '",
                "telefonoCustomer": "' . $infoCustomer->phone_number . '",
                "mssg":"Este número de identificación ya se encuentra registrado",
                "customerExist":"1"
            }';
        } else {
            return '{
                "customerExist":"0"
            }';
        }

    }

    public function ordersById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "ordersById";
        $productReference = $_POST['productReference'];
        $url = $urlIn . "orders/?filter[reference]=" . $productReference . "&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "productReference" => $productReference,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $id_order = $response_object->orders[0]->id;
        $adress_id = $response_object->orders[0]->id_address_delivery;
        $total_price = $response_object->orders[0]->total_paid;
        $status = $response_object->status;

        $var = '{
            "orderId" : "' . $id_order . '",
            "addressId" : "' . $adress_id . '",
            "totalPrice" : "' . $total_price . '",
            "statusWS" : "' . $status . '"
        }';

        return $var;
    }

    public function orderState($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "orderState";
        $orderStatus = $_POST['orderStatus'];
        $url = $urlIn . "order_states/" . $orderStatus . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "orderStatus" => $orderStatus,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $name_status = $response_object->order_state->name;

        if (preg_match('~[0-9]+~', $name_status)) {
            $name_status = substr($name_status, 2);
        }

        $status = $response_object->status;

        $var = '{
            "nameStatus" : "' . $name_status . '",
            "statusWS" : "' . $status . '"
        }';

        return $var;
    }

    public function searchByProduct($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "searchByProduct";
        $product = $_POST['product'];
        $url = $urlIn . "search/?language=1&query=" . $product . "&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "product" => $product,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        };

        $categoryList = $response_object->categories;
        $sizeList = sizeof($categoryList);
        $response = new \stdClass();

        for ($i = 0; $i < $sizeList; $i++) {
            $response->dynamicArray[$i]->categoryName = $categoryList[$i]->name;
            $response->dynamicArray[$i]->categoryId = $categoryList[$i]->id;
        }

        return json_encode($response);
    }

    public function searchServ($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "searchServ";
        $product = $_POST['product'];
        $url = $urlIn . "search/?language=1&query=" . $product . "&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "product" => $prodcut,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        };

        return json_encode($response_object);
    }

    public function product_option_values($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "product_option_values";
        $optAtr = $_POST['optAtr'];
        $url = $urlIn . "product_option_values/" . $optAtr . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "optAtr" => $optAtr,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        };

        return json_encode($response_object);
    }

    public function createCustomer($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {

        /**
         * @author Andrés Cubillos
         * This function get all the parameters mandatory for create a new customer(email,firstname,lastname,phone number, identification number)
         * as the same time use the function checkCustomer to know if exists a customer with the same email or identification number
         * @return response with a atribute to confirm if the customer was created or not
         * this function is used too when have to create a new customer for validate a don't exist another count with the same email or identification number
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var lastname get the lastname type for the user in bot
         * @var firstname get the firstname type for the user in bot
         * @var email get the email type for the user in bot
         * @var identification_number get the identification number type for the user in bot
         * @var telefonoCustomer get the phone number type for the user in bot
         * @var date_add get the actual date when the customer is created
         * @var tokenSms saves the token that gives access to the consumption of this service
         */
        $nameFunction = "createCustomer";
        $url = $urlIn . "customers?output_format=JSON";
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $identification_number = $_POST['identification_number'];
        $telefonoCustomer = $_POST['telefonoCustomer'];
        $date_add = date("Y-m-d H:i:s");
        
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "firstname" => $firstname,
            "email" => $email,
            "identification_number" => $identification_number,
            "telefonoCustomer" => $telefonoCustomer,
            "date_add" => $date_add,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $checkCustomer = $this->checkCustomer($app, $params_error_report, $nameController, $chat_id, $email, $identification_number, $urlIn, $tokenSms);
        $checkCustomer = json_decode($checkCustomer);
        if (($checkCustomer->{'customerExist'}) === "1") {
            return '{
                "clienteExistente":"1",
                "mssg":"' . $checkCustomer->{'mssg'} . '"
            }';
        }
        $namesCustomer = explode(" ", $firstname, 2);
        $firstnameCustomer = $namesCustomer[0];
        if ($namesCustomer[1]) {
            $lastnameCustomer = $namesCustomer[1];
        } else {
            $lastnameCustomer = 'null';
        }

        $request = '<?xml version="1.0" encoding="UTF-8"?>
                    <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
        	            <customer>
        	                <id></id>
        	                <id_default_group>4</id_default_group>
        	                <id_lang></id_lang>
        	                <newsletter_date_add></newsletter_date_add>
        	                <ip_registration_newsletter></ip_registration_newsletter>
        	                <last_passwd_gen></last_passwd_gen>
        	                <secure_key></secure_key>
        	                <deleted></deleted>
        	                <passwd></passwd>
        	                <lastname>' . $lastnameCustomer . '</lastname>
        	                <firstname>' . $firstnameCustomer . '</firstname>
        	                <email>' . $email . '</email>
        	                <id_gender></id_gender>
        	                <birthday></birthday>
        	                <newsletter></newsletter>
        	                <optin></optin>
        	                <website></website>
        	                <company></company>
        	                <siret></siret>
        	                <ape></ape>
        	                <outstanding_allow_amount></outstanding_allow_amount>
        	                <show_public_prices></show_public_prices>
        	                <id_risk></id_risk>
        	                <max_payment_days></max_payment_days>
        	                <active>1</active>
        	                <note></note>
        	                <is_guest>0</is_guest>
        	                <id_shop></id_shop>
        	                <id_shop_group></id_shop_group>
        	                <date_add>' . $date_add . '</date_add>
        	                <date_upd></date_upd>
        	                <reset_password_token></reset_password_token>
        	                <reset_password_validity></reset_password_validity>
        	                <identification_number>' . $identification_number . '</identification_number>
        	                <phone_number>' . $telefonoCustomer . '</phone_number>
        	                <affiliate></affiliate>
        	                <associations>
        	                    <groups>
        	                        <group>
        	                            <id>4</id>
        	                        </group>
        	                    </groups>
        	                </associations>
        	            </customer>
                    </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        if ($response_object->status == 201) {
            return '{
                "createCustomerSuccessful": "1",
                "customerId": "' . $response_object->customer->id . '"
            }';
        } else {
            return '{
                "createCustomerSuccessful": 0
            }';
        }

    }

    public function createAddress($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        /**
         * @author Andrés Cubillos
         * This function get all the parameters mandatorys for create a new address(email,firstname,lastname,phone number, identification number)
         * and make the association with the customer with customer_id
         * @return response with a atribute to confirm if the customer was created or not
         * this function is used too when have to create a new customer for validate a don't exist another count with the same email or identification number
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var lastname get the lastname, type for the user in bot
         * @var firstname get the firstname, type for the user in bot
         * @var address1 get the address, type for the user in bot
         * @var id_city get the id_city always is 1006 send in the bot
         * @var city get the city, always is cali send in the  bot
         * @var tokenSms saves the token that gives access to the consumption of this service
         */

        $nameFunction = "createAddress";
        $url = $urlIn . "addresses?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $id_customer = $_POST['id_customer'];
        $id_country = $_POST['id_country'];
        $alias = $_POST['alias'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $address1 = $_POST['address1'];
        $id_city = $_POST['id_city'];
        $city = $_POST['city'];

        $datos = array(
            "id_customer" => $id_customer,
            "id_country" => $id_country,
            "alias" => $alias,
            "lastname" => $lastname,
            "firstname" => $firstname,
            "address1" => $address1,
            "id_city" => $id_city,
            "city" => $city,
            "url" => $url,
        );
        $request = '<?xml version="1.0" encoding="UTF-8"?>
                        <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
                            <address>
                                <id></id>
                                <id_customer>' . $id_customer . '</id_customer>
                                <id_manufacturer></id_manufacturer>
                                <id_supplier></id_supplier>
                                <id_warehouse></id_warehouse>
                                <id_country>' . $id_country . '</id_country>
                                <id_state></id_state>
                                <alias>' . $alias . '</alias>
                                <company></company>
                                <lastname>' . $lastname . '</lastname>
                                <firstname>' . $firstname . '</firstname>
                                <vat_number></vat_number>
                                <address1>' . $address1 . '</address1>
                                <address2></address2>
                                <postcode></postcode>
                                <city>' . $city . '</city>
                                <other></other>
                                <phone></phone>
                                <phone_mobile></phone_mobile>
                                <dni></dni>
                                <deleted></deleted>
                                <date_add></date_add>
                                <date_upd></date_upd>
                                <id_city>' . $id_city . '</id_city>
                            </address>
                        </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        if ($response_object->status == 201) {
            return '{
                "createAddressSuccessful": "1",
                "address_id": "' . $response_object->address->id . '"
            }';
        } else {
            return '{
                "createAddressSuccessful": 0
            }';
        }

    }

    public function addProductsCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "addProductsCart";
        $idCat = $_POST['idCat'];
        $urlCart = $urlIn . "carts/" . $idCat . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idCat" => $idCat,
            "urlCart" => $urlCart,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $urlCart, $urlCart, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        $arrayProducts = $response_object->cart->associations->cart_rows;

        $url = $urlIn . "carts/?schema=blank&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);

        $id_currency = $_POST['id_currency'];
        $id_customer = $_POST['id_customer'];
        $id_lang = $_POST['id_lang'];
        $id_shop = $_POST['id_shop'];
        $xmlProduct = "";

        $id_productn = $_POST['id_productn'];
        $id_product_attributen = $_POST['id_product_attributen'];
        $quantityn = $_POST['quantityn'];
        $falgEdit = 0;

        $varCapture = array(
            "id_currency" => $id_currency,
            "id_customer" => $id_customer,
            "id_lang" => $id_lang,
            "id_shop" => $id_shop,
            "id_productn" => $id_productn,
            "id_product_attributen" => $id_product_attributen,
            "quantityn" => $quantityn,
        );

        foreach ($arrayProducts as $prodcut) {
            if ($prodcut->id_product == $id_productn && $prodcut->id_product_attribute == $id_product_attributen) {
                $xmlProduct = $xmlProduct . '<cart_row>
                <id_product>
                    ' . $id_productn . '
                </id_product>
                <id_product_attribute>
                    ' . $id_product_attributen . '
                </id_product_attribute>
                <id_address_delivery>
                    <![CDATA[]]>
                </id_address_delivery>
                <id_customization>
                    <![CDATA[]]>
                </id_customization>
                <quantity>
                    ' . $quantityn . '
                </quantity>
                </cart_row>';
                $falgEdit = 1;
            } else {
                $xmlProduct = $xmlProduct . '<cart_row>
                    <id_product>
                        ' . $prodcut->id_product . '
                    </id_product>
                    <id_product_attribute>
                        ' . $prodcut->id_product_attribute . '
                    </id_product_attribute>
                    <id_address_delivery>
                        <![CDATA[]]>
                    </id_address_delivery>
                    <id_customization>
                        <![CDATA[]]>
                    </id_customization>
                    <quantity>
                        ' . $prodcut->quantity . '
                    </quantity>
                    </cart_row>';
            }
        }
        if ($falgEdit == 0) {
            $xmlProduct = $xmlProduct . '<cart_row>
                    <id_product>
                        ' . $id_productn . '
                    </id_product>
                    <id_product_attribute>
                       ' . $id_product_attributen . '
                    </id_product_attribute>
                    <id_address_delivery>
                        <![CDATA[]]>
                    </id_address_delivery>
                    <id_customization>
                        <![CDATA[]]>
                    </id_customization>
                    <quantity>
                        ' . $quantityn . '
                    </quantity>
                    </cart_row>';
        }

        $request = '<?xml version="1.0" encoding="UTF-8"?>
        <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
            <cart>
                <id>' . $idCat . '</id>
                <id_address_delivery></id_address_delivery>
                <id_address_invoice></id_address_invoice>
                <id_currency>' . $id_currency . '</id_currency>
                <id_customer>' . $id_customer . '</id_customer>
                <id_guest></id_guest>
                <id_lang>' . $id_lang . '</id_lang>
                <id_shop_group></id_shop_group>
                <id_shop>' . $id_shop . '</id_shop>
                <id_carrier></id_carrier>
                <recyclable></recyclable>
                <gift></gift>
                <gift_message></gift_message>
                <mobile_theme></mobile_theme>
                <delivery_option></delivery_option>
                <secure_key></secure_key>
                <allow_seperated_package></allow_seperated_package>
                <date_add></date_add>
                <date_upd></date_upd>
                <payment></payment>
                <bono_usado></bono_usado>
                <error></error>
                <associations>
                    <cart_rows>
                        ' . $xmlProduct . '
                    </cart_rows>
                </associations>
            </cart>
        </prestashop>';

        $curl = curl_init();
        $headerCurl = array(
            "Authorization" => $tokenSms,
            "Content-Type" => "application/xml",
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlIn . 'carts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="UTF-8"?>
        <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
            <cart>
                <id>' . $idCat . '</id>
                <id_address_delivery></id_address_delivery>
                <id_address_invoice></id_address_invoice>
                <id_currency>' . $id_currency . '</id_currency>
                <id_customer>0</id_customer>
                <id_guest></id_guest>
                <id_lang>' . $id_lang . '</id_lang>
                <id_shop_group></id_shop_group>
                <id_shop>' . $id_shop . '</id_shop>
                <id_carrier></id_carrier>
                <recyclable></recyclable>
                <gift></gift>
                <gift_message></gift_message>
                <mobile_theme></mobile_theme>
                <delivery_option></delivery_option>
                <secure_key></secure_key>
                <allow_seperated_package></allow_seperated_package>
                <date_add></date_add>
                <date_upd></date_upd>
                <payment></payment>
                <bono_usado></bono_usado>
                <error></error>
                <associations>
                    <cart_rows>
                    ' . $xmlProduct . '
                    </cart_rows>
                </associations>
            </cart>
        </prestashop>',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic OFFaWlpQTktCNTJUSEEzQUJMSFU0OUpNMjFBVlhIQjE6',
                'Content-Type: application/xml',
                'Cookie: PrestaShop-71e5a4bb3efa0ab3f74acb08fa474dbc=def502007b8ec4e657146edbd7123e5985c5297a845b41fd2a0cc258641f3af90f3bf29542a1b7247f1f9af4a7f8672b3533623cb1d1901927d5d046397fd5ba491a5cbb5a3dece2061baeeb6f676f68658556f77fc46265acfe57e3528f0bb4960c9cc64f9965ca717f1e47f606e1f87dc81d027646ef93cd8c0e7b27bf822511a39949cde82c0a11b4a74e086d0e1956d26cf941ed192dabe99ff1f8e39223cca2a409aa099381d8879c99b132ea346750228dc651f903736acc762857bd026fb4cbfeb20f6de4e8df593d5358037c4b301be1f1bc66caeb',
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        http_response_code($http_code);
        \App\Utils\StaticExecuteService::createLog($response, $request, $chat_id, $nameFunction, $type = "PUT", $this->nameLog, $headerCurl, $varCapture);

        //echo json_encode($response_object);
        if ($response_object2 === false) {
            //Ws Caidos! saliendo
            return;
        }
        return $response;

    }
    public function delProductsCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "delProductsCart";
        $idCat = $_POST['idCat'];
        $urlCart = $urlIn . "carts/" . $idCat . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $urlCart, $urlCart, "GET", $token, $headers, $params_error_report, $this->nameLog);

        if ($response_object === false) {
            return;
        }
        $arrayProducts = $response_object->cart->associations->cart_rows;

        $url = $urlIn . "carts/?schema=blank&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);

        $id_currency = $_POST['id_currency'];
        $id_customer = $_POST['id_customer'];
        $id_lang = $_POST['id_lang'];
        $id_shop = $_POST['id_shop'];
        $xmlProduct = "";

        $id_productn = $_POST['id_productn'];
        $id_product_attributen = $_POST['id_product_attributen'];
        $quantityn = $_POST['quantityn'];
        $falgEdit = 0;
        $varCapture = array(
            "id_currency" => $id_currency,
            "id_customer" => $id_customer,
            "id_lang" => $id_lang,
            "id_shop" => $id_shop,
            "id_productn" => $id_productn,
            "id_product_attributen" => $id_product_attributen,
            "quantityn" => $quantityn,
        );
        foreach ($arrayProducts as $prodcut) {
            if ($prodcut->id_product == $id_productn && $prodcut->id_product_attribute == $id_product_attributen) {

            } else {
                $xmlProduct = $xmlProduct . '<cart_row>
                    <id_product>
                        ' . $prodcut->id_product . '
                    </id_product>
                    <id_product_attribute>
                        ' . $prodcut->id_product_attribute . '
                    </id_product_attribute>
                    <id_address_delivery>
                        <![CDATA[]]>
                    </id_address_delivery>
                    <id_customization>
                        <![CDATA[]]>
                    </id_customization>
                    <quantity>
                        ' . $prodcut->quantity . '
                    </quantity>
                    </cart_row>';
            }
        }

        $request = '<?xml version="1.0" encoding="UTF-8"?>
        <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
            <cart>
                <id>' . $idCat . '</id>
                <id_address_delivery></id_address_delivery>
                <id_address_invoice></id_address_invoice>
                <id_currency>' . $id_currency . '</id_currency>
                <id_customer>' . $id_customer . '</id_customer>
                <id_guest></id_guest>
                <id_lang>' . $id_lang . '</id_lang>
                <id_shop_group></id_shop_group>
                <id_shop>' . $id_shop . '</id_shop>
                <id_carrier></id_carrier>
                <recyclable></recyclable>
                <gift></gift>"PUT"
                <gift_message></gift_message>
                <mobile_theme></mobile_theme>
                <delivery_option></delivery_option>
                <secure_key></secure_key>
                <allow_seperated_package></allow_seperated_package>
                <date_add></date_add>
                <date_upd></date_upd>
                <payment></payment>
                <bono_usado></bono_usado>
                <error></error>
                <associations>
                    <cart_rows>
                        ' . $xmlProduct . '
                    </cart_rows>
                </associations>
            </cart>
        </prestashop>';

        //$response_object2 = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "PUT", $token, $headers, $params_error_report, "ComfandiCarrito");
        $headersCurl = array(
            'Authorization: ' . $tokenSms,
            'Content-Type: application/xml',
            'Cookie: PrestaShop-fc5c417ebbd2a4fb0d55c1c014cc1aaa=def50200ba173f5d73f30511cf94fc1d0ca5a2a5051b77dd53dba21960e614ed77819ed8d3e02750f36ba25e83d720eb8d467644f3e8b4b4b1d9ae718259859c2ef997ae50bc0bb21b9bccf4d5c4562fffb4d495d4cbb7117c97eb13fb9d30f819050a64ab67077ba3f86d3770f50d5d5a17002c65b3158dff952020bf407b397462982a81fa4ac9900e18a9919f3cde1fcb72b590e8e7e3d6a876cf8e99be59758b4ce3c386bab9c9d4b6a9e27c1c21a2706e57a4b191fc4a09eb1eea080bc40b80334470c8',
        );
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlIn . 'carts?output_format=JSON',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $tokenSms,
                'Content-Type: application/xml',
                'Cookie: PrestaShop-fc5c417ebbd2a4fb0d55c1c014cc1aaa=def50200ba173f5d73f30511cf94fc1d0ca5a2a5051b77dd53dba21960e614ed77819ed8d3e02750f36ba25e83d720eb8d467644f3e8b4b4b1d9ae718259859c2ef997ae50bc0bb21b9bccf4d5c4562fffb4d495d4cbb7117c97eb13fb9d30f819050a64ab67077ba3f86d3770f50d5d5a17002c65b3158dff952020bf407b397462982a81fa4ac9900e18a9919f3cde1fcb72b590e8e7e3d6a876cf8e99be59758b4ce3c386bab9c9d4b6a9e27c1c21a2706e57a4b191fc4a09eb1eea080bc40b80334470c8',
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        http_response_code($http_code);
        // $this->createLog($response, $request, $chat_id, $nameFunction, "PUT");
        \App\Utils\StaticExecuteService::createLog($response, $request, $chat_id, $nameFunction, $type = "PUT", $this->nameLog, $headersCurl, $varCapture);

        if ($response_object2 === false) {
            return;
        }
        return $response;

    }

    public function createCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {

        $nameFunction = "createCart";
        $url = $urlIn . "carts/?schema=blank&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);

        $id_currency = $_POST['id_currency'];
        $id_customer = $_POST['id_customer'];
        $id_lang = $_POST['id_lang'];
        $id_shop = $_POST['id_shop'];
        $datos = array(
            "id_currency" => $id_currency,
            "id_customer" => $id_customer,
            "id_lang" => $id_lang,
            "id_shop" => $id_shop,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );

        $request = '<?xml version="1.0" encoding="UTF-8"?>
        <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
            <cart>
                <id></id>
                <id_address_delivery></id_address_delivery>
                <id_address_invoice></id_address_invoice>
                <id_currency>' . $id_currency . '</id_currency>
                <id_customer>' . $id_customer . '</id_customer>
                <id_guest></id_guest>
                <id_lang>' . $id_lang . '</id_lang>
                <id_shop_group></id_shop_group>
                <id_shop>' . $id_shop . '</id_shop>
                <id_carrier></id_carrier>
                <recyclable></recyclable>
                <gift></gift>
                <gift_message></gift_message>
                <mobile_theme></mobile_theme>
                <delivery_option></delivery_option>
                <secure_key></secure_key>
                <allow_seperated_package></allow_seperated_package>
                <date_add></date_add>
                <date_upd></date_upd>
                <payment></payment>
                <bono_usado></bono_usado>
                <error></error>
                <associations>
                    <cart_rows>
                    </cart_rows>
                </associations>
            </cart>
        </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        if ($response_object->status == 201) {
            return '{
                "createCart": "1",
                "cartId": "' . $response_object->cart->id . '"
            }';
        } else {
            return '{
                "createCart": 0
            }';
        }

    }

    public function createOrder($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        /**
         * @author Andrés Cubillos
         * This function get all the parameters mandatorys for create a new order(id address,id customer,total value to paid, number of products in the cart)
         * Make the post to create the order and return a variable to confirm if the order was created or not
         * @return response with a atribute to confirm if the order was created or not
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var id_address_delivery get the id of the address selected to the user in the bot
         * @var id_cart get the id of the cart created in the webview
         * @var id_customer get the id of the customer obtained in the function checkCustomer() or the id obtained after created the customer with createCustomer()
         * @var total_paid get the total value of the products, this variable come from the webview
         * @var total_products get the total number of the products add to the cart, this variable come from the webview
         * @var tokenSms saves the token that gives access to the consumption of this service
         */

        $nameFunction = "createOrder";

        $id_address_delivery = $_POST['id_address_delivery'];
        $id_cart = $_POST['id_cart'];
        $id_customer = $_POST['id_customer'];
        $total_paid = $_POST['total_paid'];
        $total_products = $_POST['total_products'];
        
        // $urlIn="https://comfandi-test.felinux.co/marketplace/api/";
        // $tokenSms = "Basic V1I2TUk3NzhWMkozN04zSkI2RVNSRVFRVUlYTkszWVE6";
        
        $url = $urlIn . "orders?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $totalWithShipping = intval($total_paid) + 3000;
        $datos = array(
            "id_address_delivery" => $id_address_delivery,
            "id_cart" => $id_cart,
            "id_customer" => $id_customer,
            "total_paid" => $total_paid,
            "total_products" => $total_products,
            "url" => $url,
            "tokenSms" => $tokenSms,
            "totalWithShipping" => $totalWithShipping,
        );

        $request = '<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
        <order>
        <id><![CDATA[]]></id>
        <id_address_delivery><![CDATA[' . $id_address_delivery . ']]></id_address_delivery>
        <id_address_invoice><![CDATA[' . $id_address_delivery . ']]></id_address_invoice>
        <id_cart><![CDATA[' . $id_cart . ']]></id_cart>
        <id_currency><![CDATA[1]]></id_currency>
        <id_lang><![CDATA[1]]></id_lang>
        <id_customer><![CDATA[' . $id_customer . ']]></id_customer>
        <id_carrier><![CDATA[165]]></id_carrier>
        <current_state><![CDATA[3]]></current_state>
        <module><![CDATA[ps_cashondelivery]]></module>
        <invoice_number><![CDATA[]]></invoice_number>
        <invoice_date><![CDATA[]]></invoice_date>
        <delivery_number><![CDATA[]]></delivery_number>
        <delivery_date><![CDATA[]]></delivery_date>
        <valid><![CDATA[1]]></valid>
        <date_add><![CDATA[]]></date_add>
        <date_upd><![CDATA[]]></date_upd>
        <shipping_number><![CDATA[]]></shipping_number>
        <note><![CDATA[]]></note>
        <id_shop_group><![CDATA[]]></id_shop_group>
        <id_shop><![CDATA[1]]></id_shop>
        <secure_key><![CDATA[]]></secure_key>
        <payment><![CDATA[Pago contra entrega]]></payment>
        <recyclable><![CDATA[]]></recyclable>
        <gift><![CDATA[]]></gift>
        <gift_message><![CDATA[]]></gift_message>
        <mobile_theme><![CDATA[]]></mobile_theme>
        <total_discounts><![CDATA[]]></total_discounts>
        <total_discounts_tax_incl><![CDATA[]]></total_discounts_tax_incl>
        <total_discounts_tax_excl><![CDATA[]]></total_discounts_tax_excl>
        <total_paid><![CDATA[' . $totalWithShipping . ']]></total_paid>
        <total_paid_tax_incl><![CDATA[' . $totalWithShipping . ']]></total_paid_tax_incl>
        <total_paid_tax_excl><![CDATA[' . $totalWithShipping . ']]></total_paid_tax_excl>
        <total_paid_real><![CDATA[' . $totalWithShipping . ']]></total_paid_real>
        <total_products><![CDATA[' . $total_paid . ']]></total_products>
        <total_products_wt><![CDATA[' . $total_paid . ']]></total_products_wt>
        <total_shipping><![CDATA[3000]]></total_shipping>
        <total_shipping_tax_incl><![CDATA[3000]]></total_shipping_tax_incl>
        <total_shipping_tax_excl><![CDATA[3000]]></total_shipping_tax_excl>
        <carrier_tax_rate><![CDATA[]]></carrier_tax_rate>
        <total_wrapping><![CDATA[]]></total_wrapping>
        <total_wrapping_tax_incl><![CDATA[]]></total_wrapping_tax_incl>
        <total_wrapping_tax_excl><![CDATA[]]></total_wrapping_tax_excl>
        <round_mode><![CDATA[]]></round_mode>
        <round_type><![CDATA[]]></round_type>
        <conversion_rate><![CDATA[1.00]]></conversion_rate>
        <reference><![CDATA[]]></reference>
        <associations>
        <order_rows>
        <order_row>
        <id><![CDATA[]]></id>
        <product_id><![CDATA[]]></product_id>
        <product_attribute_id><![CDATA[]]></product_attribute_id>
        <product_quantity><![CDATA[]]></product_quantity>
        <product_name><![CDATA[]]></product_name>
        <product_reference><![CDATA[]]></product_reference>
        <product_ean13><![CDATA[]]></product_ean13>
        <product_isbn><![CDATA[]]></product_isbn>
        <product_upc><![CDATA[]]></product_upc>
        <product_price><![CDATA[]]></product_price>
        <id_customization><![CDATA[]]></id_customization>
        <unit_price_tax_incl><![CDATA[]]></unit_price_tax_incl>
        <unit_price_tax_excl><![CDATA[]]></unit_price_tax_excl>
        </order_row>
        </order_rows>
        </associations>
        </order>
        </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        if ($response_object->order) {
            return '{
                "createOrderSuccessful": "1",
                "order_id": "' . $response_object->order->id . '"
            }';
        } else {
            return '{
                "createOrderSuccessful": 0
            }';
        }

    }




    public function createOrderPagoEnLinea($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        /**
         * @author Andrés Cubillos
         * This function get all the parameters mandatorys for create a new order(id address,id customer,total value to paid, number of products in the cart)
         * Make the post to create the order and return a variable to confirm if the order was created or not
         * @return response with a atribute to confirm if the order was created or not
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var id_address_delivery get the id of the address selected to the user in the bot
         * @var id_cart get the id of the cart created in the webview
         * @var id_customer get the id of the customer obtained in the function checkCustomer() or the id obtained after created the customer with createCustomer()
         * @var total_paid get the total value of the products, this variable come from the webview
         * @var total_products get the total number of the products add to the cart, this variable come from the webview
         * @var tokenSms saves the token that gives access to the consumption of this service
         */

        $nameFunction = "createOrderPagoEnLinea";

        $id_address_delivery = $_POST['id_address_delivery'];
        $id_cart = $_POST['id_cart'];
        $id_customer = $_POST['id_customer'];
        $total_paid = $_POST['total_paid'];
        $total_products = $_POST['total_products'];
        $url = $urlIn . "orders?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $totalWithShipping = intval($total_paid) + 3000;
        $datos = array(
            "id_address_delivery" => $id_address_delivery,
            "id_cart" => $id_cart,
            "id_customer" => $id_customer,
            "total_paid" => $total_paid,
            "total_products" => $total_products,
            "url" => $url,
            "tokenSms" => $tokenSms,
            "totalWithShipping" => $totalWithShipping,
        );

        // $urlIn="https://comfandi-test.felinux.co/marketplace/api/";
        // $tokenSms = "Basic V1I2TUk3NzhWMkozN04zSkI2RVNSRVFRVUlYTkszWVE6";


        $request = '<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
        <order>
        <id><![CDATA[]]></id>
        <id_address_delivery><![CDATA[' . $id_address_delivery . ']]></id_address_delivery>
        <id_address_invoice><![CDATA[' . $id_address_delivery . ']]></id_address_invoice>
        <id_cart><![CDATA[' . $id_cart . ']]></id_cart>
        <id_currency><![CDATA[1]]></id_currency>
        <id_lang><![CDATA[1]]></id_lang>
        <id_customer><![CDATA[' . $id_customer . ']]></id_customer>
        <id_carrier><![CDATA[165]]></id_carrier>
        <current_state><![CDATA[24]]></current_state>
        <module><![CDATA[tucomprav2]]></module>
        <invoice_number><![CDATA[]]></invoice_number>
        <invoice_date><![CDATA[]]></invoice_date>
        <delivery_number><![CDATA[]]></delivery_number>
        <delivery_date><![CDATA[]]></delivery_date>
        <valid><![CDATA[1]]></valid>
        <date_add><![CDATA[]]></date_add>
        <date_upd><![CDATA[]]></date_upd>
        <shipping_number><![CDATA[]]></shipping_number>
        <note><![CDATA[]]></note>
        <id_shop_group><![CDATA[]]></id_shop_group>
        <id_shop><![CDATA[1]]></id_shop>
        <secure_key><![CDATA[]]></secure_key>
        <payment><![CDATA[TUCOMPRA]]></payment>
        <recyclable><![CDATA[]]></recyclable>
        <gift><![CDATA[]]></gift>
        <gift_message><![CDATA[]]></gift_message>
        <mobile_theme><![CDATA[]]></mobile_theme>
        <total_discounts><![CDATA[]]></total_discounts>
        <total_discounts_tax_incl><![CDATA[]]></total_discounts_tax_incl>
        <total_discounts_tax_excl><![CDATA[]]></total_discounts_tax_excl>
        <total_paid><![CDATA[' . $totalWithShipping . ']]></total_paid>
        <total_paid_tax_incl><![CDATA[' . $totalWithShipping . ']]></total_paid_tax_incl>
        <total_paid_tax_excl><![CDATA[' . $totalWithShipping . ']]></total_paid_tax_excl>
        <total_paid_real><![CDATA[' . $totalWithShipping . ']]></total_paid_real>
        <total_products><![CDATA[' . $total_paid . ']]></total_products>
        <total_products_wt><![CDATA[' . $total_paid . ']]></total_products_wt>
        <total_shipping><![CDATA[3000]]></total_shipping>
        <total_shipping_tax_incl><![CDATA[3000]]></total_shipping_tax_incl>
        <total_shipping_tax_excl><![CDATA[3000]]></total_shipping_tax_excl>
        <carrier_tax_rate><![CDATA[]]></carrier_tax_rate>
        <total_wrapping><![CDATA[]]></total_wrapping>
        <total_wrapping_tax_incl><![CDATA[]]></total_wrapping_tax_incl>
        <total_wrapping_tax_excl><![CDATA[]]></total_wrapping_tax_excl>
        <round_mode><![CDATA[]]></round_mode>
        <round_type><![CDATA[]]></round_type>
        <conversion_rate><![CDATA[1.00]]></conversion_rate>
        <reference><![CDATA[]]></reference>
        <associations>
        <order_rows>
        <order_row>
        <id><![CDATA[]]></id>
        <product_id><![CDATA[]]></product_id>
        <product_attribute_id><![CDATA[]]></product_attribute_id>
        <product_quantity><![CDATA[]]></product_quantity>
        <product_name><![CDATA[]]></product_name>
        <product_reference><![CDATA[]]></product_reference>
        <product_ean13><![CDATA[]]></product_ean13>
        <product_isbn><![CDATA[]]></product_isbn>
        <product_upc><![CDATA[]]></product_upc>
        <product_price><![CDATA[]]></product_price>
        <id_customization><![CDATA[]]></id_customization>
        <unit_price_tax_incl><![CDATA[]]></unit_price_tax_incl>
        <unit_price_tax_excl><![CDATA[]]></unit_price_tax_excl>
        </order_row>
        </order_rows>
        </associations>
        </order>
        </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        if ($response_object->order) {
            return '{
                "createOrderSuccessful": "1",
                "order_id": "' . $response_object->order->id . '"
            }';
        } else {
            return '{
                "createOrderSuccessful": 0
            }';
        }

    }
    public function customerInfoById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "customerInfoById";
        $idNumber = $_POST['identification_number'];
        $url = $urlIn . "customers?filter[identification_number]=" . $idNumber . "&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "idNumber" => $idNumber,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $id_customer = $response_object->customers[0]->id;
        $status = $response_object->status;

        $var = '{
            "idCustomer" : "' . $id_customer . '",
            "statusWS" : "' . $status . '"
        }';

        return $var;
    }

    public function ordersByCustomerId($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "ordersByCustomerId";
        $idCustomer = $_POST['id_customer'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        $url = $urlIn . "orders?filter[id_customer]=" . $idCustomer . "&sort=[delivery_date_DESC]&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        
        $datos = array(
            "idCustomer" => $idCustomer,
            "ciclo" => $ciclo,
            "cantidad" => $cantidad,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        $response = new \stdClass();

        $validationArray = array();

        for ($i = 0; $i < (sizeof($response_object->orders)); $i++) {
            if ($response_object->orders[$i]->valid == 1) {
                array_push($validationArray, $response_object->orders[$i]);
            }

        }

        $response->numVerMas = ceil((sizeof($validationArray)) / $cantidad);

        $temporalArray = array();

        if ($final > sizeof($validationArray)) {

            for ($i = $inicio; $i < (sizeof($validationArray)); $i++) {
                array_push($temporalArray, $validationArray[$i]);
            }
        } else {

            for ($i = $inicio; $i <= $final; $i++) {
                array_push($temporalArray, $validationArray[$i]);
            }
        }

        $temporalArray2 = array();

        for ($i = 0; $i < sizeof($temporalArray); $i++) {
            if (gettype($temporalArray[$i]) == object) {
                array_push($temporalArray2, $temporalArray[$i]);
            }
        }

        for ($i = 0; $i < sizeof($temporalArray2); $i++) {
            $response->dynamicArray[$i]->mensaje_opc = "Pedido #REF: " . $temporalArray2[$i]->reference;
            $response->dynamicArray[$i]->referenciaCompra = $temporalArray2[$i]->reference;
            $response->dynamicArray[$i]->idCompra = $temporalArray2[$i]->id;
            $response->dynamicArray[$i]->totalPrice = $temporalArray2[$i]->total_paid;
            $response->dynamicArray[$i]->addressId = $temporalArray2[$i]->id_address_delivery;
        }

        return \GuzzleHttp\json_encode($response);

    }

    public function consultOrderById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "consultOrderById";
        $order_id = $_POST['order_id'];
        $url = $urlIn . "orders?filter[id]=" . $order_id . "&display=full&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "order_id" => $order_id,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );

        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        return json_encode($response_object);

    }

    public function consultAddressById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "consultAddressById";
        $address_id = $_POST['address_id'];
        $url = $urlIn . "addresses/" . $address_id . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "address_id" => $address_id,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        $address = $response_object->address->address1;
        $status = $response_object->status;

        $var = '{
            "addressCustomer" : "' . $address . '",
            "statusWS" : "' . $status . '"
        }';

        return $var;

    }

    public function consultCustomerById($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "consultCustomerById";
        $customer_id = $_POST['customer_id'];
        $url = $urlIn . "customers/" . $customer_id . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "customer_id" => $customer_id,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);
        return json_encode($response_object);

    }

    public function updateCart($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "updateCart";
        $idCart = $_POST['idCart'];
        $address_id = $_POST['address_id'];
        $customer_id = $_POST['customer_id'];
        $payment = $_POST['payment'];

        $varCapture = array(
            "idCart" => $idCart,
            "address_id" => $address_id,
            "customer_id" => $customer_id,
        );
        $url = $urlIn . "carts/" . $idCart . "?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, "cartById", $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog);

        //echo json_encode($response_object);
        if ($response_object === false) {
            //Ws Caidos! saliendo
            return;
        }

        $tamano = sizeof($response_object->cart->associations->cart_rows);
        $cart_rows = '';
        for ($i = 0; $i < $tamano; $i++) {
            //print_r($products->cart->associations->cart_rows[$i]->id_product);
            $cart_rows = $cart_rows . '<cart_row>
            <id_product>' . $response_object->cart->associations->cart_rows[$i]->id_product . '</id_product>
            <id_product_attribute>' . $response_object->cart->associations->cart_rows[$i]->id_product_attribute . '</id_product_attribute>
            <id_address_delivery>' . $address_id . '</id_address_delivery>
            <id_customization>' . $response_object->cart->associations->cart_rows[$i]->id_customization . '</id_customization>
            <quantity>' . $response_object->cart->associations->cart_rows[$i]->quantity . '</quantity>
            </cart_row>';
        }
        $xml_post_string = '<?xml version="1.0" encoding="UTF-8"?>
          <prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
              <cart>
                  <id>' . $response_object->cart->id . '</id>
                  <id_address_delivery>' . $address_id . '</id_address_delivery>
                  <id_address_invoice>' . $address_id . '</id_address_invoice>
                  <id_currency>' . $response_object->cart->id_currency . '</id_currency>
                  <id_customer>' . $customer_id . '</id_customer>
                  <id_guest>' . $response_object->cart->id_guest . '</id_guest>
                  <id_lang>' . $response_object->cart->id_lang . '</id_lang>
                  <id_shop_group>' . $response_object->cart->id_shop_group . '</id_shop_group>
                  <id_shop>' . $response_object->cart->id_shop . '</id_shop>
                  <id_carrier>165</id_carrier>
                  <recyclable>' . $response_object->cart->recyclable . '</recyclable>
                  <gift>' . $response_object->cart->gift . '</gift>
                  <gift_message>' . $response_object->cart->gift_message . '</gift_message>
                  <mobile_theme>' . $response_object->cart->mobile_theme . '</mobile_theme>
                  <delivery_option>' . $response_object->cart->delivery_option . '</delivery_option>
                  <secure_key>' . $response_object->cart->secure_key . '</secure_key>
                  <allow_seperated_package>' . $response_object->cart->allow_seperated_package . '</allow_seperated_package>
                  <date_add>' . $response_object->cart->date_add . '</date_add>
                  <date_upd>' . $response_object->cart->date_upd . '</date_upd>
                  <payment>' . $payment . '</payment>
                  <bono_usado>' . $response_object->cart->bono_usado . '</bono_usado>
                  <error>' . $response_object->cart->error . '</error>
                  <associations>
                      <cart_rows>' . $cart_rows . '</cart_rows>
                  </associations>
              </cart>
          </prestashop>';

        $headersCurl = array(
            'Authorization: ' . $tokenSms,
            'Content-Type: application/xml',
            'Cookie: PrestaShop-fc5c417ebbd2a4fb0d55c1c014cc1aaa=def50200ba173f5d73f30511cf94fc1d0ca5a2a5051b77dd53dba21960e614ed77819ed8d3e02750f36ba25e83d720eb8d467644f3e8b4b4b1d9ae718259859c2ef997ae50bc0bb21b9bccf4d5c4562fffb4d495d4cbb7117c97eb13fb9d30f819050a64ab67077ba3f86d3770f50d5d5a17002c65b3158dff952020bf407b397462982a81fa4ac9900e18a9919f3cde1fcb72b590e8e7e3d6a876cf8e99be59758b4ce3c386bab9c9d4b6a9e27c1c21a2706e57a4b191fc4a09eb1eea080bc40b80334470c8',
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlIn . 'carts?output_format=JSON',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $xml_post_string,
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $tokenSms,
                'Content-Type: application/xml',
                'Cookie: PrestaShop-fc5c417ebbd2a4fb0d55c1c014cc1aaa=def50200ba173f5d73f30511cf94fc1d0ca5a2a5051b77dd53dba21960e614ed77819ed8d3e02750f36ba25e83d720eb8d467644f3e8b4b4b1d9ae718259859c2ef997ae50bc0bb21b9bccf4d5c4562fffb4d495d4cbb7117c97eb13fb9d30f819050a64ab67077ba3f86d3770f50d5d5a17002c65b3158dff952020bf407b397462982a81fa4ac9900e18a9919f3cde1fcb72b590e8e7e3d6a876cf8e99be59758b4ce3c386bab9c9d4b6a9e27c1c21a2706e57a4b191fc4a09eb1eea080bc40b80334470c8',
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        http_response_code($http_code);
        \App\Utils\StaticExecuteService::createLog($response, $xml_post_string, $chat_id, $nameFunction, $type = "PUT", $this->nameLog, $headersCurl, $varCapture);
        $response = json_decode($response);
        if ($response->{'cart'}) {
            return '{
                "updateSuccess":"1"
            }';
        } else {
            return '{
                "updateSuccess":"0"
            }';
        }

    }

    public function orderId($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        $nameFunction = "orderId";
        $orderId = $_POST['order_id'];
        $url = $urlIn . "orders/" . $orderId . "&output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $datos = array(
            "orderId" => $orderId,
            "url" => $url,
            "tokenSms" => $tokenSms,
        );
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $url, "GET", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }

        $id_order = $response_object->order->id;
        $reference = $response_object->order->reference;
        $date_add = $response_object->order->date_add;
        $status = $response_object->status;

        $var = '{
            "orderId" : "' . $id_order . '",
            "ordenReferencia" : "' . $reference . '",
            "date_add" : "' . $date_add . '",
            "statusWS" : "' . $status . '"
        }';

        return $var;
    }

    public function customerThread($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        /**
         * @author Andrés Cubillos
         * This function get all the parameters mandatorys for create a new address(email,firstname,lastname,phone number, identification number)
         * and make the association with the customer with customer_id
         * @return response with a atribute to confirm if the customer was created or not
         * this function is used too when have to create a new customer for validate a don't exist another count with the same email or identification number
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var lastname get the lastname, type for the user in bot
         * @var firstname get the firstname, type for the user in bot
         * @var address1 get the address, type for the user in bot
         * @var id_city get the id_city always is 1006 send in the bot
         * @var city get the city, always is cali send in the  bot
         * @var tokenSms saves the token that gives access to the consumption of this service
         */

        $nameFunction = "customerThread";
        $url = $urlIn . "customer_threads?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $id_customer = $_POST['id_customer'];
        $id_order = $_POST['id_order'];
        $email = $_POST['email'];
        $token = $this->generarCadena();
        $datos = array(
            "url" => $url,
            "id_customer" => $id_customer,
            "id_order" => $id_order,
            "email" => $email,
            "token" => $token,
        );
        $request = '<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
        <customer_thread>
          <id><![CDATA[]]></id>
          <id_lang>1</id_lang>
          <id_shop>1</id_shop>
          <id_customer>' . $id_customer . '</id_customer>
          <id_order>' . $id_order . '</id_order>
          <id_product>0</id_product>
          <id_contact>0</id_contact>
          <email>' . $email . '</email>
          <token>' . $token . '</token>
          <status>open</status>
          <date_add><![CDATA[]]></date_add>
          <date_upd><![CDATA[]]></date_upd>
          <associations>
            <customer_messages>
              <customer_message>
                <id><![CDATA[]]></id>
              </customer_message>
            </customer_messages>
          </associations>
        </customer_thread>
      </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        try {
            if ($response_object->status == 201) {
                return '{
                    "id_customer_thread":' . $response_object->customer_thread->id . ',
                    "status":' . $response_object->status . '
            }';
            } else {
                return '{
                    "customer_thread_successful": 0,
                }';
            }
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function generarCadena()
    {
        $longitud = 12;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cadena = '';
        $caracteresLength = strlen($caracteres);

        for ($i = 0; $i < $longitud; $i++) {
            $cadena .= $caracteres[rand(0, $caracteresLength - 1)];
        }

        return $cadena;
    }

    public function setOrderMessage($app, $params_error_report, $nameController, $chat_id, $urlIn, $tokenSms)
    {
        /**
         * @author Andrés Cubillos
         * This function get all the parameters mandatorys for create a new address(email,firstname,lastname,phone number, identification number)
         * and make the association with the customer with customer_id
         * @return response with a atribute to confirm if the customer was created or not
         * this function is used too when have to create a new customer for validate a don't exist another count with the same email or identification number
         */
        /**
         * @var nameFunction save the name of this function for be send to the function in charge of create logs
         * @var lastname get the lastname, type for the user in bot
         * @var firstname get the firstname, type for the user in bot
         * @var address1 get the address, type for the user in bot
         * @var id_city get the id_city always is 1006 send in the bot
         * @var city get the city, always is cali send in the  bot
         * @var tokenSms saves the token that gives access to the consumption of this service
         */

        $nameFunction = "setOrderMessage";
        $url = $urlIn . "customer_messages?output_format=JSON";
        $headers = array("Authorization" => $tokenSms);
        $message = $_POST['message'];
        $id_customer_thread = $_POST['id_customer_thread'];
        $datos = array(
            "url" => $url,
            "id_customer_thread" => $id_customer,
            "message" => $id_order,
        );
        $request = '<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
        <customer_message>
          <id></id>
          <id_employee>0</id_employee>
          <id_customer_thread>' . $id_customer_thread . '</id_customer_thread>
          <ip_address></ip_address>
          <message>' . $message . '</message>
          <file_name></file_name>
          <user_agent></user_agent>
          <private>0</private>
          <date_add></date_add>
          <date_upd></date_upd>
          <read></read>
        </customer_message>
      </prestashop>';
        $response_object = \App\Utils\StaticExecuteService::executeService($chat_id, $nameController, $nameFunction, $app, $url, $request, "POST", $token, $headers, $params_error_report, $this->nameLog, $datos);

        if ($response_object === false) {
            return;
        }
        try {
            if ($response_object->status == 201) {
                return '{
                "id_customer_message":' . $response_object->customer_message->id . ',
                "status":' . $response_object->status . ',
                "customer_message_successful": 1
            }';
            } else {
                return '{
                "customer_message_successful": 0
                }';
            }
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function createLog($response, $datosEntrada, $chat_id, $nameFunction, $typeRequest)
    {
        try {
            $response = json_encode($response);
            if (gettype($datosEntrada) == "array") {
                $datosEntrada = json_encode($datosEntrada);
            }
            $bodyLog = 'Funcion: ' . $nameFunction . ' ---------Type: ' . $typeRequest . ' ----------Datos de Entrada: ' . $datosEntrada . ' ----------Respuesta del servicio:' . $response;

            \App\Utils\SetLogs::customLog($this->nameLog, $bodyLog, $chat_id);
        } catch (\Exception $e) {
            return $e;
        }
    }

}

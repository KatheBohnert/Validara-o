<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use Phalcon\Http\Response;

/**
 * Description of CariController
 *
 * @author mtobar
 *
 */
class MtController {

    //put your code here

    public function process(\Phalcon\Mvc\Micro $app) {

        $operation = $_POST['operation'];

        switch ($operation) {
            case "validarUsuario":
                $response = $this->validarUsuario();
                echo $response;
                break;
            case "generarArray":
                $response = $this->generarArray();
                echo $response;
                break;
            case "crearErrorLog":
                $response = $this->crearErrorLog($app);
                echo $response;
                break;
            default:
                break;
        }
    }

    public function validarUsuario() {
        $edad = $_POST["edadUsuario"];

        if ($edad >= 18) {
            $valid = 1;
        } else {
            $valid = 0;
        }

        $var = '{
            "mayorEdad": "' . $valid . '"            
        }';

        return $var;
    }

    function generarArray() {

        $response = new \stdClass();
        
        $nombre = array("Milton", "Santiago", "Paulo");

        $response->dynamicArray[0]->mensaje = "Este es el mensaje para la opción 1 ".$nombre[0];
        $response->dynamicArray[0]->nombre = $nombre[0];
        $response->dynamicArray[0]->email = "Email 1";
        $response->dynamicArray[1]->mensaje = "Este es el mensaje para la opción 2 ".$nombre[1];
        $response->dynamicArray[1]->nombre = $nombre[1];
        $response->dynamicArray[1]->email = "Email 2";
        $response->dynamicArray[2]->mensaje = "Este es el mensaje para la opción 3 ".$nombre[2];
        $response->dynamicArray[2]->nombre = $nombre[2];
        $response->dynamicArray[2]->email = "Email 3";

        return \GuzzleHttp\json_encode($response);
    }

    function crearErrorLog($app) {
       
        $client = new \App\Utils\CrudApiClient();
        $client->createToken($app, "cTlPZ2I4cTQ4SThSUy83WEpDaGlqekh6MWQrMlpnQ3lLRER0Q3dDelhiQnJKYzg9");
        $data = $client->executeOperation($app, 'create', [
            'model' => 'FluxErrorLog',
            'fields' => [
                [
                    'name' => 'enterprise_id',
                    'value' => $app->request->get('enterprise', 'string'),
                ], 
                [
                    'name' => 'error_date',
                    'value' => date("Y-m-d H:i:s")
                ]
            ]
        ]);
        
        return "OK2";
    }
  
}
   


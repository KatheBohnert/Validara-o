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
 * @author rmelo
 */
class MtController {

    //put your code here

    public function validateCellphone(\Phalcon\Mvc\Micro $app) {
//        $client = new \App\Utils\CrudApiClient();
//        $client->createToken($app, "cTlPZ2I4cTQ4SThSUy83VUpDaGlqekh6MWQrMlpnQ3lLRER0Q3dDeldMUjdlZz09");
//        $data = $client->executeOperation($app, 'read', [
//            'model' => 'DemoCellValidated',
//            'search_fields' => [
//                [
//                    'name' => 'cell_phone',
//                    'value' => $app->request->get('cell_phone', 'string'),
//                    'operation' => 'equals'
//                ]
//            ]
//        ]);
//
//        $ret = new \stdClass();
//        $ret->sndl_ws_error = 1;
//        if ($data) {
//            $ret->sndl_ws_error = 0;
//            $ret->sndl_ws_is_cell_verified = 1;
//            if (!count($data->payload)) {
//                $client->executeOperation($app, 'create', [
//                    'model' => 'DemoCellValidated',
//                    'fields' => [
//                        [
//                            'name' => 'cell_phone',
//                            'value' => $app->request->get('cell_phone', 'string')
//                        ],
//                        [
//                            'name' => 'is_validated',
//                            'value' => '1'
//                        ]
//                    ]
//                ]);
//            }
//        }
//        if ($app->request->get('cell_phone', 'string') == '3001112222') {
//            $ret->sndl_ws_is_cell_verified = 0;
//        }
//
//        echo json_encode($ret);
        //echo "Hola Mundo";
        
        $edad = $_POST["edadUsuario"];
        
        if ($edad >= 18){
            $valid = 1;
        } else {
            $valid = 0;
        }
                
        $var = '{
            "mayorEdad": "'.$valid.'"            
        }';
        
         echo $var;
        
    }

}

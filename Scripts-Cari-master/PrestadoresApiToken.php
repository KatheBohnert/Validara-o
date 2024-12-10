<?php

namespace Store\Toys;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;

class PrestadoresApiToken extends Model {

    public function getToken($app, $botId = "1104") {
        
        $client = new \App\Utils\CrudApiClient();
        $client->createToken($app, "cTlPZ2I4cTQ4SThSUy83V0pDaGlqekh6MWQrMlpnQ3lLRER0Q3dDelhiQnJKYzg9");
        $data = $client->executeOperation($app, 'read', [
            'model' => 'PrestadoresApiToken',
            'search_fields' => [
                [
                    'name' => 'flux_bot_id',
                    "operation" => "equals",
                    'value' => $botId
                ],
                [
                    'name' => 'ctime',
                    "operation" => "greater",
                    'value' => date("Y-m-d H:i:s")
                ]
            ]
        ]);
        
        if ($data->payload){
            $payload = $data->payload[0];
            foreach ($payload as $py){
                if ($py->name == "token") {
                    $token = $py->value;
                    break;
                }
            }
            return $token;
        } else {
            return false;
        }
    }    
    
    public function saveToken($app, $token, $expires_in, $ctime, $flux_bot_id) {
       
        $client = new \App\Utils\CrudApiClient();
        $client->createToken($app, "cTlPZ2I4cTQ4SThSUy83V0pDaGlqekh6MWQrMlpnQ3lLRER0Q3dDelhiQnJKYzg9");
        $data = $client->executeOperation($app, 'create', [
            'model' => 'PrestadoresApiToken',
            'fields' => [
                [
                    'name' => 'token',
                    'value' => $token
                ],
                [
                    'name' => 'expires_in',
                    'value' => $expires_in
                ],
                [
                    'name' => 'enterprise_id',
                    'value' => "242"
                ],
                [
                    'name' => 'ctime',
                    'value' => $ctime
                ],
                [
                    'name' => 'flux_bot_id',
                    'value' => $flux_bot_id
                ]
            ]
        ]);
       
    }
}

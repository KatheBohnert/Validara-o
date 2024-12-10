<?php

namespace Store\Toys;

use Phalcon\Mvc\Model;

class ErrorLogModel extends Model
{

    public function crearErrorLog($app, $errorReport)
    {
        date_default_timezone_set('America/Bogota');
        $client = new \App\Utils\CrudApiClient();
        $client->createToken($app, "cTlPZ2I4cTQ4SThSUy83WEpDaGlqekh6MWQrMlpnQ3lLRER0Q3dDelhiQnJKYzg9");
        $data = $client->executeOperation($app, 'create', [
            'model' => 'FluxErrorLog',
            'fields' => [
                [
                    'name' => 'enterprise_id',
                    'value' => $errorReport["enterprise_id"],
                ],
                [
                    'name' => 'flux_bot_id',
                    'value' => $errorReport["bot_id"],
                ],
                [
                    'name' => 'session_id',
                    'value' => $errorReport["session_id"],
                ],
                [
                    'name' => 'error_date',
                    'value' => date("Y-m-d H:i:s"),
                ],
                [
                    'name' => 'service',
                    'value' => $errorReport["url"],
                ],
                [
                    'name' => 'error_type',
                    'value' => 'web',
                ],
                [
                    'name' => 'error_code',
                    'value' => $errorReport["status"],
                ],
                [
                    'name' => 'error_message',
                    'value' => 'El servicio ha fallado',
                ],
                [
                    'name' => 'action',
                    'value' => $errorReport["url"],
                ],
                [
                    'name' => 'data1',
                    'value' => $errorReport["response"],
                ],
                [
                    'name' => 'bot_client_id',
                    'value' => 123,
                ],
                [
                    'name' => 'flux_session_record_id',
                    'value' => $errorReport["convesartion_id"],
                ],

            ],
        ]);
        return "OK2";
    }
}

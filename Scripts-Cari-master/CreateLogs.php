<?php

namespace App\Utils;

class CreateLogs
{

    public static function registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url)
    {

        $array = array(
            "message" => "Se ha realizado un llamado a un servicio Web, se describen los detalles a continuación",
            "Chat_id" => $chat_identification,
            "Path" => "/var/www/app/controllers/" . $nameController . "/" . $nameFunction,
            "Payload" => "body: " . print_r($app->request->get(), true),
            "Url" => $url,
        );

        $app->getSharedService('logger')->info("log: " . print_r($array, true));

    }

    public static function registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $statusCode, $response_object, $diffSecs)
    {

        $array = array(
            "message" => "Luego de realizar el llamado al servicio Web se obtuvo la siguiente respuesta:",
            "Chat_id" => $chat_identification,
            "Path" => "/var/www/app/controllers/" . $nameController . "/" . $nameFunction,
            "Payload" => "body: " . print_r($app->request->get(), true),
            "Url" => $url,
            "Status" => $statusCode,
            "Response" => $response_object,
            "Time Response" => $diffSecs,
        );

        $app->getSharedService('logger')->info("log: " . print_r($array, true));

    }

}

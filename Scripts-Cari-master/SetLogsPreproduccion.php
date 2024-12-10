<?php

namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use SoapClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;
use Phalcon\Logger\Formatter\Line;

class SetLogsPreproduccion {

    public static function customLogPreproduccion($logName = "main", $data = null, $chat_id = 111) {
        date_default_timezone_set("America/Bogota");
	$formatter = new Line('%date%|%type%|'.$chat_id.'| %message%');
        $formatter->setDateFormat('Y-m-d H:i:s.v');
        $adapter = new Stream('/var/log/app/' . $logName . '.log');
        $adapter->setFormatter($formatter);
        $logger = new Logger(
                'messages',
                [
                    "$logName" => $adapter
                ]
        );
        $data = str_replace(">\n", ">", $data);
        $logger->info($data);
        return 1;
    }

}

?>

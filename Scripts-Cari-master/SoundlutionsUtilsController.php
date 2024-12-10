<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use DateTime;
use DateTimeZone;

/**
 * Description of CariController
 *
 * @author devteam
 */

class SoundlutionsUtilsController 
{
    public $nameLog = 'SoundlutionsUtilsController';

    public function process(\Phalcon\Mvc\Micro $app)
    {
        header('Access-Control-Allow-Origin: *');
        $nameController = "SoundlutionsUtilsController";
        $chat_id = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'conversation_id' => $_POST['convesartion_id'],
        ];
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];
        $token = $_POST['token'];

        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {

            switch ($operation) {
                case 'test':
                    $response = 'Hello world';
                    echo $response;
                    break;
                
                case 'stringReplace':
                    $response = $this->stringReplace();
                    echo $response;
                    break;

                case 'dateFormat':
                    $response = $this->dateFormat();
                    echo $response;
                    break;

                case 'getType':
                    $response = $this->getType();
                    echo $response;
                    break;

                case 'formatName':
                    $response = $this->nameValidator();
                    echo $response;
                    break;

                case 'maskCellphone':
                    $response = $this->maskCellphone();
                    echo $response;
                    break;

                case 'maskEmail':
                    $response = $this->maskEmail();
                    echo $response;
                    break;
                
                case 'validarAño':
                    $response = $this->validarAño();
                    echo $response;
                    break;    
                
                default:
                    $response = 'Operation not found';
                    echo $response;
                    break;
            }
        } else {
            $response = "useProduction and token is mandatory!";
            echo $response;
        }
    }

    public function stringReplace()
    {
        $str = $_POST['string'];
        $search = $_POST['search'];
        $replace = $_POST['replace'];
    
        return str_replace($search, $replace, $str);
    }

    public function dateFormat(): string
    {
        $initialDate = $_POST['date'];
        $separator = $_POST['separator'];

        $validSeparators = array('/', '-', '.');

        // Verifica que el separador sea válido
        if (!in_array($separator, $validSeparators)) {
            $response = array(
                "message" => "Separador no válido"
            );
            return json_encode($response);
        }

        $timestamp = strtotime($initialDate);
        $finalDate = date("d{$separator}m{$separator}Y", $timestamp);

        $response = array(
            "message" => $finalDate
        );

        return json_encode($response);
    }

    public function getType(): string
    {
        $variable = $_POST['variable'];

        return gettype($variable);
    }

    // Funciones estáticas para utilizarlas en otros controladores
    public static function formatDateToWords($initialDate): string
    {
        $timestamp = strtotime($initialDate);

        $nombreDia = date('l', $timestamp);
        $diaMes = date('j', $timestamp);
        $nombreMes = date('F', $timestamp);

        $nombresDias = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo',
        ];

        $nombresMeses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];

        $nombreDia = isset($nombresDias[$nombreDia]) ? $nombresDias[$nombreDia] : $nombreDia;
        $nombreMes = isset($nombresMeses[$nombreMes]) ? $nombresMeses[$nombreMes] : $nombreMes;

        $cadenaFormateada = "$nombreDia $diaMes de $nombreMes de " . date('Y', $timestamp);

        return $cadenaFormateada;
    }

    public static function getYear($date, int $digits = 4): string
    {
        $timestamp = strtotime($date);
        if ($digits !== 4) {
            return date('Y', $timestamp);
        }
        return date('y', $timestamp);
    }

    public static function getMonth($date, string $type = 'digits'):string
    {
        $timestamp = strtotime($date);
        if ($type !== 'digits') {
            return date('M', $timestamp);
        }
        return date('m', $timestamp);
    }

    public static function getDay($date, string $type = 'digits'): string
    {
        $timestamp = strtotime($date);
        if ($type !== 'digits') {
            return date('D', $timestamp);
        }
        return date('d', $timestamp);
    }

    // Validador de nombres inicialmente para el proyecto de IQO Secretaría de movilidad
    public function nameValidator(): string
    {
        $name = $_POST['name'];

        $pattern = '/^[a-zA-ZáéíóúÁÉÍÓÚüÜ]+(?:\s[a-zA-ZáéíóúÁÉÍÓÚüÜ]+)+$/';

        if (preg_match($pattern, $name)) {
            $response = array(
                "message" => "El nombre es valido"
            );
        } else {
            $response = array(
                "message" => "El nombre no es valido"
            );
        }

        return json_encode($response);
    }

    public function maskCellphone(): string
    {
        $phoneNumber = $_POST['phoneNumber'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $maskChar = $_POST['mask'];

        $phoneLength = strlen($phoneNumber);

        if ($start < 0 || $start >= $phoneLength || $end < 0 || $end >= $phoneLength || $start > $end) {
            $response = array(
                "message" => "Rango de celdas inválido"
            );
        }

        $phoneArray = str_split($phoneNumber);

        // Enmascarar desde start hasta end
        for ($i = $start; $i <= $end; $i++) {
            $phoneArray[$i] = $maskChar;
        }

        $response = array(
            "message" => implode('', $phoneArray)
        );

        return json_encode($response);
    }

    public function maskEmail(): string
    {
        $email = $_POST['email'];
        $maskChar = $_POST['mask'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        // Dividir el correo en la parte local y el dominio
        list($local, $domain) = explode('@', $email);

        // Longitud de la parte local y del dominio
        $localLength = strlen($local);
        $domainLength = strlen($domain);

        // Asegurarse de que start y end están dentro del rango de la parte local y del dominio
        if ($start < 0 || $start >= $localLength || $end < 0 || $end >= $domainLength) {
            $response = array(
                "message" => "Rango de celdas inválido"
            );
        }

            // Enmascarar la parte local desde start hasta el final
        $localMasked = substr($local, 0, $start) . str_repeat($maskChar, $localLength - $start);

        // Enmascarar la parte del dominio desde end hacia atrás
        $domainMasked = str_repeat($maskChar, $domainLength - $end - 1) . substr($domain, $domainLength - $end - 1);

        $response = array(
            "message" => $localMasked . '@' . $domainMasked
        );

        return json_encode($response);
    }

    public function validarAño(): string
    {
    header('Content-Type: application/json');
    // Obtener la fecha de nacimiento de la entrada del usuario
    $fechaNacimiento = $_POST['fechaNacimiento'];

    // Convertir la fecha de nacimiento a un objeto DateTime
    $fechaNacimientoFormat = new DateTime($fechaNacimiento);
    $fechaActual = new DateTime();

    // Obtener el año actual
    $añoActual = $fechaActual->format('Y');

    // Obtener el año de nacimiento
    $añoNacimiento = $fechaNacimientoFormat->format('Y');

    // Calcular la edad
    $edad = $fechaActual->diff($fechaNacimientoFormat)->y;

    // Validar que el año de nacimiento sea menor al año actual
    if ($añoNacimiento >= $añoActual) {
        $response = array(
            "message" => "La fecha de nacimiento debe ser anterior al año actual."
        );
    } elseif ($edad > 150) {
        $response = array(
            "message" => "La persona no puede tener más de 150 años."
        );
    } else {
        $response = array(
            "message" => "Fecha de nacimiento válida."
        );
    }

    return json_encode($response);
}
}

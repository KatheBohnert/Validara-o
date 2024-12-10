<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of CariController
 *
 * @author SoundLutions
 */
class ValidateDateController {

    public function validateDate(\Phalcon\Mvc\Micro $app) {
        $fechaObtenida = $_POST['fechaInicial'];
        $fecha1 = date_create(date($fechaObtenida));
        $fecha2 = date_create(date('Y-m-d h:i:s'));
        $interval = date_diff($fecha1, $fecha2);
        $var = '{
            "fechaCalculada": "'.$interval->format('%d').'"
        }';
        echo $var;
    }

}
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
 * @author rmelo
 */
class LealController {

    //put your code here

    public function validateRut(\Phalcon\Mvc\Micro $app) {
        $estadoRut = $_POST["rut"];
        if ($estadoRut == "1"){
            $validRut = 1;
        }else {
            $validRut = 0;
        }
        $respuesta = '{
            "llaveRut": "'.$validRut.'"
        }';
        echo $respuesta;
      
    }
}

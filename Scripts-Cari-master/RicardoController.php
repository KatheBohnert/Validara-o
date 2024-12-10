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
class RicardoController {

    //put your code here

    public function validateContract(\Phalcon\Mvc\Micro $app) {
       
       $estadoContrato = $_POST["contrato"]; /* POST variable global */
       if ($estadoContrato == "1") { 
           $validContrato = 'si';
       }else {
           $validContrato = 'no';
       }
       $respuesta = '{"llaveContrato": "'.$validContrato.'"}'; /* string con el formato Json */
       echo $respuesta;
    }
}

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
class TestApiController {

    //put your code here

    public function validateApi(\Phalcon\Mvc\Micro $app) {

        $data = file_get_contents('http://osiapppre02.colsanitas.com/osi/api/prestador/usuarios/relaciones/consultarRelacionesDelUsuario?usuario=Legranados&tiporelacion=2');
        $dataArray = explode(',',$data);
        $arrayEmail = explode('"',$dataArray[10]);
        $email = $arrayEmail[3];

        $var = '{
            "email" : "'.$email.'"
        }';

        echo $var;
    }
}

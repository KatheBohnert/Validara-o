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
class ValidationUserController {

    public function validateUser(\Phalcon\Mvc\Micro $app) {
        $id_type = $_POST['tipoId'];
        $id_num = $_POST['numId'];
        if ($id_type=='CC' && $id_num=='1122334455'){
            $validUser = 1;
        } else {
            $validUser = 0;
        }
        $var = '{
            "UsuarioValido": "'.$validUser.'"
        }';
        echo $var;
    }

}
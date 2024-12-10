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
class MateoController {

    //put your code here

    public function validateUserE(\Phalcon\Mvc\Micro $app) {

        
        $users = ['mateo','andres','santiago','juan','paulo','cristian'];
        $userBot = $_POST["user"];
        $valid = 'no';

        for ($i = 0; $i < count($users) ; $i++) {
            if ($users[$i] == $userBot){
                $valid = 'Si';
            }
        }
        $var = '{
            "esuerExist" : "'.$valid.'"
        }';

        echo $var;
    }
}

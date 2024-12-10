<?php


namespace App\Controllers;
/**
 * Description of CariController
 *
 * @author rmelo
 */
class ValidacionprestadoresController {


    public function validatePrestador(\Phalcon\Mvc\Micro $app) {

    $usuarioDocu = $_POST['usuario'];

    $url = 'http://osiapppre02.colsanitas.com/osi/api/prestador/usuarios/relaciones/consultarRelacionesDelUsuario';
    $temporal = '?usuario=';
    // $usuarioDocu ='17007437.prest&';             //DOCTOR
    // $usuarioDocu ='1014249245.prest&';        //ASISTENTE
    // $usuarioDocu = '1072649681.prest&';
    $tipoRelTemp = 'tiporelacion=2';            //Captura tipo de relación
    
    $parametros = $temporal.$usuarioDocu.$tipoRelTemp;

    $data = file_get_contents($url.$parametros, false, stream_context_create(['http'=>['ignore_errors'=> true]]));

    $status_line = $http_response_header[0];
    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    $status = $match[1];

    if ($status !== "200") {
        echo ("unexpected response status: {$status}\n" . $data);
    }
    echo $data;

    $datos = json_decode($data,true);


    $lengthUsuario = sizeof($datos['relacion']);
    if ($lengthUsuario < 1) {
        echo "<br>El usuario no existe";
    };

    $prueba = key($datos['relacion']);

    if (array_key_exists('numId', $datos['relacion'][$prueba]['prestador'])) {

        $numId=($datos['relacion'][$prueba]['prestador']['numId']);
        echo $numId;
    } else {

        $numId='';
        echo $numId;
    };
    
    if (array_key_exists('document', $datos['relacion'][$prueba]['usuario'])) {

        $document=($datos['relacion'][$prueba]['usuario']['document']);
        echo $document;
    } else {

        $document='';
        echo "No hay datos";
    };


    $numId=($datos['relacion'][$prueba]['prestador']['numId']);
    $document=($datos['relacion'][$prueba]['usuario']['document']);
    $tipoId=($datos['relacion'][$prueba]['prestador']['tipoId']);

   

    $tamanoUsuarios=count($datos["relacion"]);

        if ($tamanoUsuarios == 1 and $numId == $document) {
        
            $prestador="Doctor";
            echo $prestador;
       
        }
        else {
            $prestador="Asistente";
            echo $prestador;
        }

        echo json_encode($prestador);
    }
}

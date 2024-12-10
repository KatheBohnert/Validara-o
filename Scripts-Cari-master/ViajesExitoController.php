<?php
namespace App\Controllers;
use Controllers\lib;
use Phalcon\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use SoapClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class ViajesExitoController {

    public function process(\Phalcon\Mvc\Micro $app) {
	 
      header('Access-Control-Allow-Origin: *');
	    $nameController = "IvantiController";
	    $chat_id = $_POST['chat_identification'];
	    $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'convesartion_id' => $_POST['convesartion_id']
        ];
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];
        $token = $_POST['token'];
        if ($useProduction && md5($token) =='da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) {
                case "fixArray":
                    $response = $this->fixArray($app,$params_error_report,$nameController,$chat_id);
                    echo $response;
                    break;
                default:
                    echo("Es necesario indicar el operation");
                    break; 
            }
        } else {
            $response = "useProduction and token is mandatory!";
            echo $response;
        }
    }


   private function fixArray($app,$params_error_report,$nameController,$chat_id){

    $result = $_POST['arreglo'];
    $result_array = json_decode($result, true);
    $final_array = $result_array["payload"];

    // var_dump($final_array);
    // print_r($final_array[0][0]["value"]);
    // print_r($final_array[0]);

    $longitudArray = count($final_array);
    $longitudArray2 = count($final_array[0]);
    // $longitudArray3 = count($final_array[0][0]);
    // print_r($final_array[0][0][0]);


    $newArray = array();
    $newArray2 = array();

    for ($i = 0; $i < $longitudArray; $i++) {
        // print_r($final_array[$i]);
        // $insideArray = $final_array[$i];
        // print_r($insideArray);
        for ($j = 0; $j < $longitudArray2; $j++) {
            $name = $final_array[$i][$j]["name"];
            $value = $final_array[$i][$j]["value"];
            /* $response = new \stdClass();
            array_push($newArray, $name, $value); */ 
            $newArray[$name] = $value;
            
        }
        array_push($newArray2, $newArray);
    }    

   $respuesta = json_encode($newArray2);
	   
   return '{
   	"dinamycArray": '.$respuesta.'
   }';
   
}

   
    
    
        

}
 

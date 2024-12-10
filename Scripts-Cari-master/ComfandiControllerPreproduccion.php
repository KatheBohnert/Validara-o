<?php
namespace App\Controllers;
use Utils\SetLogs;

class ComfandiControllerPreproduccion
{
    public function process(\Phalcon\Mvc\Micro $app)
    {
        
        $nameLog = "ComfandiPreproduccion";
        header('Access-Control-Allow-Origin: *');
        $nameController = "ComfandiControllerPreproduccion";
        $chat_id = $_POST['chat_identification'];
        $params_error_report = [
            'enterprise_id' => $_POST['enterprise_id'],
            'session_id' => $_POST['session_id'],
            'bot_id' => $_POST['bot_id'],
            'convesartion_id' => $_POST['convesartion_id'],
        ];
        $operation = $_POST['operation'];
        $useProduction = $_POST['useProduction'];
        $token = $_POST['token'];
        if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
            switch ($operation) {
                case "validaDerechos":
                    $response = $this->ValidarDerechos($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "validaUsuarioMarcacion":
                    $response = $this->ValidarUsuarioMarcaciones($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "listarCitas":
                    $response = $this->ListarCitas($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "agenda":
                    $response = $this->Agenda($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "anularCita":
                    $response = $this->AnularCitas($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "crearCita":
                    $response = $this->CrearCitas($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "disponibilidad":
                    $response = $this->Disponibilidad($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "validaCitaIncumplida":
                    $response = $this->ValidaCitaIncumplida($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "formatoFecha":
                    $response = $this->formatoFecha($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "obtenerInfo":
                    $response = $this->obtenerInfo($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "validaDerechos2":
                    $response = $this->ValidarDerechos2($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "validaDerechos3":
                    $response = $this->ValidarDerechos3($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "ValidhoraCita":
                    $response = $this->ValidhoraCita($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "addDia":
                    $response = $this->addDia($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;
                case "obtenerInfoCita":
                    $response = $this->obtenerInfoCita($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;   
                case "responseCancelarCitas":
                    $response = $this->responseCancelarCitas($app, $params_error_report, $nameController, $chat_id,$nameLog);
                    echo $response;
                    break;                  
                default:
                    echo ("Es necesario indicar el operation");
                    break;
            }
        } else {
            $response = "useProduction and token is mandatory!";
            echo $response;
        }
    }

        /**
    * Toma la variable $fechaDia, y la comvierte en el formato deseado y le suma un dia mas
    * 
    * @param fechaDia String  fecha desdea por el usuario
    * @param fecha_actua Date convierte la variable fechaDia a Date
    * @param diaSum Date fecha deseada con un dia mas
    * 
    * @author Mateo Peña
    * @return var Variable que contiene la fecha desea mas un dia en formato Json para poder obtener la fecha desde cariai
    */ 

    private function addDia($app, $params_error_report, $nameController, $chat_id,$nameLog){
        $fechaDia = $_POST['fechaDia'];
        $fecha_actual = date($fechaDia);
        $diaSum = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));

        $body = "{}";

        $datos = array(
            "fecha_dia" => $fechaDia,
            "fecha_actual" => $fecha_actual,
        );

        $var = '{
            "diaSum": "' . $diaSum . '"
         }';
        
         \App\Utils\StaticExecuteServicePreproduccion::createLogPreproduccion($var,$body,$chat_identification,$nameFunction,$type="POST",$nameLog, $datos);

        return $var;
    }

    /**
    * Funcion para Validar si el usuario tiene derechos con COMFANDI
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param tipoPaciente String Tipo de contrato o Tipo de paciente (POS o PARTICULAR)
    * @param numeroIdentificacion Int Numero de Identificacion del usuario
    * @param tipoIdentificacion String Tipo de Identificacion del usuario
    *
    * @author Cristian
    * @return var JSON Variables necesarias para poder consumir proximos servicios
    */ 
    

    private function ValidarDerechos($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {
        $urlIn = $_POST['main_url'];
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_vsos/520/zivmf_vsos/zivmf_vsos"; // asmx URL of WSDL
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $nameFunction = "validaDerechos()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $tipo_paciente = $_POST['tipoPaciente'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "tipo_paciente" => $tipo_paciente,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id
        );

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_VSOS>
            <IT_MCAB>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <VALMC>?</VALMC>
               </item>
            </IT_MCAB>
            <IT_MESPE_U>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <FATXT>?</FATXT>
               </item>
            </IT_MESPE_U>
            <IT_MIPS_U>
               <!--Zero or more repetitions:-->
               <item>
                  <ORGID>?</ORGID>
                  <ORGNA>?</ORGNA>
               </item>
            </IT_MIPS_U>
            <IT_MMEDI_U>
               <!--Zero or more repetitions:-->
               <item>
                  <POBNR>?</POBNR>
                  <NMEDI>?</NMEDI>
               </item>
            </IT_MMEDI_U>
            <IT_OTROS_U>
               <!--Zero or more repetitions:-->
               <item>
                  <PLANE>?</PLANE>
                  <TARLS>?</TARLS>
                  <UNTRA>?</UNTRA>
                  <NPERS>?</NPERS>
                  <IPS>?</IPS>
                  <NIPS>?</NIPS>
                  <NUNTRA>?</NUNTRA>
               </item>
            </IT_OTROS_U>
            <IT_SUBES>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <NPERS>?</NPERS>
               </item>
            </IT_SUBES>
            <IT_TCON>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <VISTY>?</VISTY>
               </item>
            </IT_TCON>
            <!--Optional:-->
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_NIDEN>' . $numero_id . '</I_NIDEN>
            <I_TIDEN>' . $tipo_id . '</I_TIDEN>
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
         </urn:ZIVMF_VSOS>
      </soapenv:Body>
   </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);

        // converting
    

        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header></soap-env:Header>',
            '<Header></Header>', $response1);

        $response3 = str_replace('<soap-env:Body>',
            '<Body>', $response2);

        $response4 = str_replace('<n0:ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response3);

        $response5 = str_replace('</n0:ZIVMF_VSOSResponse>',
            '</ZIVMF_VSOSResponse>', $response4);

        $response6 = str_replace('</soap-env:Body>',
            '</Body>', $response5);
        $response7 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response6);

        $parser = simplexml_load_string($response7);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        if (!($response_code < 300 && $response_code > 199)) {

            $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

        }

        $cod_retorno = $parser->Body->ZIVMF_VSOSResponse->E_SOS_ERRORCODE;
        $convenio = $parser->Body->ZIVMF_VSOSResponse->E_CONVENIO;
        $clase_cobertura = $parser->Body->ZIVMF_VSOSResponse->E_CLASECOBER;
        $id_validacion = $parser->Body->ZIVMF_VSOSResponse->E_IDVAL;
        $rango_salarial = $parser->Body->ZIVMF_VSOSResponse->E_RANGOSALARIAL;
        $cod_ips = $parser->Body->ZIVMF_VSOSResponse->E_IPSPRI;

        $var = '{
            "codigoRetornoVD": "' . $cod_retorno . '",
            "convenio": "' . $convenio . '",
            "claseCobertura": "' . $clase_cobertura . '",
            "idValidacion": "' . $id_validacion . '",
            "rangoSalarial": "' . $rango_salarial . '",
            "codigoIPS": "' . $cod_ips . '"
         }';

        return $var;
        //return $response;
    }

        /**
    * Funcion para Validar si el usuario puede continuar con una solicitud en COMFANDI
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param numeroIdentificacion Int Numero de Identificacion del usuario
    * @param tipoIdentificacion String Tipo de Identificacion del usuario
    * @param datos_personales String Aceptacion de tratamiento de datos personales
    * @param terminos_condiciones String Aceptacion de terminos y condiciones (X=Si, Vacio=No)
    *
    * @author Cristian
    * @return var JSON Variables necesarias para poder consumir proximos servicios
    */ 

    private function ValidarUsuarioMarcaciones($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_vali/520/zivmf_vali/zivmf_vali"; // asmx URL of WSDL
        $nameFunction = "validarUsuarioMarcaciones()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $datos_personales = $_POST['datos_personales'];
        $terminos_condiciones = $_POST['terminos_condiciones'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id,
            "datos_personales" => $datos_personales,
            "terminos_condiciones" => $terminos_condiciones
        );

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_VALI>
            <I_APOTR>' . $datos_personales . '</I_APOTR>
            <I_ATERM>' . $terminos_condiciones . '</I_ATERM>
            <!--Optional:-->
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_NIDEN>' . $numero_id . '</I_NIDEN>
            <I_TIDEN>' . $tipo_id . '</I_TIDEN>
         </urn:ZIVMF_VALI>
      </soapenv:Body>
   </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header></soap-env:Header>',
            '<Header></Header>', $response1);

        $response3 = str_replace('<soap-env:Body>',
            '<Body>', $response2);

        $response4 = str_replace('<n0:ZIVMF_VALIResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_VALIResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response3);

        $response5 = str_replace('</n0:ZIVMF_VALIResponse>',
            '</ZIVMF_VALIResponse>', $response4);

        $response6 = str_replace('</soap-env:Body>',
            '</Body>', $response5);
        $response7 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response6);

        $parser = simplexml_load_string($response7);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        if (!($response_code < 300 && $response_code > 199)) {

            $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

        }

        $cod_retorno = $parser->Body->ZIVMF_VALIResponse->E_TIPO;
        $numero_paciente = $parser->Body->ZIVMF_VALIResponse->E_PADEF;
        $id_medico_cabecera = $parser->Body->ZIVMF_VALIResponse->E_ZZMEDICOCAB;

        $var = '{
            "codigoRetornoVUM" : ' . $cod_retorno . ',
            "numeroPaciente" : "' . $numero_paciente . '",
            "medicoCabecera" : "' . $id_medico_cabecera . '"
         }';

        return $var;

    }

    /**
    * Funcion para listar las citas del usuario
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param numeroIdentificacion Int Numero de Identificacion del usuario
    * @param tipoIdentificacion String Tipo de Identificacion del usuario
    * @param espec Int Especializacion medica
    * @param fecha_inicial Date Fecha actual
    *
    * @author Mateo
    * @return var JSON Arreglo de citas, siempre trae en la primera pos. info vacia
    */ 

    private function listarCitas($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_citas/520/zivmf_citas/zivmf_citas"; // asmx URL of WSDL
        $nameFunction = "listarCitas()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $espec = $_POST['espec'];

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "especialidad" => $espec,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id

        );

        // xml post structure
        $hoy = date("Ymd");
        $fecha_inicial = $hoy;
        
        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
         <soapenv:Header/>
         <soapenv:Body>
            <urn:ZIVMF_CITAS>
               <IT_CITAS>
                  <!--Zero or more repetitions:-->
                  <item>
                     <TMNID></TMNID>
                     <EINRI></EINRI>
                     <PATNR></PATNR>
                     <TMNDT></TMNDT>
                     <TMNZT></TMNZT>
                     <ORGID></ORGID>
                     <ORGZU></ORGZU>
                     <FACHR></FACHR>
                     <FATXT></FATXT>
                     <PERNR></PERNR>
                     <NAME1></NAME1>
                     <NAME2></NAME2>
                     <CORDERID></CORDERID>
                     <BELNR></BELNR>
                     <VLRCI></VLRCI>
                  </item>
               </IT_CITAS>
               <!--Optional:-->
               <I_BUKRS>1000</I_BUKRS>
               <!--Optional:-->
               <I_EINRI>' . $centro_sanitario . '</I_EINRI>
               <I_FECHA>' . $fecha_inicial . '</I_FECHA>
               <I_NIDEN>' . $numero_id . '</I_NIDEN>
               <I_TIDEN>' . $tipo_id . '</I_TIDEN>
            </urn:ZIVMF_CITAS>
         </soapenv:Body>
      </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);

        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_CITASResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_CITASResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_CITASResponse>',
            '</ZIVMF_CITASResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);
        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

         $json = json_encode($parser);
         $array = json_decode($json,TRUE);
         $arrayCitas = $array[Body][ZIVMF_CITASResponse][IT_CITAS][item];
      
            
         $citasList = new \stdClass();
         $longitudCitas = sizeof($arrayCitas);


      $citasArray = [];
      if($array[Body][ZIVMF_CITASResponse][E_TIPO]=="2" ){
        return '{
            "dynamicArray":'.json_encode($citasArray).'
            }';
      }else {
        for($i=1;$i<$longitudCitas;$i++){
            $Array = array(
                "MSJ"   =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][FATXT].' - '.$array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][TMNDT],
                "TMNID" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][TMNID],
                "EINRI" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][EINRI],
                "PATNR" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][PATNR],
                "TMNDT" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][TMNDT],
                "TMNZT" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][TMNZT],
                "ORGID" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][ORGID],
                "ORGZU" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][ORGZU],
                "FACHR" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][FACHR],
                "FATXT" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][FATXT],
                "NAME1" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][NAME1],
                "NAME2" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][NAME2],
                "CORDERID" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][CORDERID],
                "BELNR" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][BELNR],
                "VLRCI" =>  $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][VLRCI],
            );
            if($array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][FACHR] == $espec){
                $horaAct = strtotime(date("Y-m-d H:i:s"));
                $horaArray = $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][TMNZT];
                $fechaArray = $array[Body][ZIVMF_CITASResponse][IT_CITAS][item][$i][TMNDT];
                $formatDate = $fechaArray." ".$horaArray;
                $horaCita =  strtotime(date($formatDate));
                if($horaCita>=$horaAct){
                    array_push($citasArray, $Array);
                }
            }

        }

      return '{
        "dynamicArray":'.json_encode($citasArray).'
        }';
      }
    
   }

       /**
    * Funcion para listar las citas del usuario
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param medico Int Numero de medico (Disponibilidad)
    * @param objetivo_planeacion Int Objeetivo de planeacion (Disponibilidad)
    * @param unidad_organizativa String Unidad organizativa (Disponibilidad)
    * @param tipo_cita Int Tipo de cita Primera vez 1 o Control 2
    * @param fecha_deseada String Contiene la fecha deseada en el fomrato (YYYY-MM-DD)
    * @param especialidad Int Especializacion medica
    * @param tipo_paciente String Tipo de contrato o Tipo de paciente (POS o PARTICULAR)
    * @param prestacion String Siempre va vacio
    * @param nombre_unidad String Nombre de la unidad organizativa
    * @param ciclo Int Variable para tener encuenta la opcion de ver mas
    * @param cantidad Int Variable para el numero de opciones a tener en cuenta al momento de listar las opc.
    * @param agenda_medico String Nombre del medico asociado a la agenda
    *
    * @author Cristian
    * @return var JSON Arreglo de citas para agendar con el medico tomado de disponibilidad, se extrae la info necesaria
    * para poder crear la cita.
    */ 

    private function Agenda($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {
        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_agend/520/zivmf_agend/zivmf_agend"; // asmx URL of WSDL
        $nameFunction = "Agenda()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $medico = $_POST['medico'];
        $objetivo_planeacion = $_POST['objetivo_planeacion'];
        $unidad_organizativa = $_POST['unidad_organizativa'];
        $tipo_cita = $_POST['tipo_cita'];
        $fecha_deseada = $_POST['fecha_deseada'];
        $especialidad = $_POST['especialidad'];
        $tipo_paciente = $_POST['tipo_paciente'];
        $prestacion = $_POST['prestacion'];
        $nombre_unidad = $_POST['nombre_unidad'];
        $ciclo = $_POST['ciclo'];
        $cantidad = $_POST['cantidad'];
        $agenda_medico = $_POST['agenda_medico'];
        $inicio = ($ciclo * $cantidad) - $cantidad;
        $final = ($ciclo * $cantidad) - 1;
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "medico" => $medico,
            "obj_planeacion" => $objetivo_planeacion,
            "unidad_organizativa" => $unidad_organizativa,
            "tipo_cita" => $tipo_cita,
            "prestacion" => $prestacion,
            "nombre_unidad" => $nombre_unidad,
            "agenda_medico" => $agenda_medico
        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_AGEND>
            <IT_AGEND>
               <!--Zero or more repetitions:-->
               <item>
                  <PERNR></PERNR>
                  <ENDYEAR></ENDYEAR>
                  <KWNO></KWNO>
                  <POBNR></POBNR>
                  <ORGZU></ORGZU>
                  <SYUZEIT_DT></SYUZEIT_DT>
                  <SYUZEIT_D1></SYUZEIT_D1>
                  <SYUZEIT_D2></SYUZEIT_D2>
                  <SYUZEIT_D3></SYUZEIT_D3>
                  <SYUZEIT_D4></SYUZEIT_D4>
                  <SYUZEIT_D5></SYUZEIT_D5>
                  <SYUZEIT_D6></SYUZEIT_D6>
                  <SYUZEIT_D7></SYUZEIT_D7>
               </item>
            </IT_AGEND>
            <!--Optional:-->
            <I_FACHR>' . $especialidad . '</I_FACHR>
            <I_FECHA>' . $fecha_deseada . '</I_FECHA>
            <I_ORGID>' . $unidad_organizativa . '</I_ORGID>
            <I_PERNR>' . $medico . '</I_PERNR>
            <I_POBNR>' . $objetivo_planeacion . '</I_POBNR>
            <!--Optional:-->
            <I_TARLS></I_TARLS>
            <!--Optional:-->
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
            <I_VISTY>' . $tipo_cita . '</I_VISTY>
         </urn:ZIVMF_AGEND>
      </soapenv:Body>
   </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_AGENDResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_AGENDResponse>',
            '</ZIVMF_AGENDResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);

        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        $longitudAgenda = sizeof($parser->Body->ZIVMF_AGENDResponse->IT_AGEND->item);
        $listaAgendaValidar = $parser->Body->ZIVMF_AGENDResponse->IT_AGEND->item;
        
        $error_code = $parser->Body->ZIVMF_AGENDResponse->E_TIPO;

        $calendario_sem = array();

        $c_dia1= $parser->Body->ZIVMF_AGENDResponse->E_DIA1;
        $c_dia2= $parser->Body->ZIVMF_AGENDResponse->E_DIA2;
        $c_dia3= $parser->Body->ZIVMF_AGENDResponse->E_DIA3;
        $c_dia4= $parser->Body->ZIVMF_AGENDResponse->E_DIA4;
        $c_dia5= $parser->Body->ZIVMF_AGENDResponse->E_DIA5;
        $c_dia6= $parser->Body->ZIVMF_AGENDResponse->E_DIA6;
        $c_dia7= $parser->Body->ZIVMF_AGENDResponse->E_DIA7;

        array_push($calendario_sem, $c_dia1, $c_dia2, $c_dia3, $c_dia4, $c_dia5, $c_dia6, $c_dia7);

        for ($i=0; $i <= 7; $i++){
//echo $fecha_deseada.'-----'.$calendario_sem[$i];
            if ($fecha_deseada == $calendario_sem[$i]){
                $valorDia = $i+1;
            }
        }

        $listaAgendaValidar2 = array();
        $long = sizeof($listaAgendaValidar);
        for($i=0;$i<$long;$i++){
            $pos = "SYUZEIT_D".$valorDia;
            $dia1 = $listaAgendaValidar[$i]->$pos;
            if (strlen($dia1->__toString()) != 0){
                array_push($listaAgendaValidar2, $listaAgendaValidar[$i]);
             }
        }

        $listaAgenda = array();
        $temporalArray = array();
        
            if ($final > ($longitudAgenda - 1)) {
                //$rest = $final - ($longitud2);
                for ($i = $inicio; $i < $longitudAgenda; $i++) {
                    array_push($temporalArray, $listaAgendaValidar2[$i]);
                }
            } else {

                for ($i = $inicio; $i <= $final; $i++) {
                    array_push($temporalArray, $listaAgendaValidar2[$i]);
                }
            }

        $response1 = new \stdClass();
        
        
        $validadorCantidad = sizeof($listaAgendaValidar2) / $longitudAgenda;
        $response1->numVerMas = ceil($validadorCantidad * ceil($longitudAgenda / $cantidad));

        $j = 0;
        $longitud = sizeof($temporalArray);
        for ($j = 0; $j < $longitud; $j++) {

            $hora_cita = $temporalArray[$j]->SYUZEIT_DT;
            $pos = "SYUZEIT_D".$valorDia;
            //echo 'aquiiiiiii: '.$valorDia;
            $dia1 = $temporalArray[$j]->$pos;

            if ($dia1 != null){

                if (strlen($dia1->__toString()) != 0){

                    $diaescogido = $dia1->__toString();

                    $horaCita = json_encode($hora_cita);
                    $horaCita = substr($horaCita, 6, -2);
    
                    $duracion = substr($diaescogido, 7, -37);
                    $tipoPlanificacion = substr($diaescogido, 12, -28);
                    $sala = substr($diaescogido, 39, -1);
    
                    $opciones = 'Fecha : '.$fecha_deseada.' Hora: '.$horaCita.' IPS: '.$nombre_unidad.' Profesional: '.$agenda_medico.'';
    
                    $response1->arrayDinamico[$j]->horaCita = $horaCita;
                    $response1->arrayDinamico[$j]->duracion = $duracion;
                    $response1->arrayDinamico[$j]->tipoPlanificacion = $tipoPlanificacion;
                    $response1->arrayDinamico[$j]->sala = $sala;
                    $response1->arrayDinamico[$j]->opciones = $opciones;
                }
            }
        }
      
        return \GuzzleHttp\json_encode($response1);
        //return $response;

    }

           /**
    * Funcion para listar las citas del usuario
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param medico Int Numero de medico (Disponibilidad)
    * @param numeroIdentificacion Int Numero de Identificacion del usuario
    * @param tipoIdentificacion String Tipo de Identificacion del usuario
    * @param id_cita Int Id de la cita a cancelar
    * @param motivo_anulacion String Valor unico XVR
    * @param grabacion_log String Valor unico X
    *
    * @author Mateo
    * @return var JSON confirmando si la cita fue cancelada o no y el motivo
    */ 

    private function AnularCitas($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        
        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_ccita/520/zivmf_ccita/zivmf_ccita"; // asmx URL of WSDL
        $nameFunction = "AnularCitas()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $numero_id = $_POST['numeroIdentificacion'];
        $id_cita = $_POST['id_cita'];
        $motivo_anulacion = $_POST['motivo_anulacion'];
        $grabacion_log = $_POST['grabacion_log'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "id_cita" => $id_cita,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id,
            "motivo_anulacion" => $motivo_anulacion,
            "grabacion_log" => $grabacion_log

        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
         <soapenv:Header/>
         <soapenv:Body>
            <urn:ZIVMF_CCITA>
               <!--Optional:-->
               <I_GRLOG>' . $grabacion_log . '</I_GRLOG>
               <I_NIDEN>' . $numero_id . '</I_NIDEN>
               <I_SS_STOID>' . $motivo_anulacion . '</I_SS_STOID>
               <I_TIDEN>' . $tipo_id . '</I_TIDEN>
               <I_TMNID>' . $id_cita . '</I_TMNID>
            </urn:ZIVMF_CCITA>
         </soapenv:Body>
      </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);

        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
        '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',$response);

        $response2 = str_replace('<soap-env:Header>',
                        '<Header>',$response1);

        $response3 = str_replace('</soap-env:Header>',
                        '</Header>',$response2);

        $response4 = str_replace('<soap-env:Body>',
                        '<Body>',$response3);

        $response5 = str_replace('<n0:ZIVMF_CCITAResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
                        '<ZIVMF_CITASResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',$response4);

        $response6 = str_replace('</n0:ZIVMF_CCITAResponse>',
                        '</ZIVMF_CITASResponse>',$response5);

        $response7 = str_replace('</soap-env:Body>',
                        '</Body>',$response6);
        $response8 = str_replace('</soap-env:Envelope>',
                        '</Envelope>',$response7);

        $parser = simplexml_load_string($response8);


        $json = json_encode($parser);
        $array = json_decode($json,TRUE);
        $msjCita = $array[Body][ZIVMF_CITASResponse][E_MENS];
        $codOperation = $array[Body][ZIVMF_CITASResponse][E_TIPO];

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);
     
        if($response_code == 200 && !$response){
            return '{
               "codOpe":"'.$response_code.'"
            }';
        }
        return '{
            "msjCita": "'.$msjCita.'",
            "codOperation": "'.$codOperation.'",
            "codOpe":"'.$response_code.'"
            }';

    }
    
private function ValidhoraCita($app, $params_error_report, $nameController, $chat_id,$nameLog){
    date_default_timezone_set("America/Bogota"); 
    $chat_identification = $_POST['chat_identification'];
    $enterprise_id = $_POST['enterprise_id'];
    $bot_id = $_POST['bot_id'];
    $session_id = $_POST['session_id'];
    $convesartion_id = $_POST['convesartion_id'];
    $horaCita = $_POST['horaCita'];
    $diaCita = $_POST['diaCita'];

    $datos = array(
        "hora_cita" => $horaCita,
        "dia_cita" => $diaCita
    );

    $body = "{}";

    $horaCitaPlus= date($horaCita); 
    $NuevaFecha = strtotime ( '-2 hour' , strtotime ($horaCitaPlus) ) ; 
    $NuevaFecha = date ( 'H:i:s' , $NuevaFecha); 

    $hora1 = strtotime(date('H:i:s'));
    $hora2 = strtotime($NuevaFecha);

    $diaCita= strtotime(date($diaCita)); 
    $diaCanel = strtotime(date ('Y-m-d'));

    if($diaCita == $diaCanel ){
        if( $hora1 > $hora2 ) {
            $var = '{
                "codValidacion": "1"
                }';
        } else {
            $var = '{
                "codValidacion": "2"
                }';
        } 
    }else{
        $var = '{
            "codValidacion": "2"
            }'; 
    }

    \App\Utils\StaticExecuteServicePreproduccion::createLog($var,$body,$chat_identification,$nameFunction,$type="POST",$nameLog, $datos);

    return $var;

}

    /**
    * Funcion para crear la cita tomando las variables de los servicios anteriores
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param numeroIdentificacion Int Numero de identificacion del Usuario
    * @param tipoIdentificacion String Tipo de identificacion del Usuario
    * @param especialidad String Especialidad medica
    * @param medico Int Numero del medico escogido
    * @param paciente Int Numero del paciente o usuario
    * @param fecha_cita String Fecha de la cita deseada
    * @param hora_cita Int Hora de la cita escogida
    * @param duracion_cita Int Duracion de la cita
    * @param tipo_planificacion Int Tipo de planificacion (Agenda)
    * @param unidad_organizativa Int Unidad organizativa seleccionada (Agenda)
    * @param unidad_organizativa_medica Int Unidad organizativa medica seleccionada (Agenda)
    * @param habitacion Int Numero de haitacion (Agenda)
    * @param objetivo_planeacion Int Objetivo de planeacion (Agenda)
    * @param tipo_cita Int Tipo de cita Primera vez 1 o Control 2
    * @param fecha_deseada String Fecha deseada de la cita
    * @param observaciones String Variable vacia
    * @param convenio String Convenio del usuario (Validar Derechos)
    * @param codigo_retorno Int Codigo retorno del servicio (0)
    * @param rango_salarial String Rango salarial del usuario (Validar Derechos)
    * @param clase_cobertura String Clase de cobertura del usuario (Validar Derechos)
    * @param id_validacion Int Variable obtenidad de Validar Usuario Marcacion (Siempre cambia cunado se corre el WS VUM)
    * @param tipo_paciente String Tipo de contrato o Paciente
    * @param prestacion String Siempre va vacio
    *
    *
    * @author Cristian
    * @return var JSON Informacion de la cita creada.
    */ 


    private function CrearCitas($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_crciv/520/zivmf_crciv/zivmf_crciv"; // asmx URL of WSDL
        $nameFunction = "CrearCitas()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $especialidad = $_POST['especialidad'];
        $medico = $_POST['medico'];
        $paciente = $_POST['paciente'];
        $fecha_cita = $_POST['fecha_cita'];
        $hora_cita = $_POST['hora_cita'];
        $duracion_cita = $_POST['duracion_cita'];
        $tipo_planificacion = $_POST['tipo_planificacion'];
        $unidad_organizativa = $_POST['unidad_organizativa'];
        $unidad_organizativa_medica = $_POST['unidad_organizativa_medica'];
        $habitacion = $_POST['habitacion'];
        $objetivo_planeacion = $_POST['objetivo_planeacion'];
        $tipo_cita = $_POST['tipo_cita'];
        $fecha_deseada = $_POST['fecha_deseada'];
        $observaciones = $_POST['observaciones'];
        $convenio = $_POST['convenio'];
        $codigo_retorno = $_POST['codigo_retorno'];
        $rango_salarial = $_POST['rango_salarial'];
        $clase_cobertura = $_POST['clase_cobertura'];
        $id_validacion = $_POST['id_validacion'];
        $tipo_paciente = $_POST['tipo_paciente'];
        $prestacion = $_POST['prestacion'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id,
            "especialidad" => $especialidad,
            "medico" => $medico,
            "paciente" => $paciente,
            "fecha_cita" => $fecha_cita,
            "hora_cita" => $hora_cita,
            "duracion_cita" => $duracion_cita,
            "tipo_planificacion" => $tipo_planificacion,
            "unidad_organizativa" => $unidad_organizativa,
            "unidad_organizativa_medica" => $unidad_organizativa_medica,
            "habitacion" => $habitacion,
            "obj_planeacion" => $objetivo_planeacion,
            "tipo_cita" => $tipo_cita,
            "fecha_deseada" => $fecha_deseada,
            "observaciones" => $observaciones,
            "convenio" => $convenio,
            "codigo_retorno" => $codigo_retorno,
            "clase_cobertura" => $clase_cobertura,
            "id_validacion" => $id_validacion,
            "tipo_paciente" => $tipo_paciente,
            "prestacion" => $prestacion
        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
         <soapenv:Header/>
         <soapenv:Body>
            <urn:ZIVMF_CRCIV>
               <I_CLASECOBER>' . $clase_cobertura . '</I_CLASECOBER>
               <I_CONVENIO>' . $convenio . '</I_CONVENIO>
               <I_DSPTY>' . $tipo_planificacion . '</I_DSPTY>
               <!--Optional:-->
               <I_EINRI>' . $centro_sanitario . '</I_EINRI>
               <I_FACHR>' . $especialidad . '</I_FACHR>
               <I_FDESE>' . $fecha_deseada . '</I_FDESE>
               <I_FECHA>' . $fecha_cita . '</I_FECHA>
               <I_HORA>' . $hora_cita . '</I_HORA>
               <I_IDVAL>' . $id_validacion . '</I_IDVAL>
               <I_NIDEN>' . $numero_id . '</I_NIDEN>
               <I_OBSER>' . $observaciones . '</I_OBSER>
               <I_ORGFA>' . $unidad_organizativa_medica . '</I_ORGFA>
               <I_ORGPF>' . $unidad_organizativa . '</I_ORGPF>
               <I_PATNR>' . $paciente . '</I_PATNR>
               <I_PERNR>' . $medico . '</I_PERNR>
               <I_POBNR>' . $objetivo_planeacion . '</I_POBNR>
               <I_RANGOSALARIAL>' . $rango_salarial . '</I_RANGOSALARIAL>
               <I_SOS_ERRORCODE>' . $codigo_retorno . '</I_SOS_ERRORCODE>
               <!--Optional:-->
               <I_TARLS>' . $prestacion . '</I_TARLS>
               <I_TIDEN>' . $tipo_id . '</I_TIDEN>
               <I_TIPOC>' . $tipo_cita . '</I_TIPOC>
               <I_TMNDR>' . $duracion_cita . '</I_TMNDR>
               <I_TPACI>' . $tipo_paciente . '</I_TPACI>
               <I_ZIMMR>' . $habitacion . '</I_ZIMMR>
                  </urn:ZIVMF_CRCIV>
         </soapenv:Body>
      </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
        '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',$response);

        $response2 = str_replace('<soap-env:Header></soap-env:Header>',
        '<Header></Header>',$response1);

        $response3 = str_replace('<soap-env:Body>',
        '<Body>',$response2);

        $response4 = str_replace('<n0:ZIVMF_CRCIVResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
        '<ZIVMF_CRCIVResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',$response3);

        $response5 = str_replace('</n0:ZIVMF_CRCIVResponse>',
        '</ZIVMF_CRCIVResponse>',$response4);

        $response6 = str_replace('</soap-env:Body>',
        '</Body>',$response5);

        $response7 = str_replace('</soap-env:Envelope>',
        '</Envelope>',$response6);

        $parser = simplexml_load_string($response7);

        $this->createLog($parser,$xml_post_string,$chat_id,$nameFunction,"POST");

        $codCita = $parser->Body->ZIVMF_CRCIVResponse->E_CITA;
        $valorCita = $parser->Body->ZIVMF_CRCIVResponse->E_COPAGO;

        $var = '{
            "codigoCita" : "'.$codCita.'",
            "valorCita" : "'.$valorCita.'"
        }';

        return $var;

    }

    /**
    * Funcion para consultar la disponibilidad de medicos en una fecha deseada
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param unidad_organizativa Int Unidad organizativa seleccionada (ValidarDerechos)
    * @param especialidad String Especialidad medica
    * @param fecha_deseada String Fecha deseada de la cita
    * @param tipo_cita Int Tipo de cita Primera vez 1 o Control 2
    * @param id_medico_cabecera Int Variable que contiene el medico cabecera, es posible que venga vacio este campo 
    *(Validar Usuario Marcacion)
    * @param tipo_paciente String Tipo de contrato o Paciente
    * @param prestacion String Siempre va vacio
    *
    *
    * @author Cristian
    * @return var JSON Arreglo de los 3 primeros medicos disponibles, con la unidad organizativa.
    */ 


    private function Disponibilidad($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_disp/520/zivmf_disp/zivmf_disp"; // asmx URL of WSDL
        $nameFunction = "Disponibilidad()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $unidad_organizativa = $_POST['unidad_organizativa'];
        $especialidad = $_POST['especialidad'];
        $fecha_deseada = $_POST['fecha_deseada'];
        $tipo_cita = $_POST['tipo_cita'];
        $id_medico_cabecera = $_POST['id_medico_cabecera'];
        $tipo_paciente = $_POST['tipo_paciente'];
        $prestacion = $_POST['prestacion'];
        $intento = $_POST['intento'];
        $intento = intval($intento);

        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "unidad_organizativa" => $unidad_organizativa,
            "especialidad" => $especialidad,
            "fecha_deseada" => $fecha_deseada,
            "tipo_cita" => $tipo_cita,
            "id_medico_cabecera" => $tipo_paciente,
            "prestacion" => $prestacion
        );

        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_DISP>
            <IT_DISPO>
               <!--Zero or more repetitions:-->
               <item>
                  <PERNR></PERNR>
                  <ENDYEAR></ENDYEAR>
                  <KWNO></KWNO>
                  <POBNR></POBNR>
                  <ORGZU></ORGZU>
                  <SYUZEIT_DT></SYUZEIT_DT>
                  <SYUZEIT_D1></SYUZEIT_D1>
                  <SYUZEIT_D2></SYUZEIT_D2>
                  <SYUZEIT_D3></SYUZEIT_D3>
                  <SYUZEIT_D4></SYUZEIT_D4>
                  <SYUZEIT_D5></SYUZEIT_D5>
                  <SYUZEIT_D6></SYUZEIT_D6>
                  <SYUZEIT_D7></SYUZEIT_D7>
               </item>
            </IT_DISPO>
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_FACHR>' . $especialidad . '</I_FACHR>
            <I_FECHA>' . $fecha_deseada . '</I_FECHA>
            <I_ORGID>' . $unidad_organizativa . '</I_ORGID>
            <!--Optional:-->
            <I_TARLS></I_TARLS>
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
            <I_VISTY>' . $tipo_cita . '</I_VISTY>
            <I_ZZMEDICOCAB>' . $id_medico_cabecera . '</I_ZZMEDICOCAB>
         </urn:ZIVMF_DISP>
      </soapenv:Body>
        </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header>',
            '<Header>', $response1);

        $response3 = str_replace('</soap-env:Header>',
            '</Header>', $response2);

        $response4 = str_replace('<soap-env:Body>',
            '<Body>', $response3);

        $response5 = str_replace('<n0:ZIVMF_DISPResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_DISPResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response4);

        $response6 = str_replace('</n0:ZIVMF_DISPResponse>',
            '</ZIVMF_DISPResponse>', $response5);

        $response7 = str_replace('</soap-env:Body>',
            '</Body>', $response6);

        $response8 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response7);

        $parser = simplexml_load_string($response8);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        if (!($response_code < 300 && $response_code > 199)) {

            $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

        }

        $medico = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->PERNR;
        $objetivoPlanificacion = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->POBNR;
        $nombreUO = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->ORGZU;
        $dia1 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D1;
        $dia2 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D2;
        $dia3 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D3;
        $dia4 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D4;
        $dia5 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D5;
        $dia6 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D6;
        $dia7 = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item[$intento]->SYUZEIT_D7;

        
        $IT_DISPO = $parser->Body->ZIVMF_DISPResponse->IT_DISPO->item;

       // echo json_encode($IT_DISPO);
        $i = 1;
        $fecha_deseada2 = str_replace("-", "", $fecha_deseada);
        $dispoClass = new \stdClass();
        $dispoArray = array();
        $j = 0;
        foreach ($IT_DISPO as $disp) {

            for ($i = 1; $i <= 7; $i++) {
                $pos = "SYUZEIT_D" . $i;
                $SYUZEIT = $disp->$pos;
//                $SYUZEIT = $disp->SYUZEIT_D2;
//                echo "SYUZEIT:".$SYUZEIT;

                if ($SYUZEIT) {
                    $SYUZEITArray = explode("|", $SYUZEIT);
                    $dateSYUZEIT = $SYUZEITArray[4];

                    if ($fecha_deseada2 == $dateSYUZEIT) {

                        $PERNR = $disp->PERNR;
                        $POBNR = $disp->POBNR;
                        $ORGZU = $disp->ORGZU;
                        $obj = new \stdClass();
                        $obj->medicoDisponible = "$PERNR";
                        $obj->objetivoPlanificacion2 = "$POBNR";
                        $obj->unidadOrganizativaDisponible = $SYUZEITArray[3];
                        $obj->nombreUnidadOganizativa = "$ORGZU";
                        $dispoArray[] = $obj;
                        $j++;
                        break;

                    }
                }
            }

            if ($j >= 3){
                break;
            }
        }
        $dispoClass->dispArray = $dispoArray;
        $dispoClass->rawResponse = $parser;
        
        return json_encode($dispoClass);

    }

        /**
    * Funcion para validar si el usuario tiene una cita incumplida
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param numeroIdentificacion Int Numero de identificacion del Usuario
    * @param tipoIdentificacion String Tipo de identificacion del Usuario
    * @param especialidad String Especialidad medica
    * @param numero_paciente Int Numero del paciente (Validar Usuario Marcacion)
    *
    *
    * @author Cristian
    * @return var JSON Booleano valdiando si el usuario tiene una cita incumplida o no
    */ 

    private function ValidaCitaIncumplida($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        
        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_valci/520/zivmf_valci/zivmf_valci"; // asmx URL of WSDL
        $nameFunction = "ValidaCitaIncumplida()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $especialidad = $_POST['especialidad'];
        $numero_paciente = $_POST['numero_paciente'];

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "numero_id" => $numero_id,
            "tipo_id" => $tipo_id,
            "especialidad" => $especialidad,
            "numero_paciente" => $numero_paciente
        );


        $xml_post_string = '
      <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
         <soapenv:Header/>
         <soapenv:Body>
            <urn:ZIVMF_VALCI>
               <!--Optional:-->
               <I_EINRI>' . $centro_sanitario . '</I_EINRI>
               <I_FACHR>' . $especialidad . '</I_FACHR>
               <I_NIDEN>' . $numero_id . '</I_NIDEN>
               <I_PATNR>' . $numero_paciente . '</I_PATNR>
               <I_TIDEN>' . $tipo_id . '</I_TIDEN>
            </urn:ZIVMF_VALCI>
         </soapenv:Body>
      </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);
        
        $diferencia = $info['total_time'];
        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header></soap-env:Header>',
            '<Header></Header>', $response1);

        $response3 = str_replace('<soap-env:Body>',
            '<Body>', $response2);

        $response4 = str_replace('<n0:ZIVMF_VALCIResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_VALCIResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response3);

        $response5 = str_replace('</n0:ZIVMF_VALCIResponse>',
            '</ZIVMF_VALCIResponse>', $response4);

        $response6 = str_replace('</soap-env:Body>',
            '</Body>', $response5);
        $response7 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response6);

        $parser = simplexml_load_string($response7);
        $this->createLog($parser,$xml_post_string,$chat_id,$nameFunction,"POST");

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        if (!($response_code < 300 && $response_code > 199)) {

            $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

        }

        $var = '{
            "citaIncumplida":' . $parser->Body->ZIVMF_VALCIResponse->E_TIPO . '
         }';

        return $var;

    }

    public function formatoFecha($app, $chat_identification, $nameController, $nameFunction,$nameLog)
    {
        date_default_timezone_set('America/Bogota');
        $fecha_deseada = $_POST['fecha_deseada'];

        $fecha_deseada2 = substr($fecha_deseada, 0, -9);
        
        $hora1 = date("Y-m-d H:i:s");
        $hora2 = date($fecha_deseada);

        $datos = array (
            "fecha_deseada" => $fecha_deseada,
            "hora" => $hora2,
            "hora_actual" => $hora1,

        );

        $body = "{}";
        
        if($hora2<=$hora1){
            $validFecha = 0;
        } else {
            $validFecha = 0;
        }

        $var = '{
            "fecha" : "' . $fecha_deseada2 . '", 
            "validFecha" : "' . $validFecha . '"
        }';

        \App\Utils\StaticExecuteServicePreproduccion::createLog($var,$body,$chat_identification,$nameFunction,$type="POST",$nameLog, $datos);

        return $var;

    }

    public function obtenerInfo($app, $chat_identification, $nameController, $nameFunction,$nameLog)
    {

        $info = $_POST['info'];

        $datos = array (
            "info" => $info,
        );

        $body = "{}";

        $medico = substr($info, 0, -29);
        $medico = substr($medico, 5);
        $objetivo_planeacion = substr($info, 0, -18);
        $objetivo_planeacion = substr($objetivo_planeacion, 16);
        $fecha_disponible = substr($info, 36);

        $fecha_disponible = substr_replace($fecha_disponible, '-', 4, 0);
        $fecha_disponible = substr_replace($fecha_disponible, '-', 7, 0);

        $var = '{
         "medico" : "' . $medico . '",
         "objetivoPlaneacion" : "' . $objetivo_planeacion . '",
         "fechaSeleccionada" : "' . $fecha_disponible . '"
        }';

        \App\Utils\StaticExecuteServicePreproduccion::createLog($var,$datos,$chat_identification,$nameFunction,$type="POST",$nameLog, $datos);


        return $var;

    }

        /**
    * Funcion para Extraer la unidad organizativa asociada al usuario ingresado y especialidad escogida
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param tipoPaciente String Tipo de contrato o Tipo de paciente (POS o PARTICULAR)
    * @param numeroIdentificacion Int Numero de Identificacion del usuario
    * @param tipoIdentificacion String Tipo de Identificacion del usuario
    *
    * @author Cristian
    * @return var JSON Codigo Unidad Organizativa
    */ 

    private function ValidarDerechos2($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_vsos/520/zivmf_vsos/zivmf_vsos"; // asmx URL of WSDL
        $nameFunction = "validaDerechos2()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $tipo_paciente = $_POST['tipoPaciente'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $especialidad = $_POST['especialidad'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "tipo_paciente" => $tipo_paciente,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id,
            "especialidad" => $especialidad
        );

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_VSOS>
            <IT_MCAB>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <VALMC>?</VALMC>
               </item>
            </IT_MCAB>
            <IT_MESPE_U>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <FATXT>?</FATXT>
               </item>
            </IT_MESPE_U>
            <IT_MIPS_U>
               <!--Zero or more repetitions:-->
               <item>
                  <ORGID>?</ORGID>
                  <ORGNA>?</ORGNA>
               </item>
            </IT_MIPS_U>
            <IT_MMEDI_U>
               <!--Zero or more repetitions:-->
               <item>
                  <POBNR>?</POBNR>
                  <NMEDI>?</NMEDI>
               </item>
            </IT_MMEDI_U>
            <IT_OTROS_U>
               <!--Zero or more repetitions:-->
               <item>
                  <PLANE>?</PLANE>
                  <TARLS>?</TARLS>
                  <UNTRA>?</UNTRA>
                  <NPERS>?</NPERS>
                  <IPS>?</IPS>
                  <NIPS>?</NIPS>
                  <NUNTRA>?</NUNTRA>
               </item>
            </IT_OTROS_U>
            <IT_SUBES>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <NPERS>?</NPERS>
               </item>
            </IT_SUBES>
            <IT_TCON>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <VISTY>?</VISTY>
               </item>
            </IT_TCON>
            <!--Optional:-->
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_NIDEN>' . $numero_id . '</I_NIDEN>
            <I_TIDEN>' . $tipo_id . '</I_TIDEN>
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
         </urn:ZIVMF_VSOS>
      </soapenv:Body>
   </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);


        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header></soap-env:Header>',
            '<Header></Header>', $response1);

        $response3 = str_replace('<soap-env:Body>',
            '<Body>', $response2);

        $response4 = str_replace('<n0:ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response3);

        $response5 = str_replace('</n0:ZIVMF_VSOSResponse>',
            '</ZIVMF_VSOSResponse>', $response4);

        $response6 = str_replace('</soap-env:Body>',
            '</Body>', $response5);
        $response7 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response6);

        $parser = simplexml_load_string($response7);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        if (!($response_code < 300 && $response_code > 199)) {

            $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

        }

        $longitudMedicos = sizeof($parser->Body->ZIVMF_VSOSResponse->IT_MIPS_U->item);
        $listadoMedicosEsp = array();

        $j = 1;

        for ($j = 1; $j <= $longitudMedicos; $j++) {

            $tabla_medicos = $parser->Body->ZIVMF_VSOSResponse->IT_MIPS_U->item[$j]->ORGID;
            array_push($listadoMedicosEsp, $tabla_medicos);

        }

        $longitudEspecialidades = sizeof($listadoMedicosEsp);

        $i = 0;

        for ($i = 0; $i <= $longitudEspecialidades; $i++) {

            $valorArray = $listadoMedicosEsp[$i];
            $valorArray2 = substr($valorArray, 0, 4);

            if ($valorArray2 == $especialidad) {

                $unidadEspecialidad = $valorArray;
                break;

            }
        }

        $unidadEspecialidad = substr($unidadEspecialidad, 5);

        $var = '{
         "unidadOrganizativa" : "' . $unidadEspecialidad . '"
      }';

        return $var;
    }

    /**
    * Funcion para Extraer el nombre completo del medico escogido
    * 
    * @param main_url String  url del ambiente de trabajo (produccion o preproduccion)
    * @param soap_user String Usuario SOAP
    * @param soap_pass String Key SOAP
    * @param centroSanitario String Centro Sanitario de COMFANDI
    * @param tipoPaciente String Tipo de contrato o Tipo de paciente (POS o PARTICULAR)
    * @param numeroIdentificacion Int Numero de Identificacion del usuario
    * @param tipoIdentificacion String Tipo de Identificacion del usuario
    *
    * @author Cristian
    * @return var JSON Nombre completo del medico para la agendacion de la cita
    */ 

    private function ValidarDerechos3($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {

        $urlIn = $_POST['main_url'];
        $soapUser = $_POST['soap_user']; //  username
        $soapPassword = $_POST['soap_pass']; // password
        $soapUrl = $urlIn.":8000/sap/bc/srt/rfc/sap/zivmf_vsos/520/zivmf_vsos/zivmf_vsos"; // asmx URL of WSDL
        $nameFunction = "validaDerechos2()";
        $chat_identification = $_POST['chat_identification'];
        $enterprise_id = $_POST['enterprise_id'];
        $bot_id = $_POST['bot_id'];
        $session_id = $_POST['session_id'];
        $convesartion_id = $_POST['convesartion_id'];
        $centro_sanitario = $_POST['centroSanitario'];
        $tipo_paciente = $_POST['tipoPaciente'];
        $numero_id = $_POST['numeroIdentificacion'];
        $tipo_id = $_POST['tipoIdentificacion'];
        $cod_medico = $_POST['cod_medico'];
        // xml post structure

        $datos = array(
            "main_url" => $urlIn,
            "soap_user" => $soapUser,
            "soap_password" => $soapPassword,
            "centro_sanitario" => $centro_sanitario,
            "tipo_paciente" => $tipo_paciente,
            "numero_identificacion" => $numero_id,
            "tipo_identificacion" => $tipo_id,
            "codigo_medico" => $cod_medico
        );

        $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sap-com:document:sap:rfc:functions">
      <soapenv:Header/>
      <soapenv:Body>
         <urn:ZIVMF_VSOS>
            <IT_MCAB>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <VALMC>?</VALMC>
               </item>
            </IT_MCAB>
            <IT_MESPE_U>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <FATXT>?</FATXT>
               </item>
            </IT_MESPE_U>
            <IT_MIPS_U>
               <!--Zero or more repetitions:-->
               <item>
                  <ORGID>?</ORGID>
                  <ORGNA>?</ORGNA>
               </item>
            </IT_MIPS_U>
            <IT_MMEDI_U>
               <!--Zero or more repetitions:-->
               <item>
                  <POBNR>?</POBNR>
                  <NMEDI>?</NMEDI>
               </item>
            </IT_MMEDI_U>
            <IT_OTROS_U>
               <!--Zero or more repetitions:-->
               <item>
                  <PLANE>?</PLANE>
                  <TARLS>?</TARLS>
                  <UNTRA>?</UNTRA>
                  <NPERS>?</NPERS>
                  <IPS>?</IPS>
                  <NIPS>?</NIPS>
                  <NUNTRA>?</NUNTRA>
               </item>
            </IT_OTROS_U>
            <IT_SUBES>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <NPERS>?</NPERS>
               </item>
            </IT_SUBES>
            <IT_TCON>
               <!--Zero or more repetitions:-->
               <item>
                  <FACHR>?</FACHR>
                  <VISTY>?</VISTY>
               </item>
            </IT_TCON>
            <!--Optional:-->
            <I_EINRI>' . $centro_sanitario . '</I_EINRI>
            <I_NIDEN>' . $numero_id . '</I_NIDEN>
            <I_TIDEN>' . $tipo_id . '</I_TIDEN>
            <I_TPACI>' . $tipo_paciente . '</I_TPACI>
         </urn:ZIVMF_VSOS>
      </soapenv:Body>
   </soapenv:Envelope>'; // data from the form, e.g. some ID number

        $headers = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Content-length: " . strlen($xml_post_string),
        ); //SOAPAction: your op URL

        $url = $soapUrl;

        $diferencia = $info['total_time'];

        $this->MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url);

        $response = \App\Utils\StaticExecuteServicePreproduccion::executeCurlSOAPPreproduccion($chat_identification, $nameController, $nameFunction, $app, $url, $soapUser, $soapPassword, $xml_post_string, $headers, $nameLog, $datos);
        
        $response1 = str_replace('<soap-env:Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">',
            '<Envelope xmlns:soap-env="http://schemas.xmlsoap.org/soap/envelope/">', $response);

        $response2 = str_replace('<soap-env:Header></soap-env:Header>',
            '<Header></Header>', $response1);

        $response3 = str_replace('<soap-env:Body>',
            '<Body>', $response2);

        $response4 = str_replace('<n0:ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">',
            '<ZIVMF_VSOSResponse xmlns:n0="urn:sap-com:document:sap:rfc:functions">', $response3);

        $response5 = str_replace('</n0:ZIVMF_VSOSResponse>',
            '</ZIVMF_VSOSResponse>', $response4);

        $response6 = str_replace('</soap-env:Body>',
            '</Body>', $response5);
        $response7 = str_replace('</soap-env:Envelope>',
            '</Envelope>', $response6);

        $parser = simplexml_load_string($response7);

        $this->MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $response_code, $parser, $diferencia);

        if (!($response_code < 300 && $response_code > 199)) {

            $this->ErrorLogSOAP($app, $response_code, $url, $parser, $diferencia, $params_error_report);

        }

        $longitudMedicos = sizeof($parser->Body->ZIVMF_VSOSResponse->IT_MMEDI_U->item);
        $listadoMedicos = array();

        $j = 1;

        for ($j = 1; $j <= $longitudMedicos; $j++) {

            $tabla_medicos = $parser->Body->ZIVMF_VSOSResponse->IT_MMEDI_U->item[$j]->POBNR;
            array_push($listadoMedicos, $tabla_medicos);

        }

        $longitudEspecialidades = sizeof($listadoMedicos);

        $i = 0;

        for ($i = 0; $i <= $longitudEspecialidades; $i++) {

            $valorArray = $listadoMedicos[$i];
            $valorArray2 = substr($valorArray, 15, -11);
            

            if ($valorArray2 == $cod_medico) {
                if($parser->Body->ZIVMF_VSOSResponse->IT_MMEDI_U->item[$i+1]->NMEDI){
                    $nombre_medico = $parser->Body->ZIVMF_VSOSResponse->IT_MMEDI_U->item[$i+1]->NMEDI;
                 break;
                }else{
                $nombre_medico = "no se encotro el medico";
                }
            }
        }

        $var = '{
         "medicoEscogido" : "' . $nombre_medico . '"
      }';

        return $var;
    }

    private function obtenerInfoCita($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {
        $codigoCita = $_POST['codigoCita'];
        $fecha = $_POST['fecha'];
        $horaCita = $_POST['horaCita'];
        $nombreUnidadOganizativa = $_POST['nombreUnidadOganizativa'];
        $especialidad = $_POST['especialidad'];
        $medicoEscogido = $_POST['medicoEscogido'];

        $datos = array(
            "codigo_cita"  => $codigoCita,
            "fecha" => $fecha,
            "hora_cita" => $horaCita,
            "nombre_unidad_organizativa"  => $nombreUnidadOganizativa,
            "especialidad" => $especialidad,
            "medico_escogido" => $medicoEscogido,
        );

        $body = "{}";

        $resultado = 'Detalle de la Cita seleccionada ('.$codigoCita.', '.$fecha.', '.$horaCita.', '.$nombreUnidadOganizativa.', '.$especialidad.', '.$medicoEscogido.')';

        $var = '{
            "resultadoCita" : "'.$resultado.'"
        }';

        \App\Utils\StaticExecuteServicePreproduccion::createLog($var,$body,$chat_identification,$nameFunction,$type="POST",$nameLog,$datos);

        return $var;
    }

    private function responseCancelarCitas($app, $params_error_report, $nameController, $chat_id,$nameLog)
    {
        $codigoOperation = $_POST['codigoOperation'];
        $msjOperation = $_POST['msjOperation'];

        $datos = array(
            "codigo_operation"  => $codigoOperation,
            "msj_operation" => $msjOperation,
        );

        $body = "{}";

        $resultado = 'Codigo ('.$codigoOperation.'), Mensaje de Salida('.$msjOperation.')';

        $var = '{
            "estadoCancelacion" : "'.$resultado.'"
        }';

        \App\Utils\StaticExecuteServicePreproduccion::createLog($var,$body,$chat_identification,$nameFunction,$type="POST",$nameLog,$datos);

        return $var;
    }

    public function MainLogBefore($app, $chat_identification, $nameController, $nameFunction, $url)
    {

        \App\Utils\CreateLogs::registerBeforeRequest($app, $chat_identification, $nameController, $nameFunction, $url);

    }

    public function MainLogAfter($app, $chat_identification, $nameController, $nameFunction, $url, $statusCode, $respuesta, $diffSecs)
    {

        \App\Utils\CreateLogs::registerAfterRequest($app, $chat_identification, $nameController, $nameFunction, $url, $statusCode, $respuesta, $diffSecs);

    }

    public function ErrorLogSOAP($app, $statusCode, $url, $response, $diferencia, $params_error_report)
    {

        $errorReport = [
            'status' => $statusCode,
            'url' => $url,
            'response' => $reponse,
            'timeResponse' => $diferencia,
            'typeService' => 'SOAP',
            'enterprise_id' => $params_error_report["enterprise_id"],
            'session_id' => $params_error_report["session_id"],
            'bot_id' => $params_error_report["bot_id"],
            'convesartion_id' => $params_error_report["convesartion_id"],
        ];

        \Store\Toys\ErrorLogModel::crearErrorLog($app, $errorReport);

    }
}

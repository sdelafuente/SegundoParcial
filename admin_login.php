<?php
    require_once('clases/lib/nusoap.php');

    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario']),true) : NULL;

    $parametro = array("Usuario" => $usuario);

    $obj = new stdClass();
    $obj->Exito = TRUE;
    $obj->Mensaje = "";

//2.- INDICAMOS URL DEL WEB SERVICE
$host = 'http://maxineiner.tuars.com/webservice/ws_segundo_parcial.php';

//3.- CREAMOS LA INSTANCIA COMO CLIENTE
        $client = new nusoap_client($host . '?wsdl');

//4.- CHECKEAMOS POSIBLES ERRORES AL INSTANCIAR
    $err = $client->getError();
    if ($err) {// MOSTRAMOS EL ERROR.
        echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
        die();
     }

//5.- INVOCAMOS AL METODO SOAP
    $result = $client->call('LoginWS', $usuario);     

//6.- CHECKEAMOS POSIBLES ERRORES AL INVOCAR AL METODO DEL WS 
    if (is_array($result)) {
        $obj->Mensaje = "Exito";
        echo json_encode($obj);
    } else {
        $obj->Exito = FALSE;
        $obj->Mensaje = "Hubo un error de login.";
        echo json_encode($obj);
    }


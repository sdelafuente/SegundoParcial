<?php
    //Archivos a leer
    require_once('clases/lib/nusoap.php');
    require_once('clases/Usuario.php');

    /* Objeto que voy a devolver a funciones_login */
    $obj = new stdClass();
    $obj->Exito = TRUE;
    $obj->Mensaje = "";

    /* Objeto login que recibi */
    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

    /* Busco el usuario */
    $user = Usuario::TraerUsuarioLogueado($usuario);

    /* De dar error salgo. */
    if (!$user) {
        $obj->Exito = FALSE;
        $obj->Mensaje = "El usuario no existe.";

    } else {//Exite el usuario    

        /* Inicio la sesion */
        session_start();

        /* Codifico a json el objeto usuario encontrado */
        $_SESSION["Usuario"] = json_encode($user);

        /* temporalmente doy como correcto */
        $obj->Exito = TRUE;
        
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

         /* Paso el usuario a un array para el webservice */
         $usuario = json_decode(json_encode($_POST['usuario']),true);

        //5.- INVOCAMOS AL METODO SOAP
        $result = $client->call('LoginWS', $usuario);     

        //6.- CHECKEAMOS POSIBLES ERRORES AL INVOCAR AL METODO DEL WS 
        if (is_array($result)) {

            $obj->Mensaje = "Exito";           

        } else {
            $obj->Exito = FALSE;
            $obj->Mensaje = "Hubo un error de login.";            
        }         
    }

    /* Devuelvo el resultado */
    echo json_encode($obj);

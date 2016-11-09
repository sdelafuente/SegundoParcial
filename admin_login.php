<?php
    require_once('clases/lib/nusoap.php');

    $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;

    $obj = new stdClass();
    $obj->Exito = TRUE;
    $obj->Mensaje = "";

//IMPLEMENTAR...


    echo json_encode($obj);
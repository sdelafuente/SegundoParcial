<?php//require_once("verificar_sesion.php");$queMuestro = isset($_POST['queMuestro']) ? $_POST['queMuestro'] : NULL;switch ($queMuestro) {        case "ENUNCIADO":                require_once("enunciado.php");                break;        case "MOSTRAR_GRILLA":        require_once("clases/Usuario.php");        $UsuariosArray = Usuario::TraerTodosLosUsuarios();                $jsonArray = json_encode($UsuariosArray);                        $grilla = '<table class="table" style="width:500px;">                        <thead >                                <tr>                                    <th rowspan="2">  Nombre </th>                                    <th rowspan="2">  Email </th>                                    <th rowspan="2">  Perfil </th>                                    <th rowspan="2">   </th>                                    <th rowspan="2">   </th>                                </tr>                         </thead>';        $grilla .= '<tbody>';        foreach ($UsuariosArray as $usuario) {                                   $usuario->accion    = "Modificar";            $objMododificar     = json_encode($usuario);            $usuario->accion    = "Eliminar";            $objEliminar        = json_encode($usuario);            $grilla .= "<tr>";                       $grilla .= "    <td>$usuario->nombre</td>";            $grilla .= "    <td>$usuario->email </td>";            $grilla .= "    <td>$usuario->perfil</td>";                        $grilla .= "    <td><input type=\"button\" class=\"MiBotonUTN\" onClick='EditarUsuario(new Object($objMododificar));' value=\"Modificar\" /></td>";                        $grilla .= "    <td><input type=\"button\" class=\"MiBotonUTN\" onClick='EditarUsuario(new Object($objEliminar));' value=\"Eliminar\" /></td>";                                    $grilla .= " </tr>";                    }        $grilla .= "</tbody>";        $grilla .= "</table>";        echo $grilla;                break;    case "FORM"://MUESTRA FORM ALTA-MODIFICACION USUARIO        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;        require_once("form.php");        break;    case "ALTA_USUARIO":        require_once("clases/Usuario.php");        $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";                $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;                        if (!Usuario::Agregar($usuario)) {            $obj->Exito = FALSE;            $obj->Mensaje = "Hubo un error, no se pudo dar de alta el usuario.";        } else {            $obj->Exito = TRUE;            $obj->Mensaje = "El usuario se ha insertado correctamente.";                    }                echo json_encode($obj);        break;    case "MODIFICAR_USUARIO":                $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";        require_once("clases/Usuario.php");        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;                if (!Usuario::Modificar($usuario)) {            $obj->Exito = FALSE;            $obj->Mensaje = "Hubo un error, no se pudo modificar el usuario.";        } else {            $obj->Exito = TRUE;            $obj->Mensaje = "El usuario se ha modificado correctamente.";                    }                           echo json_encode($obj);        break;            case "ELIMINAR_USUARIO":                require_once("clases/Usuario.php");                $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;        if (!Usuario::Eliminar($usuario->id)) {            $obj->Exito = FALSE;            $obj->Mensaje = "Hubo un error, no se pudo eliminar el usuario.";        } else {            $obj->Exito = TRUE;            $obj->Mensaje = "El usuario se ha eliminado correctamente.";                    }                           echo json_encode($obj);        break;    case "LOGOUT":        //implementar...        break;    default:        echo ":(";}
<?php 


    require_once('./lib/nusoap.php'); 
    require_once('AccesoDatos.php');
    require_once('Producto.php');
    
    //$server = new soap_server(); 
    $server = new nusoap_server(); 
    
    $server->configureWSDL('WebService Con PDO', 'urn:wsPdo'); 

///**********************************************************************************************************///                                
//REGISTRO METODO SIN PARAMETRO DE ENTRADA Y PARAMETRO DE SALIDA 'ARRAY de ARRAYS'
    $server->register('ObtenerTodosLosCds',                 
                        array(),  
                        array('return' => 'xsd:array'),   
                        'urn:wsPdo',                        
                        'urn:wsPdo#ObtenerTodosLosCds',             
                        'rpc',                              
                        'encoded',                          
                        'Obtiene todos los productos de la Base de Datos'             
                    );


    function ObtenerTodosLosCds() {     
        return array("Hola" => "Mundo");//Producto::ObtenerTodosLosCds();
    }
///**********************************************************************************************************///                                
    $HTTP_RAW_POST_DATA = file_get_contents("php://input"); 
    
    $server->service($HTTP_RAW_POST_DATA);
?>
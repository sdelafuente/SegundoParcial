<?php
require_once("AccesoDatos.php");
class Producto
{
    public $id;
    public $interpret;
    public $jahr;
    public $titel;
    
    public static function ObtenerTodosLosCds()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        //
        
        $sql = "SELECT descripcion, codigo, precio FROM productos WHERE habilitado = 1";

        $consulta = $objetoAccesoDato->RetornarConsulta($sql);
        $consulta->execute();

        return $consulta->fetchall();       
    }
}
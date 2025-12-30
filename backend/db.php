<?php 

$host = 'localhost';
$usuario = 'root';
$password = '';
$baseDatos = 'tareas_db';

try{
    $conexion = new PDO("mysql:host=$host;dbname=$baseDatos;charset=utf8", $usuario, $password);

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    die("Error de conexion: " .$e->getMessage());
}
?>
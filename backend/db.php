<?php 

$host = 'localhost';
$usuario = 'root';
$password = 'leaartibai';
$baseDatos = 'tareas_db';

if (file_exists('config.php')) {
    include 'config.php';
} else {
    die("Error: Falta el archivo de configuración (config.php).");
}
try{
    $conexion = new PDO("mysql:host=$host;dbname=$baseDatos;charset=utf8", $usuario, $password);

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    die("Error de conexion: " .$e->getMessage());
}
?>
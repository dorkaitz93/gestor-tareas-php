<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db.php';

//Leemos los datos json

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['titulo']) && !empty($data['titulo'])){

    $titulo = $data['titulo'];
try {

    $sql = "INSERT INTO tareas (titulo) VALUES (:titulo)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([':titulo' => $titulo]);

    echo json_encode(["id"=> $conexion->lastInsertId(), "mensaje" => "Tarea guardada"]);
} catch(PDOException $e ){
    echo json_encode(["error"=> $e->getMessage()]);
}
}else{
    echo json_encode(["error" => "Titulo es obligatorio"]);
}


?>
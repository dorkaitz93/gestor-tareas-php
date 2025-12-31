<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db.php';

try {
    $sql = "SELECT * FROM tareas ORDER BY  fecha_creacion DESC";
    $stmt = $conexion->query($sql);

    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tareas);
} catch(PDOException $e ){
    echo json_encode(["error"=> $e->getMessage()]);
}

?>
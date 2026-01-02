<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db.php';

//Leemos los datos json

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])){
    $id = $data['id'];

    try{
        // invierte el valor de completado, asi evitamos comprobarlo
        $sql = "UPDATE  tareas SET completada = NOT completada WHERE id =:id";

        $stmt = $conexion->prepare($sql);
        $stmt->execute(['id' => $id]);

        echo json_encode(["Mensaje" => "Tarea actualizada con exito"]);
    }catch(Exception $e){
        echo json_encode(["Error" => $e->getMessage()]);
    }

}else{
    echo json_encode(["mensaje" => "No se encuntra ninguna tarea con esa id"]);
}
?>
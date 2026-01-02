<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db.php';

//Leemos los datos json
$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['id'])){
    $id = $data['id'];

    try{
        $sql = "DELETE FROM tareas WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute(['id'=> $id]);

        if($stmt-> rowCount() > 0){
            echo json_encode(["message" => "Tarea eliminada con exito"]);
        }else{
            echo json_encode(["Error" => "No se a podido eliminar ninguna tarea"]);
        }
   }catch(Exception $e){
     echo json_encode(["error" => $e->getMessage()]);
   }
}else{
    echo json_encode(["message" => "No se encuntra ninguna tarea con esa id"]);
}

?>
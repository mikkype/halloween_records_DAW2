<?php

include(__DIR__ . "/../../middleware/db.php");

//Funcion para insertar POST
function  insertarPuntuaciones($db)
{
    
    $datosIn = json_decode(file_get_contents('php://input'), true);
    //$puntuacion_id = $datosIn['puntuacion_id'];
    $nombre = $datosIn['nombre'];
    $curso = $datosIn['curso'];
    $puntaje = $datosIn['puntaje'];


    $sql = "INSERT INTO puntuacion (nombre,curso,puntaje) VALUES('$nombre' , '$curso', '$puntaje')";
    $result = $db->executeQuery($sql);

    if ($result === false) {
        echo json_encode(array('mensaje' => 'Error en la consulta SQL' . $db->error));
    }
    if ($result) {
        echo json_encode(array('mensaje' => 'Puntuacion insertada'));
    } else {
        echo json_encode(array('mensaje' => 'Error al insertar Puntuacion'));
    }
    echo json_encode($datosIn);
}

//funcion para mostrar GET
function mostrarPuntuaciones($db)
{
    $sql = 'SELECT * FROM puntuacion';
    $result = $db->executeQuery($sql);
    if ($result === false) {
        echo "Error en la consulta SQL: " . $db->error;
    }
    // tratamiento de los datos
    $users = array();
    while ($data = $result->fetch_object()) {
        $users[] = $data;
    }
    echo json_encode($users);
}

//funcion para mostrar ID GET
function mostrarPuntuacionesID($db, $id_puntuacion)
{
    //$id_puntuacion = isset($_GET['id']) ? intval($_GET['id']) : null;

    $sql = "SELECT * FROM puntuacion WHERE puntuacion_id = $id_puntuacion";
    $result = $db->executeQuery($sql);

    if ($result === false) {
        echo "Error en la consulta SQL: " . $db->error;
    }
    // tratamiento de los datos
    if ($result->num_rows > 0) {
        $estudiante = $result->fetch_object();
        $datos = $estudiante;
    } else {
        echo "Puntuacion no encontrada.";
    }
    echo json_encode($datos);
}

//Funcion para actualizar datos PUT
function actualizarPuntuacionesID($db, $id_puntuacion)
{

    $datosUpdate = json_decode(file_get_contents('php://input'), true);
    $nombre = $datosUpdate['nombre'];
    $curso = $datosUpdate['curso'];
    $puntaje = $datosUpdate['puntaje'];
   

    $sql = "UPDATE puntuacion SET nombre = '$nombre', curso= '$curso', puntaje = '$puntaje'  WHERE puntuacion_id = $id_puntuacion";

    echo "Consulta SQL: $sql";
    $result = $db->executeQuery($sql);

    if ($result === false) {
        echo json_encode(array('mensaje' => 'Error en la consulta SQL' . $db->error));
    }
    if ($result) {
        echo json_encode(array('mensaje' => 'Puntuacion actualizada'));
    } else {
        echo json_encode(array('mensaje' => 'Error al actualizar puntuacion'));
    }
}

//Funcion para eliminar 
function eliminarPuntuacionesID($db, $id_puntuacion)
{

    $sql = "DELETE FROM puntuacion WHERE puntuacion_id = $id_puntuacion";
    echo "Consulta SQL: $sql";
    $result = $db->executeQuery($sql);

    if ($result === false) {
        echo json_encode(array('mensaje' => 'Error en la consulta SQL' . $db->error));
    }
    if ($result) {
        echo json_encode(array('mensaje' => 'Puntuacion eliminada'));
    } else {
        echo json_encode(array('mensaje' => 'Error al eliminar Puntuacion'));
    }
}




/*// pintado de los datos
    /*foreach ($users as $user) {
        echo "<br>";
        echo $user->nombre . " " . $user->apellido;
        echo "<br>";
    }*/
/*// pintado de los datos
        echo "<br>";
        echo "ID : " . $estudiante->estudiante_id. "<br>";
        echo "Nombre: " . $estudiante->nombre . "<br>";
        echo "Apellido: " . $estudiante->apellido . "<br>";
        echo "Fecha de Nacimiento: " . $estudiante->fecha_nacimiento . "<br>";
        echo "Dirección: " . $estudiante->direccion . "<br>";
        echo "Teléfono: " . $estudiante->telefono . "<br>";
        echo "<br>";*/
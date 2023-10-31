<?php
include(__DIR__ . "/../models/puntuacionesMD.php");

// dominios 

$db = new Db();

$method = $_SERVER["REQUEST_METHOD"];
header("content-type: application/json");

switch ($method) {

    case 'GET':
        if (isset($_GET['id'])) {
            $id_puntuacion = $_GET['id'];
            mostrarPuntuacionesID($db, $id_puntuacion);
        } else {
            mostrarPuntuaciones($db);
        }
        break;
    case 'PUT':
        if (isset($_GET['id'])) {
            $id_puntuacion = $_GET['id'];
            actualizarPuntuacionesID($db, $id_puntuacion);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            $id_puntuacion = $_GET['id'];
            eliminarPuntuacionesID($db, $id_puntuacion);
        }
        break;
    case 'POST':
        insertarPuntuaciones($db);
        break;
    default:
        echo "Metodo no permitido.";
        break;
}




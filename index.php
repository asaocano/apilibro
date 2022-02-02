<?php
session_start();
require_once('conexion.php');
require_once('api.php');
require_once('cors.php');
require_once('sesionesApi.php');

$method = $_SERVER['REQUEST_METHOD'];

if($method == "GET"){
    if (!empty($_GET['id'])) {
        $vector = null;
        $id = $_GET['id'];
        //$json = null;
        $usuario = $_SESSION['user'];
        if (isset($usuario)) {
            $api = new Api();
            $vector = $api->getLibro($id);
        }
        
        $json = json_encode($vector);
        echo $json;
    }else if (!empty($_GET['user'])) {
        $vector = null;
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        $api = new sesionesApi();
        $vector = $api->getUsuario($user, $pass);
        if ($vector != null) {
            $_SESSION['user'] = $vector['usuario'];
        }
        $json = json_encode($vector);
        echo $json;
    }else{
        $vector = array();
        $api = new Api();
        $vector = $api->getLibros();
        $json = json_encode($vector);
        echo $json;
    }
    
}

if ($method == "POST") {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $nombre = $data['nombre'];
    $edicion = $data['edicion'];
    $api = new Api();
    $json = $api->addLibro($nombre, $edicion);
    echo $json;
}

if ($method == 'DELETE') {
    $json = null;
    $id = $_REQUEST['id'];
    $api = new Api();
    $json = $api->deleteLibro($id);
    echo $json;
}

if ($method == 'PUT') {
    $json = null;
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $nombre = $data['nombre'];
    $edicion = $data['edicion'];
    $api = new Api();
    $usuario = $_SESSION['user'];
    if (isset($usuario)) {
        $json = $api->updateLibro($id, $nombre, $edicion);
    }
    
    echo $json;
}
?>
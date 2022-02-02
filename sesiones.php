<?php
require_once('conexion.php');
require_once('cors.php');
require_once('sesionesApi.php');

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    if (!empty($_GET['user']) && !empty($_GET['pass'])) {
        $user = $_GET['user'];
        $pass = $_GET['pass'];
        $api = new sesionesApi();
        $vector = $api->getUsuario($user, $pass);
        $json = json_encode($vector);
        echo $json;
    }
}



?>
<?php

class Conexion {

    public function getConexion(){
    $host = "localhost";
    $db = "dblibro";
    $user = "root";
    $password = "";

    $db = new PDO("mysql:host=$host;dbname=$db;", $user, $password);

    return $db;

}

}



?>




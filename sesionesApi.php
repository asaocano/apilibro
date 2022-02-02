<?php
class sesionesApi{
    public function getUsuario($usuario, $contra){
        $vector = array();
        $conexion = new Conexion();
        $db = $conexion->getConexion();
        $sql = 'SELECT * FROM usuarios WHERE usuario=:usuario AND password=:pass';
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':usuario', $usuario);
        $consulta->bindParam(':pass', $contra);
        $consulta->execute();
        while ($fila = $consulta->fetch()) {
            $vector[] = array(
                "id" => $fila['id'],
                "usuario" => $fila['usuario'],
                "password" => $fila['password'],
                "tipo" => $fila['tipo']
            );
        }

        return $vector[0];
    }
}


?>
<?php
require __DIR__ . '\\config.php';
class Sistema extends Config
{
    var $conn;
    var $count = 0;
    function connect()
    {
        $this->conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    }

    function query($sql)
    {
        $this->connect();
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        return $datos;
    }

    function getRol($correo)
    {
        $sql = "SELECT r.rol FROM usuario u
        JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
        JOIN rol r on ur.id_rol = r.id_rol
        WHERE u.correo = '" . $correo . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['rol']);
        return $info;
    }

    function getPrivilegio($correo)
    {
        $sql = "SELECT p.privilegio FROM usuario u
        JOIN usuario_rol ur on u.id_usuario = ur.id_usuario
        JOIN rol_privilegio rp on ur.id_rol = rp.id_rol
        JOIN privilegio p on rp.id_privilegio = p.id_privilegio
        WHERE u.correo = '" . $correo . "';";
        $datos = $this->query($sql);
        $info = array();
        foreach ($datos as $row)
            array_push($info, $row['privilegio']);
        return $info;
    }

    function login($correo, $password)
    {
        $password = md5($password);
        $this->connect();
        $sql = "SELECT * FROM usuario
        WHERE correo = :correo AND password = :password;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $datos = array();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0]))
            return $datos[0];
        return false;
    }

    function setCount($count)
    {
        $this->count = $count;
    }

    function getCount()
    {
        return $this->count;
    }

    function upload($carpeta)
    {
        if (in_array($_FILES['fotografia']['type'], $this->getImageType())) {
            if ($_FILES['fotografia']['size'] <= $this->getImageSize()) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n . $_FILES['fotografia']['size'] . $_FILES['fotografia']['name'];
                $nombre_archivo = md5($nombre_archivo);
                $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);
                $nombre_archivo = $nombre_archivo . "." . $extension;
                $ruta = '..\\uploads\\' . $carpeta . '\\' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], $ruta);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }
}

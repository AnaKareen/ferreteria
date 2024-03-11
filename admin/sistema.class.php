<?php
require __DIR__ . '\\config.php';
class Sistema
{
    var $conn;
    var $count = 0;
    function connect()
    {

        $this->conn = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
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
        $permitidos = array('image/jpeg', 'image/png');
        if (in_array($_FILES['fotografia']['type'], $permitidos)) {
            if ($_FILES['fotografia']['size'] <= 1024000) {
                $n = rand(1, 1000000);
                $nombre_archivo = $n . $_FILES['fotografia']['size'] . $_FILES['fotografia']['name'];
                $nombre_archivo = md5($nombre_archivo);
                $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);
                // $extension = explode('.', $_FILES['fotografia']['name']);
                // $extension = $extension[sizeof($extension) - 1];
                $nombre_archivo = $nombre_archivo . "." . $extension;
                $ruta = '..\\uploads\\' . $carpeta . '\\' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], $ruta);
                    chmod($ruta, 0777);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }
}

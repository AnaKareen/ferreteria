<?php
class Sistema
{
    var $conn;
    var $count = 0;
    function connect()
    {
        $servername = "127.0.0.1";
        $username = "ferreteria";
        $password = "@admin";
        $mydb = "ferreteria";
        $this->conn = new PDO("mysql:host=$servername;dbname=$mydb", $username, $password);
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
                $extension = explode('.', $_FILES['fotografia']['name']);
                $extension = $extension[sizeof($extension) - 1];
                $nombre_archivo = $nombre_archivo . "." . $extension;
                // $extension = pathinfo($_FILES['fotografia']['name'], PATHINFO_EXTENSION);
                if (!file_exists('..\\uploads\\' . $carpeta . '\\' . $nombre_archivo)) {
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], '..\\uploads\\' . $carpeta . '\\' . $nombre_archivo);
                    return $nombre_archivo;
                }
            }
        }
        return false;
    }
}

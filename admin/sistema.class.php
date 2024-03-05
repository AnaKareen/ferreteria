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

    function upload()
    {
        $permitidos = array('image/jpeg', 'image/png');
        if (in_array($_FILES['fotografia']['type'], $permitidos)) {
            if ($_FILES['fotografia']['size'] <= 1024000) {
                move_uploaded_file($_FILES['fotografia']['tmp_name'], '..\\uploads\\productos\\'.$_FILES['fotografia']['name']);
                return $_FILES['fotografia']['name'];
            }
        }
        return false;
    }
}

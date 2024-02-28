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

    function setCount($count) {
        $this->count = $count;
    }

    function getCount() {
        return $this->count;
    }
}

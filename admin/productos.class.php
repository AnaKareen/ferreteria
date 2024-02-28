<?php
require_once('sistema.class.php');
class Productos extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_producto, producto, precio, id_marca FROM producto;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }

    function getOne($id_producto)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_producto, producto, precio, id_marca FROM producto WHERE id_producto = :id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = array();
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }

    function insert($datos)
    {
        $this->connect();
        if ($this->validateDoctor($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO producto(producto, precio, id_marca) VALUES (:producto, :precio, :id_marca);");
            $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
            $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
            $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }

    function delete($id_producto)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM producto WHERE id_producto = :id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function update($id_producto, $datos)
    {
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE producto SET producto = :producto, precio = :precio, id_marca = :id_marca WHERE id_producto = :id_producto;");
        $stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function validateDoctor($datos)
    {
        if (empty($datos["producto"])) {
            return false;
        }
        return true;
    }
}

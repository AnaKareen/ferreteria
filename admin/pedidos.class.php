<?php
include __DIR__ . '/sistema.class.php';

class Pedidos extends Sistema
{
    public function getAll()
    {
        try {
            $this->connect();
            $stmt = $this->conn->prepare("SELECT * FROM venta inner join venta_detalle using (id_venta) ORDER BY id_venta;");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener todos los pedidos: " . $e->getMessage());
        }
    }

    public function getOne($id_venta)
    {
        $datos = array();
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM venta WHERE id_venta = :id_venta;");
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            return $datos[0];
        }
        return $datos;
    }

    public function delete($id_venta)
    {
        $this->connect();
        $this->conn->beginTransaction();
        $sql = "DELETE FROM venta_detalle WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $sql = "DELETE FROM venta WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->execute();
        $this->conn->commit();
        return $stmt->rowCount();
    }

    public function insert($datos)
    {
        $this->connect();
        $this->conn->beginTransaction();
        $sql = "INSERT INTO venta (id_tienda, id_empleado, id_cliente, fecha) VALUES (:id_tienda, :id_empleado, :id_cliente, :fecha)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_tienda', $datos['id_tienda'], PDO::PARAM_INT);
        $stmt->bindParam(':id_empleado', $datos['id_empleado'], PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->execute();
        if(isset($datos)){
            $id_venta = $this->conn->lastInsertId();
            $sql = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad) VALUES (:id_venta, :id_producto, :cantidad)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
            $stmt->bindParam(':id_producto', $datos['id_producto'], PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $datos['cantidad'], PDO::PARAM_INT);
            $stmt->execute();
            $this->conn->commit();
            return $stmt->rowCount();
        }

        $this->conn->commit();
        return $stmt->rowCount();
    }

    public function modify($id_venta, $datos)
    {
        $this->connect();
        $this->conn->beginTransaction();
        $sql = "UPDATE venta SET id_tienda = :id_tienda, id_empleado = :id_empleado, id_cliente = :id_cliente, fecha = :fecha WHERE id_venta = :id_venta";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->bindParam(':id_tienda', $datos['id_tienda'], PDO::PARAM_INT);
        $stmt->bindParam(':id_empleado', $datos['id_empleado'], PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $datos['id_cliente'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->execute();
        $this->conn->commit();
        return $stmt->rowCount();
    }
}
?>
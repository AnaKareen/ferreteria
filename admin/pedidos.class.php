<?php
include __DIR__ . '/sistema.class.php';

class Pedidos extends Sistema
{
    public function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT * FROM orders ORDER BY id_venta;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
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
}
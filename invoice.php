<?php
include __DIR__ . '/admin/sistema.class.php';
include __DIR__ . '/headerSinMenu.php';
$datos = $_POST;
$app = new Sistema();
$app->checkRol('Cliente');
try {
    // conexion a la base de datos
    $app->connect();
    // iniciar transaccion
    $app->conn->beginTransaction();
    // preguntar si existe el carrito
    if (isset($_SESSION['cart'])) {
        $correo = $_SESSION['correo'];
        // obtener el id del cliente a partir del correo
        $sql = "SELECT c.id_cliente FROM cliente c JOIN usuario u ON c.id_usuario = u.id_usuario WHERE u.correo = ?;";
        $stmt = $app->conn->prepare($sql);
        $stmt->bindParam(1, $correo, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $cliente = $stmt->fetchAll();
        if (isset($cliente[0])) {
            $id_cliente = $cliente[0]['id_cliente'];
            $id_empleado = 4;
            $id_tienda = 1;
            $sql = "INSERT INTO venta (id_cliente, id_empleado, id_tienda, fecha) VALUES (?,?,?, now());";
            $stmt = $app->conn->prepare($sql);
            $stmt->bindParam(1, $id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_empleado, PDO::PARAM_INT);
            $stmt->bindParam(3, $id_tienda, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $venta = $stmt->fetchAll();
            $filasAfetadas = $stmt->rowCount();
            if ($filasAfetadas) {
                $sql = "SELECT v.id_venta FROM venta v WHERE id_cliente = ? ORDER BY 1 DESC LIMIT 1;";
                $stmt = $app->conn->prepare($sql);
                $stmt->bindParam(1, $id_cliente, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $venta = $stmt->fetchAll();
                if (isset($venta[0])) {
                    $id_venta = $venta[0]['id_venta'];
                    $carrito = $_SESSION['cart'];
                    $filasAfetadas = 0;
                    foreach ($carrito as $key => $value) {
                        $id_producto = $key;
                        $cantidad = $value;
                        $sql = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad) VALUES (?,?,?);";
                        $stmt = $app->conn->prepare($sql);
                        $stmt->bindParam(1, $id_venta, PDO::PARAM_INT);
                        $stmt->bindParam(2, $id_producto, PDO::PARAM_INT);
                        $stmt->bindParam(3, $cantidad, PDO::PARAM_INT);
                        $stmt->execute();
                        $filasAfetadas += $stmt->rowCount();
                    }
                    if ($filasAfetadas) {
                        $app->conn->commit();
                        unset($_SESSION['cart']);
                        $_SESSION['total'] = 0;
                        $app->alert("success", "<i class='fa fa-check'></i> Compra realizada");
                        $sql = "SELECT CONCAT(c.nombre, ' ', c.primer_apellido, ' ', c.segundo_apellido) AS nombre, u.correo FROM cliente c JOIN usuario u ON c.id_usuario = u.id_usuario WHERE correo = ?;";
                        $stmt = $app->conn->prepare($sql);
                        $stmt->bindParam(1, $correo, PDO::PARAM_STR);
                        $stmt->execute();
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $cliente = $stmt->fetchAll();
                        if (isset($cliente[0])) {
                            $nombre = $cliente[0]['nombre'];
                            $correo = $cliente[0]['correo'];
                            $mensaje = "Estimado $nombre, su compra ha sido realizada con éxito.<br>Agradecemos su preferencia.<br>Atentamente, La Ferreteria";
                            $app->sendMail($correo, $nombre, "Compra realizada", $mensaje);
                            header("Location: orders.php");
                        }
                    }
                } else {
                    $app->conn->rollback();
                    $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> No se ha podido realizar la compra");
                }
            } else {
                $app->conn->rollback();
                $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> No se ha podido realizar la compra");
            }
        } else {
            $app->conn->rollback();
            print_r($app);
            $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> No se ha encontrado el cliente");
        }
    } else {
        $app->conn->rollback();
        $app->alert("danger", "<i class='fa-solid fa-circle-xmark'></i> El carrito esta vacío");
    }
} catch (Exception $e) {
    echo $e->getMessage();
    $app->conn->rollback();
}
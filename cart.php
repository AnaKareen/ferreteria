<?php
//session_start();
include __DIR__ . '/header.php';
include __DIR__ . '/admin/productos.class.php';
$web = new Productos();
$productos = array();
$productos = $web->getAll();

$carrito = array();
if (isset($_SESSION['cart'])) {
    $carrito = $_SESSION['cart'];
}
foreach ($carrito as $id_producto => $cantidad) {
    echo "id_producto: " . $id_producto . "\n";
    echo "cantidad: " . $cantidad . "\n";
    $dato = $web->getOne($id_producto);
    echo $dato['producto'];
//    print_r($dato);
}
?>

<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Precio Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach ($carrito as $id_producto => $cantidad):
            $dato = $web->getOne($id_producto);
        $total += $dato['precio'] * $cantidad;
        $_SESSION['total'] = $total;
        ?>
            <tr>
                <td><?php echo $dato['producto']?></td>
                <td><?php echo $dato['precio']?></td>
                <td><?php echo $cantidad; ?></td>
                <td><?php echo $dato['precio'] * $cantidad; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3">Total:</th>
            <td><?php echo $total; ?></td>
        </tr>
        </tfoot>
    </table>
    <a href="checkout.php" class="btn btn-success">Pagar</a>
</div>

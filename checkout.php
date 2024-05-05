<div class="container">
    <?php
    include __DIR__ . '/views/headerSinMenu.php';
    include __DIR__ . '/admin/productos.class.php';
    $web = new Productos();
    $productos = array();
    $productos = $web->getAll();
    if (isset($_SESSION['validado'])) {
        if ($_SESSION['validado']) {
            $carrito = array();
            if (isset($_SESSION['cart'])) {
                $carrito = $_SESSION['cart'];
            }
            foreach ($carrito as $id_producto => $cantidad) {
                $dato = $web->getOne($id_producto);
                echo "Producto: ". $dato['producto'] . " | ";
                echo "Cantidad: ". $cantidad. "<br>";
//    print_r($dato);
            }
            echo "Total: $" . $_SESSION['total'];
        } else {
            header('Location: login.php');
        }
    } else {
        header('Location: login.php');
    }
    ?>
    <form action="invoice.php" method="post">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input name="nombre_tarjeta" type="text" class="form-control" id="nombre" placeholder="Nombre">
                    <label for="nombre">Nombre que aparece en la tarjerta</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="tarjeta" type="text" class="form-control" id="tarjeta" placeholder="No. de tarjeta">
                    <label for="tarjeta">No. de tarjerta</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="fecha_expiracion" type="text" class="form-control" id="fechaExpiracion" placeholder="Fecha de expiración">
                    <label for="fechaExpiracion">Fecha de expiración</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cvv" type="password" class="form-control" id="cvv" placeholder="CVV" max="999" maxlength="3">
                    <label for="cvv">CVV</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <a href="productos.php" class="btn btn-warning">Seguir comprando</a>
                <a href="#" class="btn btn-danger">Vaciar carrito</a>
                <button name="invoice" type="submit" class="btn btn-success" value="Confirmar pago">Confirmar Pago</button>
            </div>
        </div>
    </form>
</div>

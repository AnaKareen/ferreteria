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
                <td><img style="max-width: 100px;" class="img-fluid" src="uploads/productos/<?php echo $dato['fotografia']; ?>" alt="<?php echo $dato['producto'] ?>"></td>
                <td style="vertical-align: middle;"><?php echo $dato['producto'] ?></td>
                <td style="vertical-align: middle;"><?php echo $dato['precio'] ?></td>
                <td style="vertical-align: middle;"><input style="max-width: 75px; width: auto;" max="999" class="form-control" type="number" min="0" name="cantidad" value="<?php echo $cantidad; ?>"></td>
                <td style="vertical-align: middle;"><?php echo $dato['precio'] * $cantidad; ?></td>
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
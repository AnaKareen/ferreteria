<!-- Productos -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1>Productos</h1>
        </div>
        
    </div>
    <div class="row">
        <?php foreach ($datos as $producto) : ?>
            <div class="col-lg-3 col-md-12">
                <div class="card mb-3 px-3 py-2">
                    <img src="uploads/productos/<?php echo $producto['fotografia']; ?>"
                         alt="<?php echo $producto['producto']; ?>">
                    <form action="cart-add.php" method="get">
                        <div class="caption mb-1">
                            <h3><?php echo $producto['producto']; ?></h3>
                            <p class="text-bg-primary badge">$<?php echo $producto['precio']; ?> MXN</p>
                            <input type="number" name="cantidad" class="form-control" min="1" required>
                            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Agregar al carrito</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
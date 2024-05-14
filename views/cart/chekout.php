<div class="container">
    <h1 class="mb-4">Forma de pago</h1>
    <form action="invoice.php" method="post">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input name="nombre_tarjeta" type="text" class="form-control" id="nombre" placeholder="Nombre">
                    <label for="nombre">Nombre que aparece en la tarjeta</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="tarjeta" type="text" class="form-control" id="tarjeta" placeholder="No. de tarjeta">
                    <label for="tarjeta">No. de tarjeta</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="fecha_expiracion" type="text" class="form-control" id="fechaExpiracion" placeholder="MM/AA">
                    <label for="fechaExpiracion">Fecha de expiración (MM/AA)</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cvv" type="password" class="form-control" id="cvv" placeholder="CVV" maxlength="4">
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
<script src="views/cart/js/script.js"></script>
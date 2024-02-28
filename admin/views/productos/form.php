<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información del producto' : 'Agregar nuevo producto'; ?></h1>
    <form action="productos.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_producto='.$datos['id_producto']: 'SAVE'; ?>" method="post">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="producto" placeholder="Producto" name="producto" value="<?php echo (isset($datos['producto'])) ? $datos['producto'] : '' ?>">
                        <label for="producto">Producto</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="precio" placeholder="Precio" name="precio" value="<?php echo (isset($datos['precio'])) ? $datos['precio'] : '' ?>">
                        <label for="precio">Precio</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="id_marca" placeholder="Marca" name="id_marca" value="<?php echo (isset($datos['id_marca'])) ? $datos['id_marca'] : '' ?>">
                        <label for="id_marca">ID Marca</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>
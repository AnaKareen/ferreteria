<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información del doctor' : 'Agregar nuevo doctor'; ?></h1>
    <form action="marca.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_marca='.$datos['id_marca']: 'SAVE'; ?>" method="post">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="marca" placeholder="Marca" name="marca" value="<?php echo (isset($datos['marca'])) ? $datos['marca'] : '' ?>">
                        <label for="marca">Marca</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>
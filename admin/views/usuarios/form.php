<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de el Usuario' : 'Agregar nuevo Usuario'; ?></h1>
    <form action="usuarios.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_usuario=' . $datos['id_usuario'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="correo" placeholder="correo" name="correo" value="<?php echo (isset($datos['correo'])) ? $datos['correo'] : '' ?>">
                        <label for="correo">Usuario</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="password" class="form-control" id="password" placeholder="password" name="password" value="<?php echo (isset($datos['password'])) ? $datos['password'] : '' ?>">
                        <label for="password">Contraseña</label>
                    </div>
                </div>
                
                
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>
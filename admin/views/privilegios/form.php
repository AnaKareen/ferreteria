<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de el privilegio' : 'Agregar nuevo privilegio'; ?></h1>
    <form action="privilegios.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_privilegio=' . $datos['id_privilegio'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                    <div class="form-floating">
                        <input required="requiered" type="text" class="form-control" id="privilegio" placeholder="privilegio" name="privilegio" value="<?php echo (isset($datos['privilegio'])) ? $datos['privilegio'] : '' ?>">
                        <label for="privilegio">Privilegio</label>
                    </div>
                </div>
                
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
                
            </div>
        </div>
    </form>
</div>
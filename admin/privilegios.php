<?php
include __DIR__ . '\\privilegios.class.php';
$app = new Privilegio();
include __DIR__ . '\\views\\header.php';
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_privilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_privilegio)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> privilegios eliminada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar la privilegios';
        }
        $datos = $app->getAll();
        include __DIR__ . '\\views\\alert.php';
        include __DIR__ . '\\views\\privilegios\\index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_privilegio);
        if (isset($datos['id_privilegio'])) {
            include __DIR__ . '\\views\\privilegios\\form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el privilegios especificada';
            $datos = $app->getAll();
            include __DIR__ . '\\views\\alert.php';
            include __DIR__ . '\\views\\privilegios\\index.php';
        }
        break;
    case "CREATE":
        include __DIR__ . '\\views\\privilegios\\form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> privilegios registrado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar el privilegios';
        }
        $datos = $app->getAll();
        include __DIR__ . '\\views\\alert.php';
        include __DIR__ . '\\views\\privilegios\\index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_privilegio, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> privilegios actualizada correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar la privilegios';
        }
        $datos = $app->getAll();
        include __DIR__ . '\\views\\alert.php';
        include __DIR__ . '\\views\\privilegios\\index.php';
        break;
    default:
        $datos = $app->getAll();
        include __DIR__ . '\\views\\privilegios\\index.php';
        break;
}
include __DIR__ . '\\views\\footer.php';

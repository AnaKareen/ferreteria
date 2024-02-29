<?php
include 'productos.class.php';
$app = new Productos();
include 'views/header.php';
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_producto = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;
$datos = array();
$alert = array();
switch ($action) {
    case "DELETE":
        if ($app->delete($id_producto)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Producto eliminado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo eliminar el producto';
        }
        $datos = $app->getAll();
        include 'views/alert.php';
        include 'views/productos/index.php';
        break;
    case "UPDATE":
        $datos = $app->getOne($id_producto);
        if (isset($datos['id_producto'])) {
            include 'views/productos/form.php';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se ha encontrado el producto especificado';
            $datos = $app->getAll();
            include 'views/alert.php';
            include 'views/productos/index.php';
        }
        break;
    case "CREATE":
        include 'views/productos/form.php';
        break;
    case "SAVE":
        $datos = $_POST;
        if ($app->insert($datos) && isset($datos['id_marca'])) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Producto registgrado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo registrar el producto';
        }
        $datos = $app->getAll();
        include 'views/alert.php';
        include 'views/productos/index.php';
        break;
    case "EDIT":
        $datos = $_POST;
        if ($app->update($id_producto, $datos)) {
            $alert['type'] = 'success';
            $alert['message'] = '<i class="fa-solid fa-circle-check"></i> Producto actualizado correctamente';
        } else {
            $alert['type'] = 'danger';
            $alert['message'] = '<i class="fa-solid fa-circle-xmark"></i> No se pudo actualizar el producto';
        }
        $datos = $app->getAll();
        include 'views/alert.php';
        include 'views/productos/index.php';
        break;
    default:
        $datos = $app->getAll();
        include 'views/productos/index.php';
        break;
}
include 'views/footer.php';

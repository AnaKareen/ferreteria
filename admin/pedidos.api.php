<?php
header('Content-Type: application/json; charset=utf-8');
include __DIR__ . '/pedidos.class.php';
$id_venta = (isset($_GET['id_venta'])) ? $_GET['id_venta'] : null;
$action = (isset($_GET['action'])) ? $_GET['action'] : null;

class Api extends Pedidos
{
    public function read()
    {
        $datos = $this->getAll();
        $datos = json_encode($datos);
        print($datos);
    }
}

$app = new Api();
$app->read();

?>
<?php
include __DIR__ . '/views/headerSinMenu.php';
include __DIR__ . '/admin/productos.class.php';
$web = new Productos();
$productos = array();
$productos = $web->getAll();
if (isset($_SESSION['validado'])) {
    if ($_SESSION['validado']) {
        $carrito = array();
        if (isset($_SESSION['cart']))
            $carrito = $_SESSION['cart'];
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}
include __DIR__ . '/views/cart/chekout.php';

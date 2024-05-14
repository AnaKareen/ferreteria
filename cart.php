<?php
//session_start();
include __DIR__ . '/header.php';
include __DIR__ . '/admin/productos.class.php';
$web = new Productos();
$productos = array();
$productos = $web->getAll();
$carrito = array();
if (isset($_SESSION['cart'])) {
    $carrito = $_SESSION['cart'];
}
include __DIR__ . '/views/cart/index.php';



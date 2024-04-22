<?php
require_once __DIR__ . '/admin/sistema.class.php';
include 'headerSinMenu.php';
$datos = $_POST;
$app = new Sistema();
if ($app->register($datos)) {
    $type = "success";
    $message = '<i class="fa-solid fa-circle-check"></i> Registro exitoso';
    $app->alert($type, $message);
} else {
    $type = "danger";
    $message = '<i class="fa-solid fa-circle-xmark"></i> Error al registrar';
    $app->alert($type, $message);
}
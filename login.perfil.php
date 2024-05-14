<?php
include __DIR__ . '/admin/sistema.class.php';
$datos = $_POST;
$app = new Sistema();
if ($app->checkEmail($datos['correo'])) {
    if ($app->login($datos['correo'], $datos['password'])) {
        header('Location: profile.php');
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}
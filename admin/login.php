<?php
include __DIR__ . '/sistema.class.php';
$app = new Sistema();
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
require_once __DIR__ . '/views/headerSinMenu.php';
switch ($action) {
    case "logout":
        $app->logout();
        $type = "success";
        $message = '<i class="fa-solid fa-circle-check"></i> Sesión cerrada correctamente';
        $app->alert($type, $message);
        break;
    case "login":
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $login = $app->login($correo, $password);
        if ($login) {
            header('Location: index.php');
        } else {
            $type = "danger";
            $message = '<i class="fa-solid fa-circle-xmark"></i> Usuario o contraseña incorrectos';
            $app->alert($type, $message);
        }
        break;
    default:
        include __DIR__ . '/views/login/index.php';
}

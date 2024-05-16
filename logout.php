<?php
include __DIR__ . "/admin/sistema.class.php";
include __DIR__ . "/views/headerSinMenu.php";
$app = new Sistema();
$app->logout();
$app->alert('success', 'Ha cerrado sesion con éxito');
header("refresh:2; url=index.php");
?>
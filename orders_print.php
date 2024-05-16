<?php
include __DIR__ . '/admin/sistema.class.php';
require_once 'vendor/autoload.php';
$app = new Sistema();

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$app->checkRol("Cliente", true);
$id_venta = $_GET['id_venta'];
$app->connect();
$sql = "SELECT * FROM orders WHERE id_usuario = :id_usuario AND id_venta = :id_venta";
$stmt = $app->conn->prepare($sql);
$id_usuario = $_SESSION['id_usuario'];
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
$stmt->execute();
$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT * FROM order_detail WHERE id_venta = :id_venta";
$stmt = $app->conn->prepare($sql);
$stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
$stmt->execute();
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
ob_start();
$content = ob_get_clean();
include __DIR__ . '/views/order_print.php';
$html2pdf = new Html2Pdf("P", "USLETTER", "es");
$html2pdf->writeHTML($content);
$html2pdf->output('order.pdf');
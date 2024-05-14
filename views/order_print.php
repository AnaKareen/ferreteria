<?php
$content = "
<h2>{$datos[0]['tienda']}</h2>
<h3>{$datos[0]['nombre']} {$datos[0]['primer_apellido']} {$datos[0]['segundo_apellido']}</h3>
<p>{$datos[0]['fecha']}</p>
<table>
<thead>
<tr>
<th>No. Producto</th>
<th>Producto</th>
<th>Cantidad</th>
<th>Precio</th>
</tr>
</thead>
<tbody>";
foreach ($detalles as $detalle) :
$content.= "
<tr>
<td>{$detalle['id_producto']}</td>
<td>{$detalle['producto']}</td>
<td>{$detalle['cantidad']}</td>
<td>{$detalle['monto']}</td>
</tr>";
endforeach;
$content.= "
</tbody>
</table>
<h2>Total</h2>
<h3>{$datos[0]['monto']}</h3>
";
?>
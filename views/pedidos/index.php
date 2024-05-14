<?php $pagina_anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '#'; ?>
<div class="container">
    <h1>Mis pedidos</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?php echo $pagina_anterior; ?>" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th style="max-width: 250px; width: 200px;">Número de pedido</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($datos as $pedido):?>
                <tr>
                    <td><?php echo $pedido['id_venta']; ?></td>
                    <td><?php echo $pedido['fecha'];?></td>
                    <td><?php echo $pedido['cantidad']%1 == 0 ? bcdiv($pedido['cantidad'], 1, 0) : $pedido['cantidad']; ?></td>
                    <td>$ <?php echo bcdiv($pedido['monto'], 1, 2);?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="" class="btn btn-primary">Ver detalles</a>
                            <a href="" class="btn btn-warning">Imprimir</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
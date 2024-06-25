<?php
include __DIR__ . '/admin/tiendas.class.php';
include __DIR__ . '/admin/marca.class.php';
include __DIR__ . '/header.php';
$webTiendas = new Tienda();
$webMarcas = new Marca();
$tiendas = array();
$tiendas = $webTiendas->getAll();
$marcas = array();
$marcas = $webMarcas->getAll();
?>
    <section class="bg-body-secondary mb-2 py-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="banner" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#banner" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#banner" data-bs-slide-to="1"
                                    aria-current="false" aria-label="Slide 2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/banner/banner1.jpg" class="d-block w-100" alt="Banner1">
                                <div class="carousel-caption d-block">
                                    <h5>Ferreteria Lika</h5>
                                    <p>Lo que buscas, aqui lo encuentras</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/banner/banner2.jpg" class="d-block w-100" alt="Banner 2">
                                <div class="carousel-caption d-block">
                                    <h5>Ferreteria Lika</h5>
                                    <p>Lo que buscas, aqui lo encuentras</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#banner"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#banner"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-body-tertiary mb-2">
        <div class="container">
            <div class="row py-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body bg-info-subtle">
                            <h5 class="card-title"><i class="fa fa-fire"></i> Oferta solo por tiempo limitado</h5>
                            <p class="card-text">Obten hasta 50% de descuento comprando con tarjetas bancarias
                                participantes.</p>
                            <a href="#promociones" class="card-link"> Ver mas detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-body-secondary">
        <div class="container">
            <div class="row py-3">
                <h2>Conoce nuestros distribuidores</h2>
                <?php foreach ($tiendas as $tienda) : ?>
                    <div class="col-3">
                        <div class="card mb-3 px-2 py-2">
                            <img src="uploads/tiendas/<?php echo $tienda['fotografia']; ?>"
                                 alt="<?php echo $tienda['tienda']; ?>" class="card-img-top img-fluid">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $tienda['tienda']; ?></h5>
                                <p class="card-text"><a href="" class="card-link">Ver detalles</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="bg-body-tertiary">
        <div class="container">
            <div class="row py-3">
                <h2>Conoce a nuestros patrocinadores</h2>
                <?php foreach ($marcas as $marca) : ?>
                    <div class="col-3">
                        <div class="card mb-3 px-2 py-2">
                            <img src="uploads/marcas/<?php echo $marca['fotografia']; ?>"
                                 alt="<?php echo $marca['marca']; ?>" class="card-img-top img-fluid">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $marca['marca']; ?></h5>
                                <p class="card-text"><a href="" class="card-link">Ver detalles</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php include __DIR__ . '/footer.php'; ?>
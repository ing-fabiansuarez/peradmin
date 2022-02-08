<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Producci&oacute;n<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('active-produccion') ?>active<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Producci&oacute;n - Listado de productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Producci&oacute;n</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 15px">#</th>
                                    <th>Producto</th>
                                    <th>Referencia</th>
                                    <th>Talla</th>
                                    <th>observation</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                foreach ($products as $product) :
                                    $counter += 1;
                                ?>
                                    <tr>
                                        <td><b><?= $counter ?></b></td>
                                        <td><?= $product['name_product'] ?></td>
                                        <td><?= $product['reference_num'] . ' - ' . $product['name_reference'] ?></td>
                                        <td><?= $product['name_size'] ?></td>
                                        <td><?= $product['observation'] ?></td>
                                        <td><?= $product['numberidenti_customer'] . ' - ' . $product['name_customer'] . ' ' . $product['surname_customer'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
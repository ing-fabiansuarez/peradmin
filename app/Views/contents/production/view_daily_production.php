<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Producci&oacute;n<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

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
                <h1>Producci&oacute;n del dia <?= $date ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Producci&oacute;n Diaria</li>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <form target="_blank" action="<?=base_url().route_to('generate_daily_graph_production')?>" method="get">
                                    <input type="hidden" name="date" value="<?=$date?>">
                                    <input type="hidden" name="line_production" value="<?=$idLineProduction?>">
                                    <input type="hidden" name="type_order" value="<?=$idTypeOrder?>">
                                    <button type="submit" class="btn btn-block btn-outline-success btn-sm">Generar Grafico</button>
                                </form>
                            </div>
                            <div class="col-md">
                                <a target="_blank" href="#" class="btn btn-block btn-outline-warning btn-sm disabled">Generar PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($orders as $order) : ?>
                <div class="col-md-4">
                    <div class="card card-success callout callout-warning">
                        <div class="card-header">
                            <?php $customer = $order->getCustomer() ?>
                            <h3 class="card-title"><?= $order->id_order ?></h3>

                            <div class="card-tools">
                                <a href="<?= base_url() ?>/pedido/cargarsesionpedido/<?= $order->id_order ?>" class="btn btn-tool" target="_blank">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <?= '<b>Nombre: </b> ' . $customer->name_customer . ' ' . $customer->surname_customer; ?>
                                </li>
                                <li class="nav-item">
                                    <?= '<b>' . $customer->getTypeDocument()['abbreviation_typeofidentification'] . '</b> ' . $customer->numberidenti_customer; ?>
                                </li>
                                <li class="nav-item">
                                    <b>Cantidad:</b>
                                    null
                                </li>
                                <li class="nav-item">
                                    <b>Cread&oacute; por:</b>
                                    <?= $order->getCreatedByNameComplete() ?>
                                </li>
                                <li class="nav-item">
                                    <b>Hace:</b>
                                    <?= $order->created_at_order->humanize() ?>
                                </li>
                                <li class="nav-item">
                                    <b>FECHA DE PRODUCCION:</b>
                                    <?= $date ?>
                                </li>
                                <br>
                                <li class="nav-item">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Datos de envio</b></h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>

                                        </div>
                                        <?php $infoAddress = $order->getInfoAdress() ?>
                                        <div class="card-body">
                                            <form action="http://localhost/peradmin/public/pedido/actualizarinfoenvio/16" method="post">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <div class="form-group">
                                                            <label>Whatsapp: </label>
                                                            <?= $infoAddress['whatsapp_infoadress'] ?>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="form-group">
                                                            <label>Email: </label>
                                                            <?= $infoAddress['email_infoadress'] ?>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="form-group">
                                                            <label>Ciudad: </label>
                                                            <?= $infoAddress['name_city'] . ' - ' . $infoAddress['name_department'] ?>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="form-group">
                                                            <label>Barrio: </label>
                                                            <?= $infoAddress['neighborhood_infoadress'] ?>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="form-group">
                                                            <label>Dirección: </label>
                                                            <?= $infoAddress['home_infoadress'] ?>
                                                        </div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <div class="form-group">
                                                            <label>Transportadora: </label>
                                                            <?= $infoAddress['name_transporter'] ?>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
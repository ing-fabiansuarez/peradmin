<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Pedido Cargado<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
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
                <h1>Cargar Pedido</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Cargar pedido</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('view_result_search_order') ?>" method="post">
                            <div class="form-group">
                                <div class="text-center">
                                    <label>Cedula del Cliente</label>
                                </div>
                                <input name="cedula" type="text" class="form-control" placeholder="Ingrese el número de cedula" value="<?= $customer->numberidenti_customer ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-block bg-gradient-secondary btn-sm">Cargar Pedidos</button>
                                </div>
                                <div class="col-md-4">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <b>Cliente:</b> <?= $customer->name_customer . ' ' . $customer->surname_customer ?>
                        <br><b>Creado desde:</b> <?= $customer->created_at_customer->humanize() ?>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-corporative">
                        <b>PEDIDOS AL POR MAYOR</b>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <?php foreach ($bulkOrder as $order) : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url() . route_to('load_session_order', $order->id_order) ?>" style="color: #000;" class="nav-link">
                                        N° <?= $order->id_order ?> - <?= $order->created_at_order->humanize() ?> <br> Creado por <b><?= $order->getCreatedByNameComplete() ?></b><span class="float-right badge bg-info"><?= count($order->getDetailList()) ?></span>
                                    </a>

                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-corporative">
                        <b>PEDIDOS AL DETAL</b>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <?php foreach ($detailOrder as $order) : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url() . route_to('load_session_order', $order->id_order) ?>" style="color: #000;" class="nav-link">
                                        N° <?= $order->id_order ?> - <?= $order->created_at_order->humanize() ?> <br> Creado por <b><?= $order->getCreatedByNameComplete() ?></b><span class="float-right badge bg-info"><?= count($order->getDetailList()) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
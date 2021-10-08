<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Por pasar a Producci&oacute;n<?= $this->endSection() ?>
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
<br>
<div class="container">
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">PEDIDOS POR PASAR A PRODUCCI&Oacute;N</h3>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Tipo de pedido</th>
                        <th>Hecho por</th>
                        <th>Cread&oacute;</th>
                        <th style="width: 40px">Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $contador = 0;
                    foreach ($ordersbypassproduction as $row) : $contador += 1; ?>
                        <tr>
                            <td><?= $contador ?>.</td>
                            <td><b><?= $row->id_order ?></b></td>
                            <td><b><?php $customer = $row->getCustomer();
                                    echo $customer->getTypeDocument()['abbreviation_typeofidentification'] . ' - ' . $customer->numberidenti_customer . '<br>' . $customer->name_customer . ' ' . $customer->surname_customer ?></b></td>
                            <td><b><?= $row->getTypeOrder()['name_typeoforder'] ?></b></td>
                            <td>
                                <?= $row->getCreatedByNameComplete() ?>
                            </td>
                            <td><?= $row->created_at_order->humanize() ?></td>
                            <td>
                                <a href="<?= base_url() . route_to('load_session_order', $row->id_order) ?>" type="submit" class="btn btn-app bg-corporative">
                                    <i class="fas fa-edit"></i> Cargar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
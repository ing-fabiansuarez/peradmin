<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido - <?= $order->id_order ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/dist/css/adminfabian.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <?= $this->renderSection('css') ?>

</head>

<body style="font-size: 25px;">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2">
                <img src="<?= base_url() ?>/public/img/corporative/logo.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-10">
                <br>
                <div class="text-center">
                    <h1>FORMATO DE PRODUCCI&Oacute;N</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="row">CLIENTE:</th>
                                    <td><?= $order->getCustomer()->name_customer . ' ' . $order->getCustomer()->surname_customer ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Telefono:</th>
                                    <td><?= $order->getInfoAdress()['whatsapp_infoadress'] ?></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>REFERENCIA</th>
                            <th>TALLA</th>
                            <th>PRODUCTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x = 0;
                        foreach ($order->getDetailList() as $row) : $x += 1;
                        ?>
                            <tr>
                                <th scope="row"><?= $x ?></th>
                                <td><?= $row['reference_num'] . ' - ' . $row['name_reference']  ?></td>
                                <td><?= $row['name_size'] ?></td>
                                <td><?= $row['name_product'] . '<br><b>' . $row['observation'] . '</b>' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url() ?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/public/dist/js/adminlte.js"></script>
    <?= $this->renderSection('js') ?>
</body>

</html>
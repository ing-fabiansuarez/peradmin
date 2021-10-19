<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Recibo de Caja<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Recibos de Caja</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() . route_to('load_session_order', $order->id_order) ?>">Pedido - <?= $order->id_order ?></a></li>
                    <li class="breadcrumb-item active">Recibos de Caja</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-dollar-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pagos recibidos por el concepto de:</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px">Catidad</th>
                                                <th>Producto</th>
                                                <th style="width: 40px">Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($order->getCountEachProduct() as $detail) : ?>
                                                <tr>
                                                    <td><?= $detail['quantity'] ?></td>
                                                    <td><?= $detail['name_product']; ?></td>
                                                    <td class="text-right"><?= number_format($detail['value']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th class="text-right">FLETE</th>
                                                <th><?= number_format($order->getTotalSale()) ?></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th class="text-right">TOTAL</th>
                                                <th><?= number_format($order->getTotalSale()) ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                            <div class="form-group">
                                <label>N&uacute;mero de aprobaci&oacute;n</label>
                                <input type="text" class="form-control" placeholder="Número de aprobación">
                                <p style="margin-bottom: 0;" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label>Valor del pago</label>
                                <input type="number" class="form-control" placeholder="Valor">
                                <p style="margin-bottom: 0;" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label>Fecha de consignaci&oacute;n</label>
                                <input max="<?= date("Y-m-d") ?>" type="date" class="form-control">
                                <p style="margin-bottom: 0;" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label>Banco</label>
                                <select class="custom-select">
                                    <?php foreach ($banks as $bank) : ?>
                                        <option value="<?= $bank['id_bank'] ?>"><?= $bank['name_bank'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p style="margin-bottom: 0;" class="text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label>Voucher</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo_perfil" value="<?= old('photo_perfil') ?>" required>
                                    <label class="custom-file-label" for="customFile">Subir Archivo</label>
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Observación adicional</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-block btn-secondary btn-sm">AGREGAR PAGO</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="callout callout-danger">
                    <h3 class="text-center"><b>2021-05-01</b></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Informaci&oacute;n del pago</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>N&uacute;mero de aprobaci&oacute;n: </label>
                                        3229243184
                                    </div>
                                    <div class="form-group">
                                        <label>Banco: </label>
                                        BANCOLOMBIA
                                    </div>
                                    <div class="form-group">
                                        <label>Fecha de consignaci&oacute;n: </label>
                                        2021-05-1020
                                    </div>
                                    <div class="form-group">
                                        <label>Informaci&oacute;n adicional: </label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                        <h5><b>$ 50,000</b></h5>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-block btn-outline-secondary">
                                <i class="fa fa-print"></i>
                                 Imprimir
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-body">
                                <img src="https://www.periodicolaguajira.com/images/stories/sociales/2020/08-agosto/Recibo.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
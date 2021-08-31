<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Nuevo Pedido<?= $this->endSection() ?>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="maintitle">
                <h2>Nuevo Pedido</h2>
            </div>
            <div class="card">
                <form method="post" action="<?= base_url() . route_to('load_customer_by_order') ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Identificaci&oacute;n del cliente</label>
                            <input value="<?= old('identification') ?>" name="identification" type="text" class="form-control" placeholder="Número">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Cargar Cliente</button>
                    </div>
                </form>
            </div>
            <?php if (!empty(session('msg'))) : ?>
                <div class="alert <?= session('msg.class') ?> alert-dismissible col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><?= session('msg.icon') ?><?= session('msg.title') ?></h5>
                    <?= session('msg.body') ?>
                </div>
            <?php endif; ?>
            <?php if ($customer != null) : ?>
                <div class="card">
                    <form method="post" action="">
                        <div class="card-body">
                            <b><?= $customer->name_customer . ' ' . $customer->surname_customer ?></b><br>
                            <?= $customer->getTypeDocument()['name_typeofidentification'] ?><br>N° <?= $customer->numberidenti_customer ?>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($customer == null) : ?>
            <div class="col-md-5">
                <br>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('create_customer', 1) ?>" method="post">
                            <div class="form-group">
                                <label>N&uacute;mero</label>
                                <input name="identification" value="<?= old('identification') ?>" type="text" class="form-control rounded-0" placeholder="Numero de identificación">
                                <p class="text-danger"><?= session('input_customer.identification') ?></p>
                            </div>
                            <div class="form-group">
                                <label>Tipo de Identificaci&oacute;n</label>
                                <select value="<?= old('type') ?>" name="type" class="custom-select form-control rounded-0">
                                    <?php foreach ($typeofidentification as $type) : ?>
                                        <option value="<?= $type['id_typeofidentification'] ?>"><?= $type['name_typeofidentification'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger"><?= session('input_customer.type') ?></p>
                            </div>
                            <div class="form-group">
                                <label>Nombres</label>
                                <input value="<?= old('name_customer') ?>" name="name_customer" type="text" class="form-control rounded-0" placeholder="Nombres" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <p class="text-danger"><?= session('input_customer.name_customer') ?></p>
                            </div>
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input value="<?= old('surname_customer') ?>" name="surname_customer" type="text" class="form-control rounded-0" placeholder="Apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                <p class="text-danger"><?= session('input_customer.surname_customer') ?></p>
                            </div>
                            <div class=" justify-content-between">
                                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
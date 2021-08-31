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
                <form action="<?= base_url() . route_to('create_customer', 3) ?>" method="post">
                    <div class="card-body">
                        <div class="card" style="margin-bottom: 0;">
                            <div class="card-body">
                                <input style="border: transparent; font-weight: bold;" type="text" name="name_customer" value="<?= $customer->name_customer ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
                                <input style="border: transparent; font-weight: bold;" type="text" name="surname_customer" value="<?= $customer->surname_customer ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
                                <?= $customer->getTypeDocument()['name_typeofidentification'] ?><br>N° <?= $customer->numberidenti_customer ?>
                                <input type="hidden" name="identification" value="<?= $customer->id_customer ?>">
                                <input type="hidden" name="type" value="<?= $customer->type_of_identification_id ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Guardar los cambios</button>
                        <a href="<?= base_url() . route_to('clean_customer') ?>" class="btn btn-primary">Limpiar</a>
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
        </div>

        <div class="col-md-9">

        </div>
    </div>
</div>
<?= $this->endSection() ?>
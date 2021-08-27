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
                            <input name="identification" type="text" class="form-control" placeholder="Número">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Cargar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
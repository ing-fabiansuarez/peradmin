<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?> - Home<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>


<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      
        <!-- <img src="<?= base_url() ?>/public/img/corporative/logo.png" alt="Logo" class="img-fluid" style="width: 100%;"> -->
    </div>
    <div class="col-md-3">

    </div>
</div>


<?= $this->endSection() ?>
<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?> - Home<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>


<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/daterangepicker/daterangepicker.css">


<?= $this->endSection() ?>
<?= $this->section('js') ?>



<!-- Select2 -->
<script src="<?= base_url() ?>/public/plugins/select2/js/select2.full.min.js"></script>

<!-- InputMask -->
<script src="<?= base_url() ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url() ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
    $(function() {
        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            }
        })
    })
</script>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->
<?= $this->section('content') ?>
<div class="row">

    <div class="col-md-6">
        <form action="<?= base_url().route_to('admin_old_validate_dates') ?>" method="post">
            <div class="form-group">
                <label>Rango de fechas:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input name="fechas" type="text" class="form-control float-right" id="reservation">
                    
                    <input type="submit" value="Buscar">

                </div>
                <!-- /.input group -->
            </div>
        </form>
    </div>

</div>
<?= $this->endSection() ?>
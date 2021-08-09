<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Mayoristas<?= $this->endSection() ?>
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
<!-- RENGE DATE -->
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
        $('#date').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            }
        })
    })
</script>
<?= $this->endSection() ?>
<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->
<?= $this->section('content') ?>
<br>
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <form action="" method="post">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><b>Producto</b></span>
                    <span class="info-box-number">
                        <select class="form-control" name="selck">
                            <option value="kljfsd">Alpargatas</option>
                            <option value="jlkfds">Camisetas</option>
                            <option value="">Body Manga Sisa</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-calendar-week"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><b>Rango de Fechas</b></span>
                    <span class="info-box-number">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input name="dates" type="text" class="form-control float-right" id="date">
                            </div>
                        </div>
                    </span>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    Generar Reporte
                </button>
            </div>
        </form>
    </div>
    <div class="col-md-2">

    </div>
</div>

<?= $this->endSection() ?>
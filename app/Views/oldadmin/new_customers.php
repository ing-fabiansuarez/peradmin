<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?> - Mayoristas<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/daterangepicker/daterangepicker.css">

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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

<!-- DATA TABLES -->
<script src="<?= base_url() ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
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
<h2>Reporte de Nuevos Mayoristas <br><?= $dates['start'] . ' a ' . $dates['finish'] ?></h2>
<br>
<div class="row">

    <div class="col-md-6">
        <form action="<?= base_url() . route_to('admin_old_validate_dates') ?>" method="post">
            <div class="form-group">
                <label>Rango de fechas:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input name="dates" type="text" class="form-control float-right" id="reservation">
                    <input type="submit" value="Buscar">
                </div>
            </div>
        </form>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevos Clientes</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Identificaci&oacute;n</th>
                            <th>Cliente</th>
                            <th>WhatsApp</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                            <th>Fecha de inicio</th>
                            <th>Cant. Alpargatas</th>
                            <th>Cant. Ropa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer) : ?>
                            <tr>
                                <td><?= $customer->cli_documento  ?> </td>
                                <td><?= $customer->cli_nombres ?></td>
                                <td><?= $customer->cli_whatsapp ?> </td>
                                <td><?= $customer->cli_email ?></td>
                                <td><?= $customer->cli_ciudad ?></td>
                                <td><?= $customer->cli_fecha_creacion ?></td>
                                <td><?= $customer->getQuantityDeilOrderMayor(1) ?></td>
                                <td><?= $customer->getQuantityDeilOrderMayor(2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Identificaci&oacute;n</th>
                            <th>Cliente</th>
                            <th>WhatsApp</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                            <th>Fecha de inicio</th>
                            <th>Cant. Alpargatas</th>
                            <th>Cant. Ropa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>
<?= $this->endSection() ?>
<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Reporte de <?= $namecategory . ' entre ' . $startdate . ' y ' . $finishdate ?><?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?= $this->endSection() ?>



<?= $this->section('js') ?>
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
        $("#table_report").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "excel", "pdf", "print"],
            "pageLength": 50
        }).buttons().container().appendTo('.col-md-6:eq(0)');
    })
</script>


<?= $this->endSection() ?>
<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="maintitle">
            <h2>Reporte de <?= $namecategory ?></h2>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Reporte de <?= $namecategory . ' entre ' . $startdate . ' y ' . $finishdate ?></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table_report" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Nombre</th>
                            <th>Mayor</th>
                            <th>Detal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($arrayresult as $row) :
                            if ($row['quantity'] != 0) :
                        ?>
                                <tr>
                                    <td><?= $row['pro_ref'] ?> </td>
                                    <td><?= $row['pro_nombre'] ?></td>
                                    <td><?= $row['quantitymayor'] ?> </td>
                                    <td><?= $row['quantitydetal'] ?> </td>
                                    <td><?= $row['quantity'] ?> </td>
                                </tr>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

</div>
<?= $this->endSection() ?>
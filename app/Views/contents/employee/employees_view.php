<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Cargos<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/toastr/toastr.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/public/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/public/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>

<div class="container">
    <div class="maintitle">
        <h2>Empleados</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Cargos De La Empresa</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de inicio</th>
                                <th>Cargo</th>
                                <th>Activo</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee) : ?>
                                <tr>
                                    <td><?= $employee->photo_employee ?> </td>
                                    <td><?= $employee->id_employee ?></td>
                                    <td><?= $employee->name_employee ?></td>
                                    <td><?= $employee->surname_employee ?></td>
                                    <td><?= $employee->startdate_employee ?></td>
                                    <td>Cargo </td>
                                    <td><?= $employee->active_employee ?></td>
                                    <td>
                                        <button id="btn-update" type="button" class="btn btn-app bg-corporative">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </td>
                                    <td>
                                        <button id="btn-delete" type="button" class="btn btn-app bg-delete">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-modal">
                    <div id="modal-header" class="modal-header">
                        <h5 class="modal-title" id="title-modal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Id Cargo</label>
                            <input id="input_modal_id" type="text" class="form-control" placeholder="" disabled="">
                        </div>
                        <div class="form-group">
                            <label>Nombre Del Cargo</label>
                            <input id="input_modal_name" name="name_jobtitle" type="text" class="form-control" placeholder="Cargo" value="<?= old('name_jobtitle') ?>">
                            <p class="text-danger"><?= session('error_validate.name_jobtitle') ?></p>
                        </div>
                        <div class="form-group">
                            <label>Salario</label>
                            <input id="input_modal_salary" name="salary_jobtitle" type="number" step="any" class="form-control" placeholder="Sueldo" value="<?= old('salary_jobtitle') ?>">
                            <p class="text-danger"><?= session('error_validate.salary_jobtitle') ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button id="btn-submit-modal" type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
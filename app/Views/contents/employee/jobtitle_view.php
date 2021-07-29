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
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/public/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/public/plugins/toastr/toastr.min.js"></script>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        <?= session('msg_toastr') ?>
    });
</script>

<?= $this->endSection() ?>


<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>

<div class="container">
    <div class="maintitle">
        <h2>Cargos</h2>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-building"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cargos</span>
                    <span class="info-box-number">1</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="card card-success shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Cliente</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-client" action="<?= base_url() . route_to('create_new_jobtitles') ?>" method="post">

                        <div class="form-group row">
                            <label>Nombre Del Cargo</label>
                            <input name="name_jobtitle" type="text" class="form-control" placeholder="Cargo" value="<?= old('name_jobtitle') ?>">
                            <p class="text-danger"><?= session('error_validate.name_jobtitle') ?></p>
                        </div>
                        <div class="form-group row">
                            <label>Salario</label>
                            <input name="salary_jobtitle" type="number" step="any" class="form-control" placeholder="Sueldo" value="<?= old('salary_jobtitle') ?>">
                            <p class="text-danger"><?= session('error_validate.salary_jobtitle') ?></p>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                GUARDAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-dark shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">CARGOS</h3>
                </div>
                <div class="card-body padding-0">
                    <div class="card-body table-responsive p-0" style="height: 59vh;">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id Cargo</th>
                                    <th>Nombre</th>
                                    <th>Salario Basico</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jobtitles as $job) : ?>
                                    <tr>
                                        <td><?= $job['id_jobtitle'] ?> </td>
                                        <td><?= $job['name_jobtitle'] ?></td>
                                        <td><?= '$ ' . number_format($job['salary_jobtitle']) ?></td>
                                        <td>
                                            <form action="<?=base_url().route_to('update_jobtitles')?>" method="post">
                                                <button class="btn btn-app bg-corporative">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="<?=base_url().route_to('delete_jobtitles')?>" method="post">
                                                <button type="submit" class="btn btn-app bg-delete">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
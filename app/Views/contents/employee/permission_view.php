<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Permisos<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/toastr/toastr.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Toastr -->
<script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        getPermissions();

        function getPermissions() {
            $.ajax({
                url: "<?= base_url() . route_to('ajax_permissionsby', $employee->id_employee) ?>",
                type: "POST",
                success: function(data1) {
                    try {
                        var permisos = JSON.parse(data1);
                        console.log(permisos);
                        for (var i in permisos) {
                            if (permisos[i] == 1) {
                                $("#div_passwords").css("display", "block");
                            }
                            console.log(i);
                            cadena = "#" + permisos[i];
                            $(cadena).prop('checked', true);
                        }
                    } catch (e) {
                        toastr.error(data1);
                    }
                },
                error: function() {
                    alert('No se pudo conectar con el servidor');
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>

<div class="container">
    <div class="maintitle">
        <h2>Permisos</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="bg-corporative widget-user-header ">
                    <h3 class="widget-user-username"><b><?= $employee->name_employee . ' ' . $employee->surname_employee ?></b></h3>
                    <h5 class="widget-user-desc"><?= $employee->getJobtitle_id_jobtitle()['name_jobtitle'] ?><br>C.C. <?= $employee->id_employee ?></h5>
                </div>
                <div class="widget-user-image" style="top: 97px;">
                    <img class="img-circle elevation-2" src="<?= base_url('img/users') . '/' . $employee->photo_employee ?>" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Informaci&oacute;n</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= $employee->startdate_employee ?></h5>
                                                <span class="description-text">TRABAJANDO DESDE</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= $employee->phonenumber_employee ?></h5>
                                                <span class="description-text">TELEFONO</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= $employee->created_at_employee->humanize() ?></h5>
                                                <span class="description-text">CREADO</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= $employee->updated_at_employee->humanize() ?></h5>
                                                <span class="description-text">ACTUALIZADO</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="div_passwords" class="card card-secondary" style="display: none;">
                                <div class="card-header">
                                    <h3 class="card-title">Establecer o Cambiar Contraseña</h3>
                                </div>
                                <div class="card-body">
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <form action="<?= base_url() . route_to('update_password_employee', $employee->id_employee) ?>" method="post">
                                                <div class='form-group'>
                                                    <label>Contraseña</label>
                                                    <input name='pass_employee' type='password' class='form-control' placeholder='Contraseña'>
                                                </div>
                                                <div class='form-group'>
                                                    <label>Confirmar contraseña</label>
                                                    <input name='pass_confirm' type='password' class='form-control' placeholder='Confirmar Contraseña'>
                                                </div><br>
                                                <button id="btn_save_changes" type="submit" class="btn btn-primary bg-corporative">Establecer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Permisos</h3>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty(session('msg'))) : ?>
                                        <div class="alert <?= session('msg.class') ?> alert-dismissible col-md-12">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><?= session('msg.icon') ?><?= session('msg.title') ?></h5>
                                            <?= session('msg.body') ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="<?= base_url() . route_to('update_employee_permission', $employee->id_employee) ?>" method="post">
                                        <ul id="list_permissions" class="list-group">
                                            <?php foreach ($permissions as $permission) : ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input name="<?= $permission['id_permission'] ?>" type="checkbox" id="<?= $permission['id_permission'] ?>">
                                                            <label for="<?= $permission['id_permission'] ?>">
                                                                <?= $permission['name_permission'] . '<br>' . $permission['description_permission'] ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <br>
                                        <button id="btn_save_changes" type="submit" class="btn btn-primary bg-corporative">Guardar los cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
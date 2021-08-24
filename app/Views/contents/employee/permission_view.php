<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Permisos<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/toastr/toastr.min.css">
<link href="<?= base_url() ?>/public/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Toastr -->
<script src="<?= base_url() ?>/public/plugins/toastr/toastr.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= base_url() ?>/public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    $(function() {
        $("[name=my-checkbox]").bootstrapSwitch();
    })
    $(document).ready(function() {
        getPermissions();
     

        function getPermissions() {
            $.ajax({
                url: "<?= base_url() . route_to('ajax_permissionsby', 1098823092) ?>",
                type: "POST",
                success: function(data1) {
                    $("#aa").prop('checked');
                    try {
                        var permisos = JSON.parse(data1);
                        console.log(permisos);

                        for (var i in permisos) {
                            console.log(permisos[i])
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
                    <img class="img-circle elevation-2" src="<?= base_url('public/img/users') . '/' . $employee->photo_employee ?>" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header"><?= $employee->startdate_employee ?></h5>
                                <span class="description-text">TRABAJANDO DESDE</span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="description-block">
                                <h5 class="description-header"><?= $employee->phonenumber_employee ?></h5>
                                <span class="description-text">TELEFONO</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header"><?= $employee->created_at_employee->humanize() ?></h5>
                                <span class="description-text">CREADO</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="description-block">
                                <h5 class="description-header"><?= $employee->updated_at_employee->humanize() ?></h5>
                                <span class="description-text">ACTUALIZADO</span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Permisos</h3>
                                </div>
                                <div class="card-body">
                                    <input id="aa" type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    <ul id="list_permissions" class="list-group">
                                        <?php foreach ($permissions as $permission) : ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <?= $permission['name_permission'] . '<br>' . $permission['description_permission'] ?>
                                                <input id="<?= $permission['id_permission'] ?>" type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
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
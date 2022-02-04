<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Empleados<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>
<?= $this->section('active-empleados') ?>active<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/toastr/toastr.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Animation -->
<link href="<?= base_url() ?>/plugins/aos/aos.css" rel="stylesheet">
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- animation -->
<script src="<?= base_url() ?>/plugins/aos/aos.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

<script>
    $(document).ready(function() {
        var action;
        var rowTable;
        reloadjobtitles();
        tableEmployee = $("#employee_table").DataTable({
            "order": [
                [4, "desc"]
            ],
            responsive: true,
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });

        function reloadjobtitles() {
            $.ajax({
                type: "get",
                url: '<?= base_url() . route_to('ajax_html_jobtitles') ?>',
                success: function(r) {
                    $("#select_jobtitles").html(r);
                },
            });
        }

        $(document).on("click", "#btn_delete_employee", function() {
            action = 4;

            //arregla para que tome la tabla correcta cuando sea responsive
            rowTable = $(this).parents('tr'); //Get the current row
            if (rowTable.hasClass('child')) { //Check if the current row is a child row
                rowTable = rowTable.prev(); //If it is, then point to the row before it (its 'parent')
            }

            cedula = rowTable.find('td:eq(2)').text();
            names = rowTable.find('td:eq(3)').text();
            surnames = rowTable.find('td:eq(4)').text();
            date = rowTable.find('td:eq(9)').text();
            phone = rowTable.find('td:eq(6)').text();
            photo = rowTable.find('td:eq(0)').find("img").attr("src");
            jobtitle = rowTable.find('td:eq(5)').text();


            //atributos del titulo
            $("#modal_employee_title").text("¿Seguro que desea ELIMINAR el registro?");
            $("#modal_employee_header").removeClass('bg-corporative');
            $("#modal_employee_header").addClass('bg-delete');

            $("#btn_save_changes").text('Eliminar Registro');
            $("#btn_save_changes").removeClass('bg-corporative');
            $("#btn_save_changes").addClass('bg-delete');

            //deshabilitar inputs
            $("#cedula_employee_modal").attr('disabled', '');
            $("#name_employee_modal").attr('disabled', '');
            $("#surname_employee_modal").attr('disabled', '');
            $("#date_employee_modal").attr('disabled', '');
            $("#phonenumber_employee_modal").attr('disabled', '');

            //poner el texto del modal
            $("#cedula_label").text(cedula);
            $("#cargo_label").text(jobtitle);
            $("#cedula_employee_modal").val(cedula);
            $("#name_employee_modal").val(names);
            $("#surname_employee_modal").val(surnames);
            $("#date_employee_modal").val(date);
            $("#phonenumber_employee_modal").val(phone);
            $("#photo_employee_modal").attr("src", photo);

            $("#modal-employee").modal("show");

        });

        $(document).on("click", "#btn_update_employee", function() {
            action = 3;

            //arregla para que tome la tabla correcta cuando sea responsive
            rowTable = $(this).parents('tr'); //Get the current row
            if (rowTable.hasClass('child')) { //Check if the current row is a child row
                rowTable = rowTable.prev(); //If it is, then point to the row before it (its 'parent')
            }

            cedula = rowTable.find('td:eq(2)').text();
            names = rowTable.find('td:eq(3)').text();
            surnames = rowTable.find('td:eq(4)').text();
            date = rowTable.find('td:eq(9)').text();
            phone = rowTable.find('td:eq(6)').text();
            photo = rowTable.find('td:eq(0)').find("img").attr("src");
            jobtitle = rowTable.find('td:eq(5)').text();

            //deshabilitar y habilitar inputs
            $("#cedula_employee_modal").attr('disabled', '');
            $("#name_employee_modal").removeAttr('disabled', '');
            $("#surname_employee_modal").removeAttr('disabled', '');
            $("#date_employee_modal").removeAttr('disabled', '');
            $("#phonenumber_employee_modal").removeAttr('disabled', '');

            //atributos de interfaz
            $("#modal_employee_title").text("Editar el empleado");
            $("#modal_employee_header").removeClass('bg-delete');
            $("#modal_employee_header").addClass('bg-corporative');

            $("#btn_save_changes").text('Guardar los cambios');
            $("#btn_save_changes").removeClass('bg-delete');
            $("#btn_save_changes").addClass('bg-corporative');

            //poner el texto del modal
            $("#cedula_label").text(cedula);
            $("#cargo_label").text(jobtitle);
            $("#cedula_employee_modal").val(cedula);
            $("#name_employee_modal").val(names);
            $("#surname_employee_modal").val(surnames);
            $("#date_employee_modal").val(date);
            $("#phonenumber_employee_modal").val(phone);
            $("#photo_employee_modal").attr("src", photo);

            $("#modal-employee").modal("show");

        });

        $("#form_edit_employee").submit(function(e) {
            e.preventDefault();

            //data para enviar por ajax
            cedula = $.trim($("#cedula_employee_modal").val());
            names = $.trim($("#name_employee_modal").val());
            surnames = $.trim($("#surname_employee_modal").val());
            date = $.trim($("#date_employee_modal").val());
            phone = $.trim($("#phonenumber_employee_modal").val());

            $.ajax({
                url: "<?= base_url() ?>/empleados/crud/" + action,
                type: "POST",
                data: {
                    cedula_employee: cedula,
                    name_employee: names,
                    surname_employee: surnames,
                    date_employee: date,
                    phonenumber_employee: phone
                },
                success: function(data1) {
                    console.log(data1);
                    if (data1 == 1) {
                        if (action == 3) {
                            inforow = tableEmployee.row(rowTable).data();
                            inforow[3] = names;
                            inforow[4] = surnames;
                            inforow[6] = phone;
                            inforow[9] = date;
                            tableEmployee.row(rowTable).data(inforow).draw();
                            toastr.success('Se guardaron los cambios.');
                            $("#modal-employee").modal("hide");
                        } else if (action == 4) {
                            tableEmployee.row(rowTable).remove().draw();
                            toastr.error('Se elimino correctamente.');
                            $("#modal-employee").modal("hide");
                        }
                    } else {
                        toastr.error(data1);
                    }
                },
                error: function() {
                    toastr.error("No hay internet, no se ha podido conectar al servidor.");
                }
            });



        });
    });
</script>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>
<div class="container">
    <div class="maintitle">
        <h2>Empleados</h2>
    </div>
    <div class="row">
        <div class="col-md-2">
        </div>
        <?php if (!empty(session('msg'))) : ?>
            <div class="alert alert-success alert-dismissible col-md-8">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> <?= session('msg.title') ?></h5>
                <?= session('msg.body') ?>
            </div>
        <?php endif; ?>
        <?php if (!empty(session('error'))) : ?>
            <div class="alert alert-danger alert-dismissible col-md-12">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> <?= session('error.title') ?></h5>
                <?= session('error.body') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Lista de Empleados</h3>
                </div>
                <div class="card-body">
                    <table id="employee_table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Acciones</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cargo</th>
                                <th>Telefono</th>
                                <th>Ultima Actualización</th>
                                <th>Fecha de creación</th>
                                <th>Inicio en la empresa</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee) : ?>
                                <tr>
                                    <td style="max-width: 60px;"><img src="<?= base_url() ?>/img/users/<?= $employee->photo_employee ?>" alt="Foto" class="img-fluid prodimg"></td>
                                    <td>
                                        <a href="<?= base_url() . route_to('view_employee_permissions', $employee->id_employee) ?>">
                                            <button id="btn_update_permissions" type="button" class="btn btn-app bg-yellow">
                                                <i class="fas fa-drum"></i> Permisos
                                            </button>
                                        </a>
                                        <button id="btn_update_employee" type="button" class="btn btn-app bg-corporative">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button id="btn_delete_employee" type="button" class="btn btn-app bg-delete">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </td>
                                    <td><?= $employee->id_employee ?></td>
                                    <td><?= $employee->name_employee ?></td>
                                    <td><?= $employee->surname_employee ?></td>
                                    <td>Cargo </td>
                                    <td><?= $employee->phonenumber_employee ?></td>
                                    <td><?= $employee->updated_at_employee->humanize() ?></td>
                                    <td><?= $employee->created_at_employee->humanize() ?></td>
                                    <td><?= $employee->startdate_employee ?></td>
                                    <td><?= $employee->active_employee ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Empleado</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <form method="post" action="<?= base_url() . route_to('crud_employee', 1) ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Cedula</label>
                                    <input name="cedula_employee" type="number" class="form-control" placeholder="Cedula" value="<?= old('cedula_employee') ?>" required>
                                    <p class="text-danger"><?= session('errorsinputs.cedula_employee') ?></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input name="name_employee" type="text" class="form-control" placeholder="Nombres" value="<?= old('name_employee') ?>" required>
                                    <p class="text-danger"><?= session('errorsinputs.name_employee') ?></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input name="surname_employee" type="text" class="form-control" placeholder="Apellidos" value="<?= old('surname_employee') ?>" required>
                                    <p class="text-danger"><?= session('errorsinputs.surname_employee') ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Fecha de Inicio</label>
                                    <input name="date_employee" type="date" class="form-control" value="<?= old('date_employee') ?>" required>
                                    <p class="text-danger"><?= session('errorsinputs.date_employee') ?></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Cargo</label>
                                    <select name="select_jobtitles" id="select_jobtitles" class="form-control" value="<?= old('select_jobtitles') ?>" required>
                                    </select>
                                    <p class="text-danger"><?= session('errorsinputs.select_jobtitles') ?></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>N&uacute;mero Celular</label>
                                    <input name="phonenumber_employee" type="number" class="form-control" placeholder="Número telefonico" value="<?= old('phonenumber_employee') ?>" required>
                                    <p class="text-danger"><?= session('errorsinputs.phonenumber_employee') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto de perfil</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo_perfil" value="<?= old('photo_perfil') ?>" required>
                                <label class="custom-file-label" for="customFile">Subir Archivo</label>
                                <p class="text-danger"><?= session('errorsinputs.photo_employee') ?></p>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Guardar Empleado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-employee">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal_employee_header" class="modal-header">
                    <h4 id="modal_employee_title" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_employee" method="post" action="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="member align-items-start aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                                        <div class="text-center">
                                            <img id="photo_employee_modal" alt="Foto de perfil" class="img-fluid">
                                            <b><label id="cedula_label"></label></b><br><label id="cargo_label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Cedula</label>
                                            <input id="cedula_employee_modal" type="number" class="form-control" placeholder="Cedula">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input id="name_employee_modal" type="text" class="form-control" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input id="surname_employee_modal" type="text" class="form-control" placeholder="Apellidos">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Fecha de Inicio</label>
                                            <input id="date_employee_modal" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>N&uacute;mero Celular</label>
                                            <input id="phonenumber_employee_modal" type="number" class="form-control" placeholder="Número telefonico">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id="btn_save_changes" type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
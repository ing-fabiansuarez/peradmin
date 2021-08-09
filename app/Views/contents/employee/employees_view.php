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
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>

<script>
    $(document).ready(function() {
        tableEmployee = $("#employee_table").DataTable({
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
    });
    $("#btn-create-employee").click(function() {
        $("#modal_employee_header").css("background-color", "#6c757d");
        $("#modal_employee_title").css("color", "#fff").text("Nuevo Empleado");
        reloadjobtitles();
        $("#modal-employee").modal("show");
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

    /* //ajax para traer los inputs del contraseñas
     $("#select_access").change(function() {
         getHtmlPass();
     });
     function getHtmlPass() {
         let access = $("#select_access").val();
         $.ajax({
             type: "get",
             url: '<?= base_url('html/inputspass') ?>' + '/' + access,
             success: function(r) {
                 $("#div_password").html(r);
             },
         });
     } 
     $("#pass").click(function() {
         $("#p_danger").text("");
     });
     $("#pass_confirmation").click(function() {
         $("#p_danger").text("");
     });*/

    $("#form_employee").submit(function(e) {
        e.preventDefault();
        //validations

        //tomar los datos para enviarlos
        cedula = $.trim($("#cedula_employee").val());
        name = $.trim($("#name_employee").val());
        surname = $.trim($("#surname_employee").val());
        date = $.trim($("#date_employee").val());
        jobtitle = $.trim($("#select_jobtitles").val());
        phonenumber = $.trim($("#phonenumber_employee").val());

        //peticion al servidor
        $.ajax({
            type: "post",
            url: '<?= base_url('empleados/crud') ?>' + '/' + 1,
            data: {
                cedula: cedula,
                name: name,
                surname: surname,
                date: date,
                jobtitle: jobtitle,
                phonenumber: phonenumber
            },
            success: function(data) {
                if (data == true) {
                    tableEmployee.row.add(['',cedula, name,surname,phonenumber,date,'',1,'','']).draw();
                    toastr.success('Se guardaron los cambios.');
                } else {
                    toastr.error(data);
                }

            }
        });

        $("#modal-employee").modal("hide");
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
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Cargos De La Empresa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button id="btn-create-employee" type="button" class="btn btn-block btn-outline-secondary btn-lg">Crear Nuevo Empleado</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <br>
                    <table id="employee_table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Telefono</th>
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
                                    <td><?= $employee->phonenumber_employee ?></td>
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
    <div class="modal fade" id="modal-employee">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal_employee_header" class="modal-header">
                    <h4 id="modal_employee_title" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_employee">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Cedula</label>
                                    <input id="cedula_employee" type="number" class="form-control" placeholder="Cedula">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input id="name_employee" type="text" class="form-control" placeholder="Nombres">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input id="surname_employee" type="text" class="form-control" placeholder="Apellidos">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Fecha de Inicio</label>
                                    <input id="date_employee" type="date" class="form-control">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Cargo</label>
                                    <select id="select_jobtitles" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>N&uacute;mero Celular</label>
                                    <input id="phonenumber_employee" type="number" class="form-control" placeholder="Número telefonico">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto de perfil</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Subir Archivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
<?= $this->endSection() ?>
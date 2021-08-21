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
<script>
    $(document).ready(function() {

        tableJobtitle = $("#jobtitle_table").DataTable({
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

        //capturar la fila para editar o borra
        var rowTable;
        var action;

        $(document).on("click", "#btn-update", function() {


            //arregla para que tome la tabla correcta cuando sea responsive
            rowTable = $(this).parents('tr'); //Get the current row
            if (rowTable.hasClass('child')) { //Check if the current row is a child row
                rowTable = rowTable.prev(); //If it is, then point to the row before it (its 'parent')
            }

            id = parseInt(rowTable.find('td:eq(0)').text());
            name = rowTable.find('td:eq(1)').text();
            salary = parseFloat(rowTable.find('td:eq(2)').text());

            action = 'update';

            //atributos del titulo
            $("#title-modal").text("EDITAR REGISTRO");
            $("#modal-header").removeClass('bg-delete');
            $("#modal-header").addClass('bg-corporative');

            //desabilitar los inputs
            $("#input_modal_name").removeAttr('disabled', '');
            $("#input_modal_salary").removeAttr('disabled', '');

            //atributos del boton
            $("#btn-submit-modal").text('Guardar los cambios');
            $("#btn-submit-modal").removeClass('bg-delete');
            $("#btn-submit-modal").addClass('bg-corporative');

            //valores de los inputs
            $("#input_modal_id").val(id);
            $("#input_modal_name").val(name);
            $("#input_modal_salary").val(salary);
            $("#modal").modal("show");

        });
        $(document).on("click", "#btn-delete", function() {

            //arregla para que tome la tabla correcta cuando sea responsive
            rowTable = $(this).parents('tr'); //Get the current row
            if (rowTable.hasClass('child')) { //Check if the current row is a child row
                rowTable = rowTable.prev(); //If it is, then point to the row before it (its 'parent')
            }

            id = parseInt(rowTable.find('td:eq(0)').text());
            name = rowTable.find('td:eq(1)').text();
            salary = parseFloat(rowTable.find('td:eq(2)').text());

            action = 'delete';

            //atributos del titulo
            $("#title-modal").text("¿Seguro que desea ELIMINAR el registro?");
            $("#modal-header").removeClass('bg-corporative');
            $("#modal-header").addClass('bg-delete');

            //desabilitar los inputs
            $("#input_modal_name").attr('disabled', '');
            $("#input_modal_salary").attr('disabled', '');

            //atributos del boton
            $("#btn-submit-modal").text('Eliminar Registro');
            $("#btn-submit-modal").removeClass('bg-corporative');
            $("#btn-submit-modal").addClass('bg-delete');

            //valores de los inputs
            $("#input_modal_id").val(id);
            $("#input_modal_name").val(name);
            $("#input_modal_salary").val(salary);
            $("#modal").modal("show");
        });

        $("#form-modal").submit(function(e) {
            e.preventDefault();
            id = $.trim($("#input_modal_id").val());
            name = $.trim($("#input_modal_name").val());
            salary = $.trim($("#input_modal_salary").val());

            $.ajax({
                url: "http://localhost/peradmin/cargos/crud/" + action,
                type: "POST",
                data: {
                    name: name,
                    id: id,
                    salary: salary
                },
                success: function(data1) {
                    console.log(data1);
                    if (data1 == 1) {
                        if (action == 'update') {
                            inforow = tableJobtitle.row(rowTable).data();
                            inforow[0] = id;
                            inforow[1] = name;
                            inforow[2] = salary;
                            tableJobtitle.row(rowTable).data(inforow).draw();
                            toastr.success('Se guardaron los cambios.');
                        } else if (action == 'delete') {
                            tableJobtitle.row(rowTable).remove().draw();
                            quean = $("#quantity").text();
                            $("#quantity").text(quean - 1);
                            toastr.error('Se elimino correctamente.');
                        }
                    } else {
                        toastr.error(data1);
                    }
                },
                error: function() {
                    toastr.error("No se ha podido conectar con el servidor");
                }
            });

            $("#modal").modal("hide");
        });



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
                    <span id="quantity" class="info-box-number"><?= count($jobtitles) ?></span>
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
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Cargos De La Empresa</h3>
                </div>
                <div class="card-body">
                    <table id="jobtitle_table" class="table table-hover text-nowrap">
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
                                    <td><?= $job['salary_jobtitle'] ?></td>
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
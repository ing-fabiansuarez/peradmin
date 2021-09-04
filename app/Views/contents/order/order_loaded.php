<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Pedido Cargado<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        tableDetailOrder = $("#detail_order_table").DataTable({
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
        loadsizes();
        loadreferences();
        loadobservations();
        $("#select_product").change(function() {
            loadreferences();
            loadsizes();
            loadobservations();
        });
    });

    function loadsizes() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_html_sizes') ?>",
            data: "product=" + $("#select_product").val(),
            success: function(r) {
                $("#select_sizes").html(r);
            },
        });
    }

    function loadreferences() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_html_references') ?>",
            data: "product=" + $("#select_product").val(),
            success: function(r) {
                $("#select_references").html(r);
            },
        });
    }

    function loadobservations() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_html_observations') ?>",
            data: "product=" + $("#select_product").val(),
            success: function(r) {
                $("#div_observation").html(r);
            },
        });
    }
</script>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>
<br>
<!-- <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pedido</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Calendar</li>
                </ol>
            </div>
        </div>
    </div>
</section> -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-block btn-default btn-lg">LIMPIAR PANTALLA</button>
                <br>
                <div class="card card-primary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('create_customer', 3) ?>" method="post">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <input style="border: transparent; font-weight: bold;" type="text" name="name_customer" value="<?= $customer->name_customer ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </li>
                                <li class="nav-item">
                                    <input style="border: transparent; font-weight: bold;" type="text" name="surname_customer" value="<?= $customer->surname_customer ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </li>
                                <li class="nav-item">
                                    <?= $customer->getTypeDocument()['name_typeofidentification'] ?>
                                </li>
                                <li class="nav-item">
                                    <b>N°</b> <?= $customer->numberidenti_customer ?>
                                </li>
                            </ul>
                            <input type="hidden" name="identification" value="<?= $customer->id_customer ?>">
                            <input type="hidden" name="type" value="<?= $customer->type_of_identification_id ?>">
                            <button type="submit" class="btn btn-default btn-block">Guardar Cambios</a>
                        </form>
                    </div>
                </div>

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Informaci&oacute;n del pedido</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <b>N° </b><?= $order->id_order ?>
                            </li>
                            <li class="nav-item">
                                <b>Creado por: </b><?= $order->getCreatedByNameComplete() ?>
                            </li>
                            <li class="nav-item">
                                <b>Fecha de creaci&oacute;n: </b><?= $order->created_at_order->humanize() ?>
                            </li>
                            <li class="nav-item">
                                <b>Observaci&oacute;n: </b><?= $order->info_order ?>
                            </li>
                        </ul>
                        <br>
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Datos de envio</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="card-body">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <b>Whatsapp: </b><?= $infoadress['whatsapp_infoadress'] ?>
                                    </li>
                                    <li class="nav-item">
                                        <b>Email: </b><?= $infoadress['email_infoadress'] ?>
                                    </li>
                                    <li class="nav-item">
                                        <b>Ciudad: </b><?= $infoadress['city_id'] ?>
                                    </li>
                                    <li class="nav-item">
                                        <b>Barrio: </b><?= $infoadress['neighborhood_infoadress'] ?>
                                    </li>
                                    <li class="nav-item">
                                        <b>Direcci&oacute;n: </b><?= $infoadress['home_infoadress'] ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('add_product_order') ?>" method="post">
                            <div class="form-group">
                                <label>Producto</label>
                                <select name="product_id" id="select_product" class="custom-select">
                                    <?php foreach ($products as $row) : ?>
                                        <option value="<?= $row['id_product'] ?>"><?= $row['name_product'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Referencia</label>
                                <select name="reference_id" id="select_references" class="custom-select">

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tallas</label>
                                <select name="size_id" id="select_sizes" class="custom-select">

                                </select>
                            </div>
                            <div id="div_observation">
                            </div>
                            <div class="form-group">
                                <label>Catidad</label>
                                <select name="quantity" class="custom-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                    <option>13</option>
                                    <option>14</option>
                                    <option>15</option>
                                    <option>16</option>
                                    <option>17</option>
                                    <option>17</option>
                                    <option>19</option>
                                    <option>20</option>
                                    <option>30</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-block btn-secondary btn-sm">AGREGAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Detalle del pedido</h3>
                    </div>
                    <div class="card-body">
                        <table id="detail_order_table" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Producto</th>
                                    <th>Referencia</th>
                                    <th>Talla</th>
                                    <th>Observaci&oacute;n</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
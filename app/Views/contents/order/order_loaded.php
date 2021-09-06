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
            /* "order": [
                [1, "desc"]
            ], */
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
        setPrice();
        $("#select_product").change(function() {
            loadreferences();
            loadsizes();
            loadobservations();
            setPrice();
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

    function setPrice() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_price_product') ?>",
            data: {
                product: $("#select_product").val(),
                type_order: <?= $order->type_of_order_id ?>
            },
            success: function(r) {
                $("#input_price").val(r);
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

                <a href="<?= base_url() . route_to('clean_customer') ?>" type="button" class="btn btn-block btn-outline-dark btn-lg">LIMPIAR PANTALLA</a>
                <br>
                <?php if (!empty(session('msg'))) : ?>
                    <div class="alert <?= session('msg.class') ?> alert-dismissible col-md-12">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><?= session('msg.icon') ?><?= session('msg.title') ?></h5>
                        <?= session('msg.body') ?>
                    </div>
                <?php endif; ?>
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
            <div class="col-md-9">
                <div class="row">
                    <div class="info-box bg-headerordermayor">
                        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><b>PEDIDO AL <?= $order->getTypeOrder()['name_typeoforder'] ?></b></span>
                            <span class="info-box-number">Pedido a nombre de <?= $order->getCustomer()->name_customer ?> <?= $order->getCustomer()->surname_customer ?></span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                Por el total de $ <b><?= number_format(55000) ?></b>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= base_url() . route_to('add_product_order') ?>" method="post">
                                    <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <select name="product_id" id="select_product" class="custom-select">
                                            <?php foreach ($products as $row) : ?>
                                                <option value="<?= $row['id_product'] ?>"><?= $row['name_product'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.product_id') ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Referencia</label>
                                        <select name="reference_id" id="select_references" class="custom-select">
                                        </select>
                                        <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.reference_id') ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tallas</label>
                                        <select name="size_id" id="select_sizes" class="custom-select">
                                        </select>
                                        <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.size_id') ?></p>
                                    </div>
                                    <div id="div_observation">
                                    </div>
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <select name="quantity" class="custom-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.quantity') ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input id="input_price" name="precio" type="number" class="form-control" placeholder="$">
                                        <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.precio') ?></p>
                                    </div>
                                    <button type="submit" class="btn btn-block btn-secondary btn-sm">AGREGAR</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-block btn-outline-success btn-sm">Pasar a producci&oacute;n</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-block btn-outline-success btn-sm">Generar PDF</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-block btn-outline-success btn-sm">Generar R&oacute;tulo</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Detalle del pedido</h3>
                            </div>
                            <div class="card-body">
                                <table id="detail_order_table" class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Producto</th>
                                            <th>Referencia</th>
                                            <th>Talla</th>
                                            <th>Precio</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0;
                                        foreach ($detail_of_order as $row) :
                                            $counter += 1; ?>
                                            <tr>
                                                <td><?= $counter ?></td>
                                                <td><?= $row['name_product'] ?><br><?= $row['observation'] ?></td>
                                                <td><?= $row['reference_num'] ?> - <?= $row['name_reference'] ?></td>
                                                <td><?= $row['name_size'] ?></td>
                                                <td>$ <?= number_format($row['pricesale_detailorder']) ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_detail_order" value="<?= $row['id_detailorder'] ?>">
                                                        <button id="btn_delete_employee" type="submit" class="btn bg-delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
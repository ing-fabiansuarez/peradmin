<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Pedido Cargado<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('active-ingresar') ?>active<?= $this->endSection() ?>

<?= $this->section('css') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {

        tableDetailOrder = $("#detail_order_table").DataTable({
            /* "order": [
                [1, "desc"]
            ], */

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
            responsive: true,
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
        $("#select_department").change(function() {
            reloadcities();
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
        /*  $.ajax({
             type: "post",
             url: "<?= base_url() . route_to('ajax_price_product') ?>",
             data: {
                 product: $("#select_product").val(),
                 type_order: <?= $order->type_of_order_id ?>
             },
             success: function(r) {
                 $("#input_price").val(r);
             },
         }); */
    }

    function reloadcities() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_html_cities') ?>",
            data: "department=" + $("#select_department").val(),
            success: function(r) {
                $("#cities_select").html(r);
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
                <div class="card card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
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
                            <?php if (!$order->isProduction()) : ?>
                                <button type="submit" class="btn btn-default btn-block">Guardar Cambios</a>
                                <?php endif; ?>
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
                            <li style="color: red;font-size: 30px;" class="nav-item">
                                <b>N° <?= $order->id_order ?></b>
                            </li>
                            <li class="nav-item">
                                <b>Creado por: </b><?= $order->getCreatedByNameComplete() ?>
                            </li>
                            <li class="nav-item">
                                <b>Fecha de creaci&oacute;n: </b><?= $order->created_at_order->humanize() ?>
                            </li>
                            <form action="<?= base_url() . route_to('update_observation_order') ?>" method="post">
                                <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                                <li class="nav-item">
                                    <div class="form-group">
                                        <label>Observaci&oacute;n:</label>
                                        <textarea name="observation_order" class="form-control" rows="3" placeholder="Enter ..."><?= $order->info_order ?></textarea>
                                    </div>
                                </li>
                                <button type="submit" class="btn btn-default btn-block">Guardar Cambios</a>
                            </form>
                        </ul>
                        <br>
                        <div class="card card-outline card-success collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Datos de envio</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url() . route_to('update_infoaddress', $order->info_adress_id) ?>" method="post">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <div class="form-group">
                                                <label>Transportadora: </label>
                                                <select name="transporter_order" class="form-control">
                                                    <?php foreach ($transporters as $transporter) : ?>
                                                        <option value="<?= $transporter['id_transporter'] ?>" <?php if ($transporter['id_transporter'] == $infoadress['id_transporter']) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>><?= $transporter['name_transporter'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="form-group">
                                                <label>Departamento - Ciudad: </label>
                                                <select id="select_department" class="form-control">
                                                    <?php foreach ($departments as $department) : ?>
                                                        <option value="<?= $department['id_department'] ?>" <?php if ($department['id_department'] == $infoadress['id_department']) {
                                                                                                                echo 'selected';
                                                                                                            } ?>><?= $department['name_department'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <select name="city_order" id="cities_select" class="form-control">
                                                    <?php foreach ($cities_of_department as $city) : ?>
                                                        <option value="<?= $city['id_city'] ?>" <?php if ($city['id_city'] == $infoadress['city_id']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= $city['name_city'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="form-group">
                                                <label>Barrio: </label>
                                                <input name="neighborhood_order" style="border: transparent;" type="text" value="<?= $infoadress['neighborhood_infoadress'] ?>">
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="form-group">
                                                <label>Direcci&oacute;n: </label>
                                                <input name="adress_order" style="border: transparent;" type="text" value="<?= $infoadress['home_infoadress'] ?>">
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="form-group">
                                                <label>Whatsapp: </label>
                                                <input name="whatsapp_order" style="border: transparent;" type="text" value="<?= $infoadress['whatsapp_infoadress'] ?>">
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <div class="form-group">
                                                <label>Email: </label>
                                                <input name="email_order" style="border: transparent;" type="email" value="<?= $infoadress['email_infoadress'] ?>">
                                            </div>
                                        </li>
                                        <?php if (!$order->isProduction()) : ?>
                                            <button type="submit" class="btn btn-default btn-block">Guardar Cambios</a>
                                            <?php endif; ?>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-9">
                        <div class="info-box bg-headerorder">
                            <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span style="font-size: 25px;" class="info-box-text"><b>PEDIDO N° <?= $order->id_order ?> </b> </span>
                                <span class="info-box-number">Pedido a nombre de <?= $order->getCustomer()->name_customer ?> <?= $order->getCustomer()->surname_customer ?></span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                                    Por el total de $ <b><?= number_format($order->getTotalSale()['totalventa']) . ' + flete por $ ' . number_format($order->getTotalSale()['freight']) . ' = $ ' . number_format($order->getTotalSale()['freight'] + $order->getTotalSale()['totalventa']) ?></b>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url() . route_to('view_receipt', $order->id_order) ?>" class="btn btn-block bg-gradient-secondary btn-lg">AGREGAR PAGOS</a>
                        <button type="button" class="btn btn-block btn-info disabled">Novedades</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php if (!$order->isProduction()) : ?>
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?= base_url() . route_to('add_product_order') ?>" method="post">
                                        <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <select name="product_id" id="select_product" class="custom-select" required>
                                                <?php foreach ($products as $row) : ?>
                                                    <option value="<?= $row['id_product'] ?>"><?= $row['name_product'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.product_id') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Referencia</label>
                                            <select name="reference_id" id="select_references" class="custom-select" required>
                                            </select>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.reference_id') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Tallas</label>
                                            <select name="size_id" id="select_sizes" class="custom-select" required>
                                            </select>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.size_id') ?></p>
                                        </div>
                                        <div id="div_observation">
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <select name="quantity" class="custom-select" required>
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
                                            <input id="input_price" name="precio" type="number" class="form-control" placeholder="$" required>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_details.precio') ?></p>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-secondary btn-sm">AGREGAR</button>
                                    </form>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> Pedido en producción!</h5>
                                El pedido ya esta en producci&oacute;n
                            </div>
                            <div class="card card-outline card-danger">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Formatos de Producci&oacute;n</b></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="padding: 0.7rem;">
                                    <div class="card-body p-0">
                                        <table class="table table-hover">
                                            <tbody>
                                                <?php foreach ($order->getProductionFormat() as $format) : ?>
                                                    <tr data-widget="expandable-table" aria-expanded="false">
                                                        <td>
                                                            <button type="button" class="btn btn-primary p-0">
                                                                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                            </button>
                                                            <b><?= $format['name_productionline'] ?> - <?= $format['name_typeproduction'] ?></b>
                                                        </td>
                                                    </tr>
                                                    <tr class="expandable-body d-none">
                                                        <td>
                                                            <div class="p-0" style="display: none;">
                                                                <table class="table table-hover">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <b>Fecha:</b>
                                                                            </td>
                                                                            <td>
                                                                                <?= $format['date_production'] ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <?php if ($format['print'] == 1) : ?>
                                                                                    YA est&aacute; impreso
                                                                                <?php else : ?>
                                                                                    NO est&aacute; impreso
                                                                                <?php endif ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>

                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php if (!$order->isProduction()) : ?>
                                        <div class="col-md">
                                            <button <?php if (!$order->canGoToProduction()) : echo " type='button' class='btn btn-block btn-outline-danger btn-sm disabled'";
                                                    else :
                                                        echo "data-toggle='modal' data-target='#modalDateProduction' type='button' class='btn btn-block btn-outline-danger btn-sm'";
                                                    endif; ?>>Pasar a producci&oacute;n</button>
                                        </div>
                                    <?php endif ?>
                                    <div class="col-md">
                                        <form <?php if ($order->isProduction()) {
                                                    echo "target='_blank'";
                                                } ?> action="<?= base_url() . route_to('general_format_order', $order->id_order) ?>" method="post">
                                            <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                                            <button type="submit" class="btn btn-block btn-outline-success btn-sm">Generar PDF</button>
                                        </form>
                                    </div>
                                    <div class="col-md">

                                        <a <?php if ($order->isProduction()) {
                                                echo "target='_blank'";
                                            } ?> href="<?= base_url() . route_to('rotulo_order', $order->id_order) ?>" class="btn btn-block btn-outline-warning btn-sm">Generar R&oacute;tulo</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Detalle del pedido</h3>
                            </div>
                            <div class="card-body">
                                <table id="detail_order_table" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Producto</th>
                                            <th>Referencia</th>
                                            <th>Talla</th>
                                            <th>Precio</th>
                                            <th>Acci&oacute;n</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0;
                                        foreach ($detail_of_order as $row) :
                                            $counter += 1; ?>
                                            <tr>
                                                <td><b><?= $counter ?></b></td>
                                                <td><?= $row['name_product'] ?><br><?= $row['observation'] ?></td>
                                                <td><?= $row['reference_num'] ?> - <?= $row['name_reference'] ?></td>
                                                <td><?= $row['name_size'] ?></td>
                                                <td>$ <?= number_format($row['pricesale_detailorder']) ?></td>
                                                <td>
                                                    <?php if (!$order->isProduction()) : ?>
                                                        <form action="<?= base_url() . route_to('delete_detail_order') ?>" method="post">
                                                            <input type="hidden" name="id_detail_order" value="<?= $row['id_detailorder'] ?>">
                                                            <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                                                            <button id="btn_delete_employee" type="submit" class="btn bg-delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif ?>
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

    <div class="modal fade" id="modalDateProduction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: #f4f6f9;">
                <form action="<?= base_url() . route_to('go_to_production', $order->id_order) ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Generar Formatos de Producci&oacute;n</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($order->getLineProductions() as $row) : ?>
                            <div class="card">
                                <div class="card-body">
                                    Se generar el Formato de producci&oacute;n para <?= $row['name_productionline'] ?>
                                    <div class="form-group">
                                        <label>Fecha de <?= $row['name_productionline'] ?></label>
                                        <input min="<?= date("Y-m-d"); ?>" name="<?= $row['id_productionline'] ?>-date" type="date" class="form-control" required>
                                    </div>
                                    <select name="<?= $row['id_productionline'] ?>-typeproduction" class="form-control">
                                        <?php foreach ($typeformatproduction as $type) : ?>
                                            <option value="<?= $type['id_typeproduction'] ?>"><?= $type['name_typeproduction'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Pasar a Producci&oacute;n</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>
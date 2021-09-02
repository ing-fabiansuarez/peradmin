<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Pedido Cargado<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/public/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>

<section class="content-header">
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
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

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
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Cargos De La Empresa</h3>
                    </div>
                    <div class="card-body">
                        <div id="jobtitle_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="jobtitle_table_length"><label>Mostrar <select name="jobtitle_table_length" aria-controls="jobtitle_table" class="custom-select custom-select-sm form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> Entradas</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="jobtitle_table_filter" class="dataTables_filter"><label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="jobtitle_table"></label></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="jobtitle_table" class="table table-hover text-nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="jobtitle_table_info" style="width: 708px;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="jobtitle_table" rowspan="1" colspan="1" style="width: 87px;" aria-sort="ascending" aria-label="Id Cargo: activate to sort column descending">Id Cargo</th>
                                                <th class="sorting" tabindex="0" aria-controls="jobtitle_table" rowspan="1" colspan="1" style="width: 177px;" aria-label="Nombre: activate to sort column ascending">Nombre</th>
                                                <th class="sorting" tabindex="0" aria-controls="jobtitle_table" rowspan="1" colspan="1" style="width: 135px;" aria-label="Salario Basico: activate to sort column ascending">Salario Basico</th>
                                                <th class="sorting" tabindex="0" aria-controls="jobtitle_table" rowspan="1" colspan="1" style="width: 49px;" aria-label=": activate to sort column ascending"></th>
                                                <th class="sorting" tabindex="0" aria-controls="jobtitle_table" rowspan="1" colspan="1" style="width: 49px;" aria-label=": activate to sort column ascending"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="odd">
                                                <td class="dtr-control sorting_1" tabindex="0">1 </td>
                                                <td>Ingeniero de Sistemas</td>
                                                <td>1200000</td>
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
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="jobtitle_table_info" role="status" aria-live="polite">Mostrando 1 a 1 de 1 Entradas</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="jobtitle_table_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="jobtitle_table_previous"><a href="#" aria-controls="jobtitle_table" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a></li>
                                            <li class="paginate_button page-item active"><a href="#" aria-controls="jobtitle_table" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item next disabled" id="jobtitle_table_next"><a href="#" aria-controls="jobtitle_table" data-dt-idx="2" tabindex="0" class="page-link">Siguiente</a></li>
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
</section>
<?= $this->endSection() ?>
<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Producci&oacute;n<?= $this->endSection() ?>
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
                <h1>Producci&oacute;n</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Producci&oacute;n</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>MAYOR</h4>
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Dia de Producci&oacute;n</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Linea de Producci&oacute;n</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-block btn-dark btn-sm">Ver dia de Producci&oacute;n</button>
                    </div>
                </div>

                <h4>DETAL</h4>
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Dia de Producci&oacute;n</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Linea de Producci&oacute;n</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-block btn-dark btn-sm">Ver dia de Producci&oacute;n</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">


                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">ALPARGATAS</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th style="width: 40px">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">55%</span></td>
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
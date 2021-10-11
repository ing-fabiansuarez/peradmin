<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Producci&oacute;n<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
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
                                <?php foreach ($lineproduction as $line) : ?>
                                    <option value="<?= $line['id_productionline'] ?>"><?= $line['name_productionline'] ?></option>
                                <?php endforeach ?>
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
                                <?php foreach ($lineproduction as $line) : ?>
                                    <option value="<?= $line['id_productionline'] ?>"><?= $line['name_productionline'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-block btn-dark btn-sm">Ver dia de Producci&oacute;n</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">IMPRESI&Oacute;N DE LISTAS</h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($arrayresult as $row) : ?>
                            <div class="card card-success shadow-sm">
                                <div class="card-header">
                                    <h3 class="card-title"><?= $row['lineproduction']['name_productionline'] ?></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Pedido</th>
                                                <th>N° Formato</th>
                                                <th>Dia de producci&oacute;n</th>
                                                <th style="width: 40px">Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $contador = 0;
                                            foreach ($row['formats'] as $format) : $contador += 1; ?>
                                                <tr>
                                                    <td><?= $contador ?>.</td>
                                                    <td><b><?= $format['order_id_order'] ?></b></td>
                                                    <td><?= $format['order_id_order'] . '-' . $row['lineproduction']['id_productionline'] ?></td>
                                                    <td>
                                                        <?= $format['date_production'] ?>
                                                    </td>
                                                    <td>
                                                        <form action="<?= base_url() . route_to('generate_list_of_production') ?>" method="post">
                                                            <input type="hidden" name="line_production" value="<?= $format['production_line_id_productionline'] ?>">
                                                            <input type="hidden" name="id_order" value="<?= $format['order_id_order'] ?>">
                                                            <button type="submit" class="btn btn-app bg-yellow">
                                                                <i class="fas fa-print"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
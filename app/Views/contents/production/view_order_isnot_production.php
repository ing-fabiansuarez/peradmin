<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">PEDIDOS POR PASAR A PRODUCCI&Oacute;N</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Pedido</th>
                    <th>Hecho por</th>

                    <th style="width: 40px">Acci&oacute;n</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador = 0;
                foreach ($ordersbypassproduction as $row) : $contador += 1; ?>
                    <tr>
                        <td><?= $contador ?>.</td>
                        <td><b><?= $row->id_order ?></b></td>
                        <td>
                            <?= $row->getCreatedByNameComplete() ?>
                        </td>

                        <td>
                            <a href="<?= base_url() . route_to('load_session_order', $row->id_order) ?>" type="submit" class="btn btn-app bg-corporative">
                                <i class="fas fa-edit"></i> Cargar
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
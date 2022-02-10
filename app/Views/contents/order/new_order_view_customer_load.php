<?= $this->extend('structure/main_view') ?>
<?= $this->section('title') ?>Nuevo Pedido<?= $this->endSection() ?>
<?= $this->section('preloader') ?>
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url() ?>/img/corporative/logo.png" alt="AdminLTELogo" height="60" width="60">
</div>
<?= $this->endSection() ?>

<?= $this->section('active-ingresar') ?>active<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        reloadcities();
        loadlastinformation();
        $("#select_department").change(function() {
            reloadcities();
        });

    });

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

    function loadlastinformation() {
        $.ajax({
            type: "post",
            url: "<?= base_url() . route_to('ajax_get_last_adress', $customer->id_customer) ?>",
            dataType: 'json',
            success: function(r) {
                if (r != null) {
                    $("#select_department option[value='" + r['department_id'] + "']").attr("selected", true);
                    $("#input_neighborhood").val(r['neighborhood_infoadress']);
                    $("#input_adress").val(r['home_infoadress']);
                    $("#input_whatsapp").val(r['whatsapp_infoadress']);
                    $("#input_email").val(r['email_infoadress']);
                    $("#select_trasporter option[value='" + r['id_transporter'] + "']").attr("selected", true);
                    $("#input_freight").val(r['freight_infoadress']);
                    reloadcities();
                    $("#cities_select option[value='" + r['id_city'] + "']").attr("selected", true);
                    console.log(r);
                } else {
                    console.log('no tiene pedidos anteriores');
                }

            },
        });
    }
</script>

<!----SCRIPT PARA VALIDACION DEL FORMULARIO ------>
<!-- <script>
    $(document).ready(function() {
        inputwhps = $("#input_whatsapp");
        inputwhps.keyup(function() {
            validarPhone();
        });
        inputwhps.blur(function() {
            validarPhone();
        });

        function validarPhone() {
            console.log("algo ha pasado");
            exp = /\d{10}[-]/;
            if (exp.test(inputwhps.val())) {
                console.log("VALIDO");
            } else {
                console.log("INVALIDO");
            }
        }
    });
</script> -->

<?= $this->endSection() ?>

<!-- ............................................CONTENIDO DE LA PAGINA................................................ -->

<?= $this->section('content') ?>
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-3">
            <a href="<?= base_url() . route_to('clean_customer') ?>" type="button" class="btn btn-default btn-block">LIMPIAR PANTALLA</a>
            <br>
            <div class="card">
                <form action="<?= base_url() . route_to('create_customer', 3) ?>" method="post">
                    <div class="card-body">
                        <div class="card" style="margin-bottom: 0;">
                            <div class="card-body">
                                <input style="border: transparent; font-weight: bold;" type="text" name="name_customer" value="<?= $customer->name_customer ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
                                <input style="border: transparent; font-weight: bold;" type="text" name="surname_customer" value="<?= $customer->surname_customer ?>" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
                                <?= $customer->getTypeDocument()['name_typeofidentification'] ?><br>N° <?= $customer->numberidenti_customer ?>
                                <input type="hidden" name="identification" value="<?= $customer->id_customer ?>">
                                <input type="hidden" name="type" value="<?= $customer->type_of_identification_id ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn">Guardar los cambios</button>
                    </div>
                </form>
            </div>
            <?php if (!empty(session('msg'))) : ?>
                <div class="alert <?= session('msg.class') ?> alert-dismissible col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><?= session('msg.icon') ?><?= session('msg.title') ?></h5>
                    <?= session('msg.body') ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="col-md-9">
            <div class="card">
                <form id="form_new_order" action="<?= base_url() . route_to('create_order') ?>" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Informaci&oacute;n Rotulo</label>
                                            <textarea value="<?= old('observation_order') ?>" name="observation_order" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.observation_order') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary btn-lg">Crear Pedido</button>
                            </div>
                            <div class="col-md-8">
                                <div class="card" style="margin-bottom: 0;">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Transportadora</label>
                                            <select id="select_trasporter" name="transporter_order" class="form-control" required>
                                                <?php foreach ($transporters as $row) : ?>
                                                    <option value="<?= $row['id_transporter'] ?>"><?= $row['name_transporter'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.transporter_order') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Departamento</label>
                                            <select id="select_department" class="form-control" required>
                                                <?php foreach ($departments as $row) : ?>
                                                    <option value="<?= $row['id_department'] ?>"><?= $row['name_department'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ciudad</label>
                                            <select name="city_order" id="cities_select" class='form-control' required>
                                            </select>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.city_order') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Barrio</label>
                                            <input id="input_neighborhood" value="<?= old('neighborhood_order') ?>" name="neighborhood_order" type="text" class="form-control" required>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.neighborhood_order') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Direcci&oacute;n</label>
                                            <input id="input_adress" value="<?= old('adress_order') ?>" name="adress_order" type="text" class="form-control" required>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.adress_order') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>WhatsApp</label>
                                            <input id="input_whatsapp" min="1000000000" max="9999999999" value="<?= old('whatsapp_order') ?>" name="whatsapp_order" type="number" class="form-control" required>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.whatsapp_order') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Correo Electr&oacute;nico</label>
                                            <input id="input_email" value="<?= old('email_order') ?>" name="email_order" type="email" class="form-control">
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.email_order') ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Valor del Flete</label>
                                            <input id="input_freight" min="0" value="<?= old('freight_order') ?>" name="freight_order" type="number" class="form-control" required>
                                            <p style="margin-bottom: 0;" class="text-danger"><?= session('input_order.freight_order') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
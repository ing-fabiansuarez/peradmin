<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Diario</title>
    <style type="text/css">
        body {
            color: #000;
            background-color: #fff;
            font-size: 17px;
        }

        .logo {
            width: 50px;
            float: right;
        }

        .caja {
            width: 20%;
            height: 150px;
            background-color: #fff;
            border: 1px solid #000;
            color: #000;
            font-size: 12px;
            border-radius: 5px;
            padding: 4px;
            margin-left: 10px;
            text-align: center;
            float: left;
        }

        .cliente {
            width: 100%;
            height: 34px;
            background-color: #76b119;
            color: #fff;
            margin-bottom: 2px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }

        .header {
            border: 1px solid #000;
            margin: 10px;
            padding: 1rem;
            border-radius: 5px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="header">
        <img class="logo" src="img/corporative/logo.png"><br>
        <b>DIA PRODUCCI&Oacute;N DE <?= $lineProduction['name_productionline'] ?> AL <?= $typeProduction['name_typeproduction'] ?> DEL <?= $date ?></b>
        <br>Impreso por <?= session()->get('cedula_employee') . ' - ' . session()->get('name_employee') . ' - ' . date("Y-m-d H:i:s") ?>
        <br>Revisado por: ______________________________
    </div>
    <?php foreach ($porductionFormats as $format) :
        $order = $format->getOrder();
        $customer = $order->getCustomer();
        $infoAdress = $order->getInfoAdress();
    ?>
        <div class="caja">
            <div class="cliente">
                <?= $customer->name_customer . ' ' . $customer->surname_customer ?>
            </div>
            # <?= $format->consecutive_productionformat ?><br>
            <b>N <?= $order->id_order ?></b><br>
            <?= '<b>' . $customer->getTypeDocument()['abbreviation_typeofidentification'] . '</b> ' . $customer->numberidenti_customer ?> <br>
            <b>Wps:</b> <?= $infoAdress['whatsapp_infoadress'] ?><br>
            <b>Ciudad:</b> <?= $infoAdress['name_city'] . ' - ' . $infoAdress['name_department'] ?> <br>
            <b>Cantidad:</b> null<br>
            <b>Transportadora:</b> <?= $infoAdress['name_transporter'] ?> <br>
            <b>Creado:</b><?= $order->created_at_order ?> <br>
            <b>Fecha Producci&oacute;n:</b> <?= $date ?><br>
            <b>Fecha:</b> <br>
            ________________ <br>
            <b>Guia:</b> <br>
            ________________ <br>
            <span style="color:red">
                <?php foreach ($order->getProductionFormat() as $item) {
                    if ($item['production_line_id_productionline'] != $format->production_line_id_productionline) {
                        echo '<b>' . $item['name_productionline'] . ' </b>al ' . $item['name_typeproduction'] . ' con salida de producción ' . $item['date_production'] . '<br>';
                    }
                }  ?>
            </span>
        </div>
    <?php endforeach; ?>
</body>

</html>
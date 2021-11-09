<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\PositiveBalanceModel;
use App\Models\ProductionFormatModel;
use App\Models\ProductionlineModel;
use App\Models\TypeProductionModel;

class Production extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->rulesvalidation = \Config\Services::validation();
        $this->mdlOrder = new OrderModel();
        $this->mdlLineProduction = new ProductionlineModel();
        $this->mdlProductionFormat = new ProductionFormatModel();
        $this->mdlTypeProduction = new TypeProductionModel();
        $this->mdlPostiveBalance = new PositiveBalanceModel();
    }

    public function index()
    {
        $arrayResult = array();
        foreach ($lineproduction = $this->mdlLineProduction->findAll() as $line) {
            array_push($arrayResult, [
                'lineproduction' => $line,
                'formats' => $this->mdlProductionFormat->getFormatsNoPrintBulk($line['id_productionline']),
            ]);
        }
        return view('contents/production/view_production', [
            'arrayresult' => $arrayResult,
            'lineproduction' => $lineproduction,
        ]);
    }

    public function viewDayProduction()
    {
        //datos recibidos desde el formulario de view production
        $date = $this->request->getPostGet('date');
        $idLineProduction = $this->request->getPostGet('line_production');
        $idTypeProduction =  $this->request->getPostGet('type_production');

        $lineProduction =  $this->mdlLineProduction->find($idLineProduction);
        $typeProduction =  $this->mdlTypeProduction->find($idTypeProduction);

        $formatProdutions =   $this->mdlProductionFormat->getDailyFormatsProductions($date, $idLineProduction, $idTypeProduction);
        $orders = array();
        foreach ($formatProdutions as $format) {
            array_push($orders, $this->mdlOrder->find($format['order_id_order']));
        }
        return view('contents/production/view_daily_production', [
            'orders' => $orders,
            'date' => $date,
            'lineProduction' => $lineProduction,
            'typeProduction' => $typeProduction
        ]);
    }

    public function goToProduction($id_order)
    {
        //VALIDACIONES

        //validar si exiiste la orden
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "NO EXISTE ESA ORDEN";
            return;
        }

        //validar si es el dueño del pedido
        if (session('cedula_employee') != $order->created_by_order) {
            if (!$this->mdlPermission->hasPermission(17)) {
                return redirect()->to(base_url() . route_to('view_order'))->with('msg', [
                    'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                    'class' => 'alert-warning',
                    'title' => 'Este pedido no es tuyo!',
                    'body' => 'No puedes pasar a producción pedidos que no son suyos.'
                ]);
            }
        }

        //aqui se le agrega la bandera para saber si esta en produccion
        $order->inproduction_order = 1;
        foreach ($this->mdlLineProduction->findAll() as $type) {
            $idLineProduction = '';
            $dateProduction = '';
            $typeProduction = '';
            foreach ($this->request->getPost() as $key => $value) {
                $arrayCadena = explode('-', $key);

                if ($arrayCadena[0] == $type['id_productionline']) {
                    $idLineProduction = $arrayCadena[0];
                    if ($arrayCadena[1] == 'date') {
                        $dateProduction = $value;
                    } elseif ($arrayCadena[1] == 'typeproduction') {
                        $typeProduction = $value;
                    }
                }
            }
            if ($idLineProduction != '' && $dateProduction != '' && $typeProduction != '') {
                $order->genereteProductionFormat($idLineProduction, $dateProduction, $typeProduction);
            }
        }

        //se crea los saldos a favor por pasar un pedido a produccion
        //determina cuanto se debe pagar
        $moneyToPay = $order->getTotalSale();
        //determina cuanto ha pagado
        $moneyPaid = 0;
        foreach ($order->getReceipts() as $receipt) {
            $moneyPaid += $receipt['value_receipt'];
        }
        echo $moneyToPay['totalventa'] . '<br>';
        echo $moneyPaid;
        if ($moneyToPay['totalventa'] < $moneyPaid) {
            $this->mdlPostiveBalance->insert([
                'id_positive_balance' => '',
                'value' => $moneyPaid - $moneyToPay['totalventa'],
                'customer_id' => $order->customer_id,
                'create_by_employee_id' => session()->get('cedula_employee'),
                'active_post_balace' => true,
                'obs_posbal' => '',
            ]);
        }
        dd();
        $this->mdlOrder->save($order);
        return redirect()->to(base_url() . route_to('view_order'));
    }
}

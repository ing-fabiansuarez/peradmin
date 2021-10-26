<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\OrderModel;
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

        $formatProdutions =   $this->mdlProductionFormat->getDailyFormatsProductions($date, $idLineProduction, $idTypeProduction);
        $orders = array();
        foreach ($formatProdutions as $format) {
            array_push($orders, $this->mdlOrder->find($format['order_id_order']));
        }
        return view('contents/production/view_daily_production', [
            'orders' => $orders,
            'date' => $date,
            'idLineProduction' => $idLineProduction,
            'idTypeOrder' => $idTypeProduction
        ]);
    }

    public function goToProduction($id_order)
    {
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
        d($this->request->getPost());
        //aqui se le agrega la bandera para saber si esta en produccion
        $order->inproduction_order = 1;
        d($this->mdlTypeProduction->findAll());
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

        $this->mdlOrder->save($order);
        return redirect()->to(base_url() . route_to('view_order'));
    }
}

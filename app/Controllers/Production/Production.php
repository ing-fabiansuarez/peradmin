<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductionlineModel;

class Production extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->rulesvalidation = \Config\Services::validation();
        $this->mdlOrder = new OrderModel();
        $this->mdlLineProduction = new ProductionlineModel();
    }

    public function index()
    {

        return view('contents/production/view_production', [
            'lineproduction' => $this->mdlLineProduction->findAll()
        ]);
    }

    public function viewDayProduction($date, $typeorder, $lineproduction)
    {
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
                    'body' => 'No puedes pasar a producción pedidos que no hallas creado.'
                ]);
            }
        }

        foreach ($this->request->getPost() as $key => $date) {
            $order->genereteProductionFormat($key, $date);
        }

        return redirect()->to(base_url() . route_to('view_order'));
    }
}

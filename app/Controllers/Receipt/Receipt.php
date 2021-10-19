<?php

namespace App\Controllers\Receipt;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\OrderModel;

class Receipt extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->rulesvalidation = \Config\Services::validation();
        $this->mdlOrder = new OrderModel();
        $this->mdlBank = new BankModel();
    }

    public function index($id_order)
    {
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "EL PEDIDO NO EXITE";
            return;
        }
        $order->getCountEachProduct();
        return view('contents/receipt/view_receipt', [
            'banks' => $this->mdlBank->findAll(),
            'order' => $order,
        ]);
    }
}

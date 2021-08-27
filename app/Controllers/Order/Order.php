<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Order extends BaseController
{

    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlCustomer = new CustomerModel();
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function index()
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(12)) {
            return view('permission/donthavepermission');
        }
        return view('contents/order/new_order_view');
    }

    public function load_customer()
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(12)) {
            return view('permission/donthavepermission');
        }
        if (!$customer = $this->mdlCustomer->where('numberidenti_customer', $this->request->getPost('identification'))->first()) {
            session()->remove('customer_new_order');
            return redirect()->back()->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'No se puedo Cambiar!',
                'body' => 'No tienes permisos para cambiar las contraseñas de los empleados'
            ]);
        }
        session()->set([
            'customer_new_order' => $this->request->getPost('identification'),
        ]);
        dd(session()->get());
    }
}

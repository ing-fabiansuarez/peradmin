<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\TypeidentificationModel;

class Order extends BaseController
{

    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlCustomer = new CustomerModel();
        $this->typeidentification = new TypeidentificationModel();
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function index()
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(12)) {
            return view('permission/donthavepermission');
        }
        if (!empty(session('customer_new_order'))) {
            $customer = $this->mdlCustomer->find(session('customer_new_order'));
        } else {
            $customer = null;
        }
        return view('contents/order/new_order_view', [
            'customer' => $customer,
            'typeofidentification' =>  $this->typeidentification->findAll()
        ]);
    }

    public function load_customer()
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(12)) {
            return view('permission/donthavepermission');
        }
        if (!$customer = $this->mdlCustomer->getCustomerByID($this->request->getPost('identification'))) {
            session()->remove('customer_new_order');
            return redirect()->back()->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'Usuario No Exite!',
                'body' => 'El usuario con la cedula ' . $this->request->getPost('identification') . ' no exite.'
            ])->withInput();
        }
        session()->set([
            'customer_new_order' => $customer->id_customer,
        ]);
        return redirect()->back();
        /* ->with('msg', [
            'icon' => '<i class="icon fas fa-check"></i>',
            'class' => 'alert-success',
            'title' => 'Usuario Cargado!',
            'body' => 'El usuario con la cedula ' . $this->request->getPost('identification') . ' fue cargado.'
        ]) */
    }
}

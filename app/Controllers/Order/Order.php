<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\DepartmentModel;
use App\Models\ProductionlineModel;
use App\Models\TransporterModel;
use App\Models\TypeidentificationModel;
use App\Models\TypeorderModel;

class Order extends BaseController
{

    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlCustomer = new CustomerModel();
        $this->mdlProductionLine = new ProductionlineModel();
        $this->mdlTypeOrder = new TypeorderModel();
        $this->mdlDepartment = new DepartmentModel();
        $this->mdlTransporter = new TransporterModel();
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
            if (!$customer = $this->mdlCustomer->find(session('customer_new_order'))) {
                $customer = null;
            } else {
                return view('contents/order/new_order_view_customer_load', [
                    'customer' => $customer,
                    'typeofidentification' =>  $this->typeidentification->findAll(),
                    'productionline' => $this->mdlProductionLine->findAll(),
                    'typeorder' => $this->mdlTypeOrder->findAll(),
                    'departments' => $this->mdlDepartment->findAll(),
                    'transporters' => $this->mdlTransporter->findAll()
                ]);
            }
        } else {
            $customer = null;
        }
        return view('contents/order/new_order_view', [
            'customer' => $customer,
            'typeofidentification' =>  $this->typeidentification->findAll()
        ]);
    }

    public function create_order()
    {
        dd($this->request->getPost());
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
    }

    public function clean_customer()
    {
        session()->remove('customer_new_order');
        return redirect()->back();
    }
}

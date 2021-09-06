<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Entities\Order as EntitiesOrder;
use App\Models\CustomerModel;
use App\Models\DepartmentModel;
use App\Models\OrderModel;
use App\Models\ProductionlineModel;
use App\Models\ProductModel;
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
        $this->mdlProduct = new ProductModel();
        $this->mdlOrder = new OrderModel();
        $this->typeidentification = new TypeidentificationModel();
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function index()
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(12)) {
            return view('permission/donthavepermission');
        }

        if (!empty(session('order_loaded'))) {
            if (!$order = $this->mdlOrder->find(session('order_loaded'))) {
                $customer = null;
            } else {
                return view('contents/order/order_loaded', [
                    'customer' => $order->getCustomer(),
                    'order' => $order,
                    'infoadress' => $order->getInfoAdress(),
                    'products' => $this->mdlProduct->where('active', 1)->findAll(),
                    'detail_of_order' => $order->getDetailList()
                ]);
            }
        } else if (!empty(session('customer_new_order'))) {
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
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(15)) {
            return view('permission/donthavepermission');
        }
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newOrder')
        ))) {
            return redirect()->to(base_url() . route_to('view_order'))->with('input_order', $this->validator->getErrors())->withInput();
        }

        $id_transporter = $this->request->getPost('transporter_order');
        $id_city =  $this->request->getPost('city_order');
        $whatApp = $this->request->getPost('whatsapp_order');
        $email = $this->request->getPost('email_order');
        $neighborhood = $this->request->getPost('neighborhood_order');
        $homeadress = $this->request->getPost('adress_order');

        $newOrder = new EntitiesOrder();
        $newOrder->fill([
            'id_order' => time(),
            'date_production' => $this->request->getPost('date_production'),
            'type_of_order_id' => $this->request->getPost('type_order'),
            'customer_id' => session()->get('customer_new_order'),
            'info_order' => $this->request->getPost('observation_order'),
            'created_by_order' => session()->get('cedula_employee')
        ]);
        $newOrder->setInfoAdress($id_transporter, $id_city, $whatApp, $email, $neighborhood, $homeadress);
        $this->mdlOrder->insert($newOrder);
        session()->set([
            'order_loaded' => $newOrder->id_order,
        ]);
        return redirect()->to(base_url() . route_to('view_order'));
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
        return redirect()->to(base_url() . route_to('view_order'));
    }

    public function clean_customer()
    {
        session()->remove('customer_new_order');
        session()->remove('order_loaded');
        return redirect()->to(base_url() . route_to('view_order'));
    }

    public function add_product()
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(15)) {
            return view('permission/donthavepermission');
        }
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newDetailOrder')
        ))) {
            return redirect()->to(base_url() . route_to('view_order'))->with('input_details', $this->validator->getErrors())->withInput();
        }
        $order = $this->mdlOrder->find($this->request->getPost('id_order'));
        $reference_num = $this->request->getPost('reference_id');
        $product_id = $this->request->getPost('product_id');
        $observation = $this->request->getPost('observation');
        if ($observation == '') {
            $observation = null;
        }
        $size_id = $this->request->getPost('size_id');
        $quantity = $this->request->getPost('quantity');
        $price = $this->request->getPost('precio');
        for ($i = 0; $i <  $quantity; $i++) {
            $order->addDetail($product_id, $reference_num, $observation, $size_id, $price);
        }
        return redirect()->to(base_url() . route_to('view_order'));
    }
}

<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Entities\Order as EntitiesOrder;
use App\Models\CustomerModel;
use App\Models\DepartmentModel;
use App\Models\DetailorderModel;
use App\Models\InfoAdressModel;
use App\Models\OrderModel;
use App\Models\ProductionFormatModel;
use App\Models\ProductionlineModel;
use App\Models\ProductModel;
use App\Models\TransporterModel;
use App\Models\TypeidentificationModel;
use App\Models\TypeProductionModel;

class Order extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlCustomer = new CustomerModel();
        $this->mdlInfoAddress = new InfoAdressModel();
        $this->mdlProductionLine = new ProductionlineModel();
        $this->mdlDepartment = new DepartmentModel();
        $this->mdlTransporter = new TransporterModel();
        $this->mdlProduct = new ProductModel();
        $this->mdlOrder = new OrderModel();
        $this->mdlDetailOrder = new DetailorderModel();
        $this->mdlTypeProductioFormat = new TypeProductionModel();
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
                    'typeformatproduction' => $this->mdlTypeProductioFormat->findAll(),
                    'products' => $this->mdlProduct->where('active', 1)->orderBy('order_product')->findAll(),
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
        $freight = $this->request->getPost('freight_order');

        $newOrder = new EntitiesOrder();
        $newOrder->fill([
            'id_order' => time(),
            'customer_id' => session()->get('customer_new_order'),
            'info_order' => $this->request->getPost('observation_order'),
            'created_by_order' => session()->get('cedula_employee'),
            'inproduction_order' => 0
        ]);
        $newOrder->setInfoAdress($id_transporter, $id_city, $whatApp, $email, $neighborhood, $homeadress, $freight);
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
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newDetailOrder')
        ))) {
            return redirect()->to(base_url() . route_to('view_order'))->with('input_details', $this->validator->getErrors())->withInput();
        }
        $order = $this->mdlOrder->find($this->request->getPost('id_order'));

        //validar si es el dueño del pedido
        if (session('cedula_employee') != $order->created_by_order) {
            if (!$this->mdlPermission->hasPermission(16)) {
                return redirect()->back()->with('msg', [
                    'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                    'class' => 'alert-warning',
                    'title' => 'Alerta!',
                    'body' => 'No puedes modificar este pedido, este pedido no es tuyo.'
                ]);
            }
        }

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

    public function deleteDetailProduct()
    {
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('deleteItemOrder')
        ))) {
            return redirect()->back()->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'Alerta!',
                'body' => 'El id es invalido o no existe.'
            ]);
        }
        $order = $this->mdlOrder->find($this->request->getPost('id_order'));
        //validar si es el dueño del pedido
        if (session('cedula_employee') != $order->created_by_order) {
            if (!$this->mdlPermission->hasPermission(16)) {
                return redirect()->back()->with('msg', [
                    'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                    'class' => 'alert-warning',
                    'title' => 'Alerta!',
                    'body' => 'No puedes modificar este pedido, este pedido no es tuyo.'
                ]);
            }
        }
        $this->mdlDetailOrder->where('id_detailorder', $this->request->getPost('id_detail_order'))->delete();
        return redirect()->to(base_url() . route_to('view_order'))->with('msg', [
            'icon' => '<i class="icon fas fa-check"></i>',
            'class' => 'alert-success',
            'title' => 'Eliminado!',
            'body' => 'Se elimino el producto.'
        ]);
    }

    public function view_search_order()
    {
        return view('contents/order/view_to_load_order');
    }

    public function viewResultSearch()
    {
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('loadOrder')
        ))) {
            return redirect()->to(base_url() . route_to('view_load_order'))->with('input_error', $this->validator->getErrors())->withInput();
        }

        $customer = $this->mdlCustomer->where('numberidenti_customer', $this->request->getPost('cedula'))->first();
        $orders = $customer->getOrders();

        return view('contents/order/view_result_research', [
            'customer' => $customer,
            'orders' => $orders
        ]);
    }

    public function loadSessionOrder($id_order)
    {
        session()->remove('customer_new_order');
        session()->remove('order_loaded');
        $order = $this->mdlOrder->find($id_order);
        session()->set([
            'customer_new_order' => $order->customer_id,
        ]);
        session()->set([
            'order_loaded' => $order->id_order,
        ]);
        return redirect()->to(base_url() . route_to('view_order'));
    }

    public function viewOrderToPassProduction()
    {

        return view('contents/order/view_order_isnot_production', [
            'ordersbypassproduction' => $this->mdlOrder->where('inproduction_order', 0)->orderBy('created_at_order', 'desc')->findAll()
        ]);
    }

    public function updateInfoAddress($id_infoaddress)
    {
        //validar los datos del formulario
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('updateInfoAddress')
        ))) {
            $cadena = '';
            foreach ($this->validator->getErrors() as $error) {
                $cadena .= '* ' . $error . '<br>';
            }
            return redirect()->to(base_url() . route_to('view_order'))->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'Validación Falló!',
                'body' => $cadena
            ]);
        }

        if (!$infoAddress = $this->mdlInfoAddress->find($id_infoaddress)) {
            echo "NO SE ENCONTRO LA INFOADDRESS";
            return;
        }

        $this->mdlInfoAddress->save([
            'id_infoadress' => $id_infoaddress,
            'transporter_id' => $this->request->getPost('transporter_order'),
            'city_id' =>  $this->request->getPost('city_order'),
            'whatsapp_infoadress' =>  $this->request->getPost('whatsapp_order'),
            'email_infoadress' =>  $this->request->getPost('email_order'),
            'neighborhood_infoadress' =>  $this->request->getPost('neighborhood_order'),
            'home_infoadress' =>  $this->request->getPost('adress_order')
        ]);
        return redirect()->to(base_url() . route_to('view_order'))->with('msg', [
            'icon' => '<i class="icon fas fa-check"></i>',
            'class' => 'alert-success',
            'title' => 'Actualizado!',
            'body' => 'Los cambios se guardarón correctamente'
        ]);
    }
}

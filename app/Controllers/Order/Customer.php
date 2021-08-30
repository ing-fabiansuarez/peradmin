<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Entities\Customer as EntitiesCustomer;
use App\Models\CustomerModel;

class Customer extends BaseController
{

    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlCustomer = new CustomerModel();
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function crud($action)
    { //[1 - create][2 - read][3 - update][4 - Delate] 
        switch ($action) {
            case 1:
                //validacion de permisos del sistema
                if (!$this->mdlPermission->hasPermission(13)) {
                    return view('permission/donthavepermission');
                }
                if (!($this->validate(
                    $this->rulesvalidation->getRuleGroup('newCustomer')
                ))) {
                    return redirect()->back()->with('input_customer', $this->validator->getErrors())->withInput();
                }
                $customer = new EntitiesCustomer([
                    'type_of_identification_id' => $this->request->getPost('type'),
                    'numberidenti_customer' => $this->request->getPost('identification'),
                    'name_customer' => $this->request->getPost('name_customer'),
                    'surname_customer' => $this->request->getPost('surname_customer'),
                    'create_by_customer' => session()->get('cedula_employee'),
                    'update_by_customer' => session()->get('cedula_employee'),
                ]);
                session()->set([
                    'customer_new_order' => $this->mdlCustomer->insert($customer),
                ]);
                return redirect()->back();
                break;
            case 3:
                break;
            case 4:
                break;
        }
    }
}

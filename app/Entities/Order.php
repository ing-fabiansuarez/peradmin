<?php

namespace App\Entities;

use App\Models\CustomerModel;
use App\Models\EmployeeModel;
use App\Models\InfoAdressModel;
use CodeIgniter\Entity\Entity;

class Order extends Entity
{
    protected $dates = ['created_at_order'];

    public function __construct()
    {
    }

    public function setInfoAdress($transporter, $city, $whtapp, $email, $neighborhood, $homeadress)
    {
        $mdlInfoAdress = new InfoAdressModel();
        $this->attributes['info_adress_id'] = $mdlInfoAdress->insert([
            'transporter_id' => $transporter,
            'city_id' => $city,
            'whatsapp_infoadress' => $whtapp,
            'email_infoadress' => $email,
            'neighborhood_infoadress' => $neighborhood,
            'home_infoadress' => $homeadress
        ]);
        return $this;
    }

    public function getCreatedByNameComplete()
    {
        $mdlEmployee = new EmployeeModel();
        $employee = $mdlEmployee->find($this->created_by_order);
        return $employee->name_employee . ' ' . $employee->surname_employee;
    }

    public function getCustomer()
    {
        $mdlCustomer = new CustomerModel();
        return $mdlCustomer->find($this->customer_id);
    }

    public function getInfoAdress()
    {
        $mdlInfoAdress = new InfoAdressModel();
        return $mdlInfoAdress->find($this->info_adress_id);
    }
}

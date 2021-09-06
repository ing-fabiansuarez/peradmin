<?php

namespace App\Entities;

use App\Models\CustomerModel;
use App\Models\DetailorderModel;
use App\Models\EmployeeModel;
use App\Models\InfoAdressModel;
use App\Models\TypeorderModel;
use CodeIgniter\Entity\Entity;

class Order extends Entity
{
    protected $dates = ['created_at_order'];
    private $mdlDetailOrder;

    public function __construct()
    {
        $this->mdlDetailOrder = new DetailorderModel();
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

    public function addDetail($product_id, $reference, $observation, $size_id, $price)
    {
        return $this->mdlDetailOrder->insert([
            'order_id' => $this->attributes['id_order'],
            'reference_num' => $reference,
            'reference_product_id' => $product_id,
            'observation' => $observation,
            'pricesale_detailorder' => $price,
            'size_id' => $size_id
        ]);
    }

    public function getDetailList()
    {
        return $this->mdlDetailOrder->db->table('detailorder')
            ->select('*')
            ->join('product', 'detailorder.reference_product_id = product.id_product')
            ->join('reference', 'detailorder.reference_num = reference.num_reference AND detailorder.reference_product_id = reference.product_id')
            ->join('size', 'detailorder.size_id = size.id_size')
            ->where('detailorder.order_id', $this->id_order)
            ->get()->getResultArray();
    }

    public function getTypeOrder()
    {
        $this->mdlTypeOrder = new TypeorderModel();
        return $this->mdlTypeOrder->find($this->type_of_order_id);
    }
}

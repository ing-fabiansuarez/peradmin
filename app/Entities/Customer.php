<?php

namespace App\Entities;

use App\Models\OrderModel;
use App\Models\TypeidentificationModel;
use CodeIgniter\Entity\Entity;

class Customer extends Entity
{
    private $mdlType, $mdlOrder;
    protected $dates = ['created_at_customer', 'update_at_customer'];

    public function __construct()
    {
        $this->mdlType = new TypeidentificationModel();
        $this->mdlOrder = new OrderModel();
    }

    public function getTypeDocument()
    {
        return $this->mdlType->find($this->type_of_identification_id);
    }

    public function getOrderByTypeOrder($typeorder)
    {
        return $this->mdlOrder->where('customer_id', $this->id_customer)
            ->where('type_of_order_id', $typeorder)->orderBy('created_at_order', 'desc')->findAll();
    }

    public function getLastAdress()
    { //retorna un array con la ultima direccion o un null si no existe ultima dirección
        return $this->mdlOrder->db->table('order')
            ->select('neighborhood_infoadress,home_infoadress,whatsapp_infoadress,email_infoadress,city_id,id_transporter,id_city,department_id,type_of_order_id')
            ->join('info_adress', 'info_adress.id_infoadress = order.info_adress_id')
            ->join('transporter', 'transporter.id_transporter = info_adress.transporter_id')
            ->join('city', 'city.id_city = info_adress.city_id')
            ->where('order.customer_id', $this->id_customer)
            ->orderBy('created_at_order', 'desc')
            ->get()
            ->getFirstRow('array');
    }
}

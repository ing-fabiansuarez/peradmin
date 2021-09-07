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
}

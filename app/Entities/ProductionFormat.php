<?php

namespace App\Entities;

use App\Models\OrderModel;
use CodeIgniter\Entity\Entity;

class ProductionFormat extends Entity
{
    public $mdlOrder;
    public function __construct()
    {
        $this->mdlOrder = new OrderModel();
    }

    public function getOrder()
    {
        return $this->mdlOrder->find($this->order_id_order);
    }
}

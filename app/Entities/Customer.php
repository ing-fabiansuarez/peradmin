<?php

namespace App\Entities;

use App\Models\TypeidentificationModel;
use CodeIgniter\Entity\Entity;

class Customer extends Entity
{
    private $mdlType;
    protected $dates = ['created_at_customer', 'update_at_customer'];

    public function __construct()
    {
        $this->mdlType = new TypeidentificationModel();
    }

    public function getTypeDocument()
    {
        return $this->mdlType->find($this->type_of_identification_id);
    }
}

<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Customer extends Entity
{
    protected $dates = ['created_at_customer', 'update_at_customer'];
}

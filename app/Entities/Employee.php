<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    protected $dates = ['created_at_employee', 'updated_at_employee', 'deleted_at_employee'];
}

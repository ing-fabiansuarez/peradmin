<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeorderModel extends Model
{
    protected $table      = 'type_of_order';
    protected $primaryKey = 'id_typeoforder';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

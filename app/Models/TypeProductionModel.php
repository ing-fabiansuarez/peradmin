<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeProductionModel extends Model
{
    protected $table      = 'type_of_production';
    protected $primaryKey = 'id_typeproduction';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

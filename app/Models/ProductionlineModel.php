<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionlineModel extends Model
{
    protected $table      = 'production_line';
    protected $primaryKey = 'id_productionline';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

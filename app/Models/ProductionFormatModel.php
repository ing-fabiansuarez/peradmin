<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionFormatModel extends Model
{
    protected $table      = 'production_format';
    protected $primaryKey = 'order_id_order';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'order_id_order',
        'production_line_id_productionline',
        'date_production',
        'print'
    ];
}

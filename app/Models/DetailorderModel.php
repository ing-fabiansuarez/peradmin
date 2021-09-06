<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailorderModel extends Model
{
    protected $table      = 'detailorder';
    protected $primaryKey = 'id_detailorder';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_detailorder',
        'order_id',
        'reference_num',
        'reference_product_id',
        'observation',
        'pricesale_detailorder',
        'size_id'
    ];
}

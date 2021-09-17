<?php

namespace App\Models;

use App\Entities\Order;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order';
    protected $primaryKey = 'id_order';

    protected $returnType     = Order::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_order',
        'type_of_order_id',
        'info_adress_id',
        'customer_id',
        'info_order',
        'created_by_order',
        'updated_at_order',
        'inproduction_order'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at_order';
    protected $updatedField = 'updated_at_order';

    protected $validationRules    = [];

    protected $validationMessages = [];
}

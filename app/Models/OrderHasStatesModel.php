<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderHasStatesModel extends Model
{
    protected $table      = 'order_has_states';
    protected $primaryKey = 'order_id_order';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'order_id_order',
        'state_order_id_state',
        'create_at',
        'create_by'
    ];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PositiveBalanceModel extends Model
{
    protected $table      = 'positive_balance';
    protected $primaryKey = 'id_positive_balance';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;
    protected $createdField  = 'create_at_posbal';
    protected $updatedField  = 'updated_at_posbal';

    protected $allowedFields = [
        'id_positive_balance',
        'value',
        'customer_id',
        'create_by_employee_id',
        'active_post_balace',
        'updated_at_posbal',
        'create_at_posbal',
        'obs_posbal',
    ];
}

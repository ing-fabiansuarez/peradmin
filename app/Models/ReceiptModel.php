<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceiptModel extends Model
{
    protected $table      = 'receipt';
    protected $primaryKey = 'approval_receipt';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'approval_receipt',
        'bank_id_bank',
        'order_id',
        'value_receipt',
        'date_receipt',
        'description_receipt',
        'consecutive_receipt',
        'image_receipt',
        'created_by_receipt',
    ];
}

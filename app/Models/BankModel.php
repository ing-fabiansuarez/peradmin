<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table      = 'bank';
    protected $primaryKey = 'id_bank';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

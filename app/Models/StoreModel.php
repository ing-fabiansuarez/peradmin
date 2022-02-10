<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{
    protected $table      = 'store';
    protected $primaryKey = 'id_store';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

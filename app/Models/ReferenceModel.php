<?php

namespace App\Models;

use CodeIgniter\Model;

class ReferenceModel extends Model
{
    protected $table      = 'reference';
    protected $primaryKey = 'num_reference';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];
}

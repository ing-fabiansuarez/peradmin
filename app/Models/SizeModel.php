<?php

namespace App\Models;

use CodeIgniter\Model;

class SizeModel extends Model
{
    protected $table      = 'size';
    protected $primaryKey = 'id_size';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

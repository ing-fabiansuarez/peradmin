<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeidentificationModel extends Model
{
    protected $table      = 'type_of_identification';
    protected $primaryKey = 'id_typeofidentification';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

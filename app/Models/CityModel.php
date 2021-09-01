<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table      = 'city';
    protected $primaryKey = 'id_city';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

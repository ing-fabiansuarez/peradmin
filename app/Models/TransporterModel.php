<?php

namespace App\Models;

use CodeIgniter\Model;

class TransporterModel extends Model
{
    protected $table      = 'transporter';
    protected $primaryKey = 'id_transporter';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
    ];
}

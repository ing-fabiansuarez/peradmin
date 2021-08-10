<?php

namespace App\Models\OldAdmin;

use CodeIgniter\Model;

class Product_oaModel extends Model
{
    protected $DBGroup = 'peradkco_admin';
    protected $table      = 'productos';
    protected $primaryKey = 'pro_ref';
    protected $returnType     = 'array';

    protected $allowedFields = [];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

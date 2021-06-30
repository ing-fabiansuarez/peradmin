<?php

namespace App\Models\OldAdmin;

use App\Entities\OldAdmin\Customer_oa;
use App\Entities\OldAdmin\Customeroa;
use CodeIgniter\Model;

class Customer_oaModel extends Model
{
    protected $DBGroup = 'peradkco_admin';
    protected $table      = 'clientes';
    protected $primaryKey = 'cli_documento';
    protected $returnType     = Customer_oa::class;

    protected $allowedFields = [];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

 
}

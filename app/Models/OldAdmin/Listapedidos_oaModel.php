<?php

namespace App\Models\OldAdmin;

use App\Entities\OldAdmin\Customer_oa;
use App\Entities\OldAdmin\Customeroa;
use CodeIgniter\Model;

class Listapedidos_oaModel extends Model
{
    protected $DBGroup = 'peradkco_admin';
    protected $table      = 'listapedidos';
    protected $primaryKey = 'lpe_id';
    protected $returnType     = 'array';

    protected $allowedFields = [];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}

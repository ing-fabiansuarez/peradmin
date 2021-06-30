<?php

namespace App\Models\OldAdmin;

use App\Entities\OldAdmin\Ordermayor_oa;
use CodeIgniter\Model;

class Ordermayor_oaModel extends Model
{
    protected $DBGroup = 'peradkco_admin';
    protected $table      = 'pedidos';
    protected $primaryKey = 'ped_id';
    protected $returnType     = Ordermayor_oa::class;

    protected $allowedFields = [];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


}

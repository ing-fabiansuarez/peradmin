<?php

namespace App\Models\OldAdmin;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $DBGroup = 'peradkco_admin';
    protected $table      = 'clientes';
    protected $primaryKey = 'cli_documento';
    protected $returnType     = 'array';

    protected $allowedFields = [];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getPedido($id)
    {
        $where = "p.ped_id LIKE '$id' AND ((p.ped_fechaInicio LIKE '%2021-03-%') OR (p.ped_fechaInicio LIKE '%2021-04-%'))";
        return
            (array)$this->db->table('pedidos p')
                ->select('*')
                ->join('clientes c', 'p.cli_documento = c.cli_documento')
                ->where($where)->get()->getFirstRow();
    }
}

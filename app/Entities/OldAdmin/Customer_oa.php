<?php

namespace App\Entities\OldAdmin;

use App\Models\OldAdmin\Ordermayor_oaModel;
use CodeIgniter\Entity\Entity;

class Customer_oa extends Entity
{
    public function getQuantityOfOrdersMayor()
    {
        $mdlOrderMayor_oa = new Ordermayor_oaModel();
        return count($mdlOrderMayor_oa->where('cli_documento', $this->cli_documento)->findAll());
    }
    public function getQuantityDeilOrderMayor($id_product)
    {
        $mdlOrderMayor_oa = new Ordermayor_oaModel();
        return count($mdlOrderMayor_oa->db->table('pedidos')
        ->select('*')
        ->join('listapedidos', 'pedidos.ped_id = listapedidos.ped_id')
        ->where('pedidos.cli_documento', $this->cli_documento)
        ->where('listapedidos.tip_id',$id_product)
        ->get()->getResultArray());
    }
}

<?php

namespace App\Models;

use App\Entities\ProductionFormat;
use CodeIgniter\Model;

class ProductionFormatModel extends Model
{
    protected $table      = 'production_format';
    protected $primaryKey = 'order_id_order';

    protected $returnType     = ProductionFormat::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'order_id_order',
        'production_line_id_productionline',
        'date_production',
        'print',
        'print_at_format',
        'created_at_format',
        'created_by_format',
        'print_by_format',
        'consecutive_productionformat',
    ];

    public function getFormatProduction($idOrder, $idLineProduction)
    {
        return $this->where('order_id_order', $idOrder)->where('production_line_id_productionline', $idLineProduction);
    }

    public function getFormatsNoPrintBulk($lineProduction)
    {
        return $this->db->table('production_format')
            ->select('*')
            ->join('order', 'production_format.order_id_order = order.id_order')
            ->where('production_format.production_line_id_productionline', $lineProduction)
            ->where('order.type_of_order_id', 1)
            ->where('production_format.print', 0)
            ->get()
            ->getResultArray();
    }
    public function getProductionFormat($id_order, $id_line_production)
    {
        return $this->db->table('production_format')
            ->select('*')
            ->join('production_line', 'production_format.production_line_id_productionline = production_line.id_productionline')
            ->where('production_format.production_line_id_productionline', $id_line_production)
            ->where('production_format.order_id_order', $id_order)
            ->get()
            ->getFirstRow('array');
    }
    public function getDailyFormatsProductions($date, $id_line_production, $type_of_order)
    {
        return $this->db->table('production_format')
            ->select('*')
            ->join('production_line', 'production_format.production_line_id_productionline = production_line.id_productionline')
            ->join('order', 'order.id_order = production_format.order_id_order')
            ->where('production_format.date_production', $date)
            ->where('production_format.production_line_id_productionline', $id_line_production)
            ->where('order.type_of_order_id', $type_of_order)
            ->get()
            ->getResultArray();
    }
}

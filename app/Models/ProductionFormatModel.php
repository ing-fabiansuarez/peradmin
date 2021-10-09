<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionFormatModel extends Model
{
    protected $table      = 'production_format';
    protected $primaryKey = 'order_id_order';

    protected $returnType     = 'array';
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
    ];

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
}

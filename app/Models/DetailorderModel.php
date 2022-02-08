<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailorderModel extends Model
{
    protected $table      = 'detailorder';
    protected $primaryKey = 'id_detailorder';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_detailorder',
        'order_id',
        'reference_num',
        'reference_product_id',
        'observation',
        'pricesale_detailorder',
        'size_id'
    ];

    public function getListDailyProducts($date, $id_line_production, $type_of_production)
    {
        return $this->db->table('detailorder')
            ->select('*')
            ->join('order', 'detailorder.order_id = order.id_order')
            ->join('product', 'product.id_product = detailorder.reference_product_id')
            ->join('reference', 'reference.num_reference = detailorder.reference_num AND reference.product_id = detailorder.reference_product_id')
            ->join('size', 'size.id_size = detailorder.size_id')
            ->join('customer', 'customer.id_customer = order.customer_id')
            ->join('employee', 'employee.id_employee = order.created_by_order')
            ->join('production_format', 'production_format.order_id_order = order.id_order')
            ->where('production_format.date_production', $date)
            ->where('production_format.production_line_id_productionline', $id_line_production)
            ->where('production_format.type_of_production', $type_of_production)
            ->where('product.production_line_id', $id_line_production)
            ->orderBy('production_format.created_at_format','asc')
            ->get()
            ->getResultArray();
    }
}

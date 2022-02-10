<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreConsignmentModel extends Model
{
    protected $table      = 'store_consignments';
    protected $primaryKey = 'id_consignments';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'value_consigments',
        'note_consigments',
        'start_date',
        'finish_date',
        'create_by',
        'update_by',
        'delete_by',
        'store_id',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
    protected $deletedField  = 'delete_at';

    protected $validationRules    = [];

    protected $validationMessages = [];

    public function getEvents($start, $end)
    {
        return $this->where('start_date >=', $start)->where('finish_date <=', $end)->get()->getResult();
    }
}

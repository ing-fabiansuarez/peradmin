<?php

namespace App\Models;

use App\Entities\Customer;
use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'customer';
    protected $primaryKey = 'id_customer';

    protected $returnType     = Customer::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_customer',
        'type_of_identification_id',
        'numberidenti_customer',
        'name_customer',
        'surname_customer',
        'create_by_customer',
        'update_by_customer',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at_customer';
    protected $updatedField  = 'update_at_customer';

    protected $validationRules    = [];

    protected $validationMessages = [];

    public function getCustomerByID($id){
        return $this->where('numberidenti_customer', $id)->first();
    }
}

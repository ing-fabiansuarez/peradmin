<?php

namespace App\Models;

use App\Entities\Employee;
use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'id_employee';

    protected $returnType     = Employee::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'id_employee',
        'name_employee',
        'surname_employee',
        'active_employee',
        'photo_employee',
        'startdate_employee',
        'pass_employee',
        'jobtitle_id_jobtitle',
        'phonenumber_employee'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at_employee';
    protected $updatedField  = 'updated_at_employee';
    protected $deletedField  = 'deleted_at_employee';

    protected $validationRules    = [];

    protected $validationMessages = [];

    public function getEmployeeLogin(string $column, string $value)
    {
        return $this->db->table('employee')
            ->select('*')
            ->join('jobtitle', 'employee.jobtitle_id_jobtitle = jobtitle.id_jobtitle')
            ->where('employee.' . $column, $value)
            ->get()->getFirstRow();
    }
}

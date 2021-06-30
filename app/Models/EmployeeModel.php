<?php

namespace App\Models;

use App\Entities\Employee;
use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'id_employee';

    protected $returnType     = Employee::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_employee',
        'name_employee',
        'surname_employee',
        'photo_employee',
        'startdate_employee'
    ];

    public function getEmployeeLogin(string $column, string $value)
    {
        return $this->db->table('employee')
            ->select('*')
            ->join('jobtitle', 'employee.jobtitle_id_jobtitle = jobtitle.id_jobtitle')
            ->where('employee.' . $column, $value)
            ->get()->getFirstRow();
    }
}

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

    protected $validationRules    = [
        'id_employee' => 'required|is_natural|is_unique[employee.id_employee]',
        'name_employee' => 'required|alpha_numeric_space',
        'surname_employee' => 'required|alpha_numeric_space',
        'active_employee' => 'required|is_natural',
        'photo_employee' => 'required',
        'startdate_employee' => 'required|valid_date[Y-m-d]',
        'jobtitle_id_jobtitle' => 'required|is_not_unique[jobtitle.id_jobtitle]',
        'phonenumber_employee' => 'required|is_natural',
        'pass_employee'     => 'required|min_length[8]',
        'pass_confirm' => 'required_with[pass_employee]|matches[pass_employee]'
    ];

    protected $validationMessages = [
        'id_employee'        => [
            'required' => 'La cedula es requerida!',
            'is_natural' => 'La cedula deben ser solo números!'
        ]
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

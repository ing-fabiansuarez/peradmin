<?php

namespace App\Models;

use App\Entities\Employee;
use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table      = 'employee_has_permission';
    protected $primaryKey = 'employee_id_employee';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'employee_id_employee',
        'permission_id_permission',
        'active_permission'
    ];

    public function hasPermission($permission, $cedula = null)
    {
        if ($cedula == null) {
            if (!$this->where('employee_id_employee', session()->cedula_employee)->where('Permission_id_permission', $permission)->where('active_permission', 1)->first()) {
                return false;
            } else {
                return true;
            }
        } else {
            if (!$this->where('employee_id_employee', $cedula)->where('Permission_id_permission', $permission)->where('active_permission', 1)->first()) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function getAllPermissions()
    {
        return $this->db->table('permission')
            ->select('*')
            ->get()->getResultArray();
    }

    public function findPermission($id_permission)
    {
        return ($this->db->table('permission')
            ->select('*')
            ->where('permission.id_permission', $id_permission)
            ->get()->getFirstRow('array'));
    }

    public function getAllPermissionsBy($cedula)
    {
        $arrayResult = array();
        foreach ($this->db->table('employee_has_permission')
            ->select('id_permission')
            ->join('permission', 'employee_has_permission.permission_id_permission = permission.id_permission')
            ->where('employee_has_permission.employee_id_employee', $cedula)
            ->where('employee_has_permission.active_permission', 1)
            ->get()->getResultArray() as $permission) {
            array_push($arrayResult, $permission['id_permission']);
        }
        return $arrayResult;
    }
}

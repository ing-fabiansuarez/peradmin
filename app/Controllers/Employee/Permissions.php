<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\PermissionModel;

class Permissions extends BaseController
{
    public function __construct()
    {
        $this->mdlPermission = new PermissionModel();
        $this->mdlEmployee = new EmployeeModel();
    }

    public function view_permissions($cedula)
    {
        return view('contents/employee/permission_view', [
            'permissions' => $this->mdlPermission->getAllPermissions(),
            'employee' => $this->mdlEmployee->find($cedula)
        ]);
    }
}

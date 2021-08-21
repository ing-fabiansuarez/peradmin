<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\PermissionModel;

class Permissions extends BaseController
{
    public function __construct()
    {
        $this->mdlPermission = new PermissionModel();
    }

    public function view_permissions($cedula)
    {
        $this->mdlPermission->getAllPermissions();
        return view('contents/employee/permission_view');
    }
}

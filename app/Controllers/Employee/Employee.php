<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use Exception;

class Employee extends BaseController
{

    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlEmployee = new EmployeeModel();
    }

    public function index()
    {
        return view('contents/employee/employees_view', [
            'employees' => $this->mdlEmployee->findAll()
        ]);
    }
}

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

    public function crud($action)
    { //[1 - create][2 - read][3 - update][4 - Delate] 

        switch ($action) {
            case 1:
                $newEmployee = [
                    'id_employee' => $this->request->getPost('cedula'),
                    'name_employee' => $this->request->getPost('name'),
                    'surname_employee' => $this->request->getPost('surname'),
                    'active_employee' => 1,
                    'photo_employee' => 'sin-image.jpg',
                    'startdate_employee' => $this->request->getPost('date'),
                    'pass_employee' => $this->request->getPost('name'),
                    'jobtitle_id_jobtitle' => $this->request->getPost('jobtitle'),
                    'phonenumber_employee' => $this->request->getPost('phonenumber'),
                ];
                try {
                    $this->mdlEmployee->insert($newEmployee);
                    print true;
                } catch (Exception $e) {
                    print $e->getMessage();
                }
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
        }
    }
}

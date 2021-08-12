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
        $this->validator = \Config\Services::validation();
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
                $this->mdlEmployee->setValidationRules(
                    $this->validator->getRuleGroup('employeeRules')
                );

                if (d($this->mdlEmployee->validate($this->request))) {
                    $newEmployee = [
                        'id_employee' => $this->request->getPost('cedula_employee'),
                        'name_employee' => $this->request->getPost('name_employee'),
                        'surname_employee' => $this->request->getPost('surname_employee'),
                        'active_employee' => 1,
                        'photo_employee' => $this->request->getPost('photo_perfil'),
                        'startdate_employee' => $this->request->getPost('date_employee'),
                        'jobtitle_id_jobtitle' => $this->request->getPost('select_jobtitles'),
                        'phonenumber_employee' => $this->request->getPost('phonenumber_employee'),
                    ];
                    try {
                        $this->mdlEmployee->insert($newEmployee);
                    } catch (Exception $e) {
                    }
                } else {
                   
                }

                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                try {
                    $this->mdlEmployee->delete($this->request->getPost('cedula'));
                    print true;
                } catch (Exception $e) {
                    print $e->getMessage();
                }
                break;
        }
    }
}

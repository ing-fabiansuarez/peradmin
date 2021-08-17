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
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function index()
    {
        return view('contents/employee/employees_view', [
            'employees' => $this->mdlEmployee->orderBy('updated_at_employee', 'desc')->findAll()
        ]);
    }

    public function crud($action)
    { //[1 - create][2 - read][3 - update][4 - Delate] 

        switch ($action) {
            case 1:
                if (!($this->validate(
                    $this->rulesvalidation->getRuleGroup('newEmployeeRules')
                ))) {
                    return redirect()->back()->with('errorsinputs', $this->validator->getErrors())->withInput();
                }

                $file = $this->request->getFile('photo_perfil');
                if ($file->isValid() && !$file->hasMoved()) {
                    $ext = '.' . $file->getClientExtension();
                    $newName = $this->request->getPost('cedula_employee');
                    $file->move('./public/img/users/', $newName . $ext);
                    $filepath = './public/img/users/' . $newName . $ext;
                    try {
                        $Image = \Config\Services::image()->withFile($filepath);
                    } catch (Exception $e) {
                        //se elimina el archivo que se habia subido porque la imagen no es imagen
                        //unlink($filepath);
                        return redirect()->back()->with('error', [
                            'body' => 'Exception: ' . $e->getMessage(),
                            'title' => 'Hubo un error al tratar de guardar la imagen'
                        ])->withInput();
                    }
                    $width_image = $Image->getFile()->origHeight;
                    $height_image = $Image->getFile()->origWidth;
                    $desired_width = 250;
                    $Image->reorient()->resize($desired_width, ($width_image / $height_image) * $desired_width)->save($filepath);
                    //se crea el registro en la base de datso
                    $this->mdlEmployee->insert([
                        'id_employee' => $this->request->getPost('cedula_employee'),
                        'name_employee' => $this->request->getPost('name_employee'),
                        'surname_employee' => $this->request->getPost('surname_employee'),
                        'active_employee' => 1,
                        'photo_employee' => $newName . $ext,
                        'startdate_employee' => $this->request->getPost('date_employee'),
                        'jobtitle_id_jobtitle' => $this->request->getPost('select_jobtitles'),
                        'phonenumber_employee' => $this->request->getPost('phonenumber_employee'),
                    ]);
                    return redirect()->back()->with('msg', [
                        'title' => 'Creado!!',
                        'body' => 'El empleado fue creado exitosamente'
                    ]);
                } else {
                    return redirect()->back()->with('error', [
                        'title' => 'No pudo ser Creado con Exito!',
                        'body' => "El Archivo no es valido o ha sido movido"
                    ]);
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

<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\PermissionModel;

class Permissions extends BaseController
{
    public function __construct()
    {
        $this->mdlEmployee = new EmployeeModel();
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function view_permissions($cedula)
    {
        return view('contents/employee/permission_view', [
            'permissions' => $this->mdlPermission->getAllPermissions(),
            'employee' => $this->mdlEmployee->find($cedula)
        ]);
    }

    public function update_permissions($cedula)
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(8)) {
            print "No tienes permisos";
            return;
        }
        //validar si el empleado existe
        if (!$this->mdlEmployee->find($cedula)) {
            print "El empleado no exite";
            return;
        }

        $array = $this->request->getPost();

        if ($this->mdlPermission->where('employee_id_employee', $cedula)->delete()) {
            foreach ($array as $key => $value) {
                //valida si el permiso que pasa por request POST es valido y existe
                if (!$this->mdlPermission->findPermission($key)) {
                    print "Hay permisos que no existen";
                    return;
                }
                $this->mdlPermission->insert([
                    'employee_id_employee' => $cedula,
                    'permission_id_permission' => $key,
                    'active_permission' => 1,
                ]);
            }
        }
        return redirect()->back()->with('msg', [
            'icon' => '<i class="icon fas fa-check"></i>',
            'class' => 'alert-success',
            'title' => 'Se guardarón!',
            'body' => 'Se guardarón conrrectamente los permisos'
        ]);
    }

    public function updatePassword($cedula)
    {
        //validacion de permisos del sistema
        if (!$this->mdlPermission->hasPermission(8)) {
            return redirect()->back()->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'No se puedo Cambiar!',
                'body' => 'No tienes permisos para cambiar las contraseñas de los empleados'
            ]);
        }
        //validacion de que las contraseñas sean iguales
        if (!($this->validate(
            $this->rulesvalidation->getRuleGroup('newPass')
        ))) {
            $text = '';
            foreach ($this->validator->getErrors() as $error) {
                $text .= '*' . $error . '<br>';
            }
            return redirect()->back()->with('msg', [
                'icon' => '<i class="icon fas fa-exclamation-triangle"></i>',
                'class' => 'alert-warning',
                'title' => 'Hubierón errores en la validación!',
                'body' => $text
            ]);
        }
        $employee = $this->mdlEmployee->find($cedula);
        $employee->setPassword($this->request->getPost('pass_employee'));
        $this->mdlEmployee->save($employee);
        return redirect()->back()->with('msg', [
            'icon' => '<i class="icon fas fa-check"></i>',
            'class' => 'alert-success',
            'title' => 'Correcto!',
            'body' => 'Cambio de contraseña con exito.'
        ]);
    }
}

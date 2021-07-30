<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;
use App\Models\JobtitleModel;
use Exception;

class Jobtitles extends BaseController
{

    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlJobtitle = new JobtitleModel();
    }

    public function index()
    {
        return view('contents/employee/jobtitle_view', [
            'jobtitles' => $this->mdlJobtitle->findAll(),
        ]);
    }

    public function create()
    {
        //se valida el formulario
        if (!$this->validate(
            [
                'name_jobtitle' => 'required|alpha_numeric_punct',
                'salary_jobtitle' => 'required|decimal'
            ],
            [   // Errors
                'name_jobtitle' => [
                    'required' => 'El nombre del cargo es requerido!',
                    'alpha_numeric_punct' => 'Contiene algo que no sea alfanumérico, espacio o este conjunto limitado de caracteres de puntuación: ~ (tilde),! (exclamación), # (número), $ (dólar),% (porcentaje), & (y comercial), * (asterisco), - (guión), _ (guión bajo), + (más), = (es igual a), | (barra vertical),: (dos puntos),. (período).es.'
                ],
                'salary_jobtitle' => [
                    'required' => 'El salario del cargo es requerido!',
                    'decimal' => 'El salario solo debe contener numeros.'
                ],
            ]
        )) {
            //no pasa la validacion no lo deja continuar hasta que los datos no sean los correctos
            return redirect()->back()->with('error_validate', $this->validator->getErrors())->withInput();
        }
        try {
            $this->mdlJobtitle->insert([
                'name_jobtitle' => $this->request->getPost('name_jobtitle'),
                'salary_jobtitle' => $this->request->getPost('salary_jobtitle')
            ]);
            return redirect()->back()
                ->with('msg_toastr', "toastr.success('SE CREO EL CARGO CORRECTAMENTE.')");
        } catch (Exception $e) {
            return redirect()->back()
                ->with('msg_toastr', "toastr.error('NO SE PUDO CREAR EL CARGO." . $e->getMessage() . "')");
        }
    }
    public function crud($action)
    {
        switch ($action) {
            case 'update':
                try {
                    $this->mdlJobtitle->update((int)$this->request->getPost('id'), [
                        'name_jobtitle' => $this->request->getPost('name'),
                        'salary_jobtitle' => floatval($this->request->getPost('salary'))
                    ]);
                    echo true;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                break;
            case 'delete':
                try {
                    $this->mdlJobtitle->delete((int)$this->request->getPost('id'));
                    echo true;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                break;
            default:
                echo false;
                break;
        }
    }
}

<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;


class Production extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->rulesvalidation = \Config\Services::validation();
    }

    public function index()
    {
        return view('contents/production/view_production');

        vamos aqui
    }
}

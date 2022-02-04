<?php

namespace App\Controllers\Quoter;

use App\Controllers\BaseController;

class Quoter extends BaseController
{
    public function Normal()
    {
        return view('contents/quoter/normal');
    }

    public function Promotion()
    {
        return view('contents/quoter/promotion');
    }
}

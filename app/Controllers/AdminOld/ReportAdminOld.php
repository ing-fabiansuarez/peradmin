<?php

namespace App\Controllers\AdminOld;

use App\Controllers\BaseController;
use App\Models\OldAdmin\Customer_oaModel;

class ReportAdminOld extends BaseController
{
	public function reportNewCustomers($startDate, $finishDate)
	{
		//validacion de las fechas que sean correctas
		$startDateArray = explode('-', $startDate);
		$finishDateArray = explode('-', $finishDate);
		if (count($startDateArray) != 3 || count($finishDateArray) != 3) {
			return "FECHAS NO TIENEN UN FORMATO CORRECTO";
		}
		if (!(checkdate((int)$startDateArray[1], (int)$startDateArray[2], (int)$startDateArray[0]) && checkdate((int)$finishDateArray[1], (int)$finishDateArray[2], (int)$finishDateArray[0]))) {
			return "FECHAS NO TIENEN UN FORMATO CORRECTO";
		}
		//:...........................................

		$mdlOldAdminCustomers = new Customer_oaModel();
		//dd($mdlOldAdminCustomers->find('1098823092')->getQuantityDeilOrderMayor(12));

		return view('oldadmin/new_customers', [
			'customers' => $mdlOldAdminCustomers->where("cli_fecha_creacion >= '" . $startDate . "' AND cli_fecha_creacion <= '" . $finishDate . "'")->findAll()
		]);
	}

	public function validateFormRangeDate()
	{
		d($arraydates = explode(' - ', $this->request->getPost('dates')));
		$startDateArray = explode('/', $arraydates[0]);
		$finishDateArray = explode('/', $arraydates[1]);
		d($startDateArray);
		if (count($startDateArray) != 3 || count($finishDateArray) != 3) {
			return "FECHAS NO TIENEN UN FORMATO CORRECTO";
		}
		if (!(checkdate((int)$startDateArray[1], (int)$startDateArray[2], (int)$startDateArray[0]) && checkdate((int)$finishDateArray[1], (int)$finishDateArray[2], (int)$finishDateArray[0]))) {
			return "FECHAS NO TIENEN UN FORMATO CORRECTO";
		}
		//:...........................................
		return redirect()->to(base_url().route_to('admin_old_report_between_dates',$startDateArray[0].'-'.$startDateArray[1].'-'.$startDateArray[2],$finishDateArray[0].'-'.$finishDateArray[1].'-'.$finishDateArray[2]));
	}
}

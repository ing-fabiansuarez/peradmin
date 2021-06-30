<?php

namespace App\Controllers\AdminOld;

use App\Controllers\BaseController;

class ReportAdminOld extends BaseController
{
	public function reportBetweenDates($startDate, $finishDate)
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


		
	}
}

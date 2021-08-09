<?php

namespace App\Controllers\Ajax;

use App\Controllers\BaseController;
use App\Models\JobtitleModel;

class Ajax extends BaseController
{
	public function __construct()
	{
		$this->mdlJobtitle = new JobtitleModel();
	}
	public function ajaxJobtitlesHtml()
	{
		$jobtitles = $this->mdlJobtitle->findAll();
		$cadena = "<option value=''>Seleccionar Cargo</option>";
		foreach ($jobtitles as $job) {
			$cadena = $cadena . '<option value="' . $job['id_jobtitle'] . '">' . $job['name_jobtitle'] . ' - ' . number_format($job['salary_jobtitle']) . '</option>';
		}
		echo $cadena . "";
		return true;
	}
	public function ajaxInputPasswordHtml($value)
	{
		switch ($value) {
			case 1:
				echo
				"<div class='row'>
						<div class='col-sm-6'>
							<div class='form-group'>
								<label>Contraseña</label>
								<input id='pass' type='password' class='form-control' placeholder='Contraseña'>

							</div>
						</div>
						<div class='col-sm-6'>
							<div class='form-group'>
								<label>Confirmar contraseña</label>
								<input id='pass_confirmation' type='password' class='form-control' placeholder='Confirmar Contraseña'>
							</div>
						</div>
					</div>";
				return;
				break;
			default:
				echo "";
				break;
		}
	}
}

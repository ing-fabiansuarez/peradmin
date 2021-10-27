<?php

namespace App\Controllers\Ajax;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Models\CustomerModel;
use App\Models\EmployeeModel;
use App\Models\JobtitleModel;
use App\Models\OrderModel;
use App\Models\PermissionModel;
use App\Models\PriceModel;
use App\Models\ReferenceModel;
use App\Models\SizeModel;

class Ajax extends BaseController
{
	public function __construct()
	{
		$this->mdlJobtitle = new JobtitleModel();
		$this->mdlEmployee = new EmployeeModel();
		$this->modelCity = new CityModel();
		$this->mdlSize = new SizeModel();
		$this->mdlReference = new ReferenceModel();
		$this->mdlPrice = new PriceModel();
		$this->mdlCustomer = new CustomerModel();
		$this->mdlOrder = new OrderModel();
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

	public function ajaxHtmlCities()
	{
		$cities = $this->modelCity->where('department_id', $this->request->getPostGet('department'))->orderBy('name_city', 'ASC')->findAll();
		$cadena = "
        <option value=''>* Ciudad</option>
        ";
		foreach ($cities as $city) {
			$cadena = $cadena . '<option value="' . $city['id_city'] . '">' . $city['name_city'] . '</option>';
		}
		echo $cadena;
		return true;
	}
	public function	ajaxHtmlSizes()
	{
		$query = $this->mdlSize
			->where('product_id', $this->request->getPostGet('product'))
			->where('active_size', 1)
			->orderBy('name_size', 'ASC')->findAll();
		$cadena = "
        <option value=''>* Tallas</option>
        ";
		foreach ($query as $row) {
			$cadena = $cadena . '<option value="' . $row['id_size'] . '">' . $row['name_size'] . '</option>';
		}
		echo $cadena;
		return true;
	}

	public function ajaxPermissionBy($cedula)
	{
		//validacion de permisos
		if (!$this->mdlPermission->hasPermission(8)) {
			print "No tienes permisos";
			return;
		}
		//validar si el empleado existe
		if (!$employee = $this->mdlEmployee->find($cedula)) {
			print "El empleado no exite";
			return;
		}
		return json_encode($employee->getPermissions());
	}

	public function ajaxHtmlReferences()
	{
		$query = $this->mdlReference
			->where('product_id', $this->request->getPostGet('product'))
			->where('active_reference', 1)
			->orderBy('num_reference', 'ASC')->findAll();
		$cadena = "
        <option value=''>* Referencias</option>
        ";
		foreach ($query as $row) {
			$cadena = $cadena . '<option value="' . $row['num_reference'] . '">' . $row['num_reference'] . ' - ' . $row['name_reference'] . '</option>';
		}
		echo $cadena;
		return true;
	}

	public function ajaxHtmlObsevation()
	{
		if ($this->request->getPostGet('product') == 1 || $this->request->getPostGet('product') == 2 || $this->request->getPostGet('product') == 3) {
			$cadena =
				"
					<div class='form-group'>
                        <label>Observación</label>
						<select name='observation' id='select_product' class='custom-select'>
							<option value=''>Ninguna</option>
							<option value='un empeine'>Un empeine</option>
							<option value='doble empeine'>Doble empeine</option>
							<option value='pie delgado'>Pie delgado</option>
						</select>
					</div>
				";
		} else {
			$cadena = '<input type="hidden" name="observation" value="">';
		}
		echo $cadena;
		return;
	}

	public function ajaxPriceProduct()
	{
		if (!$price = $this->mdlPrice->select('unit_price')->where('product_id_product', $this->request->getPostGet('product'))->where('type_of_order_id_typeoforder', $this->request->getPostGet('type_order'))->first()) {
			echo 0;
			return;
		}
		echo $price['unit_price'];
		return;
	}

	public function getLastAdress($id_customer)
	{
		if (!$customer = $this->mdlCustomer->find($id_customer)) {
			echo 'null';
			return;
		}
		echo json_encode($customer->getLastAdress());
		return;
	}

	public function ajaxHtmlOrderAsesor($id_order)
	{
		if (!$order = $this->mdlOrder->find($id_order)) {
			echo "ORDEN NO EXITE";
			return;
		}
		return view('reports/view_print_order', [
			'order' => $order
		]);
	}


}

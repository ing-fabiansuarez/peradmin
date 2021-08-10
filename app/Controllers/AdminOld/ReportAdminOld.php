<?php

namespace App\Controllers\AdminOld;

use App\Controllers\BaseController;
use App\Models\OldAdmin\Customer_oaModel;
use App\Models\OldAdmin\Listapedidos_oaModel;
use App\Models\OldAdmin\Product_oaModel;
use App\Models\OldAdmin\TypeProduct_oaModel;

class ReportAdminOld extends BaseController
{

	public function __construct()
	{
		$this->mdlTypeModel = new TypeProduct_oaModel();
		$this->mdlListapedidos = new Listapedidos_oaModel();
		$this->mdlReferences = new Product_oaModel();
	}

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
			'customers' => $mdlOldAdminCustomers->where("cli_fecha_creacion >= '" . $startDate . "' AND cli_fecha_creacion <= '" . $finishDate . "'")->findAll(),
			'dates' => [
				'start' => $startDate,
				'finish' => $finishDate
			]
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
		return redirect()->to(base_url() . route_to('admin_old_report_between_dates', $startDateArray[0] . '-' . $startDateArray[1] . '-' . $startDateArray[2], $finishDateArray[0] . '-' . $finishDateArray[1] . '-' . $finishDateArray[2]));
	}

	public function view_report_references()
	{
		return view('oldadmin/references_by_products', [
			'type' => $this->mdlTypeModel->findAll()
		]);
	}

	public function view_report_references_genered()
	{
		$arraydates = explode(' - ', $this->request->getPost('dates'));
		$startDate = str_replace('/', '-', $arraydates[0]);
		$finishDate = str_replace('/', '-', $arraydates[1]);
		$product = $this->request->getPostGet('product');
		$nameProduct = $this->mdlTypeModel->find($product)['tip_nombre'];

		$refActives = $this->mdlReferences->select('pro_ref,pro_nombre')->where('tip_id', $product)->where('pro_activo !=', 'no')->get()->getResultArray();

		$arrayResult = array();
		foreach ($refActives as $ref) {
			$quantityMayor = $this->mdlListapedidos->db->table('listapedidos')
				->select('*')
				->join('pedidos', 'listapedidos.ped_id = pedidos.ped_id')
				->where('listapedidos.pro_ref', $ref['pro_ref'])
				->where('listapedidos.tip_id', $product)
				->where('pedidos.ped_fechaInicio >=', $startDate)
				->where('pedidos.ped_fechaInicio <=', $finishDate)
				->countAllResults();

			$quantityDetal = $this->mdlListapedidos->db->table('listapedidosdetal')
				->select('*')
				->join('pedidosdetal', 'listapedidosdetal.detal_id = pedidosdetal.detal_id')
				->where('listapedidosdetal.pro_ref', $ref['pro_ref'])
				->where('listapedidosdetal.tip_id', $product)
				->where('pedidosdetal.ped_fechaInicio >=', $startDate)
				->where('pedidosdetal.ped_fechaInicio <=', $finishDate)
				->countAllResults();

			array_push($arrayResult, array_merge($ref, [
				'quantity' => $quantityMayor + $quantityDetal,
				'quantitymayor' => $quantityMayor,
				'quantitydetal' => $quantityDetal
			]));
		}
		return view('oldadmin/references_by_products_genered', [
			'arrayresult' => $arrayResult,
			'startdate' => $startDate,
			'finishdate' => $finishDate,
			'namecategory' => $nameProduct
		]);
	}
}

<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->group('/', ['filter' => 'auth'], function ($routes) {
	$routes->get('', 'Home::index', ['as' => 'home_system']);

	//cargos
	$routes->group('cargos', ['namespace' => 'App\Controllers\Employee', 'filter' => 'auth'], function ($routes) {
		$routes->get('', 'Jobtitles::index', ['as' => 'view_jobtitles']);
		$routes->post('', 'Jobtitles::create', ['as' => 'create_new_jobtitles']);
		$routes->post('crud/(:alpha)', 'Jobtitles::crud/$1', ['as' => 'delete_jobtitles']);
	});

	//empleados
	$routes->group('empleados', ['namespace' => 'App\Controllers\Employee', 'filter' => 'auth'], function ($routes) {
		$routes->get('', 'Employee::index', ['as' => 'view_employee']);
		$routes->post('crud/(:num)', 'Employee::crud/$1', ['as' => 'crud_employee']);
		$routes->get('permisos/(:segment)', 'Permissions::view_permissions/$1', ['as' => 'view_employee_permissions']);
		$routes->post('update/(:segment)', 'Permissions::update_permissions/$1', ['as' => 'update_employee_permission']);
		$routes->post('password/(:segment)', 'Permissions::updatePassword/$1', ['as' => 'update_password_employee']);
	});

	//pedidos
	$routes->group('pedido', ['namespace' => 'App\Controllers\Order', 'filter' => 'auth'], function ($routes) {
		$routes->get('', 'Order::index', ['as' => 'view_order']);
		$routes->post('loadcustomer', 'Order::load_customer', ['as' => 'load_customer_by_order']);
		$routes->get('cleancustomer', 'Order::clean_customer', ['as' => 'clean_customer']);
		$routes->post('crear', 'Order::create_order', ['as' => 'create_order']);
		$routes->post('addproducto', 'Order::add_product', ['as' => 'add_product_order']);
		$routes->post('deleteitem', 'Order::deleteDetailProduct', ['as' => 'delete_detail_order']);
		$routes->get('cargar', 'Order::view_search_order', ['as' => 'view_load_order']);
		$routes->post('cargar', 'Order::viewResultSearch', ['as' => 'view_result_search_order']);
		$routes->get('cargarsesionpedido/(:segment)', 'Order::loadSessionOrder/$1', ['as' => 'load_session_order']);
		$routes->get('porpasaraproduccion', 'Order::viewOrderToPassProduction', ['as' => 'view_to_pass_producction']);
	});

	//production
	$routes->group('produccion', ['namespace' => 'App\Controllers\Production', 'filter' => 'auth'], function ($routes) {
		$routes->get('', 'Production::index', ['as' => 'view_production']);
		$routes->post('goproduction/(:segment)', 'Production::goToProduction/$1', ['as' => 'go_to_production']);
		$routes->get('ver/(:segment)/(:segment)/(:segment)', 'Production::viewDayProduction/$1/$2/$3', ['as' => 'view_day_production']);
	});

	//cliente
	$routes->group('cliente', ['namespace' => 'App\Controllers\Order', 'filter' => 'auth'], function ($routes) {
		$routes->post('crear/(:num)', 'Customer::crud/$1', ['as' => 'create_customer']);
	});

	//ajax
	$routes->group('api', ['namespace' => 'App\Controllers\Ajax', 'filter' => 'auth'], function ($routes) {
		$routes->get('jobtitles', 'Ajax::ajaxJobtitlesHtml', ['as' => 'ajax_html_jobtitles']);
		$routes->add('permissions/(:segment)', 'Ajax::ajaxPermissionBy/$1', ['as' => 'ajax_permissionsby']);
		$routes->post('htmlcities', 'Ajax::ajaxHtmlCities', ['as' => 'ajax_html_cities']);
		$routes->post('htmlsizes', 'Ajax::ajaxHtmlSizes', ['as' => 'ajax_html_sizes']);
		$routes->post('htmlreferences', 'Ajax::ajaxHtmlReferences', ['as' => 'ajax_html_references']);
		$routes->post('htmlobservation', 'Ajax::ajaxHtmlObsevation', ['as' => 'ajax_html_observations']);
		$routes->post('price', 'Ajax::ajaxPriceProduct', ['as' => 'ajax_price_product']);
		$routes->post('getlastadress/(:segment)', 'Ajax::getLastAdress/$1', ['as' => 'ajax_get_last_adress']);

		//imprmir orders
		$routes->add('htmlpedidoasesores/(:segment)', 'Ajax::ajaxHtmlOrderAsesor/$1', ['as' => 'ajax_html_order_asesores']);
	});

	//Generador de reportes
	$routes->group('generar', ['namespace' => 'App\Controllers\GenerateReport', 'filter' => 'auth'], function ($routes) {
		$routes->get('rotulo/(:segment)', 'OrderReport::generateRotulo/$1', ['as' => 'rotulo_order']);
		$routes->post('formatogeneral/(:segment)', 'OrderReport::generateGeneralFormat/$1', ['as' => 'general_format_order']);
	});

	//el administrador viejo
	$routes->group('admin_old', ['namespace' => 'App\Controllers\AdminOld', 'filter' => 'auth'], function ($routes) {
		$routes->get('reportes/clientesentrefechas/(:segment)/(:segment)', 'ReportAdminOld::reportNewCustomers/$1/$2', ['as' => 'admin_old_report_between_dates']);
		$routes->post('reportes/verificarfechas', 'ReportAdminOld::validateFormRangeDate', ['as' => 'admin_old_validate_dates']);
		$routes->get('reportes/referencias', 'ReportAdminOld::view_report_references', ['as' => 'admin_old_report_by_references']);
		$routes->post('reportes/referencias', 'ReportAdminOld::view_report_references_genered', ['as' => 'admin_old_report_by_references_genered']);
	});
});

//routes of auth
$routes->group('auth', function ($routes) {
	$routes->get('login', 'Auth::login', ['as' => 'login']);
	$routes->post('check', 'Auth::signin', ['as' => 'check_login']);
	$routes->get('logout', 'Auth::logout', ['as' => 'logout']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

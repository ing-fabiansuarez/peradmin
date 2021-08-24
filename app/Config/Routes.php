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
	});

	//ajax
	$routes->group('api', ['namespace' => 'App\Controllers\Ajax', 'filter' => 'auth'], function ($routes) {
		$routes->get('jobtitles', 'Ajax::ajaxJobtitlesHtml', ['as' => 'ajax_html_jobtitles']);
		$routes->add('permissions/(:segment)', 'Ajax::ajaxPermissionBy/$1', ['as' => 'ajax_permissionsby']);
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

<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $newEmployeeRules = [
		'cedula_employee' => [
			'rules'  => 'required|is_natural|is_unique[employee.id_employee]',
			'errors' => [
				'required' => 'La cedula es requerida.',
				'is_natural' => 'La cedula debe contener solo numeros.',
				'is_unique' => 'Ese número de cedula ya existe.',
			]
		],
		'name_employee'    => [
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'El nombre es requerida.',
				'alpha_numeric_space' => 'Hay caracteres que no son validos.'
			]
		],
		'surname_employee'    => [
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'El apellido es requerida.',
				'alpha_numeric_space' => 'Hay caracteres que no son validos.'
			]
		],
		'date_employee'    => [
			'rules'  => 'required|valid_date[Y-m-d]',
			'errors' => [
				'required' => 'La fecha es requerida.',
				'valid_date' => 'Por favor ingresa una fecha valida.'
			]
		],
		'select_jobtitles'    => [
			'rules'  => 'required|is_not_unique[jobtitle.id_jobtitle]',
			'errors' => [
				'required' => 'El cargo es requerida.',
				'is_not_unique' => 'El cargo no exite.'
			]
		],
		'phonenumber_employee'    => [
			'rules'  => 'required|is_natural',
			'errors' => [
				'required' => 'El telefono es requerida.',
				'is_natural' => 'El numero de telefono debe contener solo numeros.',
			]
		],

	];

	public $newPass = [
		'pass_employee'    => [
			'rules'  => 'required|min_length[8]',
			'errors' => [
				'valid_email' => 'Please check the Email field. It does not appear to be valid.'
			]
		],
		'pass_confirm'    => [
			'rules'  => 'required_with[pass_employee]|matches[pass_employee]',
			'errors' => [
				'valid_email' => 'Please check the Email field. It does not appear to be valid.'
			]
		],
	];
}

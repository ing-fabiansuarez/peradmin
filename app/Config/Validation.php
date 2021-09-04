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
			'rules'  => 'required|valid_date[dd/mm/Y]',
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

	public $editEmployee = [
		'cedula_employee' => [
			'rules'  => 'required|is_natural|is_not_unique[employee.id_employee]',
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
				'required' => 'Es requerida la contraseña.',
				'min_length' => 'La contraseña debe tener minimo 8 digitos.'
			]
		],
		'pass_confirm'    => [
			'rules'  => 'required_with[pass_employee]|matches[pass_employee]',
			'errors' => [
				'required_with' => 'Es requerida la confirmación de la contraseña',
				'matches' => 'Las contraseñas no coinciden.'
			]
		],
	];

	public $newCustomer = [
		'identification' => [
			'rules'  => 'required|is_unique[customer.numberidenti_customer]',
			'errors' => [
				'required' => 'La cedula es requerida.',
				'is_natural' => 'La cedula debe contener solo numeros.',
				'is_unique' => 'Ese número de identificación ya existe.',
			]
		],
		'type'    => [
			'rules'  => 'required|is_not_unique[type_of_identification.id_typeofidentification]',
			'errors' => [
				'required' => 'La fecha es requerida.',
				'is_not_unique' => 'El tipo de identificación es desconocida.'
			]
		],
		'name_customer'    => [
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'El nombre es requerida.',
				'alpha_numeric_space' => 'Hay caracteres que no son validos.'
			]
		],
		'surname_customer'    => [
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'El apellido es requerida.',
				'alpha_numeric_space' => 'Hay caracteres que no son validos.'
			]
		],
	];

	public $editCustomer = [
		'identification' => [
			'rules'  => 'required|is_not_unique[customer.id_customer]',
			'errors' => [
				'required' => 'La cedula es requerida.',
				'is_natural' => 'La cedula debe contener solo numeros.',
				'is_not_unique' => 'El cliente no existe.',
			]
		],
		'type'    => [
			'rules'  => 'required|is_not_unique[type_of_identification.id_typeofidentification]',
			'errors' => [
				'required' => 'La fecha es requerida.',
				'is_not_unique' => 'El tipo de identificación es desconocida.'
			]
		],
		'name_customer'    => [
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'El nombre es requerida.',
				'alpha_numeric_space' => 'Hay caracteres que no son validos.'
			]
		],
		'surname_customer'    => [
			'rules'  => 'required|alpha_numeric_space',
			'errors' => [
				'required' => 'El apellido es requerida.',
				'alpha_numeric_space' => 'Hay caracteres que no son validos.'
			]
		],
	];

	public $newOrder = [
		'date_production' => [
			'rules'  => 'required|valid_date[Y-m-d]',
			'errors' => [
				'required' => 'Fecha requerida.',
				'valid_date' => 'Fecha invalida.',
			]
		],
		'prodution_line'    => [
			'rules'  => 'required|is_not_unique[production_line.id_productionline]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite la linea de producción.'
			]
		],
		'type_order'    => [
			'rules'  => 'required|is_not_unique[type_of_order.id_typeoforder]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite el tipo de pedido.'
			]
		],
		'transporter_order'    => [
			'rules'  => 'required|is_not_unique[transporter.id_transporter]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite la transportadora.'
			]
		],
		'city_order'    => [
			'rules'  => 'required|is_not_unique[city.id_city]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite la ciudad.'
			]
		],
		'neighborhood_order'    => [
			'rules'  => 'required|alpha_numeric_punct',
			'errors' => [
				'required' => 'Es requerido.',
				'alpha_numeric_punct' => 'Hay caracteres que no son validos.'
			]
		],
		'adress_order'    => [
			'rules'  => 'required|alpha_numeric_punct',
			'errors' => [
				'required' => 'Es requerido.',
				'alpha_numeric_punct' => 'Hay caracteres que no son validos.'
			]
		],
		'whatsapp_order'    => [
			'rules'  => 'required|is_natural|max_length[10]|min_length[10]',
			'errors' => [
				'required' => 'Es requerido.',
				'max_length' => 'Debe contener 10 caracteres.',
				'min_length' => 'Debe contener 10 caracteres.',
				'is_natural' => 'Solo se aceptan números naturales'
			]
		],
		'email_order'    => [
			'rules'  => 'required|valid_email',
			'errors' => [
				'required' => 'Es requerido.',
				'valid_email' => 'Es un correo invalido.'
			]
		],
	];

	public $newDetailOrder = [
		'product_id' => [
			'rules'  => 'required|valid_date[Y-m-d]',
			'errors' => [
				'required' => 'Fecha requerida.',
				'valid_date' => 'Fecha invalida.',
			]
		],
		'reference_id'    => [
			'rules'  => 'required|is_not_unique[production_line.id_productionline]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite la linea de producción.'
			]
		],
		'size_id'    => [
			'rules'  => 'required|is_not_unique[type_of_order.id_typeoforder]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite el tipo de pedido.'
			]
		],
		'quantity'    => [
			'rules'  => 'required|is_not_unique[transporter.id_transporter]',
			'errors' => [
				'required' => 'Es requerido.',
				'is_not_unique' => 'No exite la transportadora.'
			]
		],
	];
}

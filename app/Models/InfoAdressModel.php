<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoAdressModel extends Model
{
    protected $table      = 'info_adress';
    protected $primaryKey = 'id_infoadress';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'transporter_id',
        'city_id',
        'whatsapp_infoadress',
        'email_infoadress',
        'neighborhood_infoadress',
        'home_infoadress'
    ];
}

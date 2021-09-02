<?php

namespace App\Entities;

use App\Models\InfoAdressModel;
use CodeIgniter\Entity\Entity;

class Order extends Entity
{
    protected $dates = ['created_at_order'];

    public function __construct()
    {
    }

    public function setInfoAdress($transporter, $city, $whtapp, $email, $neighborhood, $homeadress)
    {
        $mdlInfoAdress = new InfoAdressModel();
        $this->attributes['info_adress_id'] = $mdlInfoAdress->insert([
            'transporter_id' => $transporter,
            'city_id' => $city,
            'whatsapp_infoadress' => $whtapp,
            'email_infoadress' => $email,
            'neighborhood_infoadress' => $neighborhood,
            'home_infoadress' => $homeadress
        ]);
        return $this;
    }
}

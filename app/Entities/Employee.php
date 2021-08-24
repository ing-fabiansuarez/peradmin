<?php

namespace App\Entities;

use App\Models\JobtitleModel;
use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    private $mdlJobtitle ;

    public function __construct()
    {
        $this->mdlJobtitle= new JobtitleModel();
    }
    
    protected $dates = ['created_at_employee', 'updated_at_employee', 'deleted_at_employee'];

    public function getJobtitle_id_jobtitle()
    {
        return $this->mdlJobtitle->find($this->jobtitle_id_jobtitle);
    }
}

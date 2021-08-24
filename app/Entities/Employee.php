<?php

namespace App\Entities;

use App\Models\JobtitleModel;
use App\Models\PermissionModel;
use CodeIgniter\Entity\Entity;

class Employee extends Entity
{
    private $mdlJobtitle;
    private $mdlPermission;

    public function __construct()
    {
        $this->mdlJobtitle = new JobtitleModel();
        $this->mdlPermission = new PermissionModel();
    }

    protected $dates = ['created_at_employee', 'updated_at_employee', 'deleted_at_employee'];

    public function getJobtitle_id_jobtitle()
    {
        return $this->mdlJobtitle->find($this->jobtitle_id_jobtitle);
    }

    public function getPermissions()
    {//retorna un array con los id de permisos que tien el empleado
        return $this->mdlPermission->getAllPermissionsBy($this->id_employee);
    }
}

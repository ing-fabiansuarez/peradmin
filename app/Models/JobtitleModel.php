<?php

namespace App\Models;

use CodeIgniter\Model;

class JobtitleModel extends Model
{
    protected $table      = 'jobtitle';
    protected $primaryKey = 'id_jobtitle';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_jobtitle',
        'name_jobtitle',
        'salary_jobtitle'
    ];
}

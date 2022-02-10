<?php

namespace App\Controllers\Calendar;

use App\Models\StoreConsignmentModel;
use CodeIgniter\RESTful\ResourceController;

class Calendar extends ResourceController
{
    public $mdlStoreConsignments;
    public function __construct()
    {
        $this->mdlStoreConsignments = new StoreConsignmentModel();
    }
    public function index()
    {
        if ($this->request->isAJAX()) {
            $data = $this->mdlStoreConsignments->getEvents($this->request->getGet('start'), $this->request->getGet('end'));
            return $this->respond($data);
        }
        return view('contents/calendar/calendar_view');
    }
    public function create()
    {
        return parent::create();
    }
    public function update($id = null)
    {
        return parent::update($id);
    }
    public function delete($id = null)
    {
        return parent::update($id);
    }
}

<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customer extends BaseController
{
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function getAll($customerName)
    {
        return $this->response->setJSON($this->customerModel->getAll($customerName));
    }
}

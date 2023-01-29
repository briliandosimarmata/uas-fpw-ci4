<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\DiscountModel;
use App\Models\InvoiceModel;

class Invoice extends BaseController
{
    protected $invoiceModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
    }

    public function index()
    {
        $totalQtyCartItem = 0;
        if (sizeof(session()->get('cart_session')) > 0) {
            foreach (session()->get('cart_session') as $value) :
                if (sizeof($value) > 0)
                    $totalQtyCartItem = $totalQtyCartItem + intval($value['qty']);
            endforeach;
        }

        $data = [
            'title' => 'Invoice',
            'totalQtyCartItem' => $totalQtyCartItem
        ];

        return view('invoice', $data);
    }
}

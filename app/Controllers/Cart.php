<?php

namespace App\Controllers;

use App\Models\BookModel;

class Cart extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }
    public function index()
    {
        if (session()->get('cart_session') == null) {
            session()->set("cart_session", []);
        }

        $totalQtyCartItem = 0;

        if (sizeof(session()->get('cart_session')) > 0) {
            foreach (session()->get('cart_session') as $value) :
                if (sizeof($value) > 0)
                    $totalQtyCartItem = $totalQtyCartItem + intval($value['qty']);
            endforeach;
        }

        $data = [
            'title' => 'Detail Comic',
            'books' => $this->bookModel->getAll(),
            'totalQtyCartItem' => $totalQtyCartItem
        ];



        return view('cart', $data);
    }
}

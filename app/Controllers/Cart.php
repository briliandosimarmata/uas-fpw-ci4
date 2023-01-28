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
        $totalQtyCartItem = 0;
        if (sizeof(session()->get('cart_session')) > 0) {
            foreach (session()->get('cart_session') as $value) :
                if (sizeof($value) > 0)
                    $totalQtyCartItem = $totalQtyCartItem + intval($value['qty']);
            endforeach;
        }

        // dd(session()->get('cart_session'));
        $data = [
            'title' => 'Keranjang',
            'totalQtyCartItem' => $totalQtyCartItem,
            'cartItems' => session()->get('cart_session')
        ];

        return view('cart', $data);
    }
}

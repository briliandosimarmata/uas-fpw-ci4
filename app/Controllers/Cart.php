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

        $data = [
            'title' => 'Keranjang',
            'totalQtyCartItem' => $totalQtyCartItem,
            'cartItems' => session()->get('cart_session')
        ];

        return view('cart', $data);
    }

    public function delete($id)
    {
        if (sizeof(session()->get('cart_session')) > 0) {
            foreach (session()->get('cart_session') as $value) :
                if ($value['id'] == $id) {
                    $tempCartSession = session()->get('cart_session');
                    $index = array_search($value, $tempCartSession);
                    array_splice($tempCartSession, $index, 1);
                    session()->set('cart_session', $tempCartSession);
                    break;
                }
            endforeach;
        }

        return redirect()->to('cart');
    }
}

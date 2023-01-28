<?php

namespace App\Controllers;

use App\Models\BookModel;

class Home extends BaseController
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



        return view('home', $data);
    }

    public function addToCart($code, $title, $img)
    {
        if ($this->request->getVar('qty') < 1) {
            return redirect()->to('');
        }

        $cartData = [
            "code" => $code,
            "title" => $title,
            "img" => $img,
            "qty" => $this->request->getVar('qty')

        ];

        $tempCartDatas = [$cartData];

        if (session()->get("cart_session") != null & sizeof(session()->get("cart_session")) > 0) {
            $tempCartDatas = session()->get("cart_session");
            $index = null;

            foreach ($tempCartDatas as $value) :
                if (sizeof($value) > 0 && $value["code"] == $cartData["code"]) {
                    $index = array_search($value, $tempCartDatas);
                    $oldQty = $tempCartDatas[$index]['qty'];
                    $newQty = $oldQty + $cartData['qty'];
                    $cartData['qty'] = $newQty;
                }
            endforeach;

            if ($index != null) {
                $tempCartDatas[$index] = $cartData;
            } else {
                array_push($tempCartDatas, $cartData);
            }
        }

        session()->set("cart_session", $tempCartDatas);

        return redirect()->to('');
    }
}

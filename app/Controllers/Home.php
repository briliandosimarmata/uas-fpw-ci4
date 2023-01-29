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

        $keyword = false;

        if (sizeof($this->request->getGet()) > 0) {
            $keyword = $this->request->getGet('title');
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
            'books' => $this->bookModel->getAll($keyword),
            'totalQtyCartItem' => $totalQtyCartItem
        ];



        return view('home', $data);
    }

    public function addToCart($id, $title, $img, $author, $publisher, $price, $typeId)
    {
        if ($this->request->getVar('qty') < 1) {
            return redirect()->to('');
        }

        $cartData = [
            "id" => $id,
            "title" => $title,
            "img" => $img,
            "author" => $author,
            "publisher" => $publisher,
            "price" => $this->request->getVar('qty') * $price,
            "qty" => $this->request->getVar('qty'),
            "typeId" => $typeId
        ];

        $tempCartDatas = [$cartData];

        if (session()->get("cart_session") != null & sizeof(session()->get("cart_session")) > 0) {
            $tempCartDatas = session()->get("cart_session");
            $index = null;

            foreach ($tempCartDatas as $value) :
                if (sizeof($value) > 0 && $value["id"] == $cartData["id"]) {
                    $index = array_search($value, $tempCartDatas);
                    $oldQty = $tempCartDatas[$index]['qty'];
                    $newQty = $oldQty + $cartData['qty'];
                    $cartData['qty'] = $newQty;
                    $cartData['price'] = $newQty * $price;
                    break;
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

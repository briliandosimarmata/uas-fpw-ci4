<?php

namespace App\Controllers;

use App\Models\BookTypeModel;
use App\Models\InvoiceDetailModel;
use App\Models\InvoiceModel;
use Faker\Provider\Uuid;

class Invoice extends BaseController
{
    protected $invoiceModel;
    protected $invoiceDetailModel;
    protected $discount;
    protected $bookTypeModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
        $this->invoiceDetailModel = new InvoiceDetailModel();
        $this->discount = new Discount();
        $this->bookTypeModel = new BookTypeModel();
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

        $arrCartItems = $this->request->getVar();

        $invoiceDetails = [];

        $totalInvQty = 0;
        $totalInvPrice = 0;
        $totalInvDisc = 0;
        $totalInvFinalPrice = 0;

        foreach ($arrCartItems as $items) {
            $v = json_decode($items, true);
            $unitPrice = $v['price'] / $v['qty'];

            $discountRate = doubleval($this->discount->getBookDiscountRate($v['id']));
            $discountValue = $unitPrice * $discountRate / 100;
            $totalDiscountValue = $discountValue * $v['qty'];

            $bonusDiscountRate = doubleval($this->bookTypeModel->find($v['typeId'])['type_disc_rate']);
            $bonusDiscountValue = $unitPrice * $bonusDiscountRate / 100;
            $totalBonusDiscountValue = $bonusDiscountValue * $v['qty'];

            $totalPriceAfterDiscount = $v['price'] - $totalDiscountValue - $totalBonusDiscountValue;

            $detailData = [
                "book_id" => $v['id'],
                "book_title" => $v['title'],
                "book_qty" => $v['qty'],
                "book_price" => $v['price'],
                "book_disc_val" => $totalDiscountValue,
                "book_disc_rate" => $discountRate,
                "book_type_disc_val" => $totalBonusDiscountValue,
                "book_type_disc_rate" => $bonusDiscountRate,
                "book_price_aftr_disc" => $totalPriceAfterDiscount,
                "unit_price" => $unitPrice
            ];

            array_push($invoiceDetails, $detailData);

            $totalInvQty = $totalInvQty + $v['qty'];
            $totalInvPrice = $totalInvPrice + $v['price'];
            $totalInvDisc = $totalInvDisc + $totalDiscountValue + $totalBonusDiscountValue;
        }

        $totalInvFinalPrice = $totalInvPrice - $totalInvDisc;

        $invoiceHeader = [
            "total_qty" => $totalInvQty,
            "total_prc" => $totalInvPrice,
            "total_disc_val" => $totalInvDisc,
            "total_prc_aftr_disc" => $totalInvFinalPrice
        ];

        $data = [
            'title' => 'Invoice',
            'totalQtyCartItem' => $totalQtyCartItem,
            'invoiceHeader' => $invoiceHeader,
            'invoiceDetails' => $invoiceDetails
        ];

        return view('invoice', $data);
    }

    public function browse()
    {
        $totalQtyCartItem = 0;
        if (sizeof(session()->get('cart_session')) > 0) {
            foreach (session()->get('cart_session') as $value) :
                if (sizeof($value) > 0)
                    $totalQtyCartItem = $totalQtyCartItem + intval($value['qty']);
            endforeach;
        }

        $data = [
            'title' => 'Browse Invoice',
            'totalQtyCartItem' => $totalQtyCartItem,
            'cartItems' => session()->get('cart_session')
        ];

        return view('invoice-browse', $data);
    }

    public function save()
    {

        $fromCart = $this->request->getVar();

        $trx_date = date("Y-m-d");
        $trx_hours = date("h:i:s");

        $id = Uuid::uuid();

        $headerData = [
            "id" => $id,
            "trx_number" => $fromCart['trxNumber'],
            "trx_date" => $trx_date,
            "trx_hours" => $trx_hours,
            "customer_id" => $fromCart['customerId'],
            "total_qty" => $fromCart['qty'],
            "total_prc" => $fromCart['harga'],
            "total_disc_val" => $fromCart['diskon'],
            "total_prc_aftr_disc" => $fromCart['hargaKes']
        ];

        if ($this->invoiceModel->save($headerData)) {
            $details = json_decode($fromCart['invoiceDetails'], true);
            foreach ($details as $detail) {
                $tempDetail = $detail;
                $tempDetail['id'] = Uuid::uuid();
                $tempDetail['invoice_id'] = $id;
                $this->invoiceDetailModel->save($tempDetail);
            }
        }

        $newSession = session()->get('cart_session');

        if (sizeof($newSession) > 0) {
            $index = 0;
            foreach ($newSession as $value) :
                if (sizeof($value) > 0) {
                    $details = json_decode($fromCart['invoiceDetails'], true);
                    foreach ($details as $detail) {
                        if ($tempDetail['book_id'] == $value['id']) {
                            array_splice($newSession, $index, 1);
                        }
                    }
                }
                $index++;
            endforeach;
        }

        session()->remove('cart_session');
        session()->set('cart_session', $newSession);

        return redirect()->to('cart');
    }
}

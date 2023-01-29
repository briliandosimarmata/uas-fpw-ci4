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
            "customer_id" => "82e1766d-9fc4-11ed-8738-009337e10b18",
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

        return redirect()->to('cart');
    }
}

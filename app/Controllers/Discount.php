<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\DiscountModel;

class Discount extends BaseController
{
    protected $discountModel;

    public function __construct()
    {
        $this->discountModel = new DiscountModel();
    }

    public function countTotalBookDiscount($id, $qty, $price)
    {
        $discountMdl =  $this->discountModel->getByDiscountByBookId($id);
        $discountValue = 0;
        $unitPrice = $price / $qty;

        if ($discountMdl != null) {
            $discountValue = doubleval($discountMdl['disc_rate']) / 100 * $unitPrice * $qty;
        }

        $arrResponse = [$id => $discountValue];

        return $this->response->setJSON($arrResponse);
    }

    public function getBookDiscountRate($id)
    {
        $discountMdl =  $this->discountModel->getByDiscountByBookId($id);
        if ($discountMdl != null) {
            return doubleval($discountMdl['disc_rate']);
        }

        return 0.00;
    }
}

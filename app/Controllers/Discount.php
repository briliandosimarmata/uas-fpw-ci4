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
            $discountValue = $discountMdl['disc_rate'] / 100 * $unitPrice * $qty;
        }

        $arrResponse = [$id => $discountValue];

        // dd($arrResponse);

        return $this->response->setJSON($arrResponse);
    }
}

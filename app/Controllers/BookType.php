<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BookTypeModel;
use App\Models\DiscountModel;

class BookType extends BaseController
{
    protected $bookTypeModel;

    public function __construct()
    {
        $this->bookTypeModel = new BookTypeModel();
    }

    public function index()
    {
        echo "";
    }
}

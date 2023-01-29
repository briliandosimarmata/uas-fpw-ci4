<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceDetailModel extends Model
{
    protected $table = 'invoiceDetail';
    protected $useTimestamps = true;
    protected $allowedFields = ["invoice_id", "book_id", "book_qty", "book_price", "book_disc_val", "book_disc_rate", "book_type_disc_val", "book_type_disc_rate", "book_price_aftr_disc"];
    protected $useAutoIncrement = false;
}

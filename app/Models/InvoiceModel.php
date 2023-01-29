<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $useTimestamps = true;
    protected $allowedFields = ["trx_number", "trx_date", "trx_hours", "customer_id", "total_qty", "total_prc", "total_disc_val", "total_prc_aftr_disc"];
    protected $useAutoIncrement = false;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $useTimestamps = true;

    public function getByDiscountByBookId($id)
    {
        return $this->where(['book_id' => $id])->first();
    }
}

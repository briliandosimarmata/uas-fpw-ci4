<?php

namespace App\Models;

use CodeIgniter\Model;

class DiscountModel extends Model
{
    protected $table = 'discount';
    protected $useTimestamps = true;

    public function getByDiscountByBookId($id)
    {
        return $this->where(['book_id' => $id])->first();
    }
}

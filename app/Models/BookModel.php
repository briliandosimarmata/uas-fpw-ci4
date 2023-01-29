<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'book';
    protected $useTimestamps = true;

    public function getByBookCode($code)
    {
        return $this->where(['book_code' => $code])->first();
    }

    public function getAll($keyword = false)
    {
        $syntax = "select a.id, a.book_code, a.book_title, a.book_author, a.book_type_id, \n
                        b.type_name, a.book_publisher, a.book_img, c.unit_price_value, \n
                        d.physical_qty - d.sold_qty as qty \n
                    from book a inner join bookType b on b.id = a.book_type_id \n
                                inner join price c on c.book_id = a.id \n
                                inner join bookBalance d on d.book_id = a.id \n
                    where 1=1 \n";

        if ($keyword != false) {
            $syntax .= "and TRIM(LOWER(a.book_title)) like TRIM(LOWER('%" . $keyword . "%'" . ")) \n";
        }

        $query = $this->db->query($syntax);

        return $query->getResultArray();
    }
}

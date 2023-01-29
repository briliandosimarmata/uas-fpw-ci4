<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $useTimestamps = true;

    public function getAll($keyword = false)
    {
        $syntax = "select * from customer where 1=1 \n";

        if ($keyword != false) {
            $syntax .= "and TRIM(LOWER(a.customer_name)) like TRIM(LOWER('%" . $keyword . "%'" . ")) \n";
        }

        $query = $this->db->query($syntax);

        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $useTimestamps = true;
    protected $allowedFields = ["trx_number", "trx_date", "trx_hours", "customer_id", "total_qty", "total_prc", "total_disc_val", "total_prc_aftr_disc"];
    protected $useAutoIncrement = false;

    public function getBrowseData($customerCode = false)
    {
        $syntax = "SELECT a.* FROM invoice a
                        inner join customer b on b.id = a.customer_id
                    WHERE b.customer_code = '" . $customerCode . "' ";

        if ($customerCode != false) {
            $query = $this->db->query($syntax);
            return $query->getResultArray();
        }

        return [];
    }
}

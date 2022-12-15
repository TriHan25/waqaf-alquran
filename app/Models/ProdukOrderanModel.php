<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukOrderanModel extends Model
{
    protected $table      = 'produk_orderan';
    protected $useTimestamps = true;
    protected $allowedFields = ['no_orderan', 'id_produk', 'jumlah'];

    public function getId($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}

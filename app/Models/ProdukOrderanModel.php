<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukOrderanModel extends Model
{
    protected $table      = 'produk_orderan';
    protected $useTimestamps = true;
    protected $allowedFields = ['no_orderan', 'id_produk', 'jumlah'];

    public function getNo($no_orderan = false)
    {
        if ($no_orderan == false) {
            return $this->findAll();
        }

        return $this->where(['no_orderan' => $no_orderan])->findAll();
    }

    public function getJoinPO($no_orderan = false)
    {
        if ($no_orderan == false) {
            return $this->findAll();
        }

        return $this->select('produk_orderan.id_produk, produk_orderan.jumlah, produk.nama, produk.harga, produk.img, orderan.total_harga')->join('produk', 'produk.id = produk_orderan.id_produk')->join('orderan', 'orderan.no_orderan = produk_orderan.no_orderan')->where(['produk_orderan.no_orderan' => $no_orderan])->findAll();
    }
}

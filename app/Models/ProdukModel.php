<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'kategori', 'harga', 'img', 'deskripsi'];


    public function getProduk($kategori = false)
    {
        if ($kategori == false) {
            return $this->findAll();
        }

        return $this->where(['kategori' => $kategori])->first();
    }

    public function getSlug($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getId($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}

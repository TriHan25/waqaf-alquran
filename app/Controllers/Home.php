<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    protected $produkModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => "Waqaf Alquran",
            'produk' => $this->produkModel->getProduk()
        ];

        return view('home', $data);
    }
}

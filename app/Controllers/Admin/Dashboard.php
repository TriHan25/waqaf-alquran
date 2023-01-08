<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\ProdukModel;
use App\Models\OrderanModel;

class Dashboard extends BaseController
{
    protected $produkModel;
    protected $orderanModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->orderanModel = new OrderanModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'produk_jum' => $this->produkModel->countAllResults(),
            'orderan_jum' => $this->orderanModel->countAllResults()
        ];

        return view('admin/home', $data);
    }
}

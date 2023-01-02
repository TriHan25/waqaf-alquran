<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\ProdukOrderanModel;
use App\Models\OrderanModel;
use App\Models\TestModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $orderanModel;
    protected $testModel;
    protected $poModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->orderanModel = new OrderanModel();
        $this->testModel = new TestModel();
        $this->poModel = new ProdukOrderanModel();
    }

    public function index()
    {
        // $test = $this->testModel->paginate(10);

        // d($test);
        $resi = $this->orderanModel->getOrderan();
        // $resi2 = $this->orderanModel->where('nama_pemesan', 'Akbar')->paginate(1);
        $data = [
            'title' => "Waqaf Alquran",
            'produk' => $this->produkModel->getProduk(),
            'produk2' => $this->poModel->paginate(2),
            'resi' => $this->orderanModel->getOrderan(),
            // 'test' => $test,
            'pager' => $this->poModel->pager
        ];

        return view('home', $data);
    }
}

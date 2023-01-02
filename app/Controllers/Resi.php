<?php

namespace App\Controllers;

use App\Models\ProdukOrderanModel;
use App\Models\OrderanModel;

class Resi extends BaseController
{
    protected $poModel;
    protected $ordeeranModel;
    public function __construct()
    {
        $this->poModel = new ProdukOrderanModel();
        $this->orderanModel = new OrderanModel();
    }

    public function index()
    {
        $data = [
            'title' => "Waqaf Alquran",
            'produk2' => $this->poModel->paginate(2),
            'resi' => $this->orderanModel->getOrderan(),
            'pager' => $this->poModel->pager
        ];

        return view('pages/resi', $data);
    }
}

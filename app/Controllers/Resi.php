<?php

namespace App\Controllers;

use App\Models\ProdukOrderanModel;
use App\Models\OrderanModel;

class Resi extends BaseController
{
    protected $poModel;
    protected $orderanModel;
    public function __construct()
    {
        $this->poModel = new ProdukOrderanModel();
        $this->orderanModel = new OrderanModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_orderan') ? $this->request->getVar('page_orderan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orderan = $this->orderanModel->search($keyword);
        } else {
            $orderan = $this->orderanModel;
        }
        $data = [
            'title' => "Waqaf Alquran",
            'orderan' => $orderan->paginate(2, 'orderan'),
            // 'resi' => $this->orderanModel->getOrderan(),
            'pager' => $this->orderanModel->pager,
            'currentPage' => $currentPage
        ];

        return view('pages/resi', $data);
    }
}

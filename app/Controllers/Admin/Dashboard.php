<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin'
        ];

        echo view('layout/header', $data);
        echo view('admin/home', $data);
        echo view('layout/header');
    }
}

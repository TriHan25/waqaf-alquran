<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Register extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Form Register',
        ];

        return view('admin/register', $data);
    }
}

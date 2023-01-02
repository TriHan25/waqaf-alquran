<?php

namespace App\Models;

use CodeIgniter\Model;

class testModel extends Model
{
    protected $table      = 'tbl_dokter';
    protected $useTimestamps = true;
    protected $allowedFields = ['tanggal_lahir', 'status'];
}

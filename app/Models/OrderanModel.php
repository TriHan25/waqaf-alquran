<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderanModel extends Model
{
    protected $table      = 'orderan';
    protected $useTimestamps = true;
    protected $allowedFields = ['no_orderan', 'nama_pemesan', 'nomor_pemesan', 'status_pengerjaan', 'status_pembayaran', 'total_harga'];


    public function getOrderan($pengerjaan = false)
    {
        if ($pengerjaan == false) {
            if ($this->findAll() === null) {
                return false;
            }
            return $this->findAll();
        }

        return $this->where(['status_pengerjaan' => $pengerjaan])->findAll();
    }

    public function getNo($no_orderan = false)
    {
        if ($no_orderan == false) {
            return $this->findAll();
        }

        return $this->where(['no_orderan' => $no_orderan])->first();
    }

    public function getStatusB($status = false)
    {
        if ($status == false) {
            return false;
        }

        return $this->where(['status_pembayaran' => $status])->findAll();
    }

    public function getStatusP($status = false)
    {
        if ($status == false) {
            return false;
        }

        return $this->where(['status_pengerjaan' => $status])->findAll();
    }

    public function getStatusBP($statusB = false, $statusP = false)
    {
        if ($statusB == false && $statusP == false) {
            return false;
        }

        return $this->where(['status_pengerjaan' => $statusP, 'status_pembayaran' => $statusB])->findAll();
    }

    public function getSearch($search = false)
    {
        if ($search == false) {
            return false;
        }

        return $this->like(['no_orderan' => $search])->findAll();
    }
}

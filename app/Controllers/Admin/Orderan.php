<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Database\Migrations\Produk;
use App\Models\OrderanModel;
use App\Models\ProdukModel;
use App\Models\ProdukOrderanModel;

class Orderan extends BaseController
{
    protected $orderanModel;
    protected $produkModel;
    protected $produkOrderanModel;
    public function __construct()
    {
        $this->orderanModel = new OrderanModel();
        $this->produkModel = new ProdukModel();
        $this->produkOrderanModel = new ProdukOrderanModel();
    }

    public function index()
    {
        // $con = new ProdukModel();
        // dd($this->orderanModel->getOrderan());
        $data = [
            'title' => 'Kelola Data Orderan',
            'orderan' => $this->orderanModel->getOrderan()
        ];


        // // cara konek db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM produk");
        // dd($komik);
        // foreach ($komik->getResultArray() as $row) {
        // d($row);
        // }

        return view('admin/orderan', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Orderan',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getProduk()
        ];

        return view('admin/createOrderan', $data);
    }

    public function konfirmasi()
    {
        // session();
        $konfirmasi = $this->request->getVar();
        // dd($konfirmasi);

        if (!$this->validate([
            'nama' => [
                'rules' => 'required[orderan.nama]',
                'errors' => [
                    'required' => '{field} pemesan harus diisi'
                ]
            ],
            'nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} telepon harus diisi'
                ]
            ],
            'status_p' => [
                'rules' => "required",
                'errors' => [
                    'required' => '{field} status harus diisi'
                ]
            ],
            'status_b' => [
                'rules' => "required",
                'errors' => [
                    'required' => 'status bayar harus diisi'
                ]
            ],
            'pilihan' => [
                'rules' => "required",
                'errors' => [
                    'required' => '{field} pilihan harus diisi'
                ]
            ],
            'jumlah' => [
                'rules' => "required",
                'errors' => [
                    'required' => '{field} jumlah harus diisi'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // session()->setFlashdata('not_validate', 'Judul harus unik dan field tidak boleh kosong');
            // return redirect()->to('/produk/create')->withInput()->with('validation', $validation);
            return redirect()->to('/orderan/create')->withInput();
        }


        // Total Harga
        $id_produk = $konfirmasi['pilihan'];
        $harga = (int)'';

        foreach ($id_produk as $k => $i) {
            $jumlah = $konfirmasi['jumlah'][$k];
            $get_produk = $this->produkModel->getId($i);
            $harga_produk = (int)$get_produk['harga'] * $jumlah;
            $harga += $harga_produk;
        }

        // Nama produk pilihan
        $nama_produk = [];
        foreach ($id_produk as $k => $i) {
            $get_produk = $this->produkModel->getId($i);
            $nama = $get_produk['nama'];
            $nama_produk[] = $nama;
        }

        if ($konfirmasi === null) {
            $data = [
                'title' => 'Form Konfirmasi Orderan',
                'konfirmasi' => null,
                'validation' => \Config\Services::validation(),
                'produk' => $this->produkModel->getProduk()
            ];
        }
        $data = [
            'title' => 'Form Konfirmasi Orderan',
            'konfirmasi' => $konfirmasi,
            'harga' => $harga,
            'nama_produk' => $nama_produk,
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getId()
        ];

        return view('admin/konfirmasiOrderan', $data);
    }

    public function save()
    {
        // save ke tabel orderan 
        $this->orderanModel->save([
            'no_orderan' => $this->request->getVar('no_orderan'),
            'nama_pemesan' => $this->request->getVar('nama'),
            'nomor_pemesan' => $this->request->getVar('nomor'),
            'status_pengerjaan' => $this->request->getVar('status_p'),
            'status_pembayaran' => $this->request->getVar('status_b'),
            'total_harga' => $this->request->getVar('harga'),
        ]);

        // save ke tabel produk orderan 
        $konfirmasi = $this->request->getVar();
        $no_orderan = $this->request->getVar('no_orderan');
        $id_produk = $this->request->getVar('pilihan');
        foreach ($id_produk as $k => $i) {
            $jumlah = $konfirmasi['jumlah'][$k];
            $this->produkOrderanModel->save([
                "no_orderan" => $no_orderan,
                "id_produk" => $i,
                "jumlah" => $jumlah
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/orderan');
    }

    public function delete($id)
    {
        $this->orderanModel->delete($id);
        session()->setFlashdata('delete', 'data berhasil dihapus');
        return redirect()->to('/orderan');
    }

    public function edit($no_orderan)
    {
        $data = [
            'title' => 'Form Ubah Produk',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getProduk(),
            'orderan' => $this->orderanModel->getNo($no_orderan),
            'produk_orderan' => $this->produkOrderanModel->getJoinPO($no_orderan)
        ];

        d($this->produkModel->getProduk());
        d($this->orderanModel->getNo($no_orderan));
        d($this->produkOrderanModel->getJoinPO($no_orderan));

        return view('admin/editOrderan', $data);
    }

    public function konfirmasi_edit($no_orderan)
    {
        // session();
        $konfirmasi = $this->request->getVar();
        d($konfirmasi);

        // if (!$this->validate([
        //     'nama_pemesan' => [
        //         'rules' => 'required[orderan.nama_pemesan]',
        //         'errors' => [
        //             'required' => 'nama pemesan harus diisi'
        //         ]
        //     ],
        //     'nomor_pemesan' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'nomor pemesan harus diisi'
        //         ]
        //     ],
        //     'status_pembayaran' => [
        //         'rules' => "required",
        //         'errors' => [
        //             'required' => 'status pembayaran harus diisi'
        //         ]
        //     ],
        //     'produk[]' => [
        //         'rules' => "required",
        //         'errors' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],
        //     'jumlah[]' => [
        //         'rules' => "required|integer",
        //         'errors' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ]
        // ])) {
        //     // $validation = \Config\Services::validation();
        //     // session()->setFlashdata('not_validate', 'Judul harus unik dan field tidak boleh kosong');
        //     // return redirect()->to('/produk/create')->withInput()->with('validation', $validation);
        //     return redirect()->to('/orderan/edit/' . $no_orderan)->withInput();
        // }


        // Total Harga
        $id_produk = $konfirmasi['produk'];
        $harga = (int)'';

        d($id_produk);

        foreach ($id_produk as $k => $i) {
            $jumlah = $konfirmasi['jumlah'][$k];
            $get_produk = $this->produkModel->getId($i);
            $harga_produk = (int)$get_produk['harga'] * $jumlah;
            $harga += $harga_produk;
        }
        d($harga);


        // Nama produk pilihan
        $nama_produk = [];
        foreach ($id_produk as $k => $i) {
            $get_produk = $this->produkModel->getId($i);
            $nama = $get_produk['nama'];
            $nama_produk[] = $nama;
        }
        d($nama_produk);



        if ($konfirmasi === null) {
            $data = [
                'title' => 'Form Konfirmasi Orderan',
                'konfirmasi' => null,
                'validation' => \Config\Services::validation(),
                'produk' => $this->produkModel->getProduk()
            ];
        }
        $data = [
            'title' => 'Form Konfirmasi Orderan',
            'konfirmasi' => $konfirmasi,
            'harga' => $harga,
            'nama_produk' => $nama_produk,
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getId()
        ];

        return view('admin/konfirmasiEditOrderan', $data);
    }

    public function update($id)
    {
        $this->orderanModel->save([
            'id' => $id,
            // 'no_orderan' => $this->request->getVar('no_orderan'),
            'nama_pemesan' => $this->request->getVar('nama_pemesan'),
            'nomor_pemesan' => $this->request->getVar('nomor_pemesan'),
            'status_pembayaran' => $this->request->getVar('status_pembayaran'),
            'total_harga' => $this->request->getVar('harga'),
        ]);

        // save ke tabel produk orderan 
        $konfirmasi = $this->request->getVar();
        $no_orderan = $this->request->getVar('no_orderan');
        $id_PO = $this->produkOrderanModel->getNo($no_orderan);

        foreach ($id_PO as $k => $i) {
            $jumlah = $konfirmasi['jumlah'][$k];
            $this->produkOrderanModel->save([
                "id" => $i['id'],
                "no_orderan" => $no_orderan,
                "id_produk" => $i['id_produk'],
                "jumlah" => $jumlah
            ]);
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');

        return redirect()->to('/orderan');
    }

    public function detail($no_orderan)
    {
        $produk = $this->produkOrderanModel->getJoinPO($no_orderan);
        $orderan = $this->orderanModel->getNo($no_orderan);

        $data = [
            'title' => 'Detail Produk',
            'validation' => \Config\Services::validation(),
            'orderan' => $orderan,
            'produk' => $produk
        ];

        // dd($data);

        return view('admin/detailOrderan', $data);
    }
}

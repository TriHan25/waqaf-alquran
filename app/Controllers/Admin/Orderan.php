<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

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
        d($konfirmasi);

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

        d($harga);
        d($nama_produk);


        if (!$this->validate([
            'nama' => [
                'rules' => 'required[orderan.nama]',
                'errors' => [
                    'required' => '{field} orderan harus diisi'
                ]
            ],
            'nomor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nomor harus diisi'
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
                    'required' => '{field} status harus diisi'
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
        dd($this->request->getVar());
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
        // cari gambar berdaasar id
        $namaProduk = $this->produkModel->find($id);
        // cek gambar default
        if ($namaProduk['img'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $namaProduk['img']);
        }

        $this->produkModel->delete($id);
        session()->setFlashdata('delete', 'data berhasil dihapus');
        return redirect()->to('/produk');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Produk',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getSlug($slug)
        ];

        return view('admin/editProduk', $data);
    }

    public function update($id)
    {
        $produkLama = $this->produkModel->getSlug($this->request->getVar('slug'));
        if ($produkLama['nama'] == $this->request->getVar('nama')) {
            $rule_nama = 'required';
        } else {
            $rule_nama = 'required|is_unique[produk.nama]';
        }

        //validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => $rule_nama,
                'errors' => [
                    'required' => '{field} produk harus diisi',
                    'is_unique' => '{field} produk sudah ada'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} produk harus diisi'
                ]
            ],
            'harga' => [
                'rules' => "required",
                'errors' => [
                    'required' => '{field} produk harus diisi'
                ]
            ],
            'deskripsi' => [
                'rules' => "required",
                'errors' => [
                    'required' => '{field} produk harus diisi'
                ]
            ],
            'img' => [
                'rules' => 'max_size[img,2048]|is_image[img]|mime_in[img,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // session()->setFlashdata('not_validate', 'Judul harus unik dan field tidak boleh kosong');
            // return redirect()->to('/produk/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            return redirect()->to('/produk/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileImg = $this->request->getFile('img');

        // cek gambar, apakah gambar lama
        if ($fileImg->getError() == 4) {
            $namaImg = $this->request->getVar('imgLama');
        } else {
            // generate nama random
            $namaImg = $fileImg->getRandomName();
            // pindah file
            $fileImg->move('img', $namaImg);
            // hapus file lama
            unlink('img/' . $this->request->getVar('imgLama'));
        }



        $slug = url_title($this->request->getVar('nama'), '-', true);

        $this->produkModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'slug' => $slug,
            'kategori' => $this->request->getVar('kategori'),
            'harga' => $this->request->getVar('harga'),
            'img' => $namaImg
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah.');

        return redirect()->to('/produk');
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Produk',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->getSlug($slug)
        ];

        // dd($data);

        return view('admin/detailProduk', $data);
    }
}

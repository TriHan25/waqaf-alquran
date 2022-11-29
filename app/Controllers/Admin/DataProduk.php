<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\ProdukModel;

class DataProduk extends BaseController
{
    protected $produkModel;
    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        // $con = new ProdukModel();
        $data = [
            'title' => 'Kelola Data',
            'produk' => $this->produkModel->getProduk()
        ];

        // // cara konek db tanpa model
        // $db = \Config\Database::connect();
        // $komik = $db->query("SELECT * FROM produk");
        // dd($komik);
        // foreach ($komik->getResultArray() as $row) {
        // d($row);
        // }

        return view('admin/dataProduk', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Produk',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/createProduk', $data);
    }

    public function save()
    {
        // ngambil satu-satu
        // dd($this->request->getVar('judul'));

        // ngambil semua
        // dd($this->request->getVar());

        //validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[produk.nama]',
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
            // return redirect()->to('/produk/create')->withInput()->with('validation', $validation);
            return redirect()->to('/produk/create')->withInput();
        }

        // ambil gambar
        $fileImg = $this->request->getFile('img');
        // apakah ada gambar yabg diupload
        if ($fileImg->getError() == 4) {
            $namaImg = 'default.png';
        } else {
            // generete nama Img (opsional)
            // $namaImg = $fileImg->getRandomName();
            // ambil nama file
            $namaImg = $fileImg->getName();
            // pindah file ke folder img
            $fileImg->move('img', $namaImg);
        }


        $slug = url_title($this->request->getVar('nama'), '-', true);

        $this->produkModel->save([
            'nama' => $this->request->getVar('nama'),
            'kategori' => $this->request->getVar('kategori'),
            'slug' => $slug,
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaImg
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan.');

        return redirect()->to('/produk');
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

<?php
namespace App\Controllers;

use \App\Models\BarangModel;
use \App\Models\CatBarangModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class Barang extends BaseController
{
    private $barangModel,$catbarModel;
    public function __construct()
    {
        $this->barangModel = new barangModel();

        $this->catbarModel = new CatBarangModel();
    }

    public function index()
    {
        $dataBarang = $this->barangModel->getBarang();
        $data = 
        [
            'title' => 'Data Barang',
            'result' => $dataBarang
        ];
        return view('barang/index', $data);
    }

    public function detail($slug)
    {
        $dataBarang = $this->barangModel->getBarang($slug);
        $data = 
        [
            'title' => 'Detail Barang',
            'result' => $dataBarang
        ];
        return view('barang/detail', $data);
    }

    public function create()
    {
        session();
        $data = 
        [
            'title' => 'Tambah Barang',
            'category' => $this->catbarModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('barang/create', $data);
    }

    public function save()
    {
        //  Validasi Input
        if (!$this->validate([
            'nama' =>  [
                'rules' => 'required|is_unique[barang.nama]',
                'label' => 'Nama',
                'errors' => 
                [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'harga' => 'required|numeric',
            'stok' => 
            [
                'rules' => 'required|integer',
                'errors' => 
                [
                    'required' => '{field} harus diisi,',
                    'integer' => '{field} hanya boleh angka'
                ]
            ],
            'sampul' =>
            [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => 
                [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in' => 'Yang anda pilih bukan gambar!',
                ]
            ],

        ])) {
            return redirect()->to('/barang/create')->withInput();
        }

        // Mengambil File Sampul
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4)
         {
            $namaFile = $this->defaultImage;
        } else {
            // Generate Nama File
            $namaFile = $fileSampul->getRandomName();
            //Pindahkan File ke Folder img di public
            $fileSampul->move('img', $namaFile);
        }
        //buat save data
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->barangModel->save([
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'barang_category_id' => $this->request->getVar('barang_category_id'),
            'slug' => $slug,
            'gambar' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan");
        return redirect()->to('/barang');
    }

    public function edit($slug)
    {
        $dataBarang = $this->barangModel->getBarang($slug);
        if (empty($dataBarang)) 
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Nama Barang $slug
            tidak ditemukan!");
        }

        $data = 
        [
            'title' => 'Ubah Barang',
            'category' => $this->catbarModel->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataBarang
        ];
        return view('barang/edit', $data);
    }

    public function update($id)
    {
        //Cek Judul
        $dataOld = $this->barangModel->getBarang($this->request->getVar('slug'));
        if ($dataOld['nama'] == $this->request->getVar('nama')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[barang.nama]';
        }
        //Validasi Data
        if (!$this->validate([
            'nama' => 
            [
                'rules' => $rule_title,
                'label' => 'Nama',
                'errors' => 
                [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'harga' => 'required|numeric',
            'stok' => 
            [
                'rules' => 'required|integer',
                'errors' => 
                [
                    'required' => '{field} harus diisi,',
                    'integer' => '{field} hanya boleh angka'
                ]
            ],
        ])) {
            return redirect()->to('/barang/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $namaFileLama = $this->request->getVar('sampullama');
        // Mengambil File Sampul
        $fileSampul = $this->request->getFile('sampul');
        // Cek gambar, apakah masih gambar lama
        if ($fileSampul->getError() == 4) {
            $namaFile = $namaFileLama;
        } else {
            // Generate Nama File
            $namaFile = $fileSampul->getRandomName();
            // Pindahkan File ke Folder img di public
            $fileSampul->move('img', $namaFile);
            // Jika sampulnya default
            if ($namaFileLama != $this->defaultImage && $namaFileLama != "") 
            {
                // Hapus Gambar
                unlink('img/' . $namaFileLama);
            }
        }
        // Membuat string menjadi huruf kecil semua dan spasinya diganti -
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->barangModel->save([
            'id_barang' => $id,
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
            'barang_category_id' => $this->request->getVar('barang_category_id'),
            'slug' => $slug,
            'gambar' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/barang');
    }

    public function delete($id)
    {
        $dataBarang = $this->barangModel->find($id);
        $this->barangModel->delete($id);

        // Jika sampulnya default
        if ($dataBarang['gambar'] != $this->defaultImage) {
            // Hapus gambar
            unlink('img/' . $dataBarang['gambar']);
        }

        session()->setFlashdata("msg", "Data berhasil dihapus!");
        return redirect()->to('/barang');
    }
}
<?php
namespace App\Controllers;

use \App\Models\LayananModel;
use \App\Models\CatLayananModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class Layanan extends BaseController
{
    private $layananModel,$catlayModel;
    public function __construct()
    {
        $this->layananModel = new LayananModel();

        $this->catlayModel = new CatLayananModel();
    }

    public function index()
    {
        $dataLayanan = $this->layananModel->getLayanan();
        $data = 
        [
            'title' => 'Data Layanan',
            'result' => $dataLayanan
        ];
        return view('layanan/index', $data);
    }

    public function detail($slug)
    {
        $dataLayanan = $this->layananModel->getLayanan($slug);
        $data = 
        [
            'title' => 'Detail Layanan',
            'result' => $dataLayanan
        ];
        return view('layanan/detail', $data);
    }

    public function create()
    {
        session();
        $data = 
        [
            'title' => 'Tambah Layanan',
            'category' => $this->catlayModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('layanan/create', $data);
    }

    public function save()
    {
        //  Validasi Input
        if (!$this->validate([
            'nama' =>  [
                'rules' => 'required|is_unique[layanan.nama]',
                'label' => 'Nama',
                'errors' => 
                [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'harga' => 'required|numeric',
        ])) {
            return redirect()->to('/layanan/create')->withInput();
        }

        //buat save data
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->layananModel->save([
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'layanan_category_id' => $this->request->getVar('layanan_category_id'),
            'slug' => $slug
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan");
        return redirect()->to('/layanan');
    }

    public function edit($slug)
    {
        $dataLayanan = $this->layananModel->getLayanan($slug);
        if (empty($dataLayanan)) 
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Nama Layanan $slug
            tidak ditemukan!");
        }

        $data = 
        [
            'title' => 'Ubah Layanan',
            'category' => $this->catlayModel->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataLayanan
        ];
        return view('layanan/edit', $data);
    }

    public function update($id)
    {
        //Cek Judul
        $dataOld = $this->layananModel->getLayanan($this->request->getVar('slug'));
        if ($dataOld['nama'] == $this->request->getVar('nama')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[layanan.nama]';
        }
        //Validasi Data
        if (!$this->validate([
            'nama' => 
            [
                'rules' => $rule_title,
                'label' => 'title',
                'errors' => 
                [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'harga' => 'required|numeric',
        ])) {
            return redirect()->to('/layanan/edit/' . $this->request->getVar('slug'))->withInput();
        }
        // Membuat string menjadi huruf kecil semua dan spasinya diganti -
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $this->layananModel->save([
            'id_layanan' => $id,
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'layanan_category_id' => $this->request->getVar('layanan_category_id'),
            'slug' => $slug
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/layanan');
    }

    public function delete($id)
    {
        $dataLayanan = $this->layananModel->find($id);
        $this->layananModel->delete($id);
        session()->setFlashdata("msg", "Data berhasil dihapus!");
        return redirect()->to('/layanan');
    }

        
}
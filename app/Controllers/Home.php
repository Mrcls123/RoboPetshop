<?php

namespace App\Controllers;
use \App\Models\BerandaModel;

class Home extends BaseController
{
    private $berandaModel;
    public function __construct()
    {
        $this->berandaModel = new BerandaModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Beranda'
        ];
        return view('beranda', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }

    public function showChartTransaksi()
    {
        $tahun = $this->request->getVar('tahun');
        $reportTrans = $this->berandaModel->reportTransaksi($tahun);
        $response = [
            'status' => false,
            'data' => $reportTrans
        ];
        echo json_encode($response);
    }

    public function showChartCustomer()
    {
        $tahun = $this->request->getVar('tahun');
        $reportCust = $this->berandaModel->reportCustomer($tahun);
        $response = [
            'status' => false,
            'data' => $reportCust
        ];
        echo json_encode($response);
    }

    public function showChartPembelian()
    {
        $tahun = $this->request->getVar('tahun');
        $reportPemb = $this->berandaModel->reportPembelian($tahun);
        $response = [
            'status' => false,
            'data' => $reportPemb
        ];
        echo json_encode($response);
    }

    public function showChartSupplier()
    {
        $tahun = $this->request->getVar('tahun');
        $reportSupp = $this->berandaModel->reportSupplier($tahun);
        $response = [
            'status' => false,
            'data' => $reportSupp
        ];
        echo json_encode($response);
    }

    public function showChartLayanan()
    {
        $tahun = $this->request->getVar('tahun');
        $reportLay = $this->berandaModel->reportLayanan($tahun);
        $response = [
            'status' => false,
            'data' => $reportLay
        ];
        echo json_encode($response);
    }

    public function showChartPegawai()
    {
        $tahun = $this->request->getVar('tahun');
        $reportPeg = $this->berandaModel->reportPegawai($tahun);
        $response = [
            'status' => false,
            'data' => $reportPeg
        ];
        echo json_encode($response);
    }

}
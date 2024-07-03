<?php
namespace App\Controllers;
use \App\Models\BarangModel;
use \App\Models\CustomerModel;
use \App\Models\SaleModel;
use \App\Models\SaleDetailModel;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjualan extends BaseController
{
    private $barang, $cart, $cust, $sale, $saleDetail;
    public function __construct()
    {
        $this->barang= new BarangModel();
        $this->cust= new CustomerModel();
        $this->sale= new SaleModel();
        $this->saleDetail= new SaleDetailModel();
        $this->cart = \Config\Services::cart();
    }
    
    public function index()
    {
        $this->cart->destroy();
        $dataBarang= $this->barang->getBarang();
        $dataCust= $this->cust->findAll();
        $data=[
            'title' => 'Penjualan',
            'dataBarang' => $dataBarang,
            'dataCust' => $dataCust,
        ];
        return view('penjualan/list', $data);
    }

    public function addCart()
    {
        $this->cart->insert(array(
            'id' => $this->request->getVar('id'),
            'qty' => $this->request->getVar('qty'),
            'price' => $this->request->getVar('price'),
            'name' => $this->request->getVar('name'),
            ));
            echo $this->showCart();
    }

    public function showCart()
    {
        $output = '';
        $no = 1;
        foreach($this->cart->contents() as $items){
            $output .= '
            <tr>
            <td>' . $no++ . '</td>
            <td>' . $items['name'] . '</td>
            <td>' . $items['qty'] . '</td>
            <td>' . number_to_currency($items['price'], 'IDR', 'id_ID', 2) . '</td>
            <td>' . number_to_currency(($items['subtotal']), 'IDR', 'id_ID', 2) . '</td>
            <td>
            <button id="' . $items['rowid'] . '" qty="' . $items['qty'] . '" 
            class="ubah_cart btn btn-warning btn-xs" title="Ubah Jumlah"><i class="fa 
            fa-edit"></i></button>
            <button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn 
            btn-danger btn-xs"><i class="fa fa-trash" title="Hapus"></i></button>
            </td>
            </tr>
            ';
        }

        if(!$this->cart->contents())
        {
            $output = '<tr><td colspan ="7" align="center">Tidak ada transaksi!</td></tr>';
        }
        return $output;
    }
    public function loadCart()
    {
        //load data cart
        echo $this->showCart();
    }

    public function getTotal()
    {
        $totalBayar = 0;
        foreach ($this->cart->contents() as $items) {
            $totalBayar += $items['subtotal'];
        }
        echo number_to_currency($totalBayar, 'IDR', 'id_ID',  2);

    }

    public function updateCart()
    {
        $this->cart->update(array(
            'rowid' => $this->request->getVar('rowid'),
            'qty'   => $this->request->getVar('qty')
        ));
        echo $this->showCart();
    }

    public function deleteCart($rowid)
    {
        $this->cart->remove($rowid);
        echo $this->showCart();
    }

    public function pembayaran()
    {
        if(!$this->cart->contents())
        {
            //Transaksi kosong
            $response = [
                'status' => false,
                'msg' => "Tidak ada transaksi !",
            ];
           echo json_encode($response);
        } else{
            //Ada transaksi
            $totalBayar = 0;
            foreach($this->cart->contents() as $items)
            {
                $totalBayar += $items['subtotal'];
            }

            $nominal = $this->request->getVar('nominal');
            $id = "J". time();

            //Pengecekan apakah nominal yang dimasukkan cukup atau kurang
            if($nominal < $totalBayar)
            {
                $response = [
                    'status' => false,
                    'msg' => "Nominal pembayaran kurang !",
                ];
                echo json_encode($response);
            }else{
                $this->sale->save([
                    'sale_id' => $id,
                    'user_id' => session()->user_id,
                    'customer_id' => $this->request->getVar('id-cust'),
                ]);
                foreach($this->cart->contents() as $items){
                    $this->saleDetail->save([
                        'sale_id' => $id,
                        'id_barang' => $items['id'],
                        'amount' => $items['qty'],
                        'price' => $items['price'],
                        'total_price' => $items['subtotal']
                    ]);
                    
                    $barang = $this->barang->where(['id_barang' => $items['id']])->first();
                    $this->barang->save([
                        'id_barang'=> $items['id'],
                        'stok' => $barang['stok'] - $items['qty'],
                    ]);


                }
                $this->cart->destroy();
                $kembalian = $nominal - $totalBayar;

                $response= [
                    'status' =>true,
                    'msg'=> "Pembayaran berhasil",
                    'data' => [
                        'kembalian' => number_to_currency(
                            $kembalian,
                            'IDR',
                            'id_ID',
                            2
                        )
                    ]
                        ];
                        echo json_encode($response);
            }
        }
    }

    public function report($tgl_awal=null, $tgl_akhir=null)
    {
        $_SESSION['tgl_awal'] = $tgl_awal == null ? date('Y-m-01') : $tgl_awal;
        $_SESSION['tgl_akhir'] = $tgl_akhir == null ? date('Y-m-t') : $tgl_akhir;
        
        $tgl1 = $_SESSION['tgl_awal'];
        $tgl2 = $_SESSION['tgl_akhir'];
        
        $report = $this->sale->getReport($tgl1, $tgl2);
        $totalIncome = 0;
            foreach ($report as $item) {
            $totalIncome += $item['total'];
            }
        $data = [
            'title' => 'Laporan Penjualan',
            'result' => $report,
            'tanggal' => [
                'tgl_awal' => $tgl1,
                'tgl_akhir' => $tgl2,
            ],
            'totalIncome' => $totalIncome,
        ];
        return view('penjualan/report', $data);
    }

    public function exportPDF()
    {
        $tgl1 = $_SESSION['tgl_awal'];
        $tgl2 = $_SESSION['tgl_akhir'];
        
        $report = $this->sale->getReport($tgl1, $tgl2);
        $totalIncome = 0;
        foreach ($report as $item) {
        $totalIncome += $item['total'];
        }
        $data = [
            'title' => 'Laporan Penjualan',
            'result' => $report,
            'totalIncome' => $totalIncome,
        ];
        $html = view('penjualan/exportPDF', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan-penjualan.pdf', 'I');
    }

    public function exportExcel()
    {
        $tgl1 = $_SESSION['tgl_awal'];
        $tgl2 = $_SESSION['tgl_akhir'];
        
        $report = $this->sale->getReport($tgl1, $tgl2);

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nota')
            ->setCellValue('C1', 'Tgl Transaksi')
            ->setCellValue('D1', 'User')
            ->setCellValue('F1', 'Total');

        // tulis data mobil ke cell
        $rows = 2;
        $no = 1;

        foreach ($report as $value){
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $rows, $no++)
                ->setCellValue('B' . $rows, $value['sale_id'])
                ->setCellValue('C' . $rows, $value['tgl_transaksi'])
                ->setCellValue('D' . $rows, $value['firstname'] . '' . $value['lastname'])
                ->setCellValue('F' . $rows, $value['total']);
            $rows++;    
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan-penjualan';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function filter()
    {
        $_SESSION['tgl_awal'] = $this->request->getVar('tgl_awal');
        $_SESSION['tgl_akhir'] = $this->request->getVar('tgl_akhir');
        return $this->report($_SESSION['tgl_awal'], $_SESSION['tgl_akhir']);
    }

}
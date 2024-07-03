<?php 
namespace App\Models;
use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $useTimestamps = true;
    protected $allowedFields  = ['penjualan_id', 'user_id', 'customer_id'];

    public function getReport($tgl_awal, $tgl_akhir)
{
    return $this->db->table('penjualan_detail as sd')
    ->select('p.penjualan_id, p.created_at tgl_transaksi, us.id user_id, us.firstname, us.lastname, us.user_name, c.customer_id, c.name name_cust, c.no_customer, SUM(sd.total_price) total')
    ->join('penjualan p', 'penjualan_id')
    ->join('pengguna us', 'us.id = p.user_id')
    ->join('customer c', 'customer_id', 'left')
    ->where('date(p.created_at) >=',$tgl_awal)
    ->where('date(p.created_at) <=',$tgl_akhir)
    ->groupBy('p.penjualan_id')
    ->get()->getResultArray();
}
}
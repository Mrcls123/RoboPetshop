<?php namespace App\Models;
use CodeIgniter\Model;

class PenjualanDetailModel extends Model
{
    protected $table ='penjualan_detail';
    protected $allowedFields =['penjualan_id', 'id_barang','id_layanan', 'amount', 
    'price', 'discount', 'total_price'];
}
<?php
namespace App\Models;

use CodeIgniter\Model;

class CatBarangModel extends Model
{
    //Nama Tabel
    protected $table      = 'barang_category';
    //Atribut yang digunakan menjadi primary key
    protected $primaryKey = 'barang_category_id';
}
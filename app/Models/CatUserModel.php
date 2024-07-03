<?php
namespace App\Models;

use CodeIgniter\Model;

class CatUserModel extends Model
{
    //Nama Tabel
    protected $table      = 'layanan_category';
    //Atribut yang digunakan menjadi primary key
    protected $primaryKey = 'layanan_category_id';
}
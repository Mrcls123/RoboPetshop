<?php
namespace App\Models;

use CodeIgniter\Model;

class CatLayananModel extends Model
{
    //Nama Tabel
    protected $table      = 'layanan_category';
    //Atribut yang digunakan menjadi primary key
    protected $primaryKey = 'layanan_category_id';
}
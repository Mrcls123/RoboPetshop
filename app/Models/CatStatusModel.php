<?php
namespace App\Models;

use CodeIgniter\Model;

class CatStatusModel extends Model
{
    //Nama Tabel
    protected $table      = 'status_category';
    //Atribut yang digunakan menjadi primary key
    protected $primaryKey = 'status_category_id';
}
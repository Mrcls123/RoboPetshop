<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa_1248';
    protected $primaryKey = 'id_mahasiswa';
    protected $allowedFields = ['nama', 'tempat_lahir', 'jenis_kelamin', 'hobi', 'address', 'kategori_favorit'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
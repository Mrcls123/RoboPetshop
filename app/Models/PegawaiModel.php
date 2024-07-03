<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawaiv2';
    protected $primaryKey = 'id_pegawai';
    protected $allowedFields = ['nama_pegawai', 'gender','email', 'no_telepon', 'status'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
}
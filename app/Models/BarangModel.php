<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $DBGruoup = 'barbershopv2';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug','harga', 'stok', 'gambar', 'barang_category_id'];
    protected $useSoftDeletes = true;

    public function getBarang($slug = false)
    {
        $query = $this->table('barang')
            ->join('barang_category', 'barang_category_id')
            ->where('deleted_at is null');

        if ($slug == false)
            return $query->get()->getResultArray();
            return $query->where(['slug' => $slug])->first();
    }
}
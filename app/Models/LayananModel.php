<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    protected $DBGruoup = 'barbershopv2';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug','harga', 'stok','layanan_category_id'];
    protected $useSoftDeletes = true;

    public function getLayanan($slug = false)
    {
        $query = $this->table('layanan')
            ->join('layanan_category', 'layanan_category_id')
            ->where('deleted_at is null');

        if ($slug == false)
            return $query->get()->getResultArray();
            return $query->where(['slug' => $slug])->first();
    }
}
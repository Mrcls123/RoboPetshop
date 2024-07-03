<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $useTimestamps = true;    
    protected $allowedFields = ['name', 'no_supplier', 'address', 'gender', 'address', 'email', 'phone'];
    protected $useSoftDeletes = true;
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPkk extends Model
{
    protected $table            = 'tb_pkk_pokja';
    protected $primaryKey       = 'id_pkkpokja';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama', 'aktif', 'deskripsi'];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';
}

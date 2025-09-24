<?php

namespace App\Models;

use CodeIgniter\Model;

class RekrutModel extends Model
{
    protected $table            = 'tb_pkk_pendaftaran';
    protected $primaryKey       = 'id_pendaftaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pkkpokja',    'nama_lengkap',    'nik',    'alamat',    'no_hp'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamankuModel extends Model
{
    protected $table            = 'tb_tanamanku';
    protected $primaryKey       = 'id_tanamanku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_umum', 'nama_latin', 'foto_tanaman', 'asal_daerah', 'manfaat', 'keterangan', 'tanggal_pendataan', 'jumlah', 'petugas_id', 'petugas_nama', 'lokasi_gps_lat', 'lokasi_gps_lng', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPertanyaan extends Model
{
    protected $table            = 'tb_quiz_questions';
    protected $primaryKey       = 'id_pertanyaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['quiz_id', 'urutan', 'pertanyaan', 'gambar', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'kunci_jawaban', 'skor'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}

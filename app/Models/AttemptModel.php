<?php

namespace App\Models;

use CodeIgniter\Model;

class AttemptModel extends Model
{
    protected $table            = 'tb_quiz_attempts';
    protected $primaryKey       = 'id_attempt';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'quiz_id',
        'token',
        'mulai_sesi',
        'selesai_sesi',
        'durasi_detik',
        'benar',
        'salah',
        'skor_total',
        'ip_address',
        'user_agent',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findByToken(string $token): ?array
    {
        return $this->where('token', $token)->first();
    }
}

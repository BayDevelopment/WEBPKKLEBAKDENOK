<?php

namespace App\Models;

use CodeIgniter\Model;

class AnswerModel extends Model
{
    protected $table            = 'tb_quiz_answers';
    protected $primaryKey       = 'id_jawaban';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields = [
        'attempt_id',
        'pertanyaan_id',
        'jawaban',
        'is_benar',
        'skor',
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

    public function byAttemptWithQuestion(int $attemptId): array
    {
        return $this->select(
            'tb_quiz_answers.*, ' .
                'tb_quiz_questions.pertanyaan, tb_quiz_questions.opsi_a, tb_quiz_questions.opsi_b, ' .
                'tb_quiz_questions.opsi_c, tb_quiz_questions.opsi_d, ' .
                'tb_quiz_questions.kunci_jawaban, tb_quiz_questions.gambar, tb_quiz_questions.urutan'
        )
            ->join('tb_quiz_questions', 'tb_quiz_questions.id_pertanyaan = tb_quiz_answers.pertanyaan_id', 'left')
            ->where('tb_quiz_answers.attempt_id', $attemptId)
            ->orderBy('tb_quiz_questions.urutan', 'ASC')
            ->findAll();
    }
}

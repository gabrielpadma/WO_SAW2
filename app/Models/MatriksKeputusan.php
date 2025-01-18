<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatriksKeputusan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'matriks_keputusan';

    public function lowongan(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    public function pelamar(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'applicant_id');
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }
}

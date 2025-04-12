<?php

namespace App\Models;

use App\JenisKelamin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $cast = ['jenis_kelamin' => JenisKelamin::class];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }



    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function applicant_scores()
    {
        return $this->hasMany(ApplicantScore::class, 'application_id', 'id');
    }


    public function matriks_keputusan(): HasMany
    {
        return $this->hasMany(MatriksKeputusan::class, 'applicant_id');
    }
}

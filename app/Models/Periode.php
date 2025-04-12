<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'periode';

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }

    public function criterias(): HasMany
    {
        return $this->hasMany(Criteria::class, 'periode_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'periode_id');
    }

    public function applicant_scores(): HasMany
    {
        return $this->hasMany(ApplicantScore::class, 'periode_id', 'id');
    }
}

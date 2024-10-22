<?php

namespace App\Models;

use App\JenisCriteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'criteria';

    protected $casts = [
        'jenis_criteria' => JenisCriteria::class
    ];

    public function sub_criterias(): HasMany
    {
        return $this->hasMany(SubCriteria::class, 'criteria_id');
    }

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }
}

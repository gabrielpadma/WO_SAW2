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

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }


    public function matriks_keputusan(): HasMany
    {
        return $this->hasMany(MatriksKeputusan::class, 'criteria_id');
    }
}

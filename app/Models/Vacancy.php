<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacancy extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'vacancy_id');
    }

    // public function criterias(): HasMany
    // {
    //     return $this->hasMany(Criteria::class, 'vacancy_id');
    // }

    public function matriks_keputusan(): HasMany
    {
        return $this->hasMany(MatriksKeputusan::class, 'vacancy_id');
    }

    public function periode(): HasMany
    {
        return $this->hasMany(Periode::class, 'vacancy_id');
    }
}

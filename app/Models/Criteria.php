<?php

namespace App\Models;

use App\JenisCriteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'criteria';

    protected $casts = [
        'jenis_criteria' => JenisCriteria::class
    ];
}

<?php

namespace App\Models;

use App\JenisKelamin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;
    protected $guard = ['id'];
    protected $cast = ['jenis_kelamin' => JenisKelamin::class];

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class, 'id_vacancy');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}

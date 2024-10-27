<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroPageContent extends Model
{
    use HasFactory;
    protected $table = 'hero_page_contents';

    protected $guarded = ['id'];
}

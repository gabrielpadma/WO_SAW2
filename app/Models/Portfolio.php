<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function portfolio_details(): HasMany
    {
        return $this->hasMany(PortfolioDetail::class, 'portfolio_id');
    }
}

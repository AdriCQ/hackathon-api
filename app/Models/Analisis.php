<?php

namespace App\Models;

use Database\Factories\AnalisisFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Analisis extends Model
{
    use HasFactory;

    protected $table = 'analisis_clinicos';

    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return AnalisisFactory::new();
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paciente_id', 'id');
    }

    public function multimedias(): HasMany
    {
        return $this->hasMany(Media::class, 'analisis_id', 'id');
    }
}

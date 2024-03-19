<?php

namespace App\Models;

use Database\Factories\AnalisisFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $paciente_id
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $multimedias
 * @property-read int|null $multimedias_count
 * @property-read \App\Models\User $paciente
 *
 * @method static \Database\Factories\AnalisisFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis query()
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis whereUpdatedAt($value)
 *
 * @property string|null $secret
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Analisis whereSecret($value)
 *
 * @mixin \Eloquent
 */
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

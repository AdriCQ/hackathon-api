<?php

namespace App\Models;

use Database\Factories\UltrasonidoFactory;
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
 * @property string|null $secret
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $multimedias
 * @property-read int|null $multimedias_count
 * @property-read \App\Models\User $paciente
 *
 * @method static \Database\Factories\UltrasonidoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido whereSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ultrasonido whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Ultrasonido extends Model
{
    use HasFactory;

    protected $table = 'ultrasonidos';

    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return UltrasonidoFactory::new();
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'paciente_id', 'id');
    }

    public function multimedias(): HasMany
    {
        return $this->hasMany(Media::class, 'ultrasonido_id', 'id');
    }
}

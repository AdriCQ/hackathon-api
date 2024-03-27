<?php

namespace App\Models;

use Database\Factories\MediaFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $ultrasonido_id
 * @property string $tipo
 * @property string $disk
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ultrasonido $ultrasonido
 *
 * @method static \Database\Factories\MediaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUltrasonidoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUrl($value)
 *
 * @mixin \Eloquent
 */
class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return MediaFactory::new();
    }

    public function ultrasonido(): BelongsTo
    {
        return $this->belongsTo(Ultrasonido::class, 'ultrasonido_id', 'id');
    }
}

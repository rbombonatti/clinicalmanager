<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static search(mixed $input)
 * @method static where(string $string, mixed $procedure_id)
 */
class Procedure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title'];
    protected $table = 'procedures';

    public function procedurePrices(): HasMany
    {
        return $this->hasMany(ProcedurePrice::class);
    }

    public function healthInsurancePlan(): BelongsTo
    {
        return $this->belongsTo(HealthInsurancePlan::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'LIKE', "%$search%");
    }
}

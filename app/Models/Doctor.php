<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static findOrFail(Doctor $doctor)
 * @method static withRelations()
 */
class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'doctors';

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['role' => function ($q) {
            $q->withTrashed();
        }, 'specialties']);
    }

    public function scopeSearch($query, $search)
    {
        return  $query->where('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%");
    }
}

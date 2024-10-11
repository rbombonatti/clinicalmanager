<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate(int $int)
 * @method static create(array $array)
 */
class Role extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title'];
    protected $table = 'roles';

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }
}

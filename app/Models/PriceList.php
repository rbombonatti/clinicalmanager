<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(mixed $validated)
 * @method static active()
 */
class PriceList extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'start_date', 'end_date', 'active'];
    protected $table = 'price_lists';

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at')->where('active', 1);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }
}

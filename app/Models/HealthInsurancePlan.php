<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static withRelations()
 */
class HealthInsurancePlan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'health_insurance_plans';
    protected $fillable = ['title'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function procedurePrices()
    {
        return $this->hasMany(ProcedurePrice::class, 'health_insurance_plan_id');
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['procedurePrices']);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static insert(array $procedures)
 * @method static withRelations()
 * @method static create(array $array)
 */
class ProcedurePrice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "procedure_prices";
    protected $fillable = ['procedure_id', 'health_insurance_plan_id', 'price_list_id', 'price'];

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class);
    }

    public function healthInsurancePlan(): BelongsTo
    {
        return $this->belongsTo(HealthInsurancePlan::class);
    }

    public function priceList(): BelongsTo
    {
        return $this->belongsTo(PriceList::class, 'price_list_id');
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['procedure', 'healthInsurancePlan', 'priceList']);
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereHas('procedure', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->whereNull('deleted_at');;
            })
            ->orWhereHas('healthInsurancePlan', function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->whereNull('deleted_at');
            });
    }

}

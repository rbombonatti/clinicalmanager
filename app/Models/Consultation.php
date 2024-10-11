<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static withRelations()
 * @method static findOrFail(mixed $id)
 * @method static where(string $string, string $string1, mixed $consultation_number)
 * @method create(array $data)
 * @method static whereNull(string $string)
 * @property mixed $reference_price
 */
class Consultation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'consultations';
    protected $fillable = [
        'patient_name',
        'consultation_number',
        'consultation_date',
        'doctor_id',
        'procedure_id',
        'health_insurance_plan_id',
        'user_id',
        'type',
        'source',
        'followup',
        'reference_price',
        'paid_price',
        'payment_date',
        'observation'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class);
    }

    public function healthInsurancePlan(): BelongsTo
    {
        return $this->belongsTo(Healthinsuranceplan::class);
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['user', 'doctor', 'procedure', 'healthInsurancePlan']);
    }
}

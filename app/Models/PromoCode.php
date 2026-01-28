<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'valid_from',
        'valid_until',
        'usage_limit',
        'times_used',
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
        'usage_limit' => 'integer',
        'times_used' => 'integer',
    ];



    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    protected function validFrom(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? Carbon::parse($value)->setTime(0, 0, 0) : null,
        );
    }

    protected function validUntil(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value ? Carbon::parse($value)->setTime(23, 59, 59) : null,
        );
    }

    protected function usageLimit(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value !== null ? max(0, (int) $value) : null,
        );
    }

    protected function timesUsed(): Attribute
    {
        return Attribute::make(
            set: fn($value) => max(0, (int) $value),
        );
    }
}

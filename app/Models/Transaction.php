<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'flight_schedule_id',
        'promo_code_id',
        'total_amount',
        'status'
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function class()
    {
        return $this->belongsTo(FlightClass::class);
    }

    public function promo()
    {
        return $this->belongsTo(PromoCode::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'flight_class_facility', 'flight_class_id', 'facility_id');
    }
}

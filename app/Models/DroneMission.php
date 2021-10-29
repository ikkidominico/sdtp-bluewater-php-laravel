<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Ramsey\Uuid\Uuid;

class DroneMission extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'drone_id',
        'mission_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        static::creating(fn(DroneMission $dronemission) => $dronemission->id = (string) Uuid::uuid4());
    }
}
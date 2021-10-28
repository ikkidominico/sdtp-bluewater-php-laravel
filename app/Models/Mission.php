<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Mission extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'codename',
        'latitude',
        'longitude',
        'radius',
        'date'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function drones()
    {
        return $this->belongsToMany(Drone::class);
    }

    protected static function booted()
    {
        static::creating(fn(Mission $mission) => $mission->id = (string) Uuid::uuid4());
    }
}

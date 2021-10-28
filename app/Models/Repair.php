<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Repair extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'description',
        'date',
        'drone_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function drone()
    {
        return $this->belongsTo(Drone::class);
    }

    protected static function booted()
    {
        static::creating(fn(Repair $repair) => $repair->id = (string) Uuid::uuid4());
    }
}

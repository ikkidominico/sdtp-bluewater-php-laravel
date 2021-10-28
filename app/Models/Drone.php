<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Drone extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'codename',
        'manufacturer',
        'model',
        'serial',
        'operator_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function operator()
    {
        return $this->hasOne(Operator::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function missions()
    {
        return $this->belongsToMany(Mission::class);
    }

    protected static function booted()
    {
        static::creating(fn(Drone $drone) => $drone->id = (string) Uuid::uuid4());
    }
}

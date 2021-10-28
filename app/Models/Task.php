<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'date',
        'is_completed',
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
        static::creating(fn(Task $task) => $task->id = (string) Uuid::uuid4());
    }
}

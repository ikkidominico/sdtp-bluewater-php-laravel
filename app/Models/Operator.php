<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Operator extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'cpf',
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected static function booted()
    {
        static::creating(fn(Operator $operator) => $operator->id = (string) Uuid::uuid4());
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'batch',
        'date_joined',
        'status',
        'discount_applicable',
        'created_by',
        'updated_by',
    ];
}

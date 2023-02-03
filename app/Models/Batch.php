<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course',
        'start_date',
        'fee',
        'created_by',
        'updated_by',
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'mobile_alt',
        'dob',
        'qualification',
        'category',
        'address',
        'admission_date',
        'fee',
        'discount_applicable',
        'photo',
        'branch',
        'created_by',
        'updated_by',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch');
    }

    public function batches(){
        return $this->hasMany(StudentBatch::class, 'student');
    }

    public function attendances(){
        return $this->hasMany(Attendance::class, 'student');
    }
    
    public function batchFee(){
        return $this->hasMany(Fee::class, 'student');
    }
}

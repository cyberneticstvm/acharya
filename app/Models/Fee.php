<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student',
        'batch',
        'paid_date',
        'fee_month',
        'fee_year',
        'fee', 
        'discount_applicable',
        'fee_pending',
        'created_by',
        'updated_by',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'student');
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch');
    }

    public function mname(){
        return $this->belongsTo(Month::class, 'fee_month');
    }
}

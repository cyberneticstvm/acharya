<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'head',
        'amount',
        'description',
        'date',
        'created_by',
        'updated_by',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch');
    }

    public function head(){
        return $this->belongsTo(Head::class, 'head');
    }
}

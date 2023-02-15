<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchSyllabus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'batch',
        'module',
        'status',
        'created_by',
        'updated_by',
    ];

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch');
    }

    public function module(){
        return $this->belongsTo(Module::class, 'module');
    }
}

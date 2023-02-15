<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'syllabus',
        'name',
        'created_by',
        'updated_by',
    ];

    public function syllabus(){
        return $this->belongsTo(Syllabus::class, 'syllabus');
    }

    public function batchModules(){
        return $this->hasMany(BatchSyllabus::class, 'module');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function modules(){
        return $this->hasMany(Module::class, 'syllabus');
    }

    public function batches(){
        return $this->hasMany(Batch::class, 'syllabus');
    }
}

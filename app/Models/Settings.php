<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'admin_name',
        'admin_email',
        'batch_fee_discount_percentage',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch');
    }
}

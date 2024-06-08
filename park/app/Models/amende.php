<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class amende extends Model
{
    use HasFactory;

    public $table = 'amende';
    public $timestamps = false;

    public $fillable = [
        'nom',
        'prix'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tarif extends Model
{
    public $table = 'tarif';
    public $timestamps = false;
    public $fillable = [
        'heure',
        'prix'
    ];

    protected $casts = [
        'prix' => 'double'
    ];

    public static array $rules = [
        'prix' => 'required|max:10000000'
    ];


}

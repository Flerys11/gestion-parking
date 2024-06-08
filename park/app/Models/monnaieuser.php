<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class monnaieuser extends Model
{
    public $table = 'monnaieuser';
    public $timestamps = false;

    public $fillable = [
        'id_user',
        'monnaie_entre'
    ];

    protected $casts = [
        'monnaie_entre' => 'double',
    ];

    public static array $rules = [
        'monnaie_entre' => 'required|max:10',
    ];

    public static array $message = [
        'monnaie_entre.max' => 'La Monnaie Entre ne peut pas dépasser :max caractères.'
    ];


}

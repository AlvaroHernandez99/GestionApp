<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heroe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'hasCape'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'remember_token',
    ];
}

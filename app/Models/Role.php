<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'rol',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'remember_token',
    ];

    public function employees() {
        return $this->hasMany(Employee::class);
    }
}

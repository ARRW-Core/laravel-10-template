<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    //check migrations and make fillable
    protected $fillable = [
        'name',
    ];

    //one-to-many relationship with employee
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}

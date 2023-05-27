<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{
    use HasFactory;

    //check migrations and make fillable
    protected $fillable = [
        'name',
    ];

    //one-to-many relationship with user
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

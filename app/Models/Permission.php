<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends \Spatie\Permission\Models\Permission
{
    use /*HasFactory,*/ SoftDeletes;
}

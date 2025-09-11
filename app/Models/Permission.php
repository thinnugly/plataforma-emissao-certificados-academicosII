<?php

namespace App\Models;

use Laratrust\Models\Permission as LaratrustPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends LaratrustPermission
{
    use HasFactory;

    protected $guarded = [];
}

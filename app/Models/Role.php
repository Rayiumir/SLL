<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as RoleSpatie;
class Role extends RoleSpatie
{
    protected $fillable = [
        'name'
    ];
}

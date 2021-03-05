<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 'Admin';

    const MEMBER = 'Member';
}

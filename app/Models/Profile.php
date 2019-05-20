<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Permission\Traits\HasRoles;

class Profile extends Model
{
    use TransformableTrait;

    use HasRoles;

    use Notifiable;

    protected $table = 'users';
}

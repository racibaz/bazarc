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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'cell_phone',
        'facebook',
        'twitter',
        'pinterest',
        'linkedin',
        'youtube',
        'web_site',
        'gender',
        'bio_note',
        'IP',
        'last_login',
        'previous_visit'
    ];
}

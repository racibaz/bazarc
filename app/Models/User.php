<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    use HasRoles;

    use Notifiable;

    protected $presenter = UserPresenter::class;

    /**
     * User types
     *
     * @var integer
     */
    public const PASSIVE = 0, ACTIVE = 1, PREPARING_EMAIL_ACTIVATION = 2, GARBAGE = 3;

    /**
     * User types
     *
     * @var array
     */
    public static $statuses = [
        'passive' => [
            'name' => 'Passive',
            'is_accept' => false,
        ],
        'active' => [
            'name' => 'Active',
            'is_accept' => true,
        ],
        'preparing_email_activation' => [
            'name' => 'Preparing Email Activation',
            'is_accept' => false,
        ],
        'garbage' => [
            'name' => 'Garbage',
            'is_accept' => false,
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'cell_phone', 'facebook', 'twitter', 'pinterest',
        'linkedin', 'youtube', 'web_site', 'gender', 'bio_note', 'IP', 'last_login', 'previous_visit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the active user
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '==', User::ACTIVE);
    }
}

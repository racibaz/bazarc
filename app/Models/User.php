<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
    use TransformableTrait;

    use HasRoles;

    use HasApiTokens;

    use Notifiable;

    use LogsActivity;

    public $transformer = UserTransformer::class;

    protected $presenter = UserPresenter::class;

    /**
     * User types
     *
     * @var integer
     */
    public const ACTIVE = 1, PASSIVE = 2, PREPARING_EMAIL_ACTIVATION = 3, GARBAGE = 4;

    /**
     * User types
     *
     * @var array
     */
    public static $statuses = [
        'active' => [
            'name' => 'Active',
            'number' => 1,
            'is_accept' => true,
        ],
        'passive' => [
            'name' => 'Passive',
            'number' => 2,
            'is_accept' => false,
        ],
        'preparing_email_activation' => [
            'name' => 'Preparing Email Activation',
            'number' => 3,
            'is_accept' => false,
        ],
        'garbage' => [
            'name' => 'Garbage',
            'number' => 4,
            'is_accept' => false,
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'two_factor_type', 'authy_id', 'slug', 'cell_phone', 'facebook', 'twitter', 'pinterest',
        'linkedin', 'youtube', 'web_site', 'gender', 'bio_note', 'IP', 'last_login', 'previous_visit'
    ];

    protected static $logAttributes = ['name'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'status'
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
        return $query->where('status', '==', $this->statuses['active']['number']);
    }


    public function phoneNumber()
    {
        return $this->hasOne(PhoneNumber::class);
    }

    public function social()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function hasSocialLinked($service)
    {
        return (bool)$this->social->where('service', $service)->count();
    }

    public function hasTwoFactorAuthenticationEnabled()
    {
        return $this->two_factor_type !== 'off';
    }

    public function hasSmsTwoFactorAuthenticationEnabled()
    {
        return $this->two_factor_type === 'sms';
    }

    public function hasTwoFactorType($type)
    {
        return $this->two_factor_type === $type;
    }

    public function hasDiallingCode($diallingCodeId)
    {
        if ($this->hasPhoneNumber() === false) {
            return false;
        }

        return $this->phoneNumber->diallingCode->id === $diallingCodeId;
    }

    public function getPhoneNumber()
    {
        if ($this->hasPhoneNumber() === false) {
            return false;
        }

        return $this->phoneNumber->phone_number;
    }

    public function hasPhoneNumber()
    {
        return $this->phoneNumber !== null;
    }

    public function registeredForTwoFactorAuthentication()
    {
        return $this->authy_id !== null;
    }

    public function updatePhoneNumber($phoneNumber, $phoneNumberDiallingCode)
    {
        $this->phoneNumber()->delete();

        if (!$phoneNumber) {
            return;
        }

        return $this->phoneNumber()->create([
            'phone_number' => $phoneNumber,
            'dialling_code_id' => $phoneNumberDiallingCode,
        ]);
    }
}


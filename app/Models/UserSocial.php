<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    protected $table = 'user_socials';

    protected $fillable = ['social_id', 'service'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

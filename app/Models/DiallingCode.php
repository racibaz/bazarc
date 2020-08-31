<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiallingCode extends Model
{
    public $timestamps = false;
    protected $table = 'dialling_codes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];
}

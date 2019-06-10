<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiallingCode extends Model
{
    protected $table = 'dialling_codes';

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];
}

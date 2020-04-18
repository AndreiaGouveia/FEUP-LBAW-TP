<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id' ,'usename', 'email', 'passwor','visible',
    ];

    protected $table = 'person';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
}

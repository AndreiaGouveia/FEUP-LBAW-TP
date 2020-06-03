<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Person extends Authenticatable
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
        'id' ,'username', 'email', 'password','visible', 'ban'
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

    public function isAdmin(){return $this->hasOne('App\Administrator', 'id_person', 'id')->exists(); }

    public function isMember(){return $this->hasOne('App\Member', 'id_person', 'id')->exists(); }

    public function isModerator() { return ($this->member != null) ? true : false;}

    public function member(){return $this->hasOne('App\Member', 'id_person', 'id'); }
}

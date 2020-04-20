<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
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
        'id_person' ,'name', 'biography', 'points','id_location', 'id_photo', 'medal', 'moderator',
    ];

    protected $table = 'member';
    protected $primaryKey = 'id_person'; //because primary key is not id

    protected $hidden = ['password'];

    //associations
    public function person(){return $this->belongsTo('App\Person','id_person');}

    public function location(){return $this->hasOne('App\Location','id_location');}

    public function photo(){return $this->hasOne('App\Photo','id_photo');}

    public function publications() {return $this->hasMany('App\Publication'); }
}

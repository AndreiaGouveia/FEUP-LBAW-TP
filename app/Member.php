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

    //associations
    public function person(){return $this->belongsTo('App\Person','id_person');}

    public function location(){return $this->hasOne('App\Location','id_location');}
}

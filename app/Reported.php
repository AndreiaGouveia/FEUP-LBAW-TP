<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reported extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_member',
        'id_publication',
        'motive',
        'resolved'
    ];

    protected $table = 'reported';

    //associations
    public function owner(){return $this->belongsTo('App\Member', 'id_member', 'id_person');}

    public function publication(){return $this->hasOne('App\Publication', 'id_publication', 'id');}
}

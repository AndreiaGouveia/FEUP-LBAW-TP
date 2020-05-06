<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id' , 'description' , 'date', 'id_owner', 'visible'
    ];

    protected $table = 'publication';

    //associations
    public function owner(){return $this->belongsTo('App\Member', 'id_owner', 'id_person');}

    public function commentable_publications(){return $this->hasMany('App\Commentable_publication');}

    public function comments(){return $this->hasMany('App\Comments');}
}

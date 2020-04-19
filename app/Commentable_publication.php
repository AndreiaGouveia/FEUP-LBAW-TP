<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commentable_publication extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_publication'
    ];

    protected $table = 'commentable_publication';
    protected $primaryKey = 'id_publication';

    //associations
    public function owner(){return $this->belongsTo('App\Publication', 'id_publication');}

    public function comments(){return $this->hasMany('App\Comment');}

}

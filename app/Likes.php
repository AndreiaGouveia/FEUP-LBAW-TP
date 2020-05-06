<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_commentable_publication', 'id_member', 'likes'
    ];

    protected $table = 'likes';

    //associations
    public function owner(){return $this->belongsTo('App\Publication', 'id', 'id_commentable_publication');}

    public function publication(){return $this->belongsTo('App\Publication', 'id', 'id_commentable_publication');}
}

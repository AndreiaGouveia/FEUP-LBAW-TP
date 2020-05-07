<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */
    protected $fillable = [
        'id_commentable_publication', 'id_member'
    ];

    protected $table = 'favorite';

    //associations
    public function owner(){return $this->belongsTo('App\Publication', 'id', 'id_commentable_publication');}

    public function publication(){return $this->belongsTo('App\Publication', 'id', 'id_commentable_publication');}
}

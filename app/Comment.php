<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_publication' , 'id_commentable_publication',
    ];

    protected $table = 'Comment';
    protected $primaryKey = 'id_publication';

    //associations
    public function owner(){return $this->belongsTo('App\Publication', 'id_publication');}

    public function commentsPublication(){return $this->hasOne('App\Commentable_publication', 'id_commentable_publication');}

}

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
        'id_publication', 'id_commentable_publication',
    ];

    protected $table = 'comment';
    protected $primaryKey = 'id_publication';

    //associations

    public function publication()
    {
        return $this->belongsTo('App\Publication', 'id_publication', 'id');
    }

    public function commentsPublication()
    {
        return $this->hasOne('App\Commentable_publication', 'id_commentable_publication', 'id_commentable_publication');
    }

    public function commentsQuestion()
    {
        return $this->hasOne('App\Question', 'id_commentable_publication', 'id_commentable_publication');
    }

    public function commentsResponse()
    {
        return $this->hasOne('App\Response', 'id_commentable_publication', 'id_commentable_publication');
    }

    public function reported() {
        return $this->hasMany('App\Reported', 'id_publication', 'id_publication')->where('resolved', false);
    }
}

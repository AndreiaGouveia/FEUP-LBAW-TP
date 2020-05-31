<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_commentable_publication','id_question'
    ];

    protected $table = 'response';
    protected $primaryKey = 'id_commentable_publication';

    //associations
    public function commentable_publication(){return $this->belongsTo('App\Commentable_publication', 'id_commentable_publication', 'id_publication');}

    public function publication(){return $this->belongsTo('App\Publication', 'id_commentable_publication', 'id');}

    public function question(){return $this->hasOne('App\Question', 'id_commentable_publication', 'id_question');}

    public function reported() {
        return $this->hasMany('App\Reported', 'id_publication', 'id_commentable_publication')->where('resolved', false);
    }
}

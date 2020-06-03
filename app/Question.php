<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_commentable_publication','title', 'tsv'
    ];

    protected $table = 'question';
    protected $primaryKey = 'id_commentable_publication';

    //associations
    public function commentable_publication(){return $this->belongsTo('App\Commentable_publication', 'id_commentable_publication', 'id_publication');}
    
    public function publication(){return $this->belongsTo('App\Publication', 'id_commentable_publication', 'id');}

    public function answers(){return $this->hasMany('App\Response', 'id_question', 'id_commentable_publication');}

    public function count_answers() { return $this->hasManyThrough('App\Publication', 'App\Response', 'id_question', 'id', 'id_commentable_publication', 'id_commentable_publication')->where('visible', true)->count(); }

    public function tags(){return $this->hasMany('App\TagQuestion', 'id_question', 'id_commentable_publication');}

    public function reported() {
        return $this->hasMany('App\Reported', 'id_publication', 'id_commentable_publication')->where('resolved', false)->select('motive')->groupBy('motive')->distinct();
    }
}

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
        'id_commentable_publication','title'
    ];

    protected $table = 'question';
    protected $primaryKey = 'id_commentable_publication';

    //associations
    public function owner(){return $this->belongsTo('App\Commentable_publication', 'id_commentable_publication', 'id_commentable_publication');}

    public function answers(){return $this->hasMany('App\Response', 'id_question', 'id_commentable_publication');}


}

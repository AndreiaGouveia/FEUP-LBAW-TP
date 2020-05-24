<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_person' ,'name', 'biography', 'points','id_location', 'id_photo', 'medal', 'moderator',
    ];

    protected $table = 'member';
    protected $primaryKey = 'id_person'; //because primary key is not id

    protected $hidden = ['password'];

    //associations
    public function person(){return $this->belongsTo('App\Person','id_person', 'id');}

    public function location(){return $this->hasOne('App\Location','id', 'id_location');}

    public function photo(){return $this->hasOne('App\Photo','id', 'id_photo');}

    public function publications() {return $this->hasMany('App\Publication', 'id_owner', 'id_person'); }

    public function questions() {
        
        return $this->hasManyThrough('App\Question', 'App\Publication', 'id_owner', 'id_commentable_publication', 'id_person', 'id')->orderBy('publication.date', 'desc');
    
    }

    public function answers() {
        
        return $this->hasManyThrough('App\Response', 'App\Publication', 'id_owner', 'id_commentable_publication', 'id_person', 'id')->orderBy('publication.date', 'desc');
    
    }

    public function comments() {
        
        return $this->hasManyThrough('App\Comment', 'App\Publication', 'id_owner', 'id_publication', 'id_person', 'id')->orderBy('publication.date', 'desc');
    
    }

    public function favoriteQuestions() {

        return $this->hasManyThrough('App\Question', 'App\Favorite', 'id_member', 'id_commentable_publication', 'id_person', 'id_commentable_publication')->orderBy('publication.date', 'desc');

    }

    public function favoriteAnswers() {

        return $this->hasManyThrough('App\Response', 'App\Favorite', 'id_member', 'id_commentable_publication', 'id_person', 'id_commentable_publication')->orderBy('publication.date', 'desc');

    }
}

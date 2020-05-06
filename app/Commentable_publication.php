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
    
    public function publication(){return $this->belongsTo('App\Publication', 'id_publication', 'id');}

    public function comments(){return $this->hasMany('App\Comment', "id_commentable_publication", "id_publication");}

    public function likes(){return $this->hasMany('App\Likes', 'id_commentable_publication', 'id_publication')->where('likes.likes', '=', 'true');}
    
    public function dislikes(){return $this->hasMany('App\Likes', 'id_commentable_publication', 'id_publication')->where('likes.likes', '=', 'false');}

    public function favorites(){return $this->hasMany('App\Favorite', 'id_commentable_publication', 'id_publication');}
    
    //checks If User Likes 

    public function likesPub($idUser) {

        return count($this->likes->where('id_member', '=', $idUser)) > 0;

    }

    //checks If User Dislikes 

    public function dislikesPub($idUser) {

        return count($this->dislikes->where('id_member', '=', $idUser)) > 0;
    }

    //checks If User Favorites 

    public function favoritePub($idUser) {

        return count($this->favorites->where('id_member', '=', $idUser)) > 0;
    }

}

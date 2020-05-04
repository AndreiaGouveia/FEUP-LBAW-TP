<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagQuestion extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_tag','id_question'
    ];

    protected $table = 'tag_question';

    public function main_tag(){return $this->hasOne('App\Tag', 'id', 'id_tag');}

}

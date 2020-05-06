<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name'
    ];

    protected $table = 'tag';
    protected $primaryKey = 'id';

    public function tagQuestion(){return $this->hasMany('App\TagQuestion', 'id_tag', 'id');}
}

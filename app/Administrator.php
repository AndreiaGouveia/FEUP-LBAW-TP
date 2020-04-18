<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
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
        'id_person' ,
    ];

    protected $table = 'administrator';

    //associations
    public function person(){return $this->belongsTo('App\Person','id_person');}
}

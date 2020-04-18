<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
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
        'id' , 'city' , 'district' , 'country',
    ];

    protected $table = 'location';

    //associations
    public function member(){return $this->belongsToMany('App\Member');}
}

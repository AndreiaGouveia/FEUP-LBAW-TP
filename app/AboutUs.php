<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'id_admin', 'description'
    ];

    protected $table = 'about_us';
    protected $primaryKey =  ['date', 'id_admin'];
    public $incrementing = false;
}

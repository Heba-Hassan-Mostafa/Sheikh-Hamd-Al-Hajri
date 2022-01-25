<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatwas extends Model 
{

    protected $table = 'fatwas';
    public $timestamps = true;

    protected $fillable=['name' , 'email' , 'message' ];

    // public function client()
    // {
    //     return $this->belongsTo('App\Models\Client');
    // }


    public function question()
    {
        return $this->hasOne('App\Models\Question' , 'fatwas_id');
    }

    

}
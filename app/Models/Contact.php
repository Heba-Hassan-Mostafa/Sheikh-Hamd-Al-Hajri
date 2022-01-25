<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contacts';
    public $timestamps = true;

    protected $fillable=['name','email','message','phone'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}
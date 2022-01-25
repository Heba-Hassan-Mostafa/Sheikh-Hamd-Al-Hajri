<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{

    protected $table = 'questions';
    public $timestamps = true;

    protected $fillable =['answer' , 'mp3File' ,'publish_date' , 'fatwas_id'];


    public function fatwas()
    {
        return $this->belongsTo('App\Models\Fatwas' , 'fatwas_id');
    }

}
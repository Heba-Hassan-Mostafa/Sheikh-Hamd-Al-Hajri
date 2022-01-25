<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $table = 'lives';
    public $timestamps = true;

    protected $fillable = ['live_link' ];

}
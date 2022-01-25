<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SheikhNew extends Model
{
    protected $table = 'sheikh_news';
    public $timestamps = true;

    protected $fillable = ['first_news','second_news','third_news' ];
}
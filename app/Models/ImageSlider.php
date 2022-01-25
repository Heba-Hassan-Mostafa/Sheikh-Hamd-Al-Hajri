<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    protected $table = 'image_sliders';
    public $timestamps = true;

    protected $fillable = ['title','image','link','status'];

}
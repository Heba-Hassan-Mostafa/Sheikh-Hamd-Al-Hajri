<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Category extends Model 
{
    use Sluggable;

   

    protected $table = 'categories';
    public $timestamps = true;

    protected $fillable =['name','status'];

   public function sluggable(): array
   {
       return [
           'slug'=> [
               'source'=>'name'
           ]
           ];
   }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function speeches()
    {
        return $this->hasMany('App\Models\Speech');
    }

    public function religiousBenefits()
    {
        return $this->hasMany('App\Models\ReligiousBenefits');
    }

}
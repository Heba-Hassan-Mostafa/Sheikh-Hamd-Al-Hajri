<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class Article extends Model 
{
    use Sluggable, SearchableTrait;

    protected $table = 'articles';
    public $timestamps = true;


    
    protected $fillable = ['name' , 'category_id' ,
     'content' , 'pdf_file' , 'publish_date' , 'status' ,'view_count' ,'download_count','keywords','description'];


    public function sluggable(): array
   {
       return [
           'slug'=> [
               'source'=>'name'
           ]
           ];
   }


   protected $searchable = [
        
    'columns' => [
        'articles.name'    => 10,

    ]
];


    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    
   

}
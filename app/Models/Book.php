<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;



class Book extends Model 
{

    use Sluggable, SearchableTrait;

    protected $table = 'books';
    public $timestamps = true;

    protected $fillable = ['name' , 'category_id' , 'note' , 'pdf_file' , 'publish_date' 
    , 'status' , 'image' ,'view_count' ,'download_count','keywords','description'];


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
            'books.name'    => 10,
           
            
        ]
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    

   
}
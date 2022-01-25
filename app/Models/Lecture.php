<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;



class Lecture extends Model 
{
    use Sluggable , SearchableTrait;

    protected $table = 'lectures';
    public $timestamps = true;

    protected $fillable = ['name' , 'category_id' , 'content' , 'pdf_file' ,
     'publish_date' , 'status' ,'view_count' ,'download_count','keywords','description'];


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
            'lectures.name'    => 10,

        ]
    ];

    

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function videos()
    {
        return $this->morphMany('App\Models\Video', 'videoable');
    }

    public function audios()
    {
        return $this->morphMany('App\Models\Audio', 'audioable');
    }
    

}
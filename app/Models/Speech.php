<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;



class Speech extends Model 
{
    use Sluggable , SearchableTrait;

    protected $table = 'speeches';
    public $timestamps = true;

    protected $fillable = ['name' , 'category_id' , 'content' , 'pdf_file' , 'publish_date' 
    , 'status' ,'view_count' ,'download_count','keywords','description'];


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
            'speeches.name'    => 10,

        ]
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function videos()
    {
        return $this->morphMany('App\Models\Video', 'videoable');
    }

    public function audios()
    {
        return $this->morphMany('App\Models\Audio', 'audioable');
    }
   


    public function views()
    {
        return $this->morphMany('App\Models\View', 'viewable');
    }
    
}
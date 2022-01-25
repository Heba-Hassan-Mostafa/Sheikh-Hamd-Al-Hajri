<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Cviebrock\EloquentSluggable\Sluggable;


Relation::morphMap([
    
     
    'lesson' => 'App\Models\Lesson',
    'lecture' => 'App\Models\Lecture',
    'speech' => 'App\Models\Speech',
    
]);

class Video extends Model 
{

    use Sluggable;

    protected $table = 'videos';
    public $timestamps = true;

    protected $fillable =['name','youtubeLink'];

    
    public function sluggable(): array
    {
        return [
            'slug'=> [
                'source'=>'name'
            ]
            ];
    }

    public function videoable()
    {
        return $this->morphTo();
    }

}
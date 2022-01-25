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

class Audio extends Model 
{
    use Sluggable;


    protected $table = 'audios';
    public $timestamps = true;

    protected $fillable = ['name' , 'audioFile' ,'embedLink', 'publish_date','view_count' ,'download_count'];
    
    public function sluggable(): array
    {
        return [
            'slug'=> [
                'source'=>'name'
            ]
            ];
    }

    public function audioable()
    {
        return $this->morphTo();
    }

}
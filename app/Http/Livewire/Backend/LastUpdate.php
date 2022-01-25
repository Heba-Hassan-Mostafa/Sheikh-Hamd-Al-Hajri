<?php

namespace App\Http\Livewire\Backend;

use App\Models\Article;
use App\Models\Book;
use App\Models\Lecture;
use App\Models\Lesson;
use App\Models\ReligiousBenefits;
use App\Models\Speech;
use Livewire\Component;

class LastUpdate extends Component
{
    public function render()
    {

        $lessons  =Lesson::orderBy('id','desc')->take(3)->get();
        $lectures =Lecture::orderBy('id','desc')->take(3)->get();
        $books    =Book::orderBy('id','desc')->take(3)->get();
        $articles =Article::orderBy('id','desc')->take(3)->get();
        $speeches =Speech::orderBy('id','desc')->take(3)->get();
        $benefits =ReligiousBenefits::orderBy('id','desc')->take(3)->get();

        return view('livewire.backend.last-update',[
            'lessons'    =>$lessons,
            'lectures'   =>$lectures,
            'books'      =>$books,
            'articles'   =>$articles,
            'speeches'   =>$speeches,
            'benefits'   =>$benefits,

        ]);
    }
}
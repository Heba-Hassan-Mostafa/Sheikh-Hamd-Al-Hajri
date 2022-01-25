<?php

namespace App\Http\Livewire\Backend;

use App\Models\Article;
use App\Models\Book;
use App\Models\Fatwas;
use App\Models\Lecture;
use App\Models\Lesson;
use App\Models\ReligiousBenefits;
use App\Models\Speech;
use App\User;
use Livewire\Component;


class Statistics extends Component
{
    public function render()
    {
        $all_user= User::whereHas('roles')->count();
        $lesson  = Lesson::whereStatus(1)->count();
        $lecture = Lecture::whereStatus(1)->count();
        $speech  = Speech::whereStatus(1)->count();
        $article = Article::whereStatus(1)->count();
        $book    = Book::whereStatus(1)->count();
        $benefit = ReligiousBenefits::whereStatus(1)->count();
        $fatwas  = Fatwas::whereStatus(1)->count();

      

        return view('livewire.backend.statistics',[
            
            'all_user'       =>  $all_user, 
            'lesson'         =>  $lesson,      
            'lecture'        =>  $lecture,      
            'speech'         =>  $speech,      
            'article'        =>  $article,      
            'book'           =>  $book,      
            'benefit'        =>  $benefit,      
            'fatwas'         =>  $fatwas,      

            ]);  
    }
}
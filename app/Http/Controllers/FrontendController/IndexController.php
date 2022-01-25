<?php

namespace App\Http\Controllers\FrontendController;


use App\User;
use App\Models\Book;
use App\Models\Live;
use App\Models\Audio;
use App\Models\Video;
use App\Models\Client;
use App\Models\Fatwas;
use App\Models\Lesson;
use App\Models\Speech;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Lecture;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\SheikhNew;
use App\Models\Subscriber;
use App\Models\ImageSlider;
use Illuminate\Http\Request;
use App\Models\ReligiousBenefits;
use App\Http\Controllers\Controller;
use App\Notifications\ContactUsMail;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ClientContactUsMail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AnswerQuestionForClientNotify;

class IndexController extends Controller
{
    
    //news of website 
    public function index()
{

    //news of articles
    $articles = Article::with('category')
    ->whereHas('category', function ($query) {
        $query->whereStatus(1);
    })
    ->whereStatus(1)->orderBy('id','desc')->paginate(3);

    //news of lessons
    $lessons = Lesson::with('category')
    ->whereHas('category', function ($query) {
        $query->whereStatus(1);
    })
    ->whereStatus(1)->orderBy('id','desc')->paginate(3);

    //news of lectures
    $lectures = Lecture::with('category')
    ->whereHas('category', function ($query) {
        $query->whereStatus(1);
    })
    ->whereStatus(1)->orderBy('id','desc')->paginate(3);
    
     //news of speeches
     $speeches = Speech::with('category')
     ->whereHas('category', function ($query) {
         $query->whereStatus(1);
     })
     ->whereStatus(1)->orderBy('id','desc')->paginate(3);


     //get videos
     $videos = Video::whereHasMorph(
         'videoable' ,
         ['App\Models\Lesson', 'App\Models\Lecture' , 'App\Models\Speech'],


        function(Builder $query,$type){
            
            $query->where('youtubeLink', 'like' ,'https%')
            ->orWhere('youtubeLink', '!=' ,'');

        if( $type === 'App\Models\Speech' || $type === 'App\Models\Lesson' || $type === 'App\Models\Lecture' )
        {
        $query->where('status', '=', 1);

        }
        })->orderBy('id','desc')->paginate(1);

         //get audios
     $audios = Audio::whereHasMorph(
        'audioable' ,
        ['App\Models\Lesson', 'App\Models\Lecture' , 'App\Models\Speech'],
          function(Builder $query,$type){
              
                $query->where('embedLink', '!=' ,'')
                  ->orWhere('audioFile', '!=' , '');
          if( $type === 'App\Models\Speech' || $type === 'App\Models\Lesson' || $type === 'App\Models\Lecture' )
               {
                $query->where('status', '=', 1);

               }


        })->orderBy('id','desc')->paginate(5);


        //Sheikh news 
        $news = SheikhNew::orderBy('id' , 'desc')->first(); 


        //slider
        $sliders = ImageSlider::whereStatus(1)->orderBy('id','desc')->paginate(5);





        $lesson_views = Lesson::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('view_count','desc')->paginate(1);

        $lesson_downloads = Lesson::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('download_count','desc')->paginate(1);

        $lecture_views = Lecture::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('view_count','desc')->paginate(1);
        
        $lecture_downloads = Lecture::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('download_count','desc')->paginate(1);

        $speech_views = Speech::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('view_count','desc')->paginate(1);

        $speech_downloads = Speech::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('download_count','desc')->paginate(1);

        $article_views = Article::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('view_count','desc')->paginate(1);

        $article_downloads = Article::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('download_count','desc')->paginate(1);

        $book_views = Book::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('view_count','desc')->paginate(1);

        $book_downloads = Book::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('download_count','desc')->paginate(1);
        
        $benefit_views = ReligiousBenefits::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereStatus(1)->orderBy('view_count','desc')->paginate(1);

        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
         
    return view('frontend.index' , 
    compact('articles','lessons','lectures','speeches','videos','audios','news','sliders',
    'lesson_views','lesson_downloads', 'lecture_views','lecture_downloads', 'speech_views','speech_downloads',
    'book_views','book_downloads', 'benefit_views', 'article_views','article_downloads','visitors'));
}


   

    //add Fatwas
    public  function add_fatwas(Request $request)
    {
       $validation = Validator::make($request->all(), [
           'name' =>'required',
           'email' =>'required|email',
           'message' =>'required'  
           
       ]);

       if($validation->fails())
       {
           return redirect()->back()->withErrors($validation)->withInput();
       }

    //    $client = Client::whereStatus(1)->first();

    //    if($client)
    //    {
    //        $clientId = $client->id ? $client->id : null ;
            
           $data['name']        = $request->name; 
           $data['email']       = $request->email; 
           $data['message']     = Purify::clean($request->message);
           //$data['client_id']   = $clientId; 
 
            $fatwa = Fatwas::create($data);
            
            User::whereStatus(1)->whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin']);
            })->each(function ($admin, $key) use ($fatwa) {
                $admin->notify(new AnswerQuestionForClientNotify($fatwa));
            });
            
            return redirect()->back()->with([
                'message'    => trans('frontend/pages/all.fatwa_mes'),
                'alert-type'=>'success'
            ]);
      // }
       return redirect()->back()->with([
           'message'     => trans('frontend/pages/all.fatwa_error'),
           'alert-type' =>'danger'
       ]);
    }


    // contact-us form
    public function contact()
    {
        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        
        return view('frontend.contacts.contact-us',compact('visitors'),['title' => trans('frontend/index/index.contacts')]);
    }
    
    //contact-us 
    public  function do_contact(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name'    =>'required',
            'email'   =>'required|email',
            'message' =>'required' ,
            'phone' =>'required' ,
            
            
        ]);
 
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['name']        = $request->name; 
        $data['email']       = $request->email; 
        $data['message']     = Purify::clean($request->message);
        $data['phone']       = $request->phone; 
      
      $contact=  Contact::create($data);


        
       $admin = User::whereStatus(1)->whereHas('roles', function ($query) {
        $query->whereIn('name', ['admin']);
    })->orderBy('id','desc')->first();
        
        Notification::route('mail' , $admin->email)
        ->notify(new ContactUsMail($contact,$admin));
       

        $reply = Contact::whereStatus(1)->orderBy('id','desc')->first();
        Notification::route('mail' , $reply->email)
        ->notify(new ClientContactUsMail($reply));
       
         
         return redirect()->back()->with([
             'message'    => trans('frontend/pages/all.contact_mes'),
             'alert-type'=>'success'
         ]);   
       
    }

    public function live_air()
    {
        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        
        $live= Live::orderBy('id' , 'desc')->first();
        if($live)
        {
             return view('frontend.live-air.live' ,compact('live','visitors'),['title' => trans('frontend/pages/all.live_title')]) ;
        }
        else{
             return view('frontend.design.errorpage',compact('visitors'));
        }
       
    }


    
    public function about_sheikh()
    {
         $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        
        $setting = Setting::orderBy('id' , 'desc')->first();
        
        return view('frontend.about.sheikh' ,compact('setting','visitors'),['title' => trans('frontend/pages/all.about_title') ]) ;
    }

     
   


    //subscribers
    public  function subscribe(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email'   =>'required|email|unique:subscribers',
        ]);
 
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $data['email']       = $request->email; 
        
      
        Subscriber::create($data);
         
         return redirect()->back()->with([
             'message'    => trans('frontend/pages/all.subscribe_mes') ,
             'alert-type'=>'success'
         ]);   
       
    }

  
     
   public function live_sound()
   {
    $visitors = Visitor::orderBy('id','desc')->first();
    $visitors->increment('visitor_count');
       
       return view('frontend.live-air.live-sound',compact('visitors'),['title' => trans('frontend/pages/all.live_sound_title')]) ;
   }




   
    //search index
    public function search(Request $request)
    {
        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        
    $keyword = isset($request->keyword) && $request->keyword != '' ? $request->keyword : null;

    $lessons = Lesson::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });

        $benefits = ReligiousBenefits::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
        
        $lectures = Lecture::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
        $articles = Article::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });

        $books = Book::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });

          $speeches = Speech::with('category')
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        });
        
        
    if ($keyword != null) {
        $lessons = $lessons->search($keyword, null, true);
         $benefits = $benefits->search($keyword, null, true);
        $lectures = $lectures->search($keyword, null, true);
        $articles = $articles->search($keyword, null, true);
        $books    = $books->search($keyword, null, true);
        $speeches = $speeches->search($keyword, null, true);


    }

    $lessons = $lessons->whereStatus(1)->orderBy('id','desc')->paginate(6);
    $benefits = $benefits->whereStatus(1)->orderBy('id','desc')->paginate(6);
    $lectures = $lectures->whereStatus(1)->orderBy('id','desc')->paginate(6);
    $articles = $articles->whereStatus(1)->orderBy('id','desc')->paginate(6);
    $books    = $books->whereStatus(1)->orderBy('id','desc')->paginate(6);
    $speeches = $speeches->whereStatus(1)->orderBy('id','desc')->paginate(6);


    return view('frontend.search.search', compact('keyword','lessons','lectures','benefits','articles','books','speeches','visitors'));
    }

   

   }


   
   
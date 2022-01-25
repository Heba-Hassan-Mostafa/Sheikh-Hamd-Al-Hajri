<?php

namespace App\Http\Controllers\WebController;

use App\Models\Audio;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\DataTables\LessonDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubscriberLessonNotification;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LessonDataTable $dataTable)
    {
        return $dataTable->render('admin.lessons.index' , ['title' => trans('admin/lessons/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lesson $model)
    {
        $lesson = Lesson::get();
        $categories = Category::whereStatus(1)->pluck('name','id')->toArray();
        return view('admin.lessons.create' , ['title' => trans('admin/lessons/create.title')] ,compact('model','categories','lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name'                => 'required|unique:lessons',
            'category_id'         => 'required',
            'content'             => 'sometimes|nullable',
            'pdf_file'            =>'sometimes|nullable',
            'pdf_file.*'          =>'mimes:doc,pdf,docx,zip',
            'publish_date'        =>'required',
            'status'              =>'required',
            'youtubeLink'         =>'url|sometimes|nullable',
            'audioFile'           =>'sometimes|nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'embedLink'           =>'url|sometimes|nullable',
            'keywords'            =>'required',
            'description'         =>'required',


        ]);

        $lesson = new Lesson;
        $lesson->name = $request->input('name');
        $lesson->category_id = $request->input('category_id');
        $lesson->content = $request->input('content');
        $lesson->publish_date = $request->input('publish_date');
        $lesson->status = $request->input('status');
        $lesson->keywords = $request->input('keywords'); 
        $lesson->description = $request->input('description');



        //uplad pdf
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('lessons');
               $file->move('files/lessons/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
           
            $lesson->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }

      

        $lesson->save();
        
        
        //upload audioFile
        $audio = new Audio();
        $audio->name =$request->input('name');
        $audio->publish_date =$request->input('publish_date');
        $audio->embedLink =$request->input('embedLink');

        
        if($request->hasFile('audioFile'))
        {
            
            $audio_file = $request->file('audioFile');  
        
                
                $extention=$audio_file->getClientOriginalExtension();
                $audioname= $audio_file->getClientOriginalName();
                $filename = $audioname.'_'.time(). '.' . $extention; 
                $audio_file->move('files/audios/' , $filename);
                $audio->audioFile = $filename;
                
               //$lesson->audios()->save($audio);

        }
          //dd($lesson);
        $lesson->audios()->create(['name'=> $request->name  ,'publish_date'=> $request->publish_date,'embedLink' => $request->embedLink,'audioFile'=>$audio->audioFile ]);
        $lesson->videos()->create(['name'=> $request->name , 'youtubeLink' => $request->youtubeLink ]);


        $subscribers=Subscriber::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->email)
            ->notify(new SubscriberLessonNotification($lesson));
        }
        
         session()->flash('success',trans('admin/lessons/messages.text_create_success'));
        return redirect(adminUrl('lesson'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Lesson::findOrFail($id);
        if($model)
        {
            $category = Category::whereStatus(1)->pluck('name','id')->toArray();
            return view('admin.lessons.edit' ,compact('model','category') , ['title' => trans('admin/lessons/edit.title')]);

 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'name'                => 'required',
            'category_id'         => 'required',
            'content'             => 'sometimes|nullable',
            'pdf_file'            =>'sometimes|nullable',
            'pdf_file.*'          =>'mimes:doc,pdf,docx,zip',
            'publish_date'        =>'required',
            'status'              =>'required',
            'youtubeLink'         =>'url|sometimes|nullable',
            'audioFile'           =>'sometimes|nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'embedLink'           =>'url|sometimes|nullable',
            'keywords'            =>'required',
            'description'         =>'required',


        ]);

        $lesson = Lesson::findOrFail($id);
        if($lesson)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
        $lesson->update($request->all());

        
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('lessons');
               $file->move('files/lessons/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $lesson->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }
        $lesson->save();

        foreach($lesson->audios as $audio)
        {
        if($request->hasFile('audioFile'))
        {
            
            $audio_file = $request->file('audioFile');  
        
                
                $extention=$audio_file->getClientOriginalExtension();
                $audioname= $audio_file->getClientOriginalName();
                $filename = $audioname.'_'.time(). '.' . $extention; 
                $audio_file->move('files/audios/' , $filename);
                
                $audio->audioFile = $filename;
                
               //$lesson->audios()->save($audio);

        }
    }
        //dd($lesson);
        $lesson->audios()->update(['name'=> $request->name  ,'publish_date'=> $request->publish_date,'embedLink' => $request->embedLink,'audioFile'=>$audio->audioFile ]);
        $lesson->videos()->update(['name'=> $request->name , 'youtubeLink' => $request->youtubeLink ]);
    
      
        
        session()->flash('success',trans('admin/lessons/messages.text_edit_success'));
        return redirect(adminUrl('lesson'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->videos()->delete();
        $lesson->audios()->delete();
        
        if(!empty($lesson->pdf_file))
             {
            foreach(json_decode($lesson->pdf_file )as $pdf)
            {
                if(File::exists('files/lessons/' . $pdf)){
                    unlink('files/lessons/' . $pdf);
                }
            }
        }
        $lesson->delete();
        session()->flash('success',trans('admin/lessons/messages.text_deleted_success'));
        
        return back();
        
    }


    public function multiDelete() {
		if (is_array(request('item'))) {
            foreach (request('item') as $id)
             {
				$lesson = lesson::findOrFail($id);
                $lesson->videos()->delete();
                $lesson->audios()->delete();


                
                if(!empty($lesson->pdf_file))
             {
            foreach(json_decode($lesson->pdf_file )as $pdf)
            {
                if(File::exists('files/lessons/' . $pdf)){
                    unlink('files/lessons/' . $pdf);
                }
            }
        }
				$lesson->delete();
			}
        } else 
        {
			$lesson = lesson::findOrFail(request('item'));
            $lesson->videos()->delete();
            $lesson->audios()->delete();


            
            if(!empty($lesson->pdf_file))
            {
           foreach(json_decode($lesson->pdf_file )as $pdf)
           {
               if(File::exists('files/lessons/' . $pdf)){
                   unlink('files/lessons/' . $pdf);
               }
           }
       }

       
			$lesson->delete();
		}
		session()->flash('success', trans('admin/lessons/messages.text_deleted_success'));
		return back();
    }
    
  
    
}
<?php

namespace App\Http\Controllers\WebController;

use App\Models\Audio;
use App\Models\Lecture;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\DataTables\LectureDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubscriberNotification;
use App\Notifications\SubscriberLectureNotification;


class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LectureDataTable $dataTable)
    {
        return $dataTable->render('admin.lectures.index' , ['title' => trans('admin/lectures/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lecture $model)
    {
        $lecture = Lecture::get();
        $categories = Category::whereStatus(1)->pluck('name','id')->toArray();
        return view('admin.lectures.create' , ['title' => trans('admin/lectures/create.title')] ,compact('model','categories','lecture'));
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
            'name'                => 'required|unique:lectures',
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

        $lecture = new Lecture;
        $lecture->name = $request->input('name');
        $lecture->category_id = $request->input('category_id');
        $lecture->content = $request->input('content');
        $lecture->publish_date = $request->input('publish_date');
        $lecture->status = $request->input('status');
        $lecture->keywords = $request->input('keywords'); 
        $lecture->description = $request->input('description');


        //upload pdf
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('lectures');
               $file->move('files/lectures/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $lecture->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }

        $lecture->save();
        
        
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
                
               //$lecture->audios()->save($audio);

        }

        
          //dd($lecture);
        $lecture->audios()->create(['name'=> $request->name  ,'publish_date'=> $request->publish_date,'embedLink' => $request->embedLink, 'audioFile'=>$audio->audioFile ]);
        $lecture->videos()->create(['name'=> $request->name , 'youtubeLink' => $request->youtubeLink ]);


        $subscribers=Subscriber::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->email)
            ->notify(new SubscriberLectureNotification($lecture));
        }
        
         session()->flash('success',trans('admin/lectures/messages.text_create_success'));
        return redirect(adminUrl('lecture'));
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
        $model = Lecture::findOrFail($id);
        if($model)
        {
            $category = Category::whereStatus(1)->pluck('name','id')->toArray();
            return view('admin.lectures.edit' ,compact('model','category') , ['title' => trans('admin/lectures/edit.title')]);

 
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

        $lecture = Lecture::findOrFail($id);
        if($lecture)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
        $lecture->update($request->all());

        
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('lectures');
               $file->move('files/lectures/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $lecture->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }
        $lecture->save();

        foreach($lecture->audios as $audio)
        {
        if($request->hasFile('audioFile'))
        {
            
            $audio_file = $request->file('audioFile');  
        
                $extention=$audio_file->getClientOriginalExtension();
                $audioname= $audio_file->getClientOriginalName();
                $filename = $audioname.'_'.time(). '.' . $extention; 
                $audio_file->move('files/audios/' , $filename);
                
                $audio->audioFile = $filename;
                
               //$lecture->audios()->save($audio);

        }
    }
        //dd($lecture);
        $lecture->audios()->update(['name'=> $request->name  ,'publish_date'=> $request->publish_date,'embedLink' => $request->embedLink,'audioFile'=>$audio->audioFile ]);
        $lecture->videos()->update(['name'=> $request->name , 'youtubeLink' => $request->youtubeLink ]);

      
        
        
        session()->flash('success',trans('admin/lectures/messages.text_edit_success'));
        return redirect(adminUrl('lecture'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lecture = Lecture::findOrFail($id);
        $lecture->videos()->delete();
        $lecture->audios()->delete();
        
        if(!empty($lecture->pdf_file))
        {
            foreach(json_decode($lecture->pdf_file )as $pdf)
            {
                if(File::exists('files/lectures/' . $pdf)){
                    unlink('files/lectures/' . $pdf);
                }
            }
        }
       
        $lecture->delete();
        session()->flash('success',trans('admin/lectures/messages.text_deleted_success'));
        
        return back();
        
    }


    public function multiDelete() {
        if (is_array(request('item'))) 
        {
            foreach (request('item') as $id)
             {
				$lecture = Lecture::findOrFail($id);
                $lecture->videos()->delete();
                $lecture->audios()->delete();

                
                if(!empty($lecture->pdf_file))
        {
            foreach(json_decode($lecture->pdf_file )as $pdf)
            {
                if(File::exists('files/lectures/' . $pdf)){
                    unlink('files/lectures/' . $pdf);
                }
            }
        }

        
				$lecture->delete();
			}
		} else {

            
			$lecture = Lecture::findOrFail(request('item'));
            $lecture->videos()->delete();
            $lecture->audios()->delete();

            
            if(!empty($lecture->pdf_file))
             {
            foreach(json_decode($lecture->pdf_file )as $pdf)
            {
                if(File::exists('files/lectures/' . $pdf)){
                    unlink('files/lectures/' . $pdf);
                }
            }
        }

        
			$lecture->delete();
		}
		session()->flash('success', trans('admin/lectures/messages.text_deleted_success'));
		return back();
    }
   
}
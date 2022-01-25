<?php

namespace App\Http\Controllers\WebController;

use App\Models\Audio;
use App\Models\Speech;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\DataTables\SpeechDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubscriberSpeechNotification;


class SpeechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SpeechDataTable $dataTable)
    {
        return $dataTable->render('admin.speeches.index' , ['title' => trans('admin/speeches/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Speech $model)
    {
        $speech = Speech::get();
        $categories = Category::whereStatus(1)->pluck('name','id')->toArray();
        return view('admin.speeches.create' , ['title' => trans('admin/speeches/create.title')] ,compact('model','categories','speech'));
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
            'name'                => 'required|unique:speeches',
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

        $speech = new Speech;
        $speech->name = $request->input('name');
        $speech->category_id = $request->input('category_id');
        $speech->content = $request->input('content');
        $speech->publish_date = $request->input('publish_date');
        $speech->status = $request->input('status');
        $speech->keywords = $request->input('keywords'); 
        $speech->description = $request->input('description');

        
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('speechs');
               $file->move('files/speeches/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $speech->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }
        
        $speech->save();
        
       
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
                
               //$speech->audios()->save($audio);

        }
          //dd($speech);
        $speech->audios()->create(['name'=> $request->name  ,'publish_date'=> $request->publish_date,'embedLink' => $request->embedLink,'audioFile'=>$audio->audioFile ]);
        $speech->videos()->create(['name'=> $request->name , 'youtubeLink' => $request->youtubeLink ]);

        $subscribers=Subscriber::all();

        foreach($subscribers as $subscriber)
        {
            Notification::route('mail' , $subscriber->email)
            ->notify(new SubscriberSpeechNotification($speech));
        }
        
        
         session()->flash('success',trans('admin/speeches/messages.text_create_success'));
        return redirect(adminUrl('speech'));
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
        $model = Speech::findOrFail($id);
        if($model)
        {
         $category = Category::whereStatus(1)->pluck('name','id')->toArray();
         return view('admin.speeches.edit' ,compact('model','category') , ['title' => trans('admin/speeches/edit.title')]);

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

        $speech = Speech::findOrFail($id);
        if($speech)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
        $speech->update($request->all());

        
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('speechs');
               $file->move('files/speeches/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $speech->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }
        
        $speech->save();

        foreach($speech->audios as $audio)
        {
        if($request->hasFile('audioFile'))
        {
            
            $audio_file = $request->file('audioFile');  
        
                
                $extention=$audio_file->getClientOriginalExtension();
                $audioname= $audio_file->getClientOriginalName();
                $filename = $audioname.'_'.time(). '.' . $extention; 
                $audio_file->move('files/audios/' , $filename);
                
                $audio->audioFile = $filename;
                
               //$speech->audios()->save($audio);

        }
    }
        //dd($speech);
        $speech->audios()->update(['name'=> $request->name  ,'publish_date'=> $request->publish_date,'embedLink' => $request->embedLink,'audioFile'=>$audio->audioFile ]);
        $speech->videos()->update(['name'=> $request->name , 'youtubeLink' => $request->youtubeLink ]);

       
        session()->flash('success',trans('admin/speeches/messages.text_edit_success'));
        return redirect(adminUrl('speech'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $speech = Speech::findOrFail($id);
        $speech->videos()->delete();
        $speech->audios()->delete();
        
        
        if(!empty($speech->pdf_file))
             {
            foreach(json_decode($speech->pdf_file )as $pdf)
            {
                if(File::exists('files/speeches/'.$pdf))
                {
                    unlink('files/speeches/'.$pdf);
                }
            }
        }

     
           
        $speech->delete();
        session()->flash('success',trans('admin/speeches/messages.text_deleted_success'));
        
        return back();
        
    }


    public function multiDelete() {
        if (is_array(request('item'))) 
        {
            foreach (request('item') as $id)
             {
				$speech = Speech::findOrFail($id);
                $speech->videos()->delete();
                $speech->audios()->delete();

                
                if(!empty($speech->pdf_file))
                {
               foreach(json_decode($speech->pdf_file )as $pdf)
               {
                   if(File::exists('files/speeches/' . $pdf)){
                       unlink('files/speeches/' . $pdf);
                   }
               }
           }

           
				$speech->delete();
			}
        } 
        else
         {
			$speech = Speech::findOrFail(request('item'));
            $speech->videos()->delete();
            $speech->audios()->delete();

            
            if(!empty($speech->pdf_file))
            {
           foreach(json_decode($speech->pdf_file )as $pdf)
           {
               if(File::exists('files/speeches/' . $pdf)){
                   unlink('files/speeches/' . $pdf);
               }
           }
       }
       
			$speech->delete();
		}
		session()->flash('success', trans('admin/speeches/messages.text_deleted_success'));
		return back();
    }
    
}
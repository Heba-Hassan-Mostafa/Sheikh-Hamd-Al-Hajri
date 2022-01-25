<?php

namespace App\Http\Controllers\WebController;

use App\Models\Fatwas;
use App\Models\Question;
use Illuminate\Http\Request;
use App\DataTables\FatwasDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReplyQuestionForClientInMail;

class FatwasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FatwasDataTable $dataTable)
    {
        return $dataTable->render('admin.fatwas.index' , ['title' => trans('admin/fatwas/index.title'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $model = Fatwas::findOrFail($id);
        

            if($model)
            {
                return view('admin.fatwas.edit' , compact('model') , ['title' => trans('admin/questions/index.title')]);
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
        $this->validate($request,[
            
            'answer'               => 'required',
            'publish_date'         =>'required',
            'mp3File'              =>'sometimes|nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            
        ]);
        $fatwas = Fatwas::findOrFail($id);

        $question = new Question();
        $question->answer       = $request->answer;
        $question->publish_date = $request->publish_date;
        $question->fatwas_id    = $fatwas->id;


        if($request->hasFile('mp3File'))
        {
            
            $audio_file = $request->file('mp3File');  
        
                
                $extention=$audio_file->getClientOriginalExtension();
                $audioname= $audio_file->getClientOriginalName();
                $filename = $audioname.'_'.time(). '.' . $extention; 
                $audio_file->move('files/questions/audios/' , $filename);
                $question->mp3File = $filename;

        }

        $fatwas->question()->create(['answer'=>$request->answer , 'publish_date' =>$request->publish_date , 'fatwas_id'=>$fatwas->id ,'mp3File'=>$question->mp3File]);
        

        

        
           $fatwa = Fatwas::whereStatus(1)->orderBy('id','desc')->first();
        
            Notification::route('mail' , $fatwa->email)
            ->notify(new ReplyQuestionForClientInMail($fatwas));
        

       
        
        session()->flash('success',trans('admin/fatwas/index.text_reply_success'));
        return redirect(adminUrl('fatwas'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fatwas = Fatwas::findOrFail($id);
        $fatwas->delete();

       session()->flash('success',trans('admin/fatwas/index.text_deleted_success'));
        
        return back();
    }

    
    public function multiDelete()
    {

        if (is_array(request('item'))) {
            foreach (request('item') as $id)
             {
				$fatwas = Fatwas::findOrFail($id);
				$fatwas->delete();
			}
		} else {
			$fatwas = Fatwas::findOrFail(request('item'));
			$fatwas->delete();
		}
		session()->flash('success', trans('admin/fatwas/index.text_deleted_success'));
		return back();
       
    }
    
   
    
    public function change(Request $request)
    {
        
        $fatwas = Fatwas::findOrFail($request->id);
        $fatwas->status = $request->status;

        $fatwas->save();
        

        return response()->json(['success'=>'Status change successfully.']);

        
    }

}
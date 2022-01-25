<?php

namespace App\Http\Controllers\WebController;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\QuestionDataTable;
use App\Models\Fatwas;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuestionDataTable $dataTable)
    {
        return $dataTable->render('admin.questions.index' , ['title' => trans('admin/questions/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Question::findOrFail($id);
        if($model)
        {
            $name = $model->fatwas->name;
            $fatwas = $model->fatwas->message;
            return view('admin.questions.edit' , compact('model','fatwas','name') , ['title' => trans('admin/questions/edit.title')]);

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

        $question = Question::findOrFail($id);


       $question->update($request->all());


        if($request->hasFile('mp3File'))
        {
            
            $audio_file = $request->file('mp3File');  
        
                
                $extention=$audio_file->getClientOriginalExtension();
                $audioname= $audio_file->getClientOriginalName();
                $filename = $audioname.'_'.time(). '.' . $extention; 
                $audio_file->move('files/questions/audios/' , $filename);
                $question->mp3File = $filename;

        }
        $question->save();
        
        session()->flash('success',trans('admin/questions/messages.text_edit_success'));
        return redirect(adminUrl('answer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
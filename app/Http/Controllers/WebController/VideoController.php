<?php

namespace App\Http\Controllers\WebController;

use App\DataTables\VideoDataTable;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VideoDataTable $dataTable)
    {
        return $dataTable->render('admin.videos.index' , ['title' => trans('admin/videos/index.title'),]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Video::findOrFail($id);
        $user->delete();
        session()->flash('success',trans('admin/videos/messages.text_deleted_success'));
        
        return back();
    }

    public function multiDelete()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
               $video = Video::findOrFail($id);
               $video->delete();
                
            }
        }else
        {
            $video = Video::findOrFail(request('item'));
            $video->delete();
        }
        session()->flash('success',trans('admin/videos/messages.text_deleted_success'));
        return back();
    }
}
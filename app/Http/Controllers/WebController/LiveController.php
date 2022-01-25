<?php

namespace App\Http\Controllers\WebController;


use App\Models\Live;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Live $model)
    {
        if ($model->all()->count() > 0) {
            
            $model = Live::find(1);
        }

        return view('admin.live-air.index' ,compact('model') , ['title' => trans('admin/live/index.title')]);
    }

  
    public function update(Request $request)
    {
        $this->validate($request,
        [
            'live_link' => 'url|nullable',
        ],[],
        [
            'live_link' => trans('admin/live/index.link'),
            
        ]);
        
    

        if (Live::all()->count() > 0) {
            Live::find(1)->update($request->all());
        } else {
            Live::create($request->all());
        }
        
         session()->flash('success', trans('admin/live/index.update_record'));
        
         return redirect(adminUrl('live'));
        
    }

   
}
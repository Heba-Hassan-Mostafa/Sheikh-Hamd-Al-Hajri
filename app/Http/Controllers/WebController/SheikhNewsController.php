<?php

namespace App\Http\Controllers\WebController;

use App\Models\SheikhNew;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SheikhNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SheikhNew $model)
    {
        if ($model->all()->count() > 0) {
            
            $model = SheikhNew::find(1);
        }

        return view('admin.news.index' ,compact('model') , ['title' => trans('admin/news/index.title')]);
    }

  
    public function update(Request $request , $id)
    {
        $this->validate($request,
        [
            'first_news'  => 'nullable',
            'second_news' => 'nullable',
            'third_news'  => 'nullable',
            
        ]);
        
    

        if (SheikhNew::all()->count() > 0) {
            SheikhNew::find(1)->update($request->all());
        } else {
            SheikhNew::create($request->all());
        }
        
         session()->flash('success', trans('admin/news/index.update_record'));
        
         return redirect(adminUrl('news'));
    }

  
}
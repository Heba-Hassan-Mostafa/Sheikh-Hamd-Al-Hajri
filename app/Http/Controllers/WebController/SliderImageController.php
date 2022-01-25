<?php

namespace App\Http\Controllers\WebController;

use App\Models\ImageSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;

class SliderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.images.index' , ['title' => trans('admin/images/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ImageSlider $model)
    {
        return view('admin.images.create' , ['title' => trans('admin/images/create.title')] ,compact('model'));

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
            'title'              => 'required|unique:image_sliders',
            'image'              =>'required|image|mimes:png,jpg,jpeg,gif,bmp',
            'link'               =>'required|url',
        ]);

        $slider = new ImageSlider;
        $slider->title = $request->input('title');
        $slider->link = $request->input('link');

        //upload image 
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename = time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){
                
                $constraint->aspectRatio();
            })->save('files/images/'. $filename , 100);
            
            $slider->image = $filename;
            
        }

        $slider->save();
        session()->flash('success',trans('admin/images/messages.text_create_success'));
        return redirect(adminUrl('slider'));
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
        $model = ImageSlider::findOrFail($id);
        
        if($model)
        {
            
        return view('admin.images.edit' , compact('model'), ['title' => trans('admin/images/edit.title')]);

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
            'title'              => 'required',
            'image'              =>'image|mimes:png,jpg,jpeg,gif,bmp',
            'link'               =>'required|url',
        ]);

         $slider = ImageSlider::findOrFail($id);
         $slider->update($request->all());


        //update image
        if($request->hasFile('image'))
        {

              //delete old image
              if ($slider->image != '')
              {
                 if (File::exists('files/images/' . $slider->image))
                 {
                     unlink('files/images/' . $slider->image);
                 }
              }

              
            $image = $request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename = time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){
                
                $constraint->aspectRatio();
            })->save('files/images/'. $filename , 100);
            
            $slider->image = $filename;
           
        }
        
        
        $slider->save();
        session()->flash('success',trans('admin/images/messages.text_edit_success'));
        return redirect(adminUrl('slider'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = ImageSlider::findOrFail($id);
        if(!empty($slider->image))
        {
            if(File::exists('files/images/'.$slider->image))
            {
                unlink('files/images/'.$slider->image);
            }
            
        }

            
        $slider->delete();
        session()->flash('success',trans('admin/images/messages.text_deleted_success'));
        
        return back();
    }

    public function multiDelete()
     {
		if (is_array(request('item'))) {
            foreach (request('item') as $id)
             {
                $slider = ImageSlider::findOrFail($id);
                
                if(!empty($slider->image))
            {
            if(File::exists('files/images/'.$slider->image))
            {
                unlink('files/images/'.$slider->image);
            }
            
             }
             
             
            
				$slider->delete();
			}
		} else {
            $slider = ImageSlider::findOrFail(request('item'));
            if(!empty($slider->image))
            {
            if(File::exists('files/images/'.$slider->image))
            {
                unlink('files/images/'.$slider->image);
            }
            
            }
            
			$slider->delete();
		}
		session()->flash('success', trans('admin/images/messages.text_deleted_success'));
		return back();
	}

    public function change(Request $request)
    {
        
        $slider = ImageSlider::findOrFail($request->id);
        $slider->status = $request->status;

        $slider->save();
        

        return response()->json(['success'=>'Status change successfully.']);

        
    }
}
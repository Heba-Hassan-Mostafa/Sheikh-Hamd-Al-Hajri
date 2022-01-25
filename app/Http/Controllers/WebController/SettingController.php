<?php

namespace App\Http\Controllers\WebController;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;



class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Setting $model)
    {
        if ($model->all()->count() > 0) {

            $model = Setting::find(1);
        }

        return view('admin.settings.index' ,compact('model') , ['title' => trans('admin/settings/index.title')]);
    }



    public function update(Request $request, $id)
    {
       $data = $this->validate($request,
        [

		'logo'                  =>validateImage(),
		'icon'                  =>validateImage(),
		'email'                 =>'nullable|email',
		'phone'                 =>'nullable',
        'instagram_url'         =>'url|nullable',
        'facebook_url'          =>'url|nullable',
        'youtube_url'           =>'url|nullable',
		'twitter_url'           =>'url|nullable',
        'telegram_url'          =>'url|nullable',
        'blog'                  =>'url|nullable',
        'about_sheikh'          =>'nullable',
        'siteName'              =>'nullable',
        'keywords'              =>'nullable',
        'description'           =>'nullable',
        'status'                =>'',
        'message_maintenance'   =>'nullable',
        'main_languge'          =>'',
        'site_right'             =>'nullable',

        ],[],
        [
            'logo' => trans('admin/settings/index.logo'),
            'icon' => trans('admin/settings/index.icon'),

        ]);

        if($request->hasFile('logo'))
        {
              //delete old image
              if ($data['logo'] != '')
              {
                 if (File::exists('files/home/images/' . setting()->logo))
                 {
                     unlink('files/home/images/' . setting()->logo);
                 }
              }

            $image = $request->file('logo');
            $extention=$image->getClientOriginalExtension();
            $filename = time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){

                $constraint->aspectRatio();
            })->save('files/home/images/'. $filename , 100);

            $data['logo'] = $filename;

        }


        if($request->hasFile('icon'))
        {
             //delete old image
             if ($data['icon'] != '')
             {
                if (File::exists('files/home/images/' . setting()->icon))
                {
                    unlink('files/home/images/' . setting()->icon);
                }
             }

            $image = $request->file('icon');
            $extention=$image->getClientOriginalExtension();
            $filename = time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){

                $constraint->aspectRatio();
            })->save('files/home/images/'. $filename , 100);

            $data['icon'] = $filename;

        }





        if (Setting::all()->count() > 0) {

            Setting::orderBy('id', 'desc')->update($data);

        } else {
            Setting::create($request->all());
        }

         session()->flash('success', trans('admin/settings/index.update_record'));

         return redirect(adminUrl('settings'));

    }


}
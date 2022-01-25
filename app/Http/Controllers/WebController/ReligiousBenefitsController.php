<?php

namespace App\Http\Controllers\WebController;

use App\Models\ReligiousBenefits;
use App\Models\Category;
use Illuminate\Http\Request;
use Image;
use App\DataTables\ReligiousBenefitsDataTable;
use App\Http\Controllers\Controller;

class ReligiousBenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReligiousBenefitsDataTable $dataTable)
    {
        return $dataTable->render('admin.benefits.index' , ['title' => trans('admin/benefits/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ReligiousBenefits $model)
    {
        $benefits = ReligiousBenefits::get();
        $categories = Category::whereStatus(1)->pluck('name','id')->toArray();
        return view('admin.benefits.create' , ['title' => trans('admin/benefits/create.title')] ,compact('model','categories','benefits'));
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
            'name'                => 'required|unique:religiousbenefits',
            'category_id'         => 'required',
            'content'             => 'required',
            'publish_date'        =>'required',
            'status'              =>'required',
            'keywords'            =>'required',
            'description'         =>'required',
          


        ]);

        $benefits = new ReligiousBenefits;
        $benefits->name = $request->input('name');
        $benefits->category_id = $request->input('category_id');
        $benefits->content = $request->input('content');
        $benefits->publish_date = $request->input('publish_date');
        $benefits->status = $request->input('status');
        $benefits->keywords = $request->input('keywords'); 
        $benefits->description = $request->input('description');
        //dd($benefits);
         $benefits->save();
         session()->flash('success',trans('admin/benefits/messages.text_create_success'));
        return redirect(adminUrl('religious-benefits'));
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
        $model = ReligiousBenefits::findOrFail($id);
        if($model)
        {
         $category = Category::whereStatus(1)->pluck('name','id')->toArray();
         return view('admin.benefits.edit' ,compact('model','category') , ['title' => trans('admin/benefits/edit.title')]);

 
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
            'content'             => 'required',
            'publish_date'        =>'required',
            'status'              =>'required',
            'keywords'            =>'required',
            'description'         =>'required',
          


        ]);

        $benefits = ReligiousBenefits::findOrFail($id);
        if($benefits)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
        $benefits->update($request->all());
        
        //dd($benefits);
        $benefits->save();
        session()->flash('success',trans('admin/benefits/messages.text_edit_success'));
        return redirect(adminUrl('religious-benefits'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $benefits = ReligiousBenefits::findOrFail($id);
        $benefits->delete();
        session()->flash('success',trans('admin/benefits/messages.text_deleted_success'));
        
        return back();
        
    }


    public function multiDelete() {
		if (is_array(request('item'))) {
            foreach (request('item') as $id)
             {
				$benefits = ReligiousBenefits::findOrFail($id);
				$benefits->delete();
			}
		} else {
			$benefits = ReligiousBenefits::findOrFail(request('item'));
			$benefits->delete();
		}
		session()->flash('success', trans('admin/benefits/messages.text_deleted_success'));
		return back();
	}
}
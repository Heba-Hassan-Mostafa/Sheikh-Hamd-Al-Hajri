<?php

namespace App\Http\Controllers\WebController;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index' , ['title' => trans('admin/categories/index.title')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $model)
    {
       return view('admin.categories.create' , ['title' => trans('admin/categories/create.title')] ,compact('model'));
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
            'name'                => 'required|unique:categories',
            'status'              =>'required',
        ]);

        $input = $request->all();
        $category = Category::create($input);

       
        session()->flash('success',trans('admin/categories/messages.text_create_success'));
        return redirect(adminUrl('category'));
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
        $model = Category::findOrFail($id);
        
        return view('admin.categories.edit' , compact('model'), ['title' => trans('admin/categories/edit.title')]);
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
            'status'              =>'required',
        ]);
        $input = $request->all();
        $category=Category::findOrfail($id);
        if($category)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
       $category->update($input); 
      
        session()->flash('success',trans('admin/categories/messages.text_edit_success'));
        return redirect(adminUrl('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
      
        
            Cache::forget('global_categories');
        
        $category->delete();
        session()->flash('success',trans('admin/categories/messages.text_deleted_success'));
        
        return back();
        
    }

    public function multiDelete()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
               $category = Category::findOrFail($id);
               

               $category->delete();
               
                
            }
        }else
        {
            $category = Category::findOrFail(request('item'));
            
            $category->delete();
        }
        session()->flash('success',trans('admin/categories/messages.text_deleted_success'));
        return redirect(adminUrl('category'));
    }
    
}
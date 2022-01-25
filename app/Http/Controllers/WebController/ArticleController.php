<?php

namespace App\Http\Controllers\WebController;

use App\Models\Article;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\ArticleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubscriberArticleNotification;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleDataTable $dataTable)
    {
        return $dataTable->render('admin.articles.index' , ['title' => trans('admin/articles/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $model)
    {
        $article = Article::get();
        $categories = Category::whereStatus(1)->pluck('name','id')->toArray();
        return view('admin.articles.create' , ['title' => trans('admin/articles/create.title')] ,compact('model','categories','article'));
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
            'name'                => 'required|unique:articles',
            'category_id'         => 'required',
            'content'             => 'required',
            'pdf_file'            =>'sometimes|nullable',
            'pdf_file.*'          =>'mimes:doc,pdf,docx,zip',
            'publish_date'        =>'required',
            'status'              =>'required',
            'image'               =>'image|mimes:png,jpg,jpeg,gif,bmp|sometimes|nullable',
            'keywords'            =>'required',
            'description'         =>'required',
          


        ]);

        $article = new Article;
        $article->name = $request->input('name');
        $article->category_id = $request->input('category_id');
        $article->content = $request->input('content');
        $article->publish_date = $request->input('publish_date');
        $article->status = $request->input('status');
        $article->keywords = $request->input('keywords'); 
        $article->description = $request->input('description');

        
      
        
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('articles');
               $file->move('files/articles/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $article->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }

        //dd($article);
         $article->save();


         $subscribers=Subscriber::all();

         foreach($subscribers as $subscriber)
         {
             Notification::route('mail' , $subscriber->email)
             ->notify(new SubscriberArticleNotification($article));
         }
         
         session()->flash('success',trans('admin/articles/messages.text_create_success'));
        return redirect(adminUrl('article'));
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
        $model = Article::findOrFail($id);
        if($model)
        {
            $category = Category::whereStatus(1)->pluck('name','id')->toArray();
            return view('admin.articles.edit' ,compact('model','category') , ['title' => trans('admin/articles/edit.title')]);

 
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
            'pdf_file'            =>'sometimes|nullable',
            'pdf_file.*'          =>'mimes:doc,pdf,docx,zip',
            'publish_date'        =>'required',
            'status'              =>'required',
            'image'               =>'image|mimes:png,jpg,jpeg,gif,bmp,svg|sometimes|nullable',
            'keywords'            =>'required',
            'description'         =>'required',
          


        ]);

        $article = Article::findOrFail($id);
        if($article)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
        $article->update($request->all());
            
    
        
        //upload pdf
        if($request->hasFile('pdf_file'))
        {
        
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('articles');
               $file->move('files/articles/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $article->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }

        
        //dd($article);
        $article->save();
        session()->flash('success',trans('admin/articles/messages.text_edit_success'));
        return redirect(adminUrl('article'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        
            // if(!empty($article->image))
            // {
            //     if(File::exists('files/articles/images/'.$article->image))
            //     {
            //         unlink('files/articles/images/'.$article->image);
            //     }
                
            // }
            
            if(!empty($article->pdf_file))
            {
                foreach(json_decode($article->pdf_file )as $pdf)
                {
                    if(File::exists('files/articles/' . $pdf)){
                        unlink('files/articles/' . $pdf);
                    }
                }
            }
            

            $article->delete();
            session()->flash('success',trans('admin/articles/messages.text_deleted_success'));
            
            return back();
        
      
       
        
    }


    public function multiDelete() {
		if (is_array(request('item'))) {
            foreach (request('item') as $id)
             {
                $article = Article::findOrFail($id);
            //     if(!empty($article->image))
            //    {
            //     if(File::exists('files/articles/images/'.$article->image))
            //     {
            //         unlink('files/articles/images'.$article->image);
            //     }
                
            //    }
                if(!empty($article->pdf_file))
                {
                    foreach(json_decode($article->pdf_file )as $pdf)
                    {
                        if(File::exists('files/articles/' . $pdf)){
                            unlink('files/articles/' . $pdf);
                        }
                    }
                }
               
				$article->delete();
            }
            
        }
         else
         {
            $article = Article::findOrFail(request('item'));
            // if(!empty($article->image))
            // {
            //     if(File::exists('files/articles/images/'.$article->image))
            //     {
            //         unlink('files/articles/images'.$article->image);
            //     }
                
            // }
            
            if(!empty($article->pdf_file))
             {
                foreach(json_decode($article->pdf_file )as $pdf)
                {
                    if(File::exists('files/articles/' . $pdf)){
                        unlink('files/articles/' . $pdf);
                    }
                }
             }
             
			$article->delete();
		}
		session()->flash('success', trans('admin/articles/messages.text_deleted_success'));
		return back();
    }
    
}
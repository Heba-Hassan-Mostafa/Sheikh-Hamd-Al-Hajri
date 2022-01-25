<?php

namespace App\Http\Controllers\WebController;

use App\Models\Book;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SubscriberBookNotification;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookDataTable $dataTable)
    {
        return $dataTable->render('admin.books.index' , ['title' => trans('admin/books/index.title')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Book $model)
    {
        $book = Book::get();
        $categories = Category::whereStatus(1)->pluck('name','id')->toArray();
        return view('admin.books.create' , ['title' => trans('admin/books/create.title')] ,compact('model','categories','book'));
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
            'name'                => 'required|unique:books',
            'category_id'         => 'required',
            'note'                => 'sometimes|nullable',
            'pdf_file'            =>'required',
            'pdf_file.*'          =>'mimes:doc,pdf,docx,zip',
            'publish_date'        =>'required',
            'status'              =>'required',
            'image'               =>'image|mimes:png,jpg,jpeg,gif,bmp|sometimes|nullable',
            'keywords'            =>'required',
            'description'         =>'required',
          


        ]);

        $book = new Book;
        $book->name = $request->input('name');
        $book->category_id = $request->input('category_id');
        $book->note = $request->input('note');
        $book->publish_date = $request->input('publish_date');
        $book->status = $request->input('status');
        $book->keywords = $request->input('keywords'); 
        $book->description = $request->input('description');


            //upload image 
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename = $book->slug.'_'.time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){
                
                $constraint->aspectRatio();
            })->save('files/books/images/'. $filename , 100);
            
            $book->image = $filename;
           
        }
        
        //upload pdf
        if($request->hasFile('pdf_file'))
        {
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
               
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('books');
               $file->move( 'files/books/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $book->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }

        //dd($book);
         $book->save();
          $subscribers=Subscriber::all();

         foreach($subscribers as $subscriber)
         {
             Notification::route('mail' , $subscriber->email)
             ->notify(new SubscriberBookNotification($book));
         }
         session()->flash('success',trans('admin/books/messages.text_create_success'));
        return redirect(adminUrl('book'));
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
        $model = Book::findOrFail($id);
        if($model)
        {
            $category = Category::whereStatus(1)->pluck('name','id')->toArray();
            return view('admin.books.edit' ,compact('model','category') , ['title' => trans('admin/books/edit.title')]);

 
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
            'note'                => 'sometimes|nullable',
            'pdf_file'            =>'nullable',
            'pdf_file.*'          =>'mimes:doc,pdf,docx,zip',
            'publish_date'        =>'required',
            'status'              =>'required',
            'image'               =>'image|mimes:png,jpg,jpeg,gif,bmp,svg|sometimes|nullable',
            'keywords'            =>'required',
            'description'         =>'required',
          


        ]);

        $book = Book::findOrFail($id);
        if($book)
        {
            $input['name'] = $request->name;
            $input['slug'] = '';

        }
        $book->update($request->all());
            

        //update image
        if($request->hasFile('image'))
        {

              //delete old image
              if ($book->image != '')
              {
                 if (File::exists('files/books/images/' . $book->image))
                 {
                     unlink('files/books/images/' . $book->image);
                 }
              }

              
            $image = $request->file('image');
            $extention=$image->getClientOriginalExtension();
            $filename = $book->slug.'_'.time(). '.' . $extention;
            Image::make($image->getRealPath())->resize(800 , null , function($constraint){
                
                $constraint->aspectRatio();
            })->save('files/books/images/'. $filename , 100);
            
            $book->image = $filename;
           
        }
        
        
        if($request->hasFile('pdf_file'))
        {   
            $pdf_file = $request->file('pdf_file');
            
            foreach($pdf_file as $file)
            {
               
                $extention=$file->getClientOriginalExtension();
                $pdf_name= $file->getClientOriginalName();
                $filename = $pdf_name.'_'.time(). '.' . $extention ;
               // $request->file('file')->store('books');
               $file->move( 'files/books/' , $pdf_name);
               
               $data[] = $pdf_name;    
            }
           
            $book->pdf_file = $file->pdf_file =json_encode($data,JSON_UNESCAPED_UNICODE) ;
           
        }

        
        //dd($book);
        $book->save();
        session()->flash('success',trans('admin/books/messages.text_edit_success'));
        return redirect(adminUrl('book'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if(!empty($book->image))
        {
            if(File::exists('files/books/images/'.$book->image))
            {
                unlink('files/books/images/'.$book->image);
            }
            
        }

        if(!empty($book->pdf_file))
            {
                foreach(json_decode($book->pdf_file )as $pdf)
                {
                    if(File::exists('files/books/' . $pdf)){
                        unlink('files/books/' . $pdf);
                    }
                }
            }

            
        $book->delete();
        session()->flash('success',trans('admin/books/messages.text_deleted_success'));
        
        return back();
        
    }


    public function multiDelete() {
		if (is_array(request('item'))) {
            foreach (request('item') as $id)
             {
                $book = Book::findOrFail($id);
                
                if(!empty($book->image))
            {
            if(File::exists('files/books/images/'.$book->image))
            {
                unlink('files/books/images/'.$book->image);
            }
            
             }
             
                 if(!empty($book->pdf_file))
            {
                foreach(json_decode($book->pdf_file )as $pdf)
                {
                    if(File::exists('files/books/' . $pdf)){
                        unlink('files/books/' . $pdf);
                    }
                }
            }
            
				$book->delete();
			}
		} else {
            $book = Book::findOrFail(request('item'));
            if(!empty($book->image))
            {
            if(File::exists('files/books/images/'.$book->image))
            {
                unlink('files/books/images/'.$book->image);
            }
            
            }

            if(!empty($book->pdf_file))
            {
                foreach(json_decode($book->pdf_file )as $pdf)
                {
                    if(File::exists('files/books/' . $pdf)){
                        unlink('files/books/' . $pdf);
                    }
                }
            }

            
			$book->delete();
		}
		session()->flash('success', trans('admin/books/messages.text_deleted_success'));
		return back();
    }
    
   
}
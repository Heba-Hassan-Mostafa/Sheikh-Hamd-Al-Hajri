<?php

namespace App\Http\Controllers\WebController;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {

        return $dataTable->render('admin.users.index' , ['title' => trans('admin/users/index.title'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $model)
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create' , ['title' => trans('admin/users/create.title')] ,compact('model','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:users',
            'mobile'        => 'required|numeric',
            'password'      => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['email_verified_at'] = Carbon::now();
        $data['mobile']         = $request->mobile;
        $data['password']       = bcrypt($request->password);
        //$data['receive_email']  = $request->receive_email;

        if ($image = $request->file('image')) {
            $filename = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save('files/users/' . $filename, 100);
            $data['image']  = $filename;
        }

        $user = User::create($data);
        $user->assignRole($request->input('roles'));
        session()->flash('success',trans('admin/users/messages.text_create_success'));
        return redirect(adminUrl('user'));
    
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
        $model = User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $model->roles->pluck('name','name')->all();
        return view('admin.users.edit' , compact('model','roles','userRole'), ['title' => trans('admin/users/edit.title')]);
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
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:users,email,'.$id,
            'mobile'        => 'required|numeric',
            'password'      => 'nullable|min:8',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::whereId($id)->first();

        if ($user) {
            $data['name']           = $request->name;
            $data['email']          = $request->email;
            $data['mobile']         = $request->mobile;
            if (trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }
            //$data['receive_email']  = $request->receive_email;

            if ($image = $request->file('image')) {
                if ($user->image != '') {
                    if (File::exists('files/users/' . $user->image)) {
                        unlink('files/users/' . $user->image);
                    }
                }
                $filename = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
                Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('files/users/' . $filename, 100);
                $data['image']  = $filename;
            }
        }
       $user->update($data);
       
       DB::table('model_has_roles')->where('model_id',$id)->delete();
       $user->assignRole($request->input('roles'));
       
        session()->flash('success',trans('admin/users/messages.text_edit_success'));
        return redirect(adminUrl('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('success',trans('admin/users/messages.text_deleted_success'));
        
        return back();
        
    }

    

    public function multiDelete()
    {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
               $user = User::findOrFail($id);
               $user->delete();
                
            }
        }else
        {
            $user = User::findOrFail(request('item'));
            $user->delete();
        }
        session()->flash('success',trans('admin/users/messages.text_deleted_success'));
        return redirect(adminUrl('user'));
    }
    
    public function changePassword()
    {
        return view('admin.users.reset-password', ['title' => trans('admin/users/messages.title')] );
    }

    public function changePasswordSave(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'current_password'  => 'required',
            'password'          => 'required|confirmed'
        ]);
        
        if($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user=Auth::user();
        
     if (Hash::check($request->input('current_password'), $user->password))
        {
            
            $user->password = bcrypt($request->input('password'));
            
            $user->save;
            
            session()->flash('success',trans('admin/users/messages.text_change_password'));
            return redirect(adminUrl('user'));
            
        }
        else{
            session()->flash('error',trans('admin/users/messages.text_change_password_error'));
            return view('admin.users.reset-password');
        }
     
    }
    public function edit_info()
    {
        return view('admin.users.user-info', ['title' => trans('admin/users/info.title')]);
    }



    public function update_info(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'mobile'        => 'required|numeric',
            //'receive_email' => 'required',
            'image'         => 'nullable|image|max:20000,mimes:jpeg,jpg,png'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['mobile']         = $request->mobile;
       // $data['receive_email']  = $request->receive_email;

        if ($image = $request->file('image')) {
            if (auth()->user()->image != ''){
                if (File::exists('/files/users/' .auth()->user()->image)){
                    unlink('/files/users/' .auth()->user()->image);
                }
            }
            $filename = Str::slug(auth()->user()->name).'.'.$image->getClientOriginalExtension();
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save('files/users/' . $filename, 100);

            $data['image'] = $filename;
        }

        $update = Auth::user()->update($data);

        if ($update) {

            session()->flash('success',trans('admin/users/info.information_updated'));
            return back();

            
          
        } else {


            session()->flash('danger',trans('admin/users/info.wrong'));
            return back();

           
        }
    }
    
     public function change(Request $request)
    {
        
        $user = User::findOrFail($request->id);
        $user->status = $request->status;

        $user->save();
        

        return response()->json(['success'=>'Status change successfully.']);

        
    }

}
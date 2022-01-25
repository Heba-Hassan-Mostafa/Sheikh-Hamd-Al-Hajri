<?php

namespace App\Http\Controllers\FrontendController\Authentcation;

use App\Models\Client;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function resetForm()
    {
        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        
        return view('frontend.auth.passwords.reset',compact('visitors'));
    }


    public function reset(Request $request)
    {
        $validation = Validator::make($request->all() ,[
            
            'pin_code' => 'required',
            'email'   => 'required|email',
            'password' => 'required|confirmed',   
        ]);
        
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $client = Client::where('pin_code' , $request->pin_code)
        ->where('pin_code' , '!=' , 0)
        ->where('email' , $request->email)->first();

        if($client)
        {
            $client->password = bcrypt($request->password);
            $client->pin_code = null;

            if($client->save())
            {
                return redirect()->route('frontend.index')->with([
                    'message'    => 'تم تعديل الرقم السرى بنجاح',
                    'alert-type'=>'success'
                ]);
            }
            else{
                return back()->with([
                    'message'    => 'حدث خطأ ، حاول مرة أخرى',
                    'alert-type'=>'danger'
                ]);
            }
        }
        else{
            return back()->with([
                'message'    => 'هذا الكود غير صالح',
                'alert-type'=>'danger'
            ]);
        }
    }

}
<?php

namespace App\Http\Controllers\FrontendController\Authentcation;

use App\Models\Client;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{


    
    public function loginForm()
    {
        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        return view('frontend.auth.login',compact('visitors'));
    }

    public function do_login(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name'    =>'required',
            'email'    =>'required',
            'password' =>'required'
            
        ]);

        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $client = Client::where('email' , $request->email)->first();
        if($client)
        {
            if(Hash::check($request->password, $client->password))
            {
                if ($client->status == 0) {

                      return redirect()->route('frontend.index')->with([
                'message'    => 'تم حظر حسابك .. اتصل بالادارة',
                'alert-type'=>'danger'
            ]);
                }
                $request->session()->put('data',$request->input());
                  return redirect()->route('frontend.index')->with([
                'message'    => 'تم تسجيل الدخول بنجاح',
                'alert-type'=>'success',
            ]);
           
            }
            else{
                return redirect('/login')->with([
                    'message'     => 'كان هناك شيء خاطئ',
                    'alert-type' =>'danger'
                ]);
            }
        }
        else{
            return redirect('/login')->with([
                'message'     => 'كان هناك شيء خاطئ',
                'alert-type' =>'danger'
            ]);
            }      
        
    }


    public function do_logout(Request $request)
    {
        session()->forget('data');
       
        return  redirect('/');
    }

    
}
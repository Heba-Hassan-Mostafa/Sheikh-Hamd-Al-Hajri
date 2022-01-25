<?php

namespace App\Http\Controllers\FrontendController\Authentcation;

use App\Models\Client;
use App\Models\Visitor;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    public function showRequestForm()
    {
        $visitors = Visitor::orderBy('id','desc')->first();
        $visitors->increment('visitor_count');
        
        return view('frontend.auth.passwords.email',compact('visitors'));
    }

    public function sendResetEmail(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email'    =>'required',
           
        ]);

        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $client = Client::where('email' , $request->email)->first();

        if ($client) 
        {
            $code = rand(1111, 9999);
            $update = $client->update(['pin_code' => $code]);
            if ($update) {

                // send email
                Mail::to($client->email)
                ->send(new ResetPassword($client));

                return redirect()->route('frontend.password.reset')->with(
                    [
                        'pin_code_for_test' => $code,
                        'mail_fails'        => Mail::failures(),
                        'email'             => $client->email,
                        'message'     =>' برجاء فحص الايميل',
                        'alert-type' =>'success'
                    ]);
            }
        else{
            return with([
                'message'     =>'حدث خطأ ، حاول مرة أخرى',
                'alert-type' =>'danger'
            ]);
            }       
        
         }
         else{
            return with([
                'message'     =>'حدث خطأ ، حاول مرة أخرى',
                'alert-type' =>'danger'
            ]);
            }    
}

}
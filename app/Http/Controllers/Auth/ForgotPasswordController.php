<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Person;
use App\Mail\ForgotPasswordMail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;




class ForgotPasswordController extends Controller
{

    public function forgot()
    {
        return view('pages.forgotPassword');
    }

    public function password(Request $request)
    {
       
        $existingUser = Person::where('email',$request->email)->first();

        if ($existingUser == null) {
            return redirect()->back()->with(['error'=>'O email não existe!']);
        }

        $user = Person::find($existingUser->id);
        $this->sendEmail($user);

        return redirect()->back()->with(['success'=>'Foi enviado um email para alterar a sua palavra-passe!']);
    }

    public function sendEmail($user){
        $email = new ForgotPasswordMail($user);
        $email->user_email = $user->email;
        $email->user_id = $user->id;

        Mail::to( $email->user_email)->send($email);
    }

    public function reset($id){
        $user = Person::find($id);

        return view('pages.resetPassword',  ['user' => $user]);
    }
   
   
}
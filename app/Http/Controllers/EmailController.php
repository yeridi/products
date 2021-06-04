<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::firstWhere('email', $request->get('email'));
        if ($user) {
            $token = Str::random(80).''.$user->id;
            
            $user->update(['token' => $token]);
            $data = ['route' => route('email.token',['token' => $token])];

            Mail::to($user->email)->send(new EmailNotification($data));
            
        }

    }

    public function verifyToken(Request $request)
    {
        $token = $request->get('token');
        $user = User::firstWhere('token',$token);

        if ($user) {
            return view('auth.reset_form', compact('user'));
        }
        return;
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        User::find($id)->update(['password' => Hash::make($request->get('password'))]);
        return redirect()->route('login');
    }
}

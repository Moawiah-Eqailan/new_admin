<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContactUsController extends Controller
{
    function index()
    {
        return view('UsersPage.Contact');
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $subject = $request->subject;
        $email = $request->email;
        $messageContent = $request->message;
        $phone = $request->phone;
        $city = $request->city;
    
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'البريد الإلكتروني غير صالح!');
        }
    
        Mail::send('UsersPage.Contact', compact('name', 'subject', 'email', 'messageContent', 'phone', 'city'), function ($message) use ($email, $subject) {
            $message->to($email);
            $message->subject($subject);
        });
    
        return back()->with('success', 'تم إرسال الرسالة بنجاح!');
    }
    
}

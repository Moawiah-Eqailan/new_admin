<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'city' => 'required|string|max:255',
        ]);

        ContactUs::create([
            'user_id' => Auth::id(),
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'user_city' => $request->city,
        ]);

        Log::info('Message sent to database');


        return redirect()->back()->with('success', 'Your message has been sent successfully. Thank you for contacting us');
    }
}

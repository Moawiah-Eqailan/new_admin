<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 

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
            'state' => 'required|string|max:255',
        ]);

        ContactUs::create([
            'user_id' => Auth::id(),
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'user_city' => $request->city,
            'user_state' => $request->state,
        ]);

        Log::info('Message sent to database');

        return redirect()->back()->with('success', 'Your message has been sent successfully. Thank you for contacting us');
    }

    // public function showMessages()
    // {
    //     // Fetch the last 5 messages from the 'contacts' table
    //     $messages = DB::table('contact_us')
    //         ->orderBy('created_at', 'desc')
    //         ->take(5)
    //         ->get();

    //         dd($messages); 
    //         return view('layouts.navbar', compact('messages'));
    // }
    public function showMessages()
    {
        $totalMessages = ContactUs::all(); 

        return view('layouts.navbar', compact('totalMessage'));
    }

}

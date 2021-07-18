<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function addContact()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate(
            [
                'address' => 'required|max:255',
                'email' => 'required|unique:contacts|email',
                'phone' => 'required|unique:contacts|digits:10',
            ],
            [
                'address.required' => 'Address field cannot be empty',
                'email.required' => 'Email field cannot be empty',
                'phone.required' => 'Phone field cannot be empty',
            ]
        );

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()

        ]);
        return redirect()->route('contact.index')->with('success', 'Contacts inserted successfully');
    }

    public function contact_us()
    {
        $contact = DB::table('contacts')->latest()->first();
        return view('pages.contact', compact('contact'));
    }
    public function contactForm(Request $request){

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()

        ]);
        return redirect()->route('contact')->with('success', 'Your message was sent successfully');

    }
    public function storeMessage(){
        $messages = ContactForm::all();
        return view('admin.contact.message',compact('messages'));
    }

}

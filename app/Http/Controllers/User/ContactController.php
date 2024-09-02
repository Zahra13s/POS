<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class ContactController extends Controller
{
    //
     //contact page
     public function userContact(){
        return view('user.contact.contact');
    }

    //create contact
    public function contact(Request $request){
        $validation = $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = [
            'user_id' => $request->userId,
            'subject' => $request->subject,
            'message' => $request->message,
            'image' => $request->image
        ];

        Contact::create($data);
        return back();
    }

    //direct contact list
    public function contactList(){
        $contact = Contact::where('user_id', Auth::user()->id)->get();
        $reply = Reply::where('user_id', Auth::user()->id)->first();
        // dd($contact);
        return view('user.contact.contactList',compact('contact', 'reply'));
    }


    // reply content
    public function contactReply($id){
        $contact = Contact::select('contacts.*', 'replies.subject as reply_subject', 'replies.message as reply_message')
        ->leftJoin('replies', 'contacts.id', 'replies.contact_id')
        ->where('replies.contact_id', $id)
        ->get();
        // dd($contact);
        return view('user.contact.contactReply',compact('contact'));
    }
}

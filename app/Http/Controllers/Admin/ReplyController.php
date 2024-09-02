<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    //direct reply page
    public function list(){
        $contact = Contact::select('contacts.*', 'users.name as user_name', 'users.nickname')
        ->leftJoin('users', 'users.id', 'contacts.user_id')
        ->get();
        return view('admin.reply.list', compact('contact'));
    }

    public function replyMessage($id){
        $contact = Contact::where('id',$id)->first();
        // dd($contact);
        return view('admin.reply.replyMessage',compact('contact'));
    }

    public function messageReply(Request $request){
        // dd($request->all());
        $validation = $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = [
            'contact_id' => $request->contactId,
            'user_id' => $request->userId,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        Reply::create($data);
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\{User, Message, MessagesFiles};

class MessagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inbox()
    {
    	// Get all messages belonging to a single user
    	$user = Auth()->user();
    	
    	$inbox_messages = Message::where('reciever_id', $user->id)->get();

        $unread = Message::where([['reciever_id', $user->id], ['message_status_id', 2]])->count();

        if($user->hasRole('Client')){
            $users = User::where('role_id', 1)->get();
        }else{
            $users = User::all();
        }

    	return view('messages.inbox', compact('inbox_messages', 'unread', 'users'));
    }

    public function sent()
    {
        // Get all messages belonging to a single user
        $user = Auth()->user();

        $sent_messages = Message::where('sender_id', $user->id)->get();

        return view('messages.sent', compact('sent_messages'));
    }

    public function show($id)
    {
    	// Get to read a single message
    	$user = Auth()->user();

        $files = null;

    	$message = Message::where('id', $id)->orWhere([['sender_id', $user->id], ['reciever_id', $user->id]])->first();

        if($message->files = true){
            $files = MessagesFiles::where('message_id', $id)->get();
        }

        // Update message status
        Message::where([['id', $id], ['reciever_id', $user->id]])->update(['message_status_id' => 1]);

    	return view('messages.view', compact('message', 'files'));
    }

    public function store(Request $request)
    {
        // Store message
        $user = Auth()->user();

        $this->validate($request, [
            'recipient' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);


        $message = new Message;
        $message->sender_id = $user->id;
        $message->reciever_id = $request->recipient;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->message_status_id = 2;
        $message->files = ($request->hasFile('file'))?'1':'0';
        $message->save();

        // dd($request->hasFile('file'));

        if ($request->hasFile('file')) {
            
            $files = $request->file('file');

            // Perform uploads
            foreach($files as $file):
                $filename = time().$file->getClientOriginalName();
                // request()->file('files')->move(public_path('upload'), $request->file('files')->getClientOriginalName());
                // $uploadedFile = $request->file('file');
                // $filename = time().$uploadedFile->getClientOriginalName();
                Storage::disk('local')->putFileAs(
                    'files/'.(int)auth()->user()->id,
                    $file,
                    $filename
                );

                // Send files into the DB
                $file = new messagesFiles;
                $file->message_id = $message->id;
                $file->name = $filename;
                $file->save();
            endforeach;
        }

        return redirect()->back()->with(['success' => 'Your message was sent successfully.']);
    }

}
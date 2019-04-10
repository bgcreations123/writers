<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\{User, Message, Attachment};

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

    public function index()
    {
    	// Get all messages belonging to a single user
    	$user = Auth()->user();
    	
    	$inbox_messages = Message::where('reciever_id', $user->id)->get();
    	$outbox_messages = Message::where('sender_id', $user->id)->get();

        $unread = Message::where([['reciever_id', $user->id], ['message_status_id', 2]])->count();

        if($user->hasRole('Client')){
            $users = User::where('role_id', 1)->get();
        }else{
            $users = User::all();
        }

    	return view('messages.index', compact('inbox_messages', 'outbox_messages', 'unread', 'users'));
    }

    public function show($id)
    {
    	// Get to read a single message
    	$user = Auth()->user();

    	$message = Message::where('id', $id)->orWhere([['sender_id', $user->id], ['reciever_id', $user->id]])->first();
        if(!empty($message->attachment)){
            $files = Attachment::where('message_id', $id)->get();
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

        if ($request->hasFile('file')){
            $filename = time().$request->file('file')->getClientOriginalName();
            // request()->file('files')->move(public_path('upload'), $request->file('files')->getClientOriginalName());
            // Perform uploads
            $uploadedFile = $request->file('file');
            // $filename = time().$uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs(
                'files/'.(int)auth()->user()->id,
                $uploadedFile,
                $filename
            );
            $message->attachment = true;
        }

        $message->save();

        if ($request->hasFile('file')){
            $file = new Attachment;
            $file->message_id = $message->id;
            $file->file_name = $filename;
            $file->save();
        }

        return redirect()->back()->with(['success' => 'Your message was sent successfully.']);
    }

}
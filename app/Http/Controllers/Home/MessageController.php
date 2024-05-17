<?php

namespace App\Http\Controllers;

use App\Models\Message;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
			public function index()
			{
					$messages = Message::where('to_user_id', Auth::id())->get();
					return view('messages.index', compact('messages'));
			}

			public function store(Request $request)
			{
					$message = new Message();
					$message->from_user_id = Auth::id();
					$message->to_user_id = $request->to_user_id;
					$message->message = $request->message;
					$message->save();

					return back()->with('success', 'Message sent successfully!');
			}
	}

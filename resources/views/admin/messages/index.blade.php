@extends('layouts.templates')

@section('page_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

<h1>Messages</h1>
<ul>
@foreach($messages as $message)
    <li>{{ $message->fromUser->name }}: {{ $message->message }}</li>
@endforeach
</ul>

<form method="post" action="{{ route('messages.store') }}">
    @csrf
    <input type="text" name="to_user_id" placeholder="Recipient ID">
    <textarea name="message" placeholder="Write your message here"></textarea>
    <button type="submit">Send</button>
</form>

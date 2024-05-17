@extends('errors::layout')

@section('title', __('Not Found'))

@section('code', '404')

@section('message')
<p>
	We are very very sorry
  The page you are looking for might have been removed had its name
  changed or is temporarily unavailable. Please try again
</p>
<a href="{{ route('home') }}">Homepage</a>
@endsection

@extends('tashtebk.english.emails.layouts.master')

@section('content') 
<h1>Welcome {{$new_user->username}}</h1>
<p>You successfully registered to Tashtebk.</p>
<a target="_blank" href="{{route('en.email.verify',[$new_user->verified_token])}}">Click here for confirmation !</a>

@endsection

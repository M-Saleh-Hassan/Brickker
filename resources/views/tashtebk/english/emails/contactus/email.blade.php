@extends('tashtebk.english.emails.layouts.master')

@section('content')
    <h1>Contact Us Message </h1>
    <label>Name :</label><span>{{$contact->full_name}}</span>
    <br>
    <label>Email :</label><span>{{$contact->email}}</span>
    <br>
    <label>Phone :</label><span>{{$contact->mobile}}</span>
    <br>
    <label>Message :</label><span>{{$contact->message}}</span>
@endsection






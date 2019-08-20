@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>Contact Us Message </h1>
    <label>Name :</label><span>{{$name}}</span>
    <br>
    <label>Email :</label><span>{{$email}}</span>
    <br>
    <label>Phone :</label><span>{{$phone}}</span>
    <br>
    <label>Message :</label><span>{{$contact_message}}</span>
@endsection






@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>Hello! {{$name}}</h1>
    <label>Your confirmation code :</label><span>{{$confirmation_code}}</span>
    <!--<a target="_blank" href=" http://66.45.251.54/~myacademy/my_academy/public/register/Confirmation/en?name={{$name}}&rand_url={{$rand_url}}&email={{$email}}&user_id={{$user_id}}">Click here for confirmation !</a>-->
@endsection



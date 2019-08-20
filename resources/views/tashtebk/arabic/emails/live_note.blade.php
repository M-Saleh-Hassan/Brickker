@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>Hello! {{$name}}</h1>
    
    <article>
        Your Live Lesson On " {{$course}} " Will Start Soon , Get Ready! 
    </article>
@endsection
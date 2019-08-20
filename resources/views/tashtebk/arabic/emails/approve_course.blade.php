@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>Hello! {{$name}}</h1>
    
    <article>
        Your Course " {{$course}} " was approved on MyAcademy, thank you for supporting MyAcademy.
    </article>
@endsection
@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>New Course Has Been Created, Please Approve It</h1>
    
    <article>
        Course Title :  " {{$course}} " 
    </article>
@endsection
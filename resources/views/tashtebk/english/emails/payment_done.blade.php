@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>Hello! {{$name}}</h1>
    
    <article>
        You have been enrolled  into " {{$course}} " successfully , thank you for choosing MyAcademy.
        <!--<br><a href="route('en.course.show', ['course_id' => $course_id])">Access The Course</a>-->
    </article>
@endsection
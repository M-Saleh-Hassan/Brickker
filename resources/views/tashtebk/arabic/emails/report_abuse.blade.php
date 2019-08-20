@extends('myacademy.english.emails.layouts.master')

@section('content') 
    <h1>Report Abuse Message </h1>
    <label>Username :</label><span>{{$username}}</span>
    <br>
    <label>Reason :</label><span>{{$reason}}</span>
    <br>
    <label>Message :</label><span>{{$contact_message}}</span>
@endsection
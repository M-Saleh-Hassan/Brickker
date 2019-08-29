@extends('tashtebk.english.emails.layouts.master')

@section('content')
<h1>Dear {{$new_user->username}},</h1>
<br>
<p>Thank your for registering on <a target="_blank" href="https://www.brickker.com">our website</a><br><br>
To verify your email address and start completing your profile on our website
Please click the following link below.
</p>
<a target="_blank" href="{{route('en.email.verify',[$new_user->verified_token])}}">Activation-Link</a>
<br><br>
<p>Thank you</p>
<p>Brickker Team</p>
@endsection

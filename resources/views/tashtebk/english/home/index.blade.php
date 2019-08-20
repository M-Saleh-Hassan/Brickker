@extends('tashtebk.english.layouts.master')

@section('content') 
    <!--<div id="body">-->
    <main class="main1">
        @include('tashtebk.english.home.header')

        @include('tashtebk.english.home.categories')

        @include('tashtebk.english.home.featured_products')
    </main>
    <!--</div>-->
@endsection
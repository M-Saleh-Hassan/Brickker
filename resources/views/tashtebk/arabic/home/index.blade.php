@extends('tashtebk.arabic.layouts.master')

@section('content') 
    <!--<div id="body">-->
    <main class="main1">
        @include('tashtebk.arabic.home.header')

        @include('tashtebk.arabic.home.categories')

        @include('tashtebk.arabic.home.featured_products')
    </main>
    <!--</div>-->
@endsection
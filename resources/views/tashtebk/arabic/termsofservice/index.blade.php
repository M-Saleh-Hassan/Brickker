@extends('tashtebk.arabic.layouts.master')

@section('content')
    <main class="gray relative" >
        <!--<section class="banner">-->
        <!--  <div class="container">-->
        <!--      <ul class="breadcrumb">-->
        <!--          <li><a href="{{route('en.home.index')}}">Home</a></li>-->
        <!--      </ul>-->
        <!--  </div>-->
        <!--</section>-->
        <section class="product">
           <div class="container">
               <div class="row">
                         <h3>بنود الخدمة</h3>
                              <div class="divider"></div>
                             <p>{!! $term->content_ar !!}</p>

                </div>
            </div>
        </section>
    </main>
@endsection

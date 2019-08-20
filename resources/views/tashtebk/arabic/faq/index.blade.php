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
                <div class="">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">الأسئلة الشائعة</h4>
                    </div>
                    
                    <div class="modal-body">
                        @foreach($faqs as $faq)
                            <h3>{!! $faq->question_ar !!}</h3>
                            <div class="divider"></div>
                            {!! $faq->answer_ar !!}
                            <!--<p>dfgsfgasgsfgagddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddfasgasg</p>-->
                            <!--<ul>-->
                            <!--    <li>wash your hand</li>-->
                            <!--    <li>wash your hand</li>-->
                            <!--    <li>wash your hand</li>-->
                            <!--    <li>wash your hand</li>-->
                            <!--</ul>-->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
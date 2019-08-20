@extends('tashtebk.english.layouts.master')

@section('content')
    <main class="gray relative" >
        <section class="product">
           <div class="container">
               <div class="row">
                         <h3>Terms Of Service</h3>
                              <div class="divider"></div>
                             <p>{!! $term->content_en !!}</p>

                </div>
            </div>
        </section>
    </main>
@endsection

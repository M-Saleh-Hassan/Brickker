@extends('tashtebk.english.layouts.master')

@section('content')
    <main class="gray relative" >
        <section class="product">
           <div class="container">
               @foreach ($items as $item)
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h3>{!! $item->header_en !!}</h3>
                            <div class="divider"></div>
                            <p>{!! $item->text_en !!}</p>
                        </div>

                        <div class="col-md-6 col-sm-12 img d-flex justify-content-center" style="justify-content: center;margin-top:50px;display: flex;">
                            <img src="{{asset('') . $item->image->link}}" alt="" class="">
                        </div>
                    </div>
               @endforeach


            </div>
            </div>
        </section>
    </main>
@endsection

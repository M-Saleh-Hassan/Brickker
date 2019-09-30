@extends('tashtebk.arabic.layouts.master')

@section('content')
<!--<div id="body">-->
<main>
    <section class="gray section">
        <div class="container relative">
            <div class="overlay-loader hidden">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            @if($user->getUserType() != NULL)
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-info box text-center">
                        <img src="{{asset('').$user->avatar}}" alt="">
                        <h4>{{$user->username}}</h4>
                        <p>{{$user->short_title}}</p>
                        <button class="btn btn-home chat-control"> <i class='fa fa-comment'></i> راسل</button>
                    </div>
                    <div class="box-about box">
                        <h4>عني</h4>
                        <div class="item">
                            <h5><div class="fa fa-map-marker"></div> الموقع</h5>
                            <p>{{$user->country->title_ar}}</p>
                            <h5><div class="fa fa-phone"></div> التليفون</h5>
                            <p>@auth{{Auth::user()->getProviderPhone($user->id)}}@endauth</p>

                            <h5><div class="fa fa-briefcase"></div> العمل</h5>
                            <p>{{ucfirst($user->getUserType())}}</p>
                            <h5><div class="fa fa-building"></div> الشركة</h5>
                            <p>{{$user->company_name}}</p>
                        </div>
                        <div class="item">
                            <h5><div class="fa fa-pencil"></div> التصنيفات</h5>
                            <?php $i=0; ?>
                            @foreach ($user->categories as $category)
                                <?php if($i==4)$i=0?>
                                @if($i==0)<span class="label danger">{{$category->title}}</span>@endif
                                @if($i==1)<span class="label primary">{{$category->title}}</span>@endif
                                @if($i==2)<span class="label success">{{$category->title}}</span>@endif
                                @if($i==3)<span class="label warning">{{$category->title}}</span>@endif
                                <?php $i++;?>
                            @endforeach
                        </div>
                        <div class="item">
                            <h5><div class="fa fa-file-text-o"></div> السيرة الئاتية</h5>
                            <p>{{$user->bio}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#products">المنتجات</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="products" class="tab-pane fade in active">
                                <div class="row product-pane">
                                    @foreach ($user->products as $product)
                                        <div class="col-md-3">
                                            <div class="p-item relate-item">
                                                <div class="img-item">
                                                    <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}" target="_blank">
                                                        <img src="{{asset('').$product->image}}" alt="" style="height:110px;">
                                                    </a>
                                                </div>

                                                <div class="p-info">
                                                    <h4 class="edit-form-title">{{$product->title}} </h4>
                                                    <div>
                                                        <a href="#" class="add-favorite" data-productid="{{$product->id}}"><i class="@auth{{$product->getFavoriteClass(Auth::user()->id)}}@endauth"></i></a>
                                                        <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                                                        <span class="price-p">{{$product->current_price}} {{$active_currency->title_ar}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Chat -->
            @auth
            <div class="chat-window col-xs-9 col-sm-4 col-md-3 hidden"  id="chat_window_1">
                <div class="panel panel-default" >
                    <a class="chat-close" href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    <div class="panel-heading top-bar" >
                        <h3 class="panel-title"><span class="fa fa-comment"></span> {{$user->username}} </h3>
                        <a href="#" class="text-right"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                    </div>

                    <div class="panel-body msg_container_base">
                        <div class="contain-chat">
                          @foreach(Auth::User()->getUserMessages($user->id) as $message)
                            @if($message->to->id == Auth::User()->id)
                            <div class="incoming_msg">
                                <div class="incoming_msg_img"> <img src="{{asset('') . $message->from->avatar}}" alt=""> </div>
                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <p>{{$message->message}}</p>
                                        <!--<span class="time_date"> 11:01 AM    |    June 9</span></div>-->
                                        <span class="time_date">{{$message->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                            @else
                              <div class="outgoing_msg">
                                <div class="sent_msg">
                                  <p>{{$message->message}}</p>
                                  <!--<span class="time_date"> 11:01 AM    |    June 9</span> </div>-->
                                  <span class="time_date">{{$message->created_at}}</span> </div>
                              </div>
                            @endif
                          @endforeach
                        </div>

                        <div class="type_msg">
                            <div class="input_msg_write">
                                <form class="form-horizontal" method="POST" action="{{ route('ar.chat.send') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="message" class="write_msg" placeholder="Type a message" />
                                    <input type="hidden" name="user" value="{{$user->id}}" />
                                    <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endauth

    </section>
</main>
<!--</div>-->
@endsection
@section('custom-js')
    $('.product-pane').on('click', '.add-favorite', function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var product_id   = $( this ).data( "productid" );
        var current_class = $( this ).children().attr('class');
        var target_class  = 'fa fa-heart';
        if(current_class == target_class) target_class = 'fa fa-heart-o';

        $.ajax({
            url:"{{ route('ar.product.favorite') }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, product_id:product_id, target_class:target_class},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('*[data-productid="' + data.product_id + '"]').children().attr('class', data.target_class);
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    $('.chat-control').on('click', function(){
        $('.chat-window').toggleClass('hidden');
    });

@endsection

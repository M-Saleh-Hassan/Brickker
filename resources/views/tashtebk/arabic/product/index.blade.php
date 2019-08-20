@extends('tashtebk.arabic.layouts.master')

@section('content') 
<!--<div id="body" class="gray">-->
<main class="gray relative">
    <div class="overlay-loader hidden">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('ar.home.index')}}">الرئيسية</a></li>
            <li><a href="{{route('ar.category.show_all',['category'=>$product->category->title])}}">{{$product->category->title}}</a></li>
            <li>{{$product->title}}</li>
        </ul>
    </div>
    </section>
    <section class="product" style="padding:20px 0 50px">
        <div class="container">
            <div class="row" style="margin-bottom:30px;">
                <div class="col-md-5 text-center">
                    <div style="text-align:center;">
                        <div class="magnify">
                            <img class="xzoom" src="{{asset('').$product->image}}" xoriginal="{{asset('').$product->image}}" />
                            @if($product->discount > 0)
                            <div class="product__price-tag">
                              <p class="product__price-tag-price">{{$product->current_price}} {{$active_currency->title_ar}}</p>	
                            </div>
                            @endif
                        </div>
                        
                        <div style="margin-top:10px">
                            <a href="{{asset('').$product->image}}" style="display: inline-block;">
                                <img class="xzoom-gallery" width="83" height="70" src="{{asset('').$product->image}}" xpreview="{{asset('').$product->image}}" />
                            </a>
                            @foreach($product->images as $image)
                            <a href="{{asset('').$image->image}}" style="display: inline-block;">
                                <img class="xzoom-gallery" width="83" height="70" src="{{asset('').$image->image}}" xpreview="{{asset('').$image->image}}" />
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-7 product-right-details">
                    <div class="desc">
                        <div class="review-prdct">
                             <ul class="list-unstyled">
                                  <li class="fa fa-star"></li>
                                  <li class="fa fa-star"></li>
                                  <li class="fa fa-star"></li>
                                  <li class="fa fa-star"></li>
                                  <li class="fa fa-star-o"></li>
                             </ul>
                        </div>
                        <h4>{{$product->title}}</h4>
                        <!--<span>by :</span>--> <a class="saler" href="{{route('en.profile.show', [$product->user->username_tag])}}" target="_blank"> <i  class="fa fa-user"></i> {{$product->user->real_name}}</a>
                        <p class="pric @if($product->discount > 0) line-through @endif">{{$product->price}} {{$active_currency->title_ar}}/{{$product->unit->title}}</p>
                        <p>{{$product->short_description}}</p>
                        <div class="count">
                            <button type="button" id="sub" class="sub">-</button>
                            <input type="number" id="1" value="1" min="1" max="99" name="quantity"/>
                            <button type="button" id="add" class="add">+</button>
                        </div>
                        @if(Auth::check())
                            <a href="#" class="btn-sec add-to-cart" >اضف الى العربة </a>
                        @else
                            <a href="#" class="btn-sec add-to-cart" type="button" data-toggle="modal" data-target="#Login-Modal">اضف الى العربة </a>
                        @endif
                        <ul class="list-unstyled">
                            <!--<li > <i class="fa fa-plus"></i> Handling Charge : 0.00</li>-->
                             <li><a href="https://www.logic-host.com/~tashtebak/tashtebat/public/policy/ar"> <i  class="fa fa-check"></i> سياسة الارجاع </a></li>
                            @auth<li><a href="" type="button"   data-toggle="modal" data-target="#spottedmistake" data-content="#spottedmistake"><i  class="fa fa-comment-o"></i>  لديك مشكلة : اخبرنا بها</a></li>@endauth
                        
                         </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
            @if($product->ads()->count())
             <div class="row overflow-hidden">
              <div class="col-12 ">
                  <div class="img-warpp">
                      <!--<img src="https://hackernoon.com/hn-images/1*j41hMsYft-ifSvXuWOb7Gg.png" alt="">-->
                          <img src="{{asset('') . $product->ads()->first()->media()->link}}" alt="">
                  </div>
              </div>
            </div>
            @endif
    </section>
    <section class="tabs-product sections">
        <div class="container">
            <div class=" nav-review">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab"  href="#spec">عن المنتج</a></li>
                    <li><a data-toggle="tab"  href="#desc">المواصفات</a></li>
                    <li><a data-toggle="tab"  href="#review">التقييمات</a></li>   
                </ul>
            </div>
              <div class="tab-content">
                <div id="spec" class="tab-pane fade in active">
                    <h3>عن المنتج</h3>
                    <ul class="list-unstyled ">
                        <li><span class="col-md-3 text-left title-bold">البراند</span><span class="col-md-9 text-left">{{$product->brand}}</span></li>
                        <li><span class="col-md-3 text-left title-bold">نوع الموديل</span> <span class="col-md-9 text-left">{{$product->model_name}}</span></li>
                        <!--<li><span class="col-md-3 text-left title-bold">Weight in kilogram</span> <span class="col-md-9 text-left">Weight in kilogram</span></li>-->
                        <!--<li><span class="col-md-3 text-left title-bold">Packing Type</span> <span class="col-md-9 text-left">Packing Type</span></li>-->
                        <li>
                            <span class="col-md-3 text-left title-bold">درجة المنتج</span> <span class="col-md-9 text-left">{{$product->grade}}</span>
                        </li>
                    </ul>
                </div>
                <div id="desc" class="tab-pane fade">
                  <h3>المواصفات</h3>
                  <p class="desc">{{$product->long_description}}</p>
                </div>
                <div id="review" class="tab-pane fade ">
                  <h3>التقييم</h3>
                  <div class="review">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="rate text-center">
                                  <span>{{$product->average_rating}}</span>
                                  <ul class="list-unstyled">
                                      @for($i=0; $i< round($product->average_rating); $i++)
                                      <li class="fa fa-star"></li>
                                      @endfor
                                      @for($i=0; $i< 5-round($product->average_rating); $i++)
                                      <li class="fa fa-star-o"></li>
                                      @endfor
                                  </ul>
                                  <p class="out">{{$product->average_rating}} من 5</p>
                                  <p>{{$product->reviews()->count()}} تقييمات</p>
                              </div>
                          </div>
                          <div class="col-md-4">
                                @for($i=5; $i> 0; $i--)
                                <div class="row">
                                    <div class="col-md-3 text-center" style="padding:0"><span class="progress-left">{{$i}} نجوم</span></div>
                                    <div class="col-md-7" style="padding:0">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{$product->getStarsPercentage($i)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$product->getStarsPercentage($i)}}%">
                                                <span class="sr-only">{{$product->getStarsPercentage($i)}}% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center" style="padding:0"><span class="progress-right">({{$product->getStarsCount($i)}})</span></div>
                                </div>
                                @endfor
                         </div>
                          <div class="col-md-4">
                              <div class="rate-modal">
                                  <p>{{$product->getRecommendedPercentage()}}% من المستخدمين ينصحون بالمنتج لصديق لهم</p>
                                  @if(Auth::check() && Auth::user()->getProductReview($product->id))
                                      <h4>You already rated this before:</h4>
                                      <ul class="list-unstyled">
                                          @for($i=0; $i<Auth::user()->getProductReview($product->id); $i++)
                                              <li class="fa fa-star"></li>
                                          @endfor
                                          @for($i=0; $i<5-Auth::user()->getProductReview($product->id); $i++)
                                              <li class="fa fa-star-o"></li>
                                          @endfor
                                      </ul>
                                  @else  
                                      <h4>قيّم المنتج :</h4>
                                      <a type="button"   data-toggle="modal" data-target="#review_modal" class="rating">
                                          <ul class="list-unstyled">
                                              <li class="fa fa-star-o" data-content="1"></li>
                                              <li class="fa fa-star-o" data-content="2"></li>
                                              <li class="fa fa-star-o" data-content="3"></li>
                                              <li class="fa fa-star-o" data-content="4"></li>
                                              <li class="fa fa-star-o" data-content="5"></li>
                                         </ul>
                                      </a>
                                  @endif
                              </div>
                          </div>
                      </div>
                      
                      <div class="row no-review">
                          <p>({{$product->reviews()->count()}}) تقييمات</p>
                      </div>
                      
                      <div class="row">
                          <ul class="list-unstyled customers-reviews">
                              @foreach($product->reviews as $review)
                              <li class="review-box">
                                  <ul class="list-unstyled ">
                                      @for($i=0; $i<$review->rate; $i++)
                                      <li class="fa fa-star"></li>
                                      @endfor
                                      @for($i=0;$i< 5-$review->rate; $i++)
                                      <li class="fa fa-star-o"></li>
                                      @endfor
                                  </ul>
                                  <p>بواسطة <span class="boldd">{{$review->user->username}} </span>في  {{date("d M Y", strtotime($review->created_at))}}</p>
                                  <p>{{$review->review}}</p>
                                  <h5>الشىء الجيد حول هذا المنتج :</h5>
                                  <p>{{$review->good}}</p>
                                  <h5>الشىء السيء حول هذا المنتج :</h5>
                                  <p>{{$review->bad}}</p>
                                  <a class="helpful helpful-button" data-review-id="{{$review->id}}"><i class=" fa fa-thumbs-up"></i> مفيد({{$review->getHelpful(1)}})</a>
                                  <a class="helpful no not-helpful-button" data-review-id="{{$review->id}}"><i class=" fa fa-thumbs-down"></i> غير مفيد({{$review->getHelpful(0)}})</a>
                              </li>
                              @endforeach
                          </ul>
                      </div>
                      
                  </div>
                </div>
              </div>
        </div>
        <div class="clearfix"></div>
    </section>
    @if( empty($product->getRelatedProducts()) )
    <section class="section gray">
        <div class="container">
            <div class="row">
                <h3 class="title-related">منتجات ذات صلة :</h3>
                <div class="swiper-container swiper-related">
                    <div class="swiper-wrapper">
                      @foreach($product->getRelatedProducts() as $related)
                      <div class="swiper-slide">
                       <div class="p-item">
                            <div class="img-item">
                                    <img src="{{asset('').$related->image}}" alt="" style="height:110px;">
                            </div>
                            
                            <div class="p-info">
                                <h4>{{$related->title}}</h4>
                                <div>
                                     <a href="#"><i class="fa fa-heart-o"></i></a>
                                    <a href="{{route('ar.product.index', ['title_tag'=>$related->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                                    <span class="price-p">{{$related->current_price}} {{$active_currency->title_ar}}</span>
                                </div>
                            </div>
                        </div>
                      </div>
                      @endforeach
                      
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <!--<div class="swiper-button-next"></div>-->
                    <!--<div class="swiper-button-prev"></div>-->
                  </div>
            </div>
        </div>
    </section>
    @endif
    @if(Auth::check())
        <a class="check-out" type="button"   data-toggle="modal" data-target="#checkout-modal-box">
    @else
        <a class="check-out" type="button"   data-toggle="modal" data-target="#Login-Modal">
    @endif
      <i class="fa fa-shopping-cart" ></i>
      <span class="no-product current-checkout" data-content="{{ $orders_count }}">{{ $orders_count }}</span>
    </a> 
    
     <!-- Modal -->
     <div class="modal fade in" id="spottedmistake" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog extend-modal-width" role="document">
	  <div class="modal-content">
		<div class="modal-header project-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		  <h4 class="modal-title" id="myModalLabel">لديك مشكلة</h4>
		</div>
		<div class="modal-body">
			<form class="project-form" method="POST"  action="{{route('ar.report.send')}}" enctype="multipart/form-data">
			    @csrf
                <div class="form-group col-md-12 text-center col">
                        <input type="text" name="message" style="width:95%" placeholder="اكتب رسالتك" required> 
                        <input type="hidden" name="product" value="{{$product->id}}">
                </div>
                
                <div class="row">
                    <div class="col-md-3 center-button">
                        <div class="form-group">
                            <button type="submit" class="btn btn-home">ارسال</button>
                        </div>
                    </div>
                </div>
                
			</form>
		</div>
	  </div>
	</div>
</div>
        <div class="modal fade" id="checkout-modal-box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content  checkout">
              
              <div class="modal-body checkout-modal-body relative">
                  <div class="overlay-loader hidden">
                      <i class="fa fa-refresh fa-spin"></i>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4>حقيبة تسوقك</h4>
                  <div class="table-responsive">
                      <table class="table">
                        <thead>
                            <tr>
                               <th >Product</th>
                               <th class="text-center" width="100px">Qty</th>
                               <th class="text-center" width="100px">Remove</th>
                               <th class="text-center" width="100px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {!! $orders_tbody !!}
                        </tbody>
                      </table>
                  </div>
              </div>
              
            </div>
          </div>
        </div>
</main>
<!--</div>-->
@endsection

@section('custom-js')
@if(Auth::check())
    $('.product-right-details').on('click', '.add-to-cart', function(){

        var CSRF_TOKEN     = $( 'meta[name="csrf-token"]' ).attr('content');
        var quantity       = $( 'input[name="quantity"]' ).val();
        var checkout_count = $( '.current-checkout' ).data( "content" );
        var new_count      = parseInt(checkout_count) + parseInt(quantity);
        
        $.ajax({
            url:"{{ route('ar.checkout.order.add', [$product->id, Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, quantity:quantity, new_count:new_count},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $( '.current-checkout' ).html( data.new_count );
                $( '.current-checkout' ).data( "content", data.new_count );
                $( "tbody" ).prepend( data.new_row);
                $(".overlay-loader").toggleClass('hidden');
            }
        });
        
    });
    
    $('.checkout-modal-body').on('click', '.delete-order', function(){
        if(confirm('Are you sure you want to Delete ?'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var order_id   = $( this ).data( "orderid" );
            
            $.ajax({
                url:"{{ route('ar.checkout.order.delete') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, order_id:order_id},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    if(data.result) 
                    {
                        $('*[data-orderid="' + data.result + '"]').closest('tr').remove();
                        var checkout_count = $( '.current-checkout' ).data( "content" ) - 1;
                        $( '.current-checkout' ).html( checkout_count );
                        $( '.current-checkout' ).data( "content", checkout_count );
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
        
    });
    
    $('.rating').on('click', 'li', function(){
    
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var rate       = $( this ).data( "content" );

        $('.rating ul').html('');
        
        $.ajax({
            url:"{{ route('ar.product.review.add', [$product->title_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, rate:rate},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $(' .rate-modal ').prepend(data.review_modal);
                $("#review_modal").modal('show');
                for(var i=5; i> 0; i--)$('.rating ul').prepend('<li class="fa fa-star-o" data-content="' + (i) + '"></li>');
                $(".overlay-loader").toggleClass('hidden');
            }
        });
        
    });
    
    $('.rate-modal').on('click', '.submit-review', function(){
        
        var CSRF_TOKEN = $( 'meta[name="csrf-token"]' ).attr('content');
        var rate       = $( 'input[name="rate"]' ).val(); 
        var good       = $( 'input[name="good"]' ).val(); 
        var bad        = $( 'input[name="bad"]' ).val(); 
        var recommend  = $( 'input:radio[name=recommend]:checked' ).val(); 
        var review     = $( 'textarea[name="review"]' ).val(); 
        if(!review) return alert('Please fill review field');
        
        $.ajax({
            url:"{{ route('ar.product.review.save', [$product->title_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, rate:rate, good:good, bad:bad, recommend:recommend, review:review},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $("#review_modal").modal('hide');
                alert(data.message);
                $('.rating ul').html('<p>You rated this product  ' + data.rate + ' stars</p>');
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    
    $('.customers-reviews').on('click', '.helpful-button', function(){
    
        var CSRF_TOKEN = $( 'meta[name="csrf-token"]' ).attr('content');
        var review_id = $( this ).data( "review-id" );
        
        $.ajax({
            url:"{{ route('ar.product.review.helpful', [$product->title_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, review_id:review_id},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                alert(data.message);
                $('*[data-review-id="' + data.review_id + '"]').remove();
                $(".overlay-loader").toggleClass('hidden');
            }
        });
        
    });
    
    $('.customers-reviews').on('click', '.not-helpful-button', function(){
    
        var CSRF_TOKEN = $( 'meta[name="csrf-token"]' ).attr('content');
        var review_id = $( this ).data( "review-id" );
        
        $.ajax({
            url:"{{ route('ar.product.review.nothelpful', [$product->title_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, review_id:review_id},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                alert(data.message);
                $('*[data-review-id="' + data.review_id + '"]').remove();
                $(".overlay-loader").toggleClass('hidden');
            }
        });
        
    });
@endif
@endsection
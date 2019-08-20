@extends('tashtebk.arabic.layouts.master')

@section('content') 
<!--<div id="body" class="gray">-->
<main class="gray relative" >
    <div class="overlay-loader hidden">
         <i class="fa fa-refresh fa-spin"></i>
    </div>
    
    <section id="products" class="product">
       <div class="container">
           <div class="row">
               <div class="col-md-3 products-filter">
                   <div class="side" style="height:985px">
                       
                            
                    <div class="row ">
                        <ul class="list-unstyled list-inline list-protfolio " id="filter">
                            <li class="fil-cat mixitup-control-active" data-mixitup-control data-filter=".categories_view_only"><a>الفئات</a></li>
                            <li class="fil-cat profiles-button " data-mixitup-control data-filter=".profiles"><a>الملفات الشخصية</a></li>
                        </ul>
                    </div>
                    
                      <div class="check-box mix scrollable categories_view_only">
                          <h3>الفئات</h3>
                          <div class="divider"></div>
                          @foreach($categories as $category)
                          <label class="contain"> {{$category->title_ar}}
                              <input name="categories_checkbox_filter" value="{{$category->id}}" type="checkbox" @if($category->title == $current_category) checked @endif>
                              <span class="checkmark"></span>
                          </label>
                          @endforeach
                      </div>
                      <div class="check-box  mix categories_view_only">
                          <h3>موردي الخدمات</h3>
                          <div class="divider"></div>
                          @foreach($user_types as $user_type)
                              <label class="contain"> {{ucfirst($user_type->type)}}
                                  <input name="user_types_checkbox_filter" value="{{$user_type->id}}"  type="checkbox" @if($user_type->type == $current_provider) checked @endif>
                                  <span class="checkmark"></span>
                              </label>
                           @endforeach
                      </div>  
                      <div class="check-box profiles-service-providers mix profiles">
                          <h3>موردي الخدمات</h3>
                          <div class="divider"></div>
                          @foreach($user_types as $user_type)
                              <label class="contain"> {{ucfirst($user_type->type)}}
                                  <input name="user_types_checkbox_profiles_filter" value="{{$user_type->id}}"  type="checkbox" @if($user_type->type == $current_provider) checked @endif>
                                  <span class="checkmark"></span>
                              </label>
                           @endforeach
                      </div>  
                      <div class="check-box mix categories_view_only">
                          <h3>السعر</h3>
                          <div class="divider"></div>
                          <!--<input id="ex2" type="text"/>-->
                          <div class="row">
                              <div class="col-md-10" style="padding-right:0">
                                <input type="text" name="minimum_range" id="minimum_range" class="form-control tooltips tooltip1" value="1" />
                                <input type="text" name="maximum_range" id="maximum_range" class="form-control tooltips tooltip2" value="450" />
                            	<div id="price_range" style="background: #fff"></div>
                            	
                              </div>
                              <div class="col-md-2">
                                  <a class="price-filter" style="cursor: pointer;"><i class="fa fa-search"></i></a>
                              </div>
                            </div>	
                         
                          <!--<div id="slider">-->
                          <!--</div>-->
                      </div>
                  </div>
               </div>
               <div class="col-md-9 products-view mix categories_view_only">
                    @foreach ($user_types as $user_type)
                    @if(!empty($current_provider))
                        @php if($current_provider != $user_type->type)continue; @endphp
                    @endif
                    @if(!empty($current_category))
                        @php if(!$user_type->hasProductsForCategory($current_category))continue; @endphp
                    @endif
                        @if($user_type->hasProducts())
                            <div class="row">
                                <h3 class="title-related">{{ucfirst($user_type->type)}}</h3>
                                <div class="swiper-container swiper-multirows">
                                    <div class="swiper-wrapper">
                                        @foreach($user_type->users as $user)
                                            @foreach($user->products as $product)
                                            @if(!empty($current_category))
                                                @php if($current_category != $product->category->title)continue; @endphp
                                            @endif
                                              <div class="swiper-slide">
                                               <div class="p-item relate-item">
                                                   @if($product->discount > 0)
                                                   <div class="product__price-tag">
                                            			 <p class="product__price-tag-price">{{$product->current_price}} {{$active_currency->title_ar}}</p>
                                                	</div>
                                                	@endif
                                                    <div class="img-item">
                                                            <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}"><img src="{{asset('').$product->image}}" alt="" style="height:110px;"></a>
                                                    </div>
                                                    
                                                    <div class="p-info">
                                                        <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}"><h4>{{$product->title}} </h4></a>
                                                        <div>
                                                            @if(Auth::check())
                                                            <a href="#" class="add-favorite" data-productid="{{$product->id}}"><i class="{{$product->getFavoriteClass(Auth::user()->id)}}"></i></a>
                                                            @else
                                                            <a href="#"><i class="fa fa-heart-o"></i></a>
                                                            @endif
                                                            <a href="{{route('ar.product.index', ['title_tag'=>$product->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                                                            <span class="price-p @if($product->discount > 0) line-through @endif">{{$product->price}} {{$active_currency->title_ar}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Add Arrows -->
                                    <!--<div class="swiper-button-next"></div>-->
                                    <!--<div class="swiper-button-prev"></div>-->
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
               <div class="col-md-9 products-view-profiles mix profiles">
                    @foreach ($user_types as $user_type)
                        @if($user_type->hasUsers())
                            <div class="row">
                                <h3 class="title-related">{{ucfirst($user_type->type)}}</h3>
                                <div class="swiper-container swiper-multirows-profiles">
                                    <div class="swiper-wrapper">
                                        @foreach($user_type->users()->WhereNotIn('user_type', [1,15])->OrderBy('user_type','ASC')->get() as $user)
                                              <div class="swiper-slide ">
                                                <div class="p-item relate-item">
                                                
                                                    <div class="img-item">
                                                        <a href="{{route('ar.profile.show', [$user->username_tag])}}"><img src="{{asset('').$user->avatar}}" alt="" style="height:110px;"></a>
                                                    </div>
                                                    
                                                    <div class="p-info">
                                                        <a href="{{route('ar.profile.show', [$user->username_tag])}}"><h4> {{$user->username}} </h4></a>
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
      <!--</div>-->
        
           <!--added by fareed-->
       <!-- MIXitUP js  added by fareed-->
     
         <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.js"></script>
       <script>
    var mixer = mixitup('#products.product', {
      load: {
        filter: '.categories_view_only'  
      },
    selectors: {
        control: '[data-mixitup-control]'
    },
    callbacks: {
        onMixClick: function(state, e) {
            e.stopPropagation();
        }
    }
});
     </script>    
     
     <style>
         #filter{
             display:flex;
            flex-direction: row; 
            justify-content:space-around;
             
         }
         #filter li{
             color:#2c2c2c;
             cursor: pointer;
             font-size:16px;
             font-weight:600;
             
             transition:.5s all;
         }
            #filter li a {
                display: inline-block;
                padding: 8px 15px;
               
                color: #384043;
                font-weight: bold;
                font-size: 14px;
                border: 1px solid #808080;
                border-radius: 10px;
            } 
            /*   #filter li:after{*/
            /* content: ""; */
            /*justify-content:flex-start;*/
            /*display: block;*/
            /*height:4px ;*/
            /*width: 0px; */
            /*margin-top:10px;*/
            /*background:#EF374A;*/
            /*border-bottom: 3px solid var(  --sec-color);; */
            /*  transition:.5s all;*/
            /*   }     */
            #filter li a:active,   #filter li a:hover,  #filter li a:focus,  #filter li.active a, #filter li.mixitup-control-active a {
                    background: #ef374a;
                    border-color: #ef374a;
                    color: #fff;
                }
         /*   #filter li.mixitup-control-active:after,*/
         /*   #filter li:hover:after {*/
         /*     width: 25px; */
         /*     transition:.5s all;*/
             
             
         /*}*/
         .side{
              transition:.5s all;
           
                 padding: 20px 30px !important;
           
         }
         .scrollable{
               overflow:auto;
                height: 360px;
                margin-left: -5px;
         }
         .products-view .swiper-slide{
             margin:15px !important;
         }
         .img-item img {
             margin:0;
             height:100% !important;
             width:100%;
         }
         .relate-item {
             overflow:hidden;
         }

     </style>

@endsection

@section('custom-css')
<style>
#slider12a .slider-track-high, #slider12c .slider-track-high {
	background: #ef374a;
}

#slider12b .slider-track-low, #slider12c .slider-track-low {
	background: #ef374a;
}

#slider12c .slider-selection {
	background: white;
}

#price_range{
    margin-top:6px;
}
.tooltips
{
    top: 4px;
    border: 0;
    box-shadow: none;
    width: 37px;
    height: 24px;
    padding: 5px;
    display: inline-block;
    color: #fff;
    background: #003662;
    position: relative;
}

.tooltip1{
    left:0;
}
.tooltip2{
    left:90px;
}

.price-filter{
    cursor: pointer;
    margin-top: 27px;
    display: inline-block;
    background: #003662;
    color: #fff;
    font-size: 12px;
    width: 24px;
    height: 24px;
    line-height: 24px;
    text-align: center;
    border-radius: 4px;
}
.ui-slider-range {
    background: #ef374a;
}

.ui-slider-handle {
    border-radius: 10px;
    background: #fff;
    border: 1px solid #000;
}
</style>
@endsection

@section('custom-js')
    /*var slider1 = $("#ex2").slider({
        id: "slider12c",
        min: 0,
        max: 100,
        range: true,
        value: [30, 70],
        tooltip: 'always'
    });*/
    /*slider1.on('slide', function(newValue) {
        alert(newValue);
    };*/
    
    $( "#price_range" ).slider({
		range: true,
		min: 1,
		max: 700,
		values: [ 1, 450 ],
		slide:function(event, ui){
		    $("#minimum_range").val(ui.values[0]);
			$("#maximum_range").val(ui.values[1]);
		}
	});
	/* Profiles Part */
    $( ".profiles-service-providers" ).on( "click", "input[type='checkbox']", function() {
    
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        var user_types_profiles_filter = [];
        $.each($("input[name='user_types_checkbox_profiles_filter']:checked"), function(){            
            user_types_profiles_filter.push($(this).val());
        });
        
        $.ajax({
            url:"{{ route('ar.profiles.filter') }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, user_types_profiles_filter:user_types_profiles_filter},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success:function(data)
            {
                $(".products-view-profiles").html('');
                $(".products-view-profiles").html(data.result);
                $(".overlay-loader").toggleClass('hidden');
                
                var swiper = new Swiper('.swiper-multirows-profiles', {
                  slidesPerView: 4,
                  slidesPerColumn: 1,
                  spaceBetween: 30,
                  pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                  },
                });
            }
        });

    });
    
	/* Products Part */
    $( ".products-filter" ).on( "click", "input[type='checkbox'], .price-filter", function() {
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        var categories_filter = [];
        $.each($("input[name='categories_checkbox_filter']:checked"), function(){            
            categories_filter.push($(this).val());
        });
        
        var user_types_filter = [];
        $.each($("input[name='user_types_checkbox_filter']:checked"), function(){            
            user_types_filter.push($(this).val());
        });
        
        var low_price = $("#minimum_range").val();
        var high_price = $("#maximum_range").val();
        
        $.ajax({
            url:"{{ route('ar.category.products.filter') }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, categories_filter:categories_filter, user_types_filter:user_types_filter, low_price:low_price, high_price:high_price},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success:function(data)
            {
                $(".products-view").html('');
                $(".products-view").html(data.result);
                $(".overlay-loader").toggleClass('hidden');
                
                var swiper = new Swiper('.swiper-multirows', {
                  slidesPerView: 4,
                  slidesPerColumn: 1,
                  spaceBetween: 30,
                  pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                  },
                });
            }
        });
    });
@if(Auth::check())
    $('.products-view').on('click', '.add-favorite', function(){
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
@endif
@endsection
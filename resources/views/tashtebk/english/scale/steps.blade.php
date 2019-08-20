@extends('tashtebk.english.layouts.master')

@section('content')
<main>
    <div id="wizard">
        <div class="overlay-loader hidden">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        @foreach($scale->scaleSteps()->orderBy('step_order', 'asc')->get() as $step)
        <h2>{{$step->title}}</h2>
        <fieldset>
            <section  class="sections gray service-providers" >
                <div class="container text-center scale-providers">
                    <h2>Service Providers</h2>
                    <!--<div class="swiper-container swiper-scale-{{$step->id}} scale-providers">-->
                    <div class="owl-carousel owl-theme scale-providers">
                        <!--<div class="swiper-wrapper">-->
                            @foreach($step->users() as $user)
                                <div class="swiper-slide item scale-item">
                                     <div class="overlay-product">
                                            <div class="elements">
                                                <a class="primary add-step-product" title="Add" data-content="{{$user->id}}" data-step="{{$step->id}}"><i class="fa fa-plus"></i></a>
                                                <a href="{{route('en.profile.show', [$user->username_tag])}}" class="success" title="view" target="_blank"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                    <a class="element scale-provider-user" data-content="{{$user->id}}" data-step="{{$step->id}}">
                                       
                                        <div class="ele-img">
                                            <img src="{{asset('')}}{{$user->avatar}}" alt="{{$user->username}}">
                                        </div>
                                        <h4>{{$user->username}}</h4>
                                    </a>
                                </div>
                            @endforeach                
                        <!--</div>-->
                        <!--<div class="swiper-pagination"></div>-->
                    </div>
                </div>
            </section>
            <div class="row product-pane additional-product-result-{{$step->id}} step-product-result">
            </div>
            
            <div class="row text-center step-btn step-offer-{{$step->id}}">
            </div>
            
            <input type="hidden" name="current_provider_{{$step->id}}" value="">
            <input type="hidden" name="current_product_{{$step->id}}" value="">
            <a class="check-out check-out-left" type="button" data-toggle="modal" data-target="#offer_step_modal_{{$step->id}}">
                <i class="fa fa-shopping-cart"></i>
                <span class="no-product current-checkout offer-modal-no-{{$step->id}}" data-content="{{$step->getOffers($subscription->id, Auth::user()->id)->count()}}">{{$step->getOffers($subscription->id, Auth::user()->id)->count()}}</span>
            </a>
             <a class="check-out check-out-left info" type="button" data-toggle="modal" style="bottom:85px" data-target="#boq-modal-box">
              <i class="fa fa-info"></i>
            </a>
            <!-- BOQ Modal -->
            <div class="modal fade" id="boq-modal-box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content  checkout">
                  <div class="modal-body checkout-modal-body relative">
                      <div class="overlay-loader hidden">
                          <i class="fa fa-refresh fa-spin"></i>
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      <h4>BOQ Details For Project {{$subscription->getProjectName()}}</h4>
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                   <th>SN</th>
                                   <th>Product/Service Description</th>
                                   <th>Unit</th>
                                   <th>Quantity</th>
                                   <th>Rate L.E</th>
                                   <th>Total</th>
                                   <th>Status</th>
                                   <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscription->offers as $offer)
                                <tr>
                                    <td>
                                        @foreach($offer->product->category->codes as $code)
                                            {{$code->code}}
                                            @if (!$loop->last)/@endif
                                        @endforeach
                                    </td>
                                    <td>
                                        Category: {{$offer->product->category->title}}<br>
                                        Product Title: {{$offer->product->title}}<br>
                                        Description: {{$offer->product->long_description}}<br>
                                        Floor: {{$offer->floor->title}} //
                                        Flat: {{$offer->flat->title}} //
                                        Room: {{$offer->room->title}} //
                                        Projection: {{$offer->projection->title}}
                                    </td>
                                    <td>{{$offer->product->unit->title}}</td>
                                    <td>{{$offer->quantity}}</td>
                                    <td>{{$offer->product->current_price}}</td>
                                    <td>{{$offer->product->current_price * $offer->quantity}}</td>
                                    <td>@if($offer->status) Accepted @else Pending @endif</td>
                                    <td><a href="{{route('en.product.index', ['title_tag'=>$offer->product->title_tag])}}" title="Show" target="_blank"><img src="{{asset('').$offer->product->image}}"></a></td>
                                </tr>
                                    @foreach($offer->product->quantitySubProducts() as $additional)
                                    <tr>
                                        <td>
                                            @foreach($additional->subProduct->category->codes as $code)
                                                {{$code->code}}
                                                @if (!$loop->last)/@endif
                                            @endforeach
                                        </td>
                                        <td>
                                            Category: {{$additional->subProduct->category->title}}<br>
                                            Product Title: {{$additional->subProduct->title}}<br>
                                            Description: {{$additional->subProduct->long_description}}
                                        </td>
                                        <td>{{$additional->subProduct->unit->title}}</td>
                                        <td>{{$additional->quantity * $offer->quantity}}</td>
                                        <td>{{$additional->subProduct->current_price}}</td>
                                        <td>{{$additional->subProduct->current_price * ($additional->quantity * $offer->quantity)}}</td>
                                        <td></td>
                                        <td><a href="{{route('en.product.index', ['title_tag'=>$additional->subProduct->title_tag])}}" title="Show" target="_blank"><img src="{{asset('').$additional->subProduct->image}}"></a></td>
                                    </tr>
                                    @endforeach
                                @endforeach
                                <!--<tr>-->
                                <!--    <td><img src="https://www.logic-host.com/~tashtebak/tashtebat/public/tashtebk/images/products/about-1.png"> product 9 </td>-->
                                {{--<td class="text-center"><span class="qt"> 3 </span><!--<br><span class="update"><a href="#">update</a></span>--></td>--}}
                                <!--    <td class="text-center"><a href="#" class="fa fa-close delete-order" data-orderid="10"></a></td>-->
                                <!--    <td class="text-center"><span class="total">$171</span></td>-->
                                <!--</tr>-->
                            </tbody>
                          </table>
                               <h3 style="float: right;color: red;">Total BOQ : {{$subscription->total_price}} {{$active_currency->title_en}}</h3>
                      </div>
                  </div>
                 
                </div>
              </div>
            </div>   

            
            <div class="modal fade" id="offer_step_modal_{{$step->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content  checkout">
                        <div class="modal-body checkout-modal-body relative">
                            <div class="overlay-loader hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4>{{$step->title}} Offers</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center" width="100px">Qty</th>
                                            <th class="text-center" width="100px">status</th>
                                            <th class="text-center" width="100px">Total</th>
                                            <th class="text-center" width="100px">cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-step-{{$step->id}}">
                                        @foreach($step->getOffers($subscription->id, Auth::user()->id) as $offer)
                                        <tr>
                                            <td><img src="{{asset('').$offer->product->image}}"><a href="{{route('en.product.index', ['title_tag'=>$offer->product->title_tag])}}" target="_blank"> {{ $offer->product->title }}</a></td>
                                            <td class="text-center"><span class="qt"> {{ $offer->quantity }} </span><!--<br><span class="update"><a href="#">update</a></span>--></td>
                                            <td class="text-center">{!!$offer->getStatus()!!}</td>
                                            <td class="text-center"><span class="total"> {{$active_currency->title_en}} {{ $offer->total_price }} </span></td>
                                            <td class="text-center">@if($offer->status == 0)<a href="#" class="fa fa-close delete-offer" data-offerid="{{$offer->id}}" title="Cancel"></a>@endif</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        @endforeach
    </div>
</main>

@endsection

@section('custom-js')
    $(document).ready(function () {
    function initializeSelect2(){
        $('.select-object').select2(); 
    }

        var test = $("#wizard").steps({
            headerTag: "h2",
            bodyTag: "fieldset",
            transitionEffect: "slideLeft",
            labels: {
                next: "Next Step",
                previous: "Previous Step",
                loading: "Loading ..."
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                //if(newIndex < currentIndex ) return false;
                return true; 
            },
            enableCancelButton: false,
            saveState: true,
        });
        
    
        $('.scale-providers').on('click', '.scale-provider-user, .add-step-product', function(){
            $(".scale-provider-user").find('h4').css("color", "#003964");
            $(this).find('h4').css("color", "#ef374a");

            var user_id = $( this ).data( "content" );
            var step_id = $( this ).data( "step" );
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var input_provider = 'current_provider_' + step_id;

            $("input[name=" + input_provider + "]").val(user_id);
            console.log($("input[name=" + input_provider + "]").val());
            
            $.ajax({
                url:"{{ route('en.scale.step.provider.products') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, user_id:user_id, step_id:step_id},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    $('.additional-product-result-' + data.step_id).html('');
                    $('.additional-product-result-' + data.step_id).html(data.result);
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }); 
        
        $('.step-product-result').on('click', '.add-step-product', function(){
        
            var product_id = $( this ).data( "content" );
            var step_id = $( this ).data( "step" );
            var input_provider = 'current_provider_' + step_id;
            var provider_id = $("input[name=" + input_provider + "]").val()
            var input_product = 'current_product_' + step_id;
            $("input[name=" + input_product + "]").val(product_id);
            //console.log($("input[name=" + input_product + "]").val());
            //console.log(provider_id);
            
            $('.check').html('');
            $(this).closest('.p-item').prepend('<div class="check"><i class="fa fa-check"></i></div>');
                    
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('en.scale.offer.modal') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, product_id:product_id, step_id:step_id, provider_id:provider_id, subscription_identifier:'{{$subscription->identifier}}' },
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    $(".overlay-loader").toggleClass('hidden');
                    $('.step-offer-' + data.step_id).html('');
                    $('.step-offer-' + data.step_id).html(data.modal);
                    initializeSelect2();
                }
            });
            
        });
        
        $('.step-btn').on('submit', '#offer_request', function(event){
            event.preventDefault();
            
            // Find disabled inputs, and remove the "disabled" attribute as serialize ignored disabled inputs
            var disabled = $( this ).find(':input:disabled').removeAttr('disabled');
            
            // serialize the form
            var serialized = $( this ).serialize() + "&subscription_identifier=" + '{{$subscription->identifier}}' + "&user_id=" + '{{Auth::user()->id}}';
            
            // re-disable the set of inputs that you previously enabled
            disabled.attr('disabled','disabled');

            $.ajax({
                url:"{{route('en.scale.offer')}}",
                method:"POST",
                data:serialized,
                dataType:'JSON',
                beforeSend: function(){
                    //console.log(serialized);
                    $(".overlay-loader").toggleClass('hidden');
                },
                success:function(data)
                {
                    $('#offer_step_' + data.step_id).modal('hide');
                    alert(data.message);
                    var checkout_count = $( '.offer-modal-no-' + data.step_id ).data( "content" ) + 1;
                    $( '.offer-modal-no-' + data.step_id ).html( checkout_count );
                    $( '.offer-modal-no-' + data.step_id ).data( "content", checkout_count );
                    $( '.tbody-step-' + data.step_id ).prepend( data.offer_new_row);
                    console.log(data.offer_new_row);
                    
                    $( '#boq-modal-box' ).html( data.boq_updated_modal );
                    $(".overlay-loader").toggleClass('hidden');
                }
            })
        });
        
        $('.modal').on('click', '.delete-offer', function(){
            if(confirm('Are you sure you want to Delete ?'))
            {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var offer_id   = $( this ).data( "offerid" );
                
                $.ajax({
                    url:"{{ route('en.scale.offer.delete') }}",
                    method:"POST",
                    data:{_token: CSRF_TOKEN, offer_id:offer_id},
                    dataType:'JSON',
                    beforeSend: function(){
                        $(".overlay-loader").toggleClass('hidden');
                    },
                    success: function(data)
                    {
                        if(data.result) 
                        {
                            $('*[data-offerid="' + data.result + '"]').closest('tr').remove();
                            var checkout_count = $( '.offer-modal-no-' + data.step_id ).data( "content" ) - 1;
                            $( '.offer-modal-no-' + data.step_id ).html( checkout_count );
                            $( '.offer-modal-no-' + data.step_id ).data( "content", checkout_count );
                            $( '#boq-modal-box' ).html( data.boq_updated_modal );
                        }
                        $(".overlay-loader").toggleClass('hidden');
                    }
                });
            }
        });
        
        var swiper = new Swiper('.swiper-scale', {
          slidesPerView: 5,
          spaceBetween: 30,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          breakpoints: {
            1024: {
              slidesPerView: 4,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 30,
            },
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            320: {
              slidesPerView: 1,
              spaceBetween: 10,
            }
          }
        });
        
        $('.owl-carousel').owlCarousel({
            items:5,
            loop:true,
            margin:10,
            nav:true,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        });


    });

@endsection

@section('custom-css')
<style>
   .owl-nav{
       display:none;
   }
   .select2-container{
        width: 623px !important;
        padding-top: 23px;
   }
</style>
@endsection
@extends('tashtebk.arabic.layouts.master')

@section('content') 
    <main>
        <section class="checkouts section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 ">
                        <nav>
                            <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <li class="active"><a data-toggle="tab" href="#orders">الطلبات</a></li>
                                <li><a data-toggle="tab" href="#subscriptions">BOQs</a></li>
                            </ul>
                        </nav>
                        <div class="tab-content" >
                            <div class="overlay-loader hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                            <div class="tab-pane fade in active" id="orders">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                               <th>Product</th>
                                               <th class="text-center" width="100px">Qty</th>
                                               <th class="text-center" width="100px">Remove</th>
                                               <th class="text-center" width="100px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Auth::user()->orders as $order)
                                            <tr>
                                                <td><img src="{{ asset('').$order->product->image }}">{{ $order->product->title }}</td>
                                                <td class="text-center"><span class="qt">{{ $order->quantity }}</span><!--<br><span class="update"><a href="#">update</a></span>--></td>
                                                <td class="text-center"><a href="#" class="fa fa-close delete-order" data-orderid="{{ $order->id }}"></a></td>
                                                <td class="text-center"><span class="total">{{$active_currency->title_ar}} {{ $order->total_price }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="subscriptions" >
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>scale id</th>
                                                <th>Type</th>
                                                <th>Project</th>
                                                <th class="text-center" width="100px">Details</th>
                                                <th class="text-center" width="100px">Show</th>
                                                <th class="text-center" width="100px">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(Auth::user()->subscriptions as $subscription)
                                            <tr>
                                                <td><span class="total">{{$subscription->identifier}}</span></td>
                                                <td><img src="{{asset('') . $subscription->scale->image->link}}"> {{$subscription->scale->title}} </td>
                                                <td><span class="total">{{$subscription->getProjectName()}}</span></td>
                                                <td class="text-center"><a href="#" class="fa fa-info" title="Details" type="button" data-toggle="modal" data-target="#checkout-modal-box-{{$subscription->identifier}}"></a></td>
                                                <td class="text-center"><a href="{{route('ar.scale.steps', [Auth::user()->username_tag, $subscription->scale->title, $subscription->identifier])}}" class="fa fa-eye" title="Show"></a></td>
                                                <td class="text-center"><a href="#" class="fa fa-close delete-subscription" data-subscriptionid="{{ $subscription->id }}"></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                @foreach(Auth::user()->subscriptions as $subscription)
                                <div class="modal fade" id="checkout-modal-box-{{$subscription->identifier}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                        <td><a href="{{route('ar.product.index', ['title_tag'=>$offer->product->title_tag])}}" title="Show" target="_blank"><img src="{{asset('').$offer->product->image}}"></a></td>
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
                                                            <td><a href="{{route('ar.product.index', ['title_tag'=>$additional->subProduct->title_tag])}}" title="Show" target="_blank"><img src="{{asset('').$additional->subProduct->image}}"></a></td>
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
                                                   <h3 style="float: right;color: red;">Total BOQ : {{$subscription->total_price}} {{$active_currency->title_ar}}</h3>
                                          </div>
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
        </section>
    </main>
@endsection
@section('custom-js')
    $('#orders').on('click', '.delete-order', function(){
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
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
        
    });
    
    $('#subscriptions').on('click', '.delete-subscription', function(){
        if(confirm('Are you sure you want to Delete ?'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var subscription_id   = $( this ).data( "subscriptionid" );
            
            $.ajax({
                url:"{{ route('ar.checkout.subscription.delete') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, subscription_id:subscription_id},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    if(data.result) 
                    {
                        $('*[data-subscriptionid="' + data.result + '"]').closest('tr').remove();
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
        
    });
@endsection
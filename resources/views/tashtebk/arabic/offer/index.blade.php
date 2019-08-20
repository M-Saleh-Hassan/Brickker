@extends('tashtebk.arabic.layouts.master')

@section('content') 
    <main>
        <section class="checkouts section">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 ">
                        <nav>
                            <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <li class="active"><a data-toggle="tab" href="#offers">العروض قيد الانتظار</a></li>
                                <li><a data-toggle="tab" href="#accepted">العروض المقبولة</a></li>
                                <li><a data-toggle="tab" href="#rejected">العروض المرفوضة</a></li>
                            </ul>
                        </nav>
                        <div class="tab-content" >
                            <div class="overlay-loader hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                            <div class="tab-pane fade in active" id="offers">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                               <th>From</th>
                                               <th>Product</th>
                                               <th class="text-center" width="100px">Qty</th>
                                               <th class="text-center" width="200px">Message</th>
                                               <th class="text-center" width="100px">Accept/Reject</th>
                                               <th class="text-center" width="100px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Auth::user()->providerOffers()->where('status', 0)->get() as $offer)
                                            <tr>
                                                <td><img src="{{ asset('').$offer->customer->avatar }}">{{ $offer->customer->username }}</td>
                                                <td><img src="{{ asset('').$offer->product->image }}">{{ $offer->product->title }}</td>
                                                <td class="text-center"><span class="qt">{{ $offer->quantity }}</span></td>
                                                <td class="text-center"><a type="button" data-toggle="modal" data-target="#offer-{{$offer->id}}" class="primary message-show-button" title="show"><i class="fa fa-eye"></i></a></td>
                                                <td class="text-center">
                                                    <a href="#" class="fa fa-check accept-offer" data-offerid="{{ $offer->id }}" title="Accept"></a>
                                                    /
                                                    <a href="#" class="fa fa-close reject-offer" data-offerid="{{ $offer->id }}" title="Reject"></a>
                                                </td>
                                                <td class="text-center"><span class="total">{{$active_currency->title_ar}} {{ $offer->total_price }}</span></td>
                                            </tr>
                                            <div class="modal fade" id="offer-{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content  checkout">
                                                        <div class="modal-body checkout-modal-body relative">
                                                            <div class="overlay-loader hidden">
                                                                <i class="fa fa-refresh fa-spin"></i>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4>{{$offer->customer->username}}</h4>
                                                            <div>
                                                                {{$offer->message}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="accepted">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                               <th>From</th>
                                               <th>Product</th>
                                               <th class="text-center" width="100px">Qty</th>
                                               <th class="text-center" width="200px">Message</th>
                                               <th class="text-center" width="100px">Delivered ?</th>
                                               <th class="text-center" width="100px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Auth::user()->providerOffers()->where('status', 1)->get() as $offer)
                                            <tr>
                                                <td><img src="{{ asset('').$offer->customer->avatar }}">{{ $offer->customer->username }}</td>
                                                <td><img src="{{ asset('').$offer->product->image }}">{{ $offer->product->title }}</td>
                                                <td class="text-center"><span class="qt">{{ $offer->quantity }}</span></td>
                                                <td class="text-center"><a type="button" data-toggle="modal" data-target="#offer-accepted-{{$offer->id}}" class="primary message-show-button" title="show"><i class="fa fa-eye"></i></a></td>
                                                <td class="text-center">
                                                    <a href="#" class="fa fa-close deliver-offer" data-offerid="{{ $offer->id }}" data-status="0" title="Not Delivered"></a>
                                                </td>
                                                <td class="text-center"><span class="total">{{$active_currency->title_ar}} {{ $offer->total_price }}</span></td>
                                            </tr>
                                            <div class="modal fade" id="offer-accepted-{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content  checkout">
                                                        <div class="modal-body checkout-modal-body relative">
                                                            <div class="overlay-loader hidden">
                                                                <i class="fa fa-refresh fa-spin"></i>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4>{{$offer->customer->username}}</h4>
                                                            <div>
                                                                {{$offer->message}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="rejected">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                               <th>From</th>
                                               <th>Product</th>
                                               <th class="text-center" width="100px">Qty</th>
                                               <th class="text-center" width="200px">Message</th>
                                               <th class="text-center" width="100px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Auth::user()->providerOffers()->where('status', -1)->get() as $offer)
                                            <tr>
                                                <td><img src="{{ asset('').$offer->customer->avatar }}">{{ $offer->customer->username }}</td>
                                                <td><img src="{{ asset('').$offer->product->image }}">{{ $offer->product->title }}</td>
                                                <td class="text-center"><span class="qt">{{ $offer->quantity }}</span></td>
                                                <td class="text-center"><a type="button" data-toggle="modal" data-target="#offer-rejected-{{$offer->id}}" class="primary message-show-button" title="show"><i class="fa fa-eye"></i></a></td>
                                                <td class="text-center"><span class="total">{{$active_currency->title_ar}} {{ $offer->total_price }}</span></td>
                                            </tr>
                                            <div class="modal fade" id="offer-rejected-{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content  checkout">
                                                        <div class="modal-body checkout-modal-body relative">
                                                            <div class="overlay-loader hidden">
                                                                <i class="fa fa-refresh fa-spin"></i>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            <h4>{{$offer->customer->username}}</h4>
                                                            <div>
                                                                {{$offer->message}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('custom-js')
    $('#offers').on('click', '.accept-offer', function(){
        if(confirm('Accept this offer ?'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var offer_id   = $( this ).data( "offerid" );
            
            $.ajax({
                url:"{{ route('ar.offer.accept') }}",
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
                        $('#accepted').find(' div table tbody ').prepend(data.row);
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
    $('#offers').on('click', '.reject-offer', function(){
        if(confirm('Reject this offer ?'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var offer_id   = $( this ).data( "offerid" );
            
            $.ajax({
                url:"{{ route('ar.offer.reject') }}",
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
                        $('#rejected').find(' div table tbody ').prepend(data.row);
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
    $('#accepted').on('click', '.deliver-offer', function(){
        if(confirm('Update status for this product ?'))
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var offer_id   = $( this ).data( "offerid" );
            var status     = $( this ).data( "status" );
            
            $.ajax({
                url:"{{ route('ar.offer.provider.deliver') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN, offer_id:offer_id, status:status},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    if(data.result) 
                    {
                        $('*[data-offerid="' + data.result + '"]').closest('td').html(data.icon);
                    }
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
@endsection
@section('custom-css')
<style>
    .checkouts nav > ul li.active a:after {
        content: "";
        position: relative;
        bottom: -50px;
        left: -22%;
        border: 15px solid transparent;
        border-top-color: #ef374a;
    }
</style>
@endsection
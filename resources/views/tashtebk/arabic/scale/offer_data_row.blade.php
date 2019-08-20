<tr>
    <td><img src="{{asset('').$offer->product->image}}"><a href="{{route('ar.product.index', ['title_tag'=>$offer->product->title_tag])}}" target="_blank"> {{ $offer->product->title }}</a></td>
    <td class="text-center"><span class="qt"> {{ $offer->quantity }} </span><!--<br><span class="update"><a href="#">update</a></span>--></td>
    <td class="text-center">{!!$offer->getStatus()!!}</td>
    <td class="text-center"><span class="total"> {{$active_currency->title_ar}} {{ $offer->total_price }} </span></td>
    <td class="text-center">@if($offer->status == 0)<a href="#" class="fa fa-close delete-offer" data-offerid="{{$offer->id}}" title="Cancel"></a>@endif</td>
</tr>
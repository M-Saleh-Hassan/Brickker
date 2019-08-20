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
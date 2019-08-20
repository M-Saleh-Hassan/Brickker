<tr>
    <td><img src="{{asset('').$order->product->image}}"> {{ $order->product->title }} </td>
    <td class="text-center"><span class="qt"> {{ $order->quantity }} </span><!--<br><span class="update"><a href="#">update</a></span>--></td>
    <td class="text-center"><a  href="#"  class="fa fa-close delete-order" data-orderid="{{ $order->id }}"></a></td>
    <td class="text-center"><span class="total">{{$active_currency->title_ar}} {{ $order->total_price }}</span></td>
</tr>

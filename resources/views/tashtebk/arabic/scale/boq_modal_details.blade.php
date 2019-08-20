  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content  checkout">
      <div class="modal-body checkout-modal-body relative">
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
                   <h3 style="float: right;color: red;">Total BOQ : {{$subscription->total_price}} {{$active_currency->title_ar}}</h3>
          </div>
      </div>
     
    </div>
  </div>
  

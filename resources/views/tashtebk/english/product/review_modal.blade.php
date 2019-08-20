<!-- Modal -->
<div class="modal fade" id="review_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content  add-review">
      <div class="modal-body">
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
          <div class="prdct-title">
              <img src="{{asset('') . $product->image}}">
              <h4>{{$product->title}}</h4>
          </div>
          <ul class="list-unstyled current-rate">
              @for($i=0; $i<$rate; $i++)
                <li class="fa fa-star"></li>
              @endfor
              @for($i=0; $i<5-$rate; $i++)
                <li class="fa fa-star-o"></li>
              @endfor
          </ul>
          <input type="hidden" value="{{$rate}}" name="rate">
          <p class="txt-italic">Thank you for rating! tell us more about your opinion:</p>
          <label>What's good about this product ?</label>
          <input type="text" name="good" class="text-form">
          <label>What's not so good about this product ?</label>
          <input type="text" name="bad" class="text-form">
          <label>Would you recommend this product to a friend ?</label>
          <input type="radio" name="recommend" value="1"><span>Yes</span>
          <input type="radio" name="recommend" value="0"><span>No</span>
          <label>Write Your review :*</label>
          <textarea class="text-form" rows="5" name="review"></textarea>
      </div>
      <div class="modal-footer review-footer">
        <button type="button" class="btn btn-primary submit-review">Submit review</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

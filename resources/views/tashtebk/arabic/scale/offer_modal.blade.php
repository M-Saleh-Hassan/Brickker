<button class="btn btn-home" data-toggle="modal" data-target="#offer_step_{{$step->id}}">ارسل العرض</button>
<div class="modal fade " id="offer_step_{{$step->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="overlay-loader hidden">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
	<div class="modal-dialog extend-modal-width" role="document">
	  <div class="modal-content" >
		<div class="modal-header offer-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" id="myModalLabel">عرض ل {{$step->title}} / مشروع: {{$subscription->getProjectName()}}</h4>
		</div>
		<div class="modal-body">
			<form class="product-edit-form" method="POST" id="offer_request" enctype="multipart/form-data">
				@csrf
                <input type="hidden" name="step_id" value="{{$step->id}}">
                <div class="form-group col-md-12">
                    <label  class="col-sm-2 control-label pad-15">المورد</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="step_provider" placeholder="المورد" value="{{$provider->username}}" disabled>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <label  class="col-sm-2 control-label pad-15">المنتج</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="step_product" placeholder="المنتج" value="{{$product->title}}" disabled>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <label  class="col-sm-2 control-label pad-15">الكمية</label>

                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="step_quantity" placeholder="الكمية" value="" min="1">
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <label  class="col-sm-2 control-label pad-15">الرسالة</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="step_message" placeholder="الرسالة" value="">
                    </div>
                </div>
                
                <div class="form-group col-md-12 text-center">
                    <label  class="col-sm-2 control-label pad-15">الدور</label>

                    <div class="col-sm-10 ">
                        <select class="select-object" name="floor_id" required>
                            @foreach ($subscription->getProject()->floors as $floor)
                            <option value="{{$floor->id}}">
                                {{$floor->title}}
                            </option>                                                    
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group col-md-12 text-center">
                    <label  class="col-sm-2 control-label pad-15">الشقة</label>

                    <div class="col-sm-10 ">
                        <select class="select-object" name="flat_id" required>
                            @foreach ($subscription->getProject()->flats as $flat)
                            <option value="{{$flat->id}}">
                                {{$flat->title}}
                            </option>                                                    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12 text-center">
                    <label  class="col-sm-2 control-label pad-15">الغرفة</label>

                    <div class="col-sm-10 ">
                        <select class="select-object" name="room_id" required>
                            @foreach ($subscription->getProject()->rooms as $room)
                            <option value="{{$room->id}}">
                                {{$room->title}}
                            </option>                                                    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12 text-center">
                    <label  class="col-sm-2 control-label pad-15">المكان</label>

                    <div class="col-sm-10 ">
                        <select class="select-object" name="projection_id" required>
                            @foreach ($subscription->getProject()->projections as $projection)
                            <option value="{{$projection->id}}">
                                {{$projection->title}}
                            </option>                                                    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 center-button">
                        <div class="form-group">
                            <button type="submit" class="btn btn-home">أرسل</button>
                        </div>
                    </div>
                </div>
			</form>
		</div>
	  </div>
	</div>
</div>

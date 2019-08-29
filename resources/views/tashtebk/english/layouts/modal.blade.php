<div class="modal fade" id="Login-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel">Login</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('signIn') }}">
					@csrf
					<div class="form-group col-md-12">
					    <input type="email" name="sign_in_email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group col-md-12">
					    <input type="password" name="sign_in_password" class="form-control" placeholder="password">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                        <p>
                            <a type="button" data-toggle="modal" data-target="#Forget-Modal" onclick="$('#Login-Modal').modal('hide')">Forget Password?</a>
                        </p>
                    </div>

					<div class="form-group ">
						<button type="submit" class="btn-home">Submit</button>
					</div>
				</form>
			</div>
			<!--<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>-->
		  </div>
		</div>
	  </div>
	  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel">Register</h4>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="form-group col-md-12">
					<input type="text" class="form-control" name="sign_up_username" placeholder="Username" value="{{Request::old('sign_up_username')}}"
						@if($errors->has('sign_up_username'))style="border-bottom: 1.4px solid #ef374a;"@endif
						>
					</div>

					<!--<div class="form-group col-md-12">-->
					<!--	<input type="text" class="form-control" name="sign_up_phone" placeholder="phone" value="{{Request::old('sign_up_phone')}}"-->
					<!--	@if($errors->has('sign_up_phone'))style="border-bottom: 1.4px solid #ef374a;"@endif-->
					<!--	>-->
					<!--</div>-->

					<div class="form-group col-md-12">
						<input type="email" class="form-control" name="sign_up_email" placeholder="Email" value="{{Request::old('sign_up_email')}}"
						@if($errors->has('sign_up_email'))style="border-bottom: 1.4px solid #ef374a;"@endif
						>
					</div>

					<div class="form-group col-md-6">
						<input type="password" pattern=".{8,}" title="Password length can't be less than 8 chars" class="form-control" name="sign_up_password" placeholder="password"
						@if($errors->has('sign_up_password'))style="border-bottom: 1.4px solid #ef374a;"@endif
						>
					</div>

					<div class="form-group col-md-6">
						<input type="password" class="form-control" name="sign_up_password_confirmation" placeholder=" Confirm password"
						@if($errors->has('sign_up_password_confirmation'))style="border-bottom: 1.4px solid #ef374a;"@endif
						>
					</div>

					<div class="form-group col-md-12">
						<select class="form-control" name="sign_up_country"
						@if($errors->has('sign_up_country'))style="border-bottom: 1.4px solid #ef374a;"@endif
						>
						@foreach($countries as $country )
							<option value="{{$country->id}}" @if (Request::old('sign_up_country') == $country->title_en) selected @endif>
								{{$country->title_en}}
							</option>
						@endforeach
						</select>
					</div>

					{{--<div class="form-group col-md-12">
						<select class="form-control" name="sign_up_user_type"
						@if($errors->has('sign_up_user_type'))style="border-bottom: 1.4px solid #ef374a;"@endif
						>
							<option value="consultant" @if (Request::old('sign_up_user_type') == 'consultant') selected @endif>
								Consultant
							</option>
							<option value="provider" @if (Request::old('sign_up_user_type') == 'provider') selected @endif>
								Provider
							</option>
							<option value="technician" @if (Request::old('sign_up_user_type') == 'technician') selected @endif>
								Technician
							</option>
							<option value="user" @if (Request::old('sign_up_user_type') == 'user') selected @endif>
								User
							</option>
						</select>
					</div>--}}

                    <div class="form-group col-md-12">
						<input name="terms" type="checkbox" required> <a href="{{route('en.policy.index')}}" target="_blank">I agree to Terms &amp; conditions.</a>
					</div>

					<div class="form-group text-right ">
						<button type="submit" class="btn-home">Submit</button>
					</div>
				</form>
			</div>
			<!--<div class="modal-footer">
			   <button type="button" class="btn-home">Submit</button>
			   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>-->
		  </div>
		</div>
</div>
<div class="modal fade" id="Forget-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Forget Password</h4>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group col-md-12">
                    <input type="email" name="reset_email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group ">
                    <button type="submit" class="btn-home">Submit</button>
                </div>
            </form>
        </div>
        <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>-->
      </div>
    </div>
  </div>

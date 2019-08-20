@extends('tashtebk.english.layouts.master')

@section('content') 
<main class="gray relative" >
    <div class="overlay-loader hidden">
         <i class="fa fa-refresh fa-spin"></i>
    </div>
    <!--<section class="banner">-->
    <!--  <div class="container">-->
    <!--      <ul class="breadcrumb">-->
    <!--          <li><a href="{{route('en.home.index')}}">Home</a></li>-->
    <!--      </ul>-->
    <!--  </div>-->
    <!--</section>-->
    <section class="product">
       <div class="container">
           <div class="row">
               <div class="">
        			<div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Contact us</h4>
                        @if(!empty($contact->contact_text))<p class="text-center" >{{strip_tags($contact->contact_text)}}</p>@endif
        			</div>
        			<div class="modal-body" style=" max-width: 600px;margin: 20px auto;">
        				<form method="POST" action="{{route('en.contactus.send')}}">
                            @csrf
        					<div class="form-group col-md-12">
        					    <input type="text" name="full_name" class="form-control" placeholder="Full name" required>
        					</div>
        					
        					<div class="form-group col-md-12">
        					    <input type="text" name="mobile" class="form-control" placeholder="Mobile" required>
        					</div>
        					
        					<div class="form-group col-md-12">
        					    <input type="email" name="email" class="form-control" placeholder="Email" required>
        					</div>
        				
        					<div class="form-group col-md-12">
        					    <textarea type="text" name="message" class="form-control" placeholder="Message" row="10" required></textarea>
        					</div>
        					
        					<div class="form-group">
        						<button type="submit" class="btn-home">Send</button>
        					</div>
        					
        				</form>
        			</div>
	            </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('custom-js')
    @if(isset($success))
        alert('{{$success}}');
    @endif
@endsection

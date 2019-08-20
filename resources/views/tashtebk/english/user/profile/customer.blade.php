@extends('tashtebk.english.layouts.master')

@section('content') 
<!--<div id="body">-->
<main>
    <section class="gray section">
        <div class="container relative">
            <div class="overlay-loader hidden">
                 <i class="fa fa-refresh fa-spin"></i>
            </div>
            @if(Auth::user()->getUserType() != NULL)
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-info box">
                        <img src="{{asset('').Auth::user()->avatar}}" alt="">
                        <h4>{{Auth::user()->real_name}}</h4>
                        <p>{{Auth::user()->short_title}}</p>
                    </div>
                    <div class="box-about box">
                        <h4>About Me</h4>
                        <div class="item">
                            <h5><div class="fa fa-map-marker"></div> Location</h5>
                            <p>{{Auth::user()->country->title_en}}</p>
                            <h5><div class="fa fa-phone"></div> Phone</h5>
                            <p>{{Auth::user()->phone}}</p>
                        </div>
                        <div class="item">
                            <h5><div class="fa fa-file-text-o"></div> Bio</h5>
                            <p>{{Auth::user()->bio}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box-tabs">
                        <ul class="nav nav-tabs">
                            <li @if(session('active') != 'my_products'  && $active == 'profile') class="active"      @endif><a data-toggle="tab" href="#home">Profile</a></li>
                            <li><a data-toggle="tab" href="#menu1">Favorites</a></li>
                            <li @if(session('active') == 'projects'  || $active == 'projects') class="active"  @endif><a data-toggle="tab" href="#menu2">Add Projects</a></li>
                            <li @if(session('active') == 'my_projects'  || $active == 'my_projects') class="active"  @endif><a data-toggle="tab" href="#menu3">My Projects</a></li>
                            <li  class=""  ><a data-toggle="tab" href="#menu5">Manage Profile</a></li>

                        </ul>
                        
                        <div class="tab-content">
                            <div id="home" class="tab-pane fade 
                            @if(session('active') != 'my_products'  && $active == 'profile') in active @endif
                            ">
                                <form class="form-horizontal" method="POST" action="{{ route('en.profile.update',['username_tag' => Auth::user()->username_tag]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Real Name*</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control"  name="real_name" placeholder="Real Name" value="{{(Request::old('real_name')) ? Request::old('real_name') : Auth::user()->real_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Email*</label>
                    
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control"  name="email" placeholder="Email" value="{{(Request::old('email')) ? Request::old('email') : Auth::user()->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Country*</label>
                    
                                        <div class="col-sm-10">
                                            <select class="form-control" name="country"                                            >
                        						@foreach($countries as $country)
                        							<option value="{{$country->id}}" @if (Request::old('sign_up_country') == $country->title_en || Auth::user()->country->title_en == $country->title_en) selected @endif>
                        								{{$country->title_en}}		
                        							</option>
                        						@endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Phone*</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{(Request::old('phone')) ? Request::old('phone') : Auth::user()->phone}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Title</label>
                    
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" name="short_title" placeholder="Title" value="{{(Request::old('short_title')) ? Request::old('short_title') : Auth::user()->short_title}}">
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Bio</label>
                                        
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="bio" placeholder="Bio" >{{(Request::old('bio')) ? Request::old('bio') : Auth::user()->bio}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Avatar</label>
                    
                                        <div class="col-sm-10">
                                        <input type="file" class="form-control" name="avatar">
                                        </div>
                                    </div>
    
                                    <div class="row">
                                        <div class="col-md-3 right-button">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-home">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="menu1" class="tab-pane fade">
                                <div class="row product-pane">
                                    @foreach (Auth::user()->favorites as $favorite)
                                        <div class="col-md-3">
                                            <div class="p-item relate-item">
                                                <div class="img-item">
                                                    <a href="{{route('en.product.index', ['title_tag'=>$favorite->product->title_tag])}}" target="_blank">
                                                        <img src="{{asset('').$favorite->product->image}}" alt="" style="height:110px;">
                                                    </a>
                                                </div>
                                                
                                                <div class="p-info">
                                                    <h4 class="edit-form-title">{{$favorite->product->title}} </h4>
                                                    <div>
                                                        <a href="#" class="add-favorite" data-productid="{{$favorite->product->id}}"><i class="{{$favorite->product->getFavoriteClass(Auth::user()->id)}}"></i></a>
                                                        <a href="{{route('en.product.index', ['title_tag'=>$favorite->product->title_tag])}}"><i class="fa fa-shopping-cart"></i></a>
                                                        <span class="price-p">{{$favorite->product->current_price}} {{$active_currency->title_en}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                                                    
                                    @endforeach
                                </div>
                            </div>
                            
                            <div id="menu2" class="tab-pane fade 
                            @if($active == 'projects') in active @endif
                            ">
                                <form id="project_add_form" class="form-horizontal" method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Project Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control"  name="project_title" placeholder="Project Title" value="{{(Request::old('project_title'))}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <label class="col-sm-2 control-label">Floors</label>
                                            <select class="floors_select form-control col-md-12" name="floors[]" multiple="multiple" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <label class="col-sm-2 control-label">Flats</label>
                                            <select class="flats_select form-control col-md-12" name="flats[]" multiple="multiple" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <label class="col-sm-2 control-label">Rooms</label>
                                            <select class="rooms_select form-control col-md-12" name="rooms[]" multiple="multiple" required>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-3 right-button">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-home">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div id="menu3" class="tab-pane fade 
                            @if($active == 'my_projects') in active @endif
                            ">
                                <style>
                                .close {
                                  position: absolute;
                                  /*top: 0;*/
                                  /*right: 40.5px;*/
                                  cursor: pointer;
                                  z-index:10;
                                  opacity:1;
                                  
                                }
                                .close:hover, .close:focus {
                                    color: white;
                                    text-decoration: none;
                                    cursor: pointer;
                                    filter: alpha(opacity=50);
                                    opacity: 1;
                                }
                                .close1 {
                                  position: absolute;
                                  /*top: 0;*/
                                  left: 43.5px;
                                  cursor: pointer;
                                  z-index:10;
                                  opacity:1;
                                  
                                }
                                .close1:hover, .close1:focus {
                                    color: white;
                                    text-decoration: none;
                                    cursor: pointer;
                                    filter: alpha(opacity=50);
                                    opacity: 1;
                                }
                            </style>
                                <div class="row product-pane projects-container">
                                    @foreach (Auth::user()->projects as $project)
                                        <div class="col-md-3">
                                            
                                            <div class="modal fade" id="ProjectModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        		<div class="modal-dialog extend-modal-width" role="document">
                                        		  <div class="modal-content" >
                                        			<div class="modal-header">
                                        			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        			  <h4 class="modal-title" id="myModalLabel">{{$project->title}}</h4>
                                        			</div>
                                        			<div class="modal-body relative">
                            			                <div class="overlay-loader hidden">
                                                             <i class="fa fa-refresh fa-spin"></i>
                                                        </div>

                                        				<form class="project-edit-form" method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                                        					@csrf
                                        					<input type="hidden" name="project_id" value="{{$project->id}}">
                                        					<div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label">Title</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" name="project_title" placeholder="Project Title" value="{{(empty(Request::old('project_title'))) ? $project->title : Request::old('project_title')}}">
                                                                </div>
                                                            </div>
                                                            
                                        					<div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label">Floors</label>
                                                                
                                                                <div class="col-sm-10">
                                                                    <select class="floors_select form-control col-md-12" name="floors[]" multiple="multiple" required>
                                                                        @foreach ($project->floors as $floor)
                                                                        <option value="{{$floor->title}}"selected>{{$floor->title}}</option>                                                    
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                        					<div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label">Flats</label>
                                                                
                                                                <div class="col-sm-10">
                                                                    <select class="flats_select form-control col-md-12" name="flats[]" multiple="multiple" required>
                                                                        @foreach ($project->flats as $flat)
                                                                        <option value="{{$flat->title}}"selected>{{$flat->title}}</option>                                                    
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                        					<div class="form-group col-md-12">
                                                                <label  class="col-sm-2 control-label">Rooms</label>
                                                                
                                                                <div class="col-sm-10">
                                                                    <select class="rooms_select form-control col-md-12" name="rooms[]" multiple="multiple" required>
                                                                        @foreach ($project->rooms as $room)
                                                                        <option value="{{$room->title}}"selected>{{$room->title}}</option>                                                    
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-3 center-button">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-home">Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                        				</form>
                                        			</div>
                                        		  </div>
                                        		</div>
                                    	  </div>
                                            <div class="p-item relate-item project">
                                                <div class="overlay-product">
                                                    <div class="elements">
                                                        <a class="delete-project danger" title="Delete"  data-project="{{$project->id}}"><i class="fa fa-close"></i></a>
                                                        <a type="button" data-toggle="modal" data-target="#ProjectModal{{$project->id}}" class="primary"  title="Edit"><i class="fa fa-edit"></i></a>
                                                        <!--<a href="{{route('en.product.index', ['title_tag'=>$project->title])}}" class="success" title="view BOQ" target="_blank"><i class="fa fa-eye"></i></a>-->
                                                    </div>
                                                    
                                                </div>
                                                <div class="img-item">
                                                        <img src="{{asset('')}}/tashtebk/images/icons/project-management.png" alt="" style="height:110px;">
                                                </div>
                                                
                                                <div class="p-info">
                                                    <h4 class="edit-form-title">{{$project->title}} </h4>
                                                </div>
                                            </div>
                                        </div>                                                                    
                                    @endforeach
                                </div>
                            </div>
                            
                             <div id="menu5" class="tab-pane fade">
                                <div class="row flexing">
                                    <button class="btn btn-danger deactivate"><i class="fa fa-times"></i> Deactivate</button>
                                    <button class="btn btn-danger delete-account"><i class="fa fa-trash"></i> Delete Account</button>
                                    <button class="btn btn-warning change-type"><i class="fa fa-id-badge"></i> Change Account Type</button>

                                </div>
                                
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </section>
</main>
<!--</div>-->
@endsection

@section('custom-js')
    function initializeSelect2()
    {
        $('.floors_select').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
        $('.flats_select').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
        $('.rooms_select').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    }
    
    initializeSelect2();
    
    $( '.change-type' ).on('click',function(){
    
        if(confirm('Note:: All Your data will be deleted and reset ?'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('en.profile.changeType') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });

    $( '.delete-account' ).on('click',function(){
    
        if(confirm('Are you sure you want to PERMANENTLY delete your account ?'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('en.profile.delete') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
    
    $( '.deactivate' ).on('click',function(){
    
        if(confirm('Are you sure you want to deactivate your account ?'))
        {
            var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('en.profile.deactivate') }}",
                method:"POST",
                data:{_token: CSRF_TOKEN},
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay-loader").toggleClass('hidden');
                },
                success: function(data)
                {
                    window.location.href = data.redirect;
                    $(".overlay-loader").toggleClass('hidden');
                }
            });
        }
    });
    
    $('.product-pane').on('click', '.add-favorite', function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var product_id   = $( this ).data( "productid" );
        var current_class = $( this ).children().attr('class');
        var target_class  = 'fa fa-heart';
        if(current_class == target_class) target_class = 'fa fa-heart-o';
        
        $.ajax({
            url:"{{ route('en.product.favorite') }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, product_id:product_id, target_class:target_class},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                $('*[data-productid="' + data.product_id + '"]').children().attr('class', data.target_class);
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    $('#project_add_form').on('submit', function(event){
        event.preventDefault();
        var serialized_form = $( this ).serialize();

        $.ajax({
            url:"{{ route('en.project.save',['username_tag' => Auth::user()->username_tag]) }}",
            method:"POST",
            data:serialized_form,
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                alert(data.message);
                if(data.status)
                {
                    $(".projects-container").prepend(data.project_container);
                    initializeSelect2();
                }
                else
                {
                    var errors_message = '';
                    $.each(data.errors, function( index, value ) {
                        errors_message += value + '  ......  ';
                    });
                    alert( errors_message );
                }
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    $('.projects-container').on('submit', '.project-edit-form', function(event){
        event.preventDefault();
        var serialized_form = $( this ).serialize();
        console.log(serialized_form);
        $.ajax({
            url:"{{ route('en.project.update',['username_tag' => Auth::user()->username_tag]) }}",
            method:"POST",
            data:serialized_form,
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                if(data.status)
                {
                    alert(data.message);
                    $("#ProjectModal"+data.project_id).modal('hide');
                    $(".modal-backdrop").remove();
                    $("#ProjectModal"+data.project_id).parent().remove();
                    $(".projects-container").prepend(data.project_container);
                    initializeSelect2();

                }
                else
                {
                    var errors_message = '';
                    $.each(data.errors, function( index, value ) {
                        errors_message += value + '  ......  ';
                    });
                    alert( errors_message );
                }
                
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
    
    $('.projects-container').on('click', '.delete-project', function(){
        if(!confirm('Are you sure you want to delete ?')) return 1;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var project_id = $( this ).data('project');
        
        $.ajax({
            url:"{{ route('en.project.delete',['username_tag' => Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, project_id:project_id},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                alert(data.message);
                if(data.status)
                {
                    $('[data-project="'+ data.project_id +'"]').parent().parent().parent().remove();
                }
                $(".overlay-loader").toggleClass('hidden');
            }
        });
    });
@endsection
@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.users')}}">Users Data</a></li>
                <li class="active">{{$current->username}}</li>    
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!--------------------------
            | Your Page Content Here |
            -------------------------->
            <div class="col-md-12">
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$current->username}} / {{$current->getUserType()}}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="edit_user_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="username" value="{{$current->username}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" placeholder="email" name="email" value="{{$current->email}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" placeholder="country" name="country" value="{{$current->country}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" placeholder="phone" name="phone" value="{{$current->phone}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" placeholder="company name" name="company_name" value="{{$current->company_name}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Short Title</label>
                                        <input type="text" class="form-control" placeholder="short title" name="short_title" value="{{$current->short_title}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <input type="text" class="form-control" placeholder="bio" name="bio" value="{{$current->bio}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Image</label>
                                        <img src="{{asset('').$current->avatar}}" class="img-circle" style="height:100px;width:100px"alt="User Image">
                                    </div>
                                    
                                </div>
                                <!-- /.box-body -->
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>        
                        </div>
                    </div>
                </div>

            </div>    
        </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection    
@section('js')  
<script>

    $(document).ready(function(){

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#edit_user_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.users.update', [$current->id])}}",
                method:"POST",
                data:$("#edit_user_form").serialize(),
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay").toggleClass('hidden');
                },
                success:function(data)
                {
                    if(data.errors == '')
                    {
                        alert(data.message);
                    }
                    else{
                        var errors_message = '';
                        $.each(data.errors, function( index, value ) {
                            errors_message += value + '  ......  ';
                        });
                            alert( errors_message );
                    }
                    $(".overlay").toggleClass('hidden');
                }
            })
        });
    });

</script> 

@endsection
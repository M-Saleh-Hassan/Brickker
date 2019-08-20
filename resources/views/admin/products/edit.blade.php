@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Products
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.products.index')}}">Products</a></li>
                <li class="active">{{$current->title}}</li>    
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
                        <h3 class="box-title">{{$current->title}} /
                        <a href="{{route('admin.categories.edit',[$current->category->id])}}">{{$current->category->title}}</a> /
                        <a href="{{route('admin.users.edit',[$current->user->id])}}">{{$current->user->username}}</a>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="edit_product_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Title" name="title" value="{{$current->title}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" placeholder="Price" name="price" value="{{$current->price}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text" class="form-control" placeholder="Discount" name="discount" value="{{$current->discount}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <input type="text" class="form-control" placeholder="Short Description" name="short_description" value="{{$current->short_description}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <input type="text" class="form-control" placeholder="Long Description" name="long_description" value="{{$current->long_description}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <input type="text" class="form-control" placeholder="Brand" name="brand" value="{{$current->brand}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Model Name</label>
                                        <input type="text" class="form-control" placeholder="Model Name" name="model_name" value="{{$current->model_name}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Grade</label>
                                        <input type="text" class="form-control" placeholder="Grade" name="grade" value="{{$current->grade}}" disabled>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Image</label>
                                        <img src="{{asset('').$current->image}}" class="img-circle img-100-100" alt="User Image">
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
        $('#edit_product_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.products.update', [$current->id])}}",
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
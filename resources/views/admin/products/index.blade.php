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
            <li class="active">Products</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!--------------------------
            | Your Page Content Here |
            -------------------------->
            <div class="col-md-12">
                <!-- All Users -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All Products</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <!--<th>counter</th>-->
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>User</th>
                                        <th>Featured</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($products as $product)
                                        <tr id="row{{$product->id}}">
                                            {{--<td>{{$counter}}</td>--}}
                                            <td>{{$product->title}}</td>
                                            <td><img src="{{asset('').$product->image}}" class="img-circle" style="width:100px;height:100px"alt="Product Image"></td>
                                            <td><a  href="{{route('admin.categories.edit', [$product->category->id])}}" >{{$product->category->title}}</a></td>
                                            <td><a  href="{{route('admin.users.edit', [$product->user->id])}}" >{{$product->user->username}}</a></td>
                                            <td id="featured{{$product->id}}">
                                                @if($product->featured)
                                                    <button  class="btn btn-success make-not-featured" data-content="{{$product->id}}">
                                                        <i class="fa fa-check"></i>
                                                        <span>Yes</span>
                                                    </button>
                                                @else
                                                    <button  class="btn btn-danger make-featured" data-content="{{$product->id}}">
                                                        <i class="fa fa-times"></i>
                                                        <span>No</span>
                                                    </button>
                                                @endif                                                
                                            </td>
                                            <td>
                                                <a  href="{{route('admin.products.edit', [$product->id])}}" class="btn btn-primary" data-content="{{$product->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$product->id}}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </td>
                                        </tr>   
                                        @php $counter++; @endphp                             
                                    @endforeach
                                </tbody>
                            </table>
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
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 
    });

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.products.delete")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        var id= data.id;
                        $( '#row' + id ).html('');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });

        $('#example').on('click', '.make-featured', function(){
            if(confirm('Are you sure you want to Make it featured ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.products.featured")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        var id= data.id;
                        $( '#featured' + id ).html('');
                        $( '#featured' + id ).html('<button type="button" class="btn btn-success make-not-featured" data-content="' + id + '"><i class="fa fa-check"></i><span> Yes</span></button>');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });
        
        $('#example').on('click', '.make-not-featured', function(){
            if(confirm('Are you sure you want to Make it not featured ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.products.notfeatured")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        var id= data.id;
                        $( '#featured' + id ).html('');
                        $( '#featured' + id ).html('<button type="button" class="btn btn-danger make-featured" data-content="' + id + '"><i class="fa fa-times"></i><span> No</span></button>');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });

    });   

</script> 
<style>
.custom-image
{
    height: 244px;
}
li.custom-image
{
    width:18.5%;
}
img.custom-image
{
    height: 200px
}
span.select2
{
    width: 100% !important;
}
</style>
@endsection

@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Categories
            {{-- <small>Optional description</small> --}}
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Categories</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!--------------------------
            | Your Page Content Here |
            -------------------------->
            <div class="col-md-12">
                <div class="box box-warning box-solid collapsed-box">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new category</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_category_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title EN</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Title EN" name="title_en">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title AR</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Title AR" name="title_ar">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Parent</label><br>
                                        <select class="parent_category_select form-control col-md-12" id="exampleInputPassword1" name="parent_category">
                                            <option value="NULL">Main</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label >User Types</label><br>
                                        <select class="user_type_select form-control col-md-12" name="user_types[]" multiple="multiple">
                                            @foreach ($user_types as $user_type)
                                                <option value="{{$user_type->id}}">{{$user_type->type}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label >Codes</label><br>
                                        <select class="codes_select form-control col-md-12" name="codes[]" multiple="multiple">
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Category Order to show (1 as first) " name="order">
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Show</label>
                                            <input type="checkbox" name="show" value="1" checked>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Show in home page</label>
                                            <input type="checkbox" name="show_in_home" value="1" checked>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Image</label><br>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                                                    Choose Image
                                                </button>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="image_chosen"></p>
                                            </div>
                                        </div> 
                                        <br>
                                        <!-- Add Image Modal -->
                                        <div class="modal fade" id="modal-default">
                                            <div class="modal-dialog" style="width:80%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Choose Image</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <select class="media_category_select form-control col-md-12" name="media">
                                                            <option value=""></option>
                                                            @foreach ($media as $one)
                                                                <option data-img-label="<a target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>'" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
                                                            @endforeach
                                                    </select>                            
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                              
                                    </div>
                                    
                                </div>
                                <!-- /.box-body -->
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>        
                        </div>
                    </div>
                </div>

                <!-- All Categories -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All Categories</h3>
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
                                        <th>order</th>
                                        <th>codes</th>
                                        <th>title</th>
                                        <th>sub</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($categories as $category)
                                        <tr id="row{{$category->id}}">
                                            <td>{{$category->order}}</td>
                                            <td>@foreach ($category->codes as $code){{$code->code}} @endforeach</td>
                                            <td>{{$category->title}}</td>
                                            <td>
                                                <a  href="{{route('admin.categories.sub_categories', [$category->id])}}" class="btn btn-info" data-content="{{$category->id}}">
                                                    <i class="fa fa-eye"></i>
                                                    <span>sub</span>
                                                </a>

                                            </td>
                                            <td>
                                                <a  href="{{route('admin.categories.edit', [$category->id])}}" class="btn btn-primary" data-content="{{$category->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$category->id}}">
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

    $('.parent_category_select').select2();
    $('.user_type_select').select2();
    $('.codes_select').select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });
    
    $(".media_category_select").imagepicker(
        {
            show_label: true
        }
    )

    $(document).ready(function(){
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 

        $( ".media_category_select" ).change(function() {
            $('#modal-default').modal('hide');
            // $("#modal-default").removeClass('in');
            // $("#modal-default").css('display', 'none');
            // $(".modal-backdrop").remove();
            $(".image_chosen").html($(" .media_category_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_category_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('admin.categories.add') }}",
                method:"POST",
                data:$("#add_category_form").serialize(),
                dataType:'JSON',
                // contentType: false,
                // cache: false,
                // processData: false,
                beforeSend: function(){
                    $(".overlay").toggleClass('hidden');
                },
                success:function(data)
                {
                    if(data.errors == '')
                    {
                        alert(data.message);
                        
                        var rowNode = t.row.add( [
                            data.category_order,
                            data.category_codes,
                            data.category_title,
                            '<a  href="' + data.category_link_sub +'" class="btn btn-info" data-content="data.category_id"><i class="fa fa-eye"></i><span>sub</span></a>',
                            '<a  href="' + data.category_link_edit +'" class="btn btn-primary" data-content="data.category_id"><i class="glyphicon glyphicon-edit"></i><span>edit</span></a>',
                            '<button type="button" class="btn btn-danger delete" data-content="' + data.category_id + '"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>'
                        ] ).draw().node();
                        
                        $( rowNode )
                            .css( 'color', 'red' )
                            .attr('id', 'row' + data.category_id );
                    }
                    else{
                        var errors_message = '';
                        $.each(data.errors, function( index, value ) {
                            errors_message += value + '  ......  ';
                        });
                        alert( errors_message );
                    }
                    $(".parent_category_select").append('<option value="'+ data.category_id +'">'+ data.category_title +'</option>');
                    $(".overlay").toggleClass('hidden');
                }
            })
        });
    });

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
        // $(".delete").click(function(){ // not working at page 2 see reason at https://www.gyrocode.com/articles/jquery-datatables-why-click-event-handler-does-not-work/
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.categories.delete")}}',
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
    });   

</script> 
<style>
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
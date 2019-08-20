@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Steps
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Steps</li>
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
                        <h3 class="box-title">Add new step</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_step_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Step Title" name="title">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Categories</label><br>
                                        <select class="category_select form-control col-md-12" name="categories[]" multiple="multiple">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>User Types</label><br>
                                        <select class="type_select form-control col-md-12" name="user_types[]" multiple="multiple">
                                            @foreach ($user_types as $user_type)
                                                <option value="{{$user_type->id}}">{{$user_type->type}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <!-- /.box-body -->
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>        
                        </div>
                    </div>
                </div>

                <!-- All Steps -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All Steps</h3>
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
                                        <th>id</th>
                                        <th>title</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="steps_body">
                                    @foreach ($steps as $step)
                                        <tr id="row{{$step->id}}">
                                            <td>{{$counter}}</td>
                                            <td>{{$step->title}}</td>
                                            <td>
                                                <a  href="{{route('admin.step.edit', [$step->id])}}" class="btn btn-primary" data-content="{{$step->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$step->id}}">
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

    $('.category_select').select2();
    $('.type_select').select2();

    /*$(".media_scale_select").imagepicker(
        {
            show_label: true
        }
    )*/

    $(document).ready(function(){
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 

        /*$( ".media_scale_select" ).change(function() {
            $('#modal-default').modal('hide');
            $(".image_chosen").html($(" .media_scale_select option:selected").text());
        });*/

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_step_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('admin.step.add') }}",
                method:"POST",
                data:$("#add_step_form").serialize(),
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay").toggleClass('hidden');
                },
                success:function(data)
                {
                    if(data.errors == '')
                    {
                        alert(data.message);
                        
                        var rowNode = t.row.add( [
                            data.step_count,
                            data.step_title,
                            '<a  href="' + data.step_link_edit +'" class="btn btn-primary" data-content="data.step_id"><i class="glyphicon glyphicon-edit"></i><span>edit</span></a>',
                            '<button type="button" class="btn btn-danger delete" data-content="' + data.step_id + '"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>'
                        ] ).draw().node();
                        
                        $( rowNode )
                            .css( 'color', 'red' )
                            .attr('id', 'row' + data.step_id );
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

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.step.delete")}}',
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
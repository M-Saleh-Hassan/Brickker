@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Scales
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Scales</li>
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
                        <h3 class="box-title">Add new scale</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_scale_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Scale Title" name="title">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="text" class="form-control" placeholder="Scale Order" name="order">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="editor1" name="description" rows="3" cols="160"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Scale Steps</label><br>
                                        <select class="step_select form-control col-md-12" name="steps[]" multiple="multiple">
                                            @foreach ($steps as $step)
                                                <option value="{{$step->id}}">{{$step->title}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Image</label><br>
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
                                                    <select class="media_scale_select form-control col-md-12" name="media">
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

                <!-- All Scales -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All Scales</h3>
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
                                        <th>title</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="scales_body">
                                    @foreach ($scales as $scale)
                                        <tr id="row{{$scale->id}}">
                                            <td>{{$scale->order}}</td>
                                            <td>{{$scale->title}}</td>
                                            <td>
                                                <a  href="{{route('admin.scale.edit', [$scale->id])}}" class="btn btn-primary" data-content="{{$scale->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$scale->id}}">
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
    $(function () {
        CKEDITOR.replace('editor1');
    });
    $('.step_select').select2();
    /*prevent tags sorting*/
    $(".step_select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
    
    $(".media_scale_select").imagepicker(
        {
            show_label: true
        }
    )

    $(document).ready(function(){
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 

        $( ".media_scale_select" ).change(function() {
            $('#modal-default').modal('hide');
            $(".image_chosen").html($(" .media_scale_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_scale_form').on('submit', function(event){
            event.preventDefault();
            var description = CKEDITOR.instances.editor1.getData();
            
            $.ajax({
                url:"{{ route('admin.scale.add') }}",
                method:"POST",
                data:$("#add_scale_form").serialize() + "&description=" + description,
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
                            data.scale_order,
                            data.scale_title,
                            '<a  href="' + data.scale_link_edit +'" class="btn btn-primary" data-content="data.scale_id"><i class="glyphicon glyphicon-edit"></i><span>edit</span></a>',
                            '<button type="button" class="btn btn-danger delete" data-content="' + data.scale_id + '"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>'
                        ] ).draw().node();
                        
                        $( rowNode )
                            .css( 'color', 'red' )
                            .attr('id', 'row' + data.scale_id );
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
                    url: '{{route("admin.scale.delete")}}',
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
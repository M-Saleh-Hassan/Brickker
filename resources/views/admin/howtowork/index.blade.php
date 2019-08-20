@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            How To Work
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">How To Work</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!------------------------
            | Your Page Content Here |
            -------------------------->                      
            <div class="col-md-12">
                <div class="box box-warning box-solid collapsed-box">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new How To Work Item</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_howtowork_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Header En</label><br>
                                        <textarea id="header_en" name="header_en" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Header AR</label><br>
                                        <textarea id="header_ar" name="header_ar" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Text EN</label><br>
                                        <textarea id="text_en" name="text_en" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Text AR</label><br>
                                        <textarea id="text_ar" name="text_ar" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="text" class="form-control" placeholder="howtowork Order to show (1 as first) " name="order">
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
                                                    <select class="image_howtowork_select form-control col-md-12" name="image_id">
                                                            <option value=""></option>
                                                            @foreach ($media as $one)
                                                                <option data-img-label="<a class='link-image' target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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

                <!-- All Slides -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All howtoworks</h3>
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
                                        <th>header</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($howtoworks as $howtowork)
                                        <tr id="row{{$howtowork->id}}">
                                            <td>{{$howtowork->order}}</td>
                                            <td>{!!$howtowork->header_en!!}</td>
                                            <td>
                                                <a  href="{{route('admin.howtowork.edit', [$howtowork->id])}}" class="btn btn-primary" data-content="{{$howtowork->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$howtowork->id}}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </td>
                                        </tr>   
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
    $(".image_howtowork_select").imagepicker(
        {
            show_label: true
        }
    )

    $(function () {
        CKEDITOR.replace('header_en');
        CKEDITOR.replace('header_ar');
        CKEDITOR.replace('text_en');
        CKEDITOR.replace('text_ar');
    });

    $(document).ready(function(){
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 

        $( ".image_howtowork_select" ).change(function() {
            $('#modal-default').modal('hide');
            $(".image_chosen").html($(" .image_howtowork_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_howtowork_form').on('submit', function(event){
            var howtowork_header_en = CKEDITOR.instances.header_en.getData();
            var howtowork_header_ar = CKEDITOR.instances.header_ar.getData();
            var howtowork_text_en   = CKEDITOR.instances.text_en.getData();
            var howtowork_text_ar   = CKEDITOR.instances.text_ar.getData();
            howtowork_header_en = trimString(howtowork_header_en );
            howtowork_header_ar = trimString(howtowork_header_ar );
            howtowork_text_en   = trimString(howtowork_text_en   );
            howtowork_text_ar   = trimString(howtowork_text_ar   );
            event.preventDefault();
            $.ajax({
                url:"{{ route('admin.howtowork.add') }}",
                method:"POST",
                data:$("#add_howtowork_form").serialize() + "&header_en=" + howtowork_header_en + "&header_ar=" + howtowork_header_ar + "&text_en=" + howtowork_text_en + "&text_ar=" + howtowork_text_ar,
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
                            data.howtowork_order,
                            data.howtowork_header_en,
                            '<a  href="' + data.howtowork_link_edit +'" class="btn btn-primary" data-content="data.howtowork_id"><i class="glyphicon glyphicon-edit"></i><span>edit</span></a>',
                            '<button type="button" class="btn btn-danger delete" data-content="' + data.howtowork_id + '"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>'
                        ] ).draw().node();
                        
                        $( rowNode )
                            .css( 'color', 'red' )
                            .attr('id', 'row' + data.howtowork_id );
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
                    url: '{{route("admin.howtowork.delete")}}',
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
@endsection

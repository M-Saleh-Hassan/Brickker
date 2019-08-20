@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            howtoworks
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.howtowork.index')}}">howtoworks</a></li>
                <li class="active">{!!$current->header_en!!}</li>    
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
                        <h3 class="box-title">{!!$current->header_en!!}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="edit_howtowork_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="box-body">
                                    <div class="form-group">
                                        <label>Header En</label><br>
                                        <textarea id="header_en" name="header_en" rows="3" cols="160">{{$current->header_en}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Header AR</label><br>
                                        <textarea id="header_ar" name="header_ar" rows="3" cols="160">{{$current->header_ar}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Text EN</label><br>
                                        <textarea id="text_en" name="text_en" rows="3" cols="160">{{$current->text_en}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Text AR</label><br>
                                        <textarea id="text_ar" name="text_ar" rows="3" cols="160">{{$current->text_ar}}</textarea>
                                    </div>

                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="text" class="form-control" placeholder="howtowork Order to show (1 as first) " name="order" value="{{$current->order}}">
                                        </div>
					<div class="form-group">
                                        <label>Image</label>
                                        
                                                <button type="button" class="btn btn-info mg" data-toggle="modal" data-target="#modal-default">
                                                    Choose Image
                                                </button>
                                            
                                                <p class="image_chosen"><a target='_blank' href='{{asset('')}}{{$current->image->link}}'>{{$current->image->original_name}}</a></p>
                                          
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
                                                                <option @if($current->image->id == $one->id){{'selected'}} @endif data-img-label="<a class='link-image' target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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
        $( ".image_howtowork_select" ).change(function() {
            $('#modal-default').modal('hide');
            $(".image_chosen").html($(" .image_howtowork_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#edit_howtowork_form').on('submit', function(event){
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
                url:"{{route('admin.howtowork.update', [$current->id])}}",
                method:"POST",
                data:$("#edit_howtowork_form").serialize() + "&header_en=" + howtowork_header_en + "&header_ar=" + howtowork_header_ar + "&text_en=" + howtowork_text_en + "&text_ar=" + howtowork_text_ar,
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
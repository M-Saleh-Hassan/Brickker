@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Slides
            {{-- <small>Optional description</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.slider.index')}}">Slider</a></li>
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
                        <h3 class="box-title">{{$current->title}}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_category_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{-- <input type="hidden" name="category_id" value="{{$current->id}}"> --}}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Slide Title" name="title" value="{{$current->title}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Text</label><br>
                                            <textarea id="editor1" name="text" rows="3" cols="160">{{$current->text}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Order</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Slide Order to show (1 as first) " name="slide_order" value="{{$current->slide_order}}">
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
                                                    <p class="image_chosen"><a target='_blank' href='{{asset('')}}{{$current->media()->link}}'>{{$current->media()->original_name}}</a></p>
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
                                                                    <option @if($current->media_id == $one->id){{'selected'}}@endif data-img-label="<a target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>'" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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
    $(function () {
       CKEDITOR.replace('editor1');
    });

    $('.parent_category_select').select2();
    $(".media_category_select").imagepicker(
        {
            show_label: true
        }
    )

    $(document).ready(function(){
        $( ".media_category_select" ).change(function() {
            $('#modal-default').modal('hide');
            // $("#modal-default").removeClass('in');
            // $("#modal-default").css('display', 'none');
            // $(".modal-backdrop").remove();
            $(".image_chosen").html($(" .media_category_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_category_form').on('submit', function(event){
            var text_value = CKEDITOR.instances.editor1.getData();
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.slider.update', [$current->id])}}",
                method:"POST",
                data:$("#add_category_form").serialize() + "&text_value=" + text_value,
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
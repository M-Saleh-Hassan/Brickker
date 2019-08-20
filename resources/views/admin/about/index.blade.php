@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            About
            {{-- <small>tashtebk</small> --}}
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">About</li>
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
                        <h3 class="box-title">Vision</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="update_vision_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Text</label><br>
                                        <textarea id="editor_vision" name="vision_text" rows="3" cols="160">{{$about->vision_text}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label><br>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#vision-image">
                                                    Choose Image
                                                </button>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="image_chosen_vision"><a target='_blank' href='{{asset('')}}{{$about->getVisionImage()->link}}'>{{$about->getVisionImage()->original_name}}</a></p>
                                            </div>
                                        </div> 
                                        <br>
                                        <!-- Add Image Modal -->
                                        <div class="modal fade" id="vision-image">
                                            <div class="modal-dialog" style="width:80%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Choose Vision Image</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <select class="media_vision_select form-control col-md-12" name="vision_image">
                                                            <option value=""></option>
                                                            @foreach ($media as $one)
                                                                <option @if($about->vision_image == $one->id){{'selected'}} @endif data-img-label="<a target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>'" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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
                                <button type="submit" class="btn btn-primary">save</button>
                            </form>        
                        </div>
                    </div>
                </div>
                
                <div class="box box-warning box-solid collapsed-box">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Mission</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="update_mission_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Text</label><br>
                                        <textarea id="editor_mission" name="mission_text" rows="3" cols="160">{{$about->mission_text}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label><br>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#mission-image">
                                                    Choose Image
                                                </button>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="image_chosen_mission"><a target='_blank' href='{{asset('')}}{{$about->getMissionImage()->link}}'>{{$about->getMissionImage()->original_name}}</a></p>
                                            </div>
                                        </div> 
                                        <br>
                                        <!-- Add Image Modal -->
                                        <div class="modal fade" id="mission-image">
                                            <div class="modal-dialog" style="width:80%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Choose Mission Image</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <select class="media_mission_select form-control col-md-12" name="mission_image">
                                                            <option value=""></option>
                                                            @foreach ($media as $one)
                                                                <option @if($about->mission_image == $one->id){{'selected'}} @endif data-img-label="<a target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>'" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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
                                <button type="submit" class="btn btn-primary">save</button>
                            </form>        
                        </div>
                    </div>
                </div>
                
                <div class="box box-warning box-solid collapsed-box">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Why Us</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="update_why_us_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Image</label><br>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#why-us-image">
                                                    Choose Image
                                                </button>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="image_chosen_why_us"><a target='_blank' href='{{asset('')}}{{$about->getWhyUsImage()->link}}'>{{$about->getWhyUsImage()->original_name}}</a></p>
                                            </div>
                                        </div> 
                                        <br>
                                        <!-- Add Image Modal -->
                                        <div class="modal fade" id="why-us-image">
                                            <div class="modal-dialog" style="width:80%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Choose Why Us Image</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <select class="media_why_us_select form-control col-md-12" name="why_us_image">
                                                            <option value=""></option>
                                                            @foreach ($media as $one)
                                                                <option @if($about->why_us_image == $one->id){{'selected'}} @endif data-img-label="<a target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>'" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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
                                <button type="submit" class="btn btn-primary">save</button>
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
       CKEDITOR.replace('editor_vision');
       CKEDITOR.replace('editor_mission');
    });

    $(".media_vision_select").imagepicker(
        {
            show_label: true
        }
    )
    $(".media_mission_select").imagepicker(
        {
            show_label: true
        }
    )
    $(".media_why_us_select").imagepicker(
        {
            show_label: true
        }
    )

    $(document).ready(function(){
        $( ".media_vision_select" ).change(function() {
            $('#vision-image').modal('hide');
            $(".image_chosen_vision").html($(" .media_vision_select option:selected").text());
        });
        $( ".media_mission_select" ).change(function() {
            $('#mission-image').modal('hide');
            $(".image_chosen_mission").html($(" .media_mission_select option:selected").text());
        });
        $( ".media_why_us_select" ).change(function() {
            $('#why-us-image').modal('hide');
            $(".image_chosen_why_us").html($(" .media_why_us_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#update_vision_form').on('submit', function(event){
            var vision_text = CKEDITOR.instances.editor_vision.getData();
            vision_text = trimString(vision_text );
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.about.vision')}}",
                method:"POST",
                data:$("#update_vision_form").serialize() + "&vision_text=" + vision_text,
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
        $('#update_mission_form').on('submit', function(event){
            var mission_text = CKEDITOR.instances.editor_mission.getData();
            mission_text = trimString(mission_text);
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.about.mission')}}",
                method:"POST",
                data:$("#update_mission_form").serialize() + "&mission_text=" + mission_text,
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
        $('#update_why_us_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.about.why_us')}}",
                method:"POST",
                data:$("#update_why_us_form").serialize(),
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
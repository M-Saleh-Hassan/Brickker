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
                <li><a href="{{route('admin.scale.index')}}">Scales</a></li>
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
                            <form method="post" id="add_scale_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Scale Title" name="title" value="{{$current->title}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="text" class="form-control" placeholder="Scale Order" name="order" value="{{$current->order}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="editor1" name="description" rows="3" cols="160">{{$current->description}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Scale Steps</label><br>
                                        <select class="step_select form-control col-md-12" name="steps[]" multiple="multiple">
                                            @foreach ($current->orderedScaleSteps() as $step)
                                                <option value="{{$step->id}}" selected>{{$step->title}}</option>    
                                            @endforeach
                                            @foreach ($current->remainingScaleSteps() as $step)
                                                <option value="{{$step->id}}">{{$step->title}}</option>    
                                            @endforeach
                                        </select>
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
                                                    <select class="media_scale_select form-control col-md-12" name="media">
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
        $( ".media_scale_select" ).change(function() {
            $('#modal-default').modal('hide');
            $(".image_chosen").html($(" .media_scale_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_scale_form').on('submit', function(event){
            event.preventDefault();
            var description = CKEDITOR.instances.editor1.getData();
            
            $.ajax({
                url:"{{route('admin.scale.update', [$current->id])}}",
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

/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
      transform: scale(0.6);
    top: -7px;
}

.image_chosen{
    display:inline-block;
}

.mg{
    margin:0 10px;
}
/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection
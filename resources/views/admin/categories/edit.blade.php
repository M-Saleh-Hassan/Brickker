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
                <li><a href="{{route('admin.categories.index')}}">Categories</a></li>
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
                                        <label>Title EN</label>
                                        <input type="text" class="form-control" placeholder="Category Title EN" name="title_en" value="{{$current->title}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Title AR</label>
                                        <input type="text" class="form-control" placeholder="Category Title AR" name="title_ar" value="{{$current->title_ar}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Parent</label><br>
                                        <select class="parent_category_select form-control col-md-12" name="parent_category">
                                            <option value="NULL" @if($current->parent_id == NULL){{'selected'}} @endif >Main</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if($current->parent_id == $category->id){{'selected'}} @endif>{{$category->title}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>User Types</label><br>
                                        <select class="user_type_select form-control col-md-12" name="user_types[]" multiple="multiple">
                                            @foreach ($user_types as $user_type)
                                                <option value="{{$user_type->id}}"
                                                    @foreach ($current->types as $type)
                                                        @if ($user_type->id == $type->id)
                                                            selected
                                                        @endif
                                                    @endforeach
                                                >{{$user_type->type}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label >Codes</label><br>
                                        <select class="codes_select form-control col-md-12" name="codes[]" multiple="multiple">
                                            @foreach ($current->codes as $code)
                                                <option value="{{$code->code}}" selected>{{$code->code}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="text" class="form-control" placeholder="Category Order to show (1 as first) " name="order" value="{{$current->order}}">
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Show</label>
                                            <label class="switch">
                                                <input type="checkbox" name="show" value="1" @if($current->show == '1'){{'checked'}} @endif>
                                                <span class="slider round"></span>
                                            </label>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Show in home page</label>
                                            <label class="switch">
                                                <input type="checkbox" name="show_in_home" value="1" @if($current->home == '1'){{'checked'}} @endif>
                                                <span class="slider round"></span>
                                            </label>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Image</label>
                                        
                                                <button type="button" class="btn btn-info mg" data-toggle="modal" data-target="#modal-default">
                                                    Choose Image
                                                </button>
                                            
                                                <p class="image_chosen"><a target='_blank' href='{{asset('')}}{{$current->getImage()->link}}'>{{$current->getImage()->original_name}}</a></p>
                                          
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
                                                                <option @if($current->getImage()->id == $one->id){{'selected'}} @endif data-img-label="<a class='link-image' target='_blank' href='{{asset('')}}{{$one->link}}'>{{$one->original_name}}</a>" data-img-src="{{asset('')}}{{$one->link}}" data-img-class="custom-image" value="{{$one->id}}">{{$one->original_name}}</option>
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
        $( ".media_category_select" ).change(function() {
            $("#modal-default").removeClass('in');
            $("#modal-default").css('display', 'none');
            $(".modal-backdrop").remove();
            $(".image_chosen").html($(" .media_category_select option:selected").text());
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_category_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.categories.update', [$current->id])}}",
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
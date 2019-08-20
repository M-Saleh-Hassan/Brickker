@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Dashboard
            <small>tashtebk</small>
            </h1>
            <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!--------------------------
            | Your Page Content Here |
            -------------------------->                      
            <div class="col-md-12">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                        <h3>{{$users_count}}</h3>
            
                        <p>User Registrations</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.users')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                        <h3>{{$products_count}}</h3>
            
                        <p>Products</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{route('admin.products.index')}}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                {{-- <div class="box box-warning box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title">Collapsable</h3>
        
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">
                        <div class="col-md-12">
                            <div class="box box-warning box-solid">
                                <div class="box-header with-border">
                                <h3 class="box-title">Collapsable</h3>
                    
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.box-tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="">
                                    <select class="js-example-basic-single col-md-12" name="states[]" multiple="multiple">
                                            <option value="AL">Alabama</option>
                                            <option value="WY">Wyoming</option>
                                    </select>                            
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <select class="image-picker show-html">
                        <option value=""></option>
                        <option data-img-src="{{asset('/adminlte/dist/img/user2-160x160.jpg')}}" data-img-alt="Page 1" value="1">  Page 1  </option>
                        <option data-img-src="{{asset('/adminlte/dist/img/user2-160x160.jpg')}}" data-img-alt="Page 2" value="2">  Page 2  </option>
                        <option data-img-src="{{asset('/adminlte/dist/img/user2-160x160.jpg')}}" data-img-alt="Page 12" value="12"> Page 12 </option>
                    </select>
                      
                </div>
                <!-- /.box --> --}}
            </div>
        </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $("select").imagepicker(
        {
            show_label: true
        }
    )
    // var selected_option = $("select").data('picker').sync_picker_with_select();
    // console.log(selected_option);
    $("select.image-picker").change(function(){
        var selectedCountry = $(this).children("option:selected").val();
        alert("You have selected the country - " + selectedCountry);
    });

    $("#ex2").slider({});
    
});
</script>    
@endsection

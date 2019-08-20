@extends('admin.layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Policy
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Policy</li>
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
                        <h3 class="box-title">Policy</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="update_policy_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Content EN</label><br>
                                        <textarea id="editor_Content_en" name="content_en" rows="3" cols="160">{{$policy->content_en}}</textarea>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Content AR</label><br>
                                        <textarea id="editor_Content_ar" name="content_ar" rows="3" cols="160">{{$policy->content_ar}}</textarea>
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
       CKEDITOR.replace('editor_Content_en');
       CKEDITOR.replace('editor_Content_ar');
    });

    $(document).ready(function(){

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#update_policy_form').on('submit', function(event){
            var policy_text_en = CKEDITOR.instances.editor_Content_en.getData();
            policy_text_en = trimString(policy_text_en );
            var policy_text_ar = CKEDITOR.instances.editor_Content_ar.getData();
            policy_text_ar  = trimString(policy_text_ar );
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.policy.update')}}",
                method:"POST",
                data:$("#update_policy_form").serialize() + "&policy_text_en=" + policy_text_en + "&policy_text_ar=" + policy_text_ar,
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

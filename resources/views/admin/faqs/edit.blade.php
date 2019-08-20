@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            FAQs
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{route('admin.faqs.index')}}">Faqs</a></li>
                <li class="active">{!!$current->question_en!!}</li>    
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
                        <h3 class="box-title">{!!$current->question_en!!}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="edit_faq_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="box-body">
                                    <div class="form-group">
                                        <label>Question EN</label><br>
                                        <textarea id="question_text_en" name="question_en" rows="3" cols="160">{{$current->question_en}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Question AR</label><br>
                                        <textarea id="question_text_ar" name="question_ar" rows="3" cols="160">{{$current->question_ar}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Answer EN</label><br>
                                        <textarea id="answer_text_en" name="answer_en" rows="3" cols="160">{{$current->answer_en}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Answer AR</label><br>
                                        <textarea id="answer_text_ar" name="answer_ar" rows="3" cols="160">{{$current->answer_ar}}</textarea>
                                    </div>

                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="text" class="form-control" placeholder="FAQ Order to show (1 as first) " name="order" value="{{$current->order}}">
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
        CKEDITOR.replace('question_text_en');
        CKEDITOR.replace('question_text_ar');
        CKEDITOR.replace('answer_text_en');
        CKEDITOR.replace('answer_text_ar');
    });

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#edit_faq_form').on('submit', function(event){
            var faq_question_text_en = CKEDITOR.instances.question_text_en.getData();
            var faq_question_text_ar = CKEDITOR.instances.question_text_ar.getData();
            var faq_answer_text_en   = CKEDITOR.instances.answer_text_en.getData();
            var faq_answer_text_ar   = CKEDITOR.instances.answer_text_ar.getData();
            event.preventDefault();
            $.ajax({
                url:"{{route('admin.faqs.update', [$current->id])}}",
                method:"POST",
                data:$("#edit_faq_form").serialize() + "&faq_question_text_en=" + faq_question_text_en + "&faq_question_text_ar=" + faq_question_text_ar + "&faq_answer_text_en=" + faq_answer_text_en + "&faq_answer_text_ar=" + faq_answer_text_ar,
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
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
            <li class="active">Faqs</li>
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
                        <h3 class="box-title">Add new FAQ</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_faq_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Question EN</label><br>
                                        <textarea id="question_text_en" name="question_en" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Question AR</label><br>
                                        <textarea id="question_text_ar" name="question_ar" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Answer EN</label><br>
                                        <textarea id="answer_text_en" name="answer_en" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Answer AR</label><br>
                                        <textarea id="answer_text_ar" name="answer_ar" rows="3" cols="160"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Order</label>
                                        <input type="text" class="form-control" placeholder="FAQ Order to show (1 as first) " name="order">
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
                        <h3 class="box-title">All FAQs</h3>
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
                                        <th>Question</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($faqs as $faq)
                                        <tr id="row{{$faq->id}}">
                                            <td>{{$faq->order}}</td>
                                            <td>{!!$faq->question_en!!}</td>
                                            <td>
                                                <a  href="{{route('admin.faqs.edit', [$faq->id])}}" class="btn btn-primary" data-content="{{$faq->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$faq->id}}">
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
    $(function () {
        CKEDITOR.replace('question_text_en');
        CKEDITOR.replace('question_text_ar');
        CKEDITOR.replace('answer_text_en');
        CKEDITOR.replace('answer_text_ar');
    });

    $(document).ready(function(){
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_faq_form').on('submit', function(event){
            var faq_question_text_en = CKEDITOR.instances.question_text_en.getData();
            var faq_question_text_ar = CKEDITOR.instances.question_text_ar.getData();
            var faq_answer_text_en   = CKEDITOR.instances.answer_text_en.getData();
            var faq_answer_text_ar   = CKEDITOR.instances.answer_text_ar.getData();
            event.preventDefault();
            $.ajax({
                url:"{{ route('admin.faqs.add') }}",
                method:"POST",
                data:$("#add_faq_form").serialize() + "&faq_question_text_en=" + faq_question_text_en + "&faq_question_text_ar=" + faq_question_text_ar + "&faq_answer_text_en=" + faq_answer_text_en + "&faq_answer_text_ar=" + faq_answer_text_ar,
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
                            data.faq_order,
                            data.faq_question,
                            '<a  href="' + data.faq_link_edit +'" class="btn btn-primary" data-content="data.faq_id"><i class="glyphicon glyphicon-edit"></i><span>edit</span></a>',
                            '<button type="button" class="btn btn-danger delete" data-content="' + data.faq_id + '"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>'
                        ] ).draw().node();
                        
                        $( rowNode )
                            .css( 'color', 'red' )
                            .attr('id', 'row' + data.faq_id );
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
                    url: '{{route("admin.faqs.delete")}}',
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

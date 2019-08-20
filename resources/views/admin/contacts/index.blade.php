@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Contacts
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Contacts</li>
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
                        <h3 class="box-title">Contact Text</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_contact_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Text EN</label>
                                        <textarea id="editor_contact_text" name="contact_text" rows="3" cols="160">{{$contact->contact_text}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Text AR</label>
                                        <textarea id="editor_contact_text_ar" name="contact_text_ar" rows="3" cols="160">{{$contact->contact_text_ar}}</textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>        
                        </div>
                    </div>
                </div>
                <!-- All Contacts -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All Contacts</h3>
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
                                        <th>Sent At</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Message</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($contacts as $contact)
                                        <tr id="row{{$contact->id}}">
                                            <td>{{$contact->created_at}}</td>
                                            <td>{{$contact->full_name}}</td>
                                            <td>{{$contact->email}}</td>
                                            <td>{{$contact->mobile}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message_modal_{{$contact->id}}">
                                                  Message
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="message_modal_{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{$contact->full_name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        {{$contact->message}}
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$contact->id}}">
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

    $(document).ready(function(){
       CKEDITOR.replace('editor_contact_text');
       CKEDITOR.replace('editor_contact_text_ar');

        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 
    });

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#add_contact_form').on('submit', function(event){
            var contact_text = CKEDITOR.instances.editor_contact_text.getData();
            contact_text = trimString(contact_text);
            var contact_text_ar = CKEDITOR.instances.editor_contact_text_ar.getData();
            contact_text_ar = trimString(contact_text_ar );

            event.preventDefault();
            $.ajax({
                url:"{{ route('admin.contact_us.text') }}",
                method:"POST",
                data:$("#add_contact_form").serialize()  + "&contact_text=" + contact_text + "&contact_text_ar=" + contact_text_ar,
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay").toggleClass('hidden');
                },
                success:function(data)
                {
                    alert(data.message);

                    $(".overlay").toggleClass('hidden');
                }
            })
        });
        $('#example').on('click', '.delete', function(){
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.contact_us.delete")}}',
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

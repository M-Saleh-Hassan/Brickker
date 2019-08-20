@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Reports
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!------------------------
            | Your Page Content Here |
            -------------------------->                      
            <div class="col-md-12">

                <!-- All reports -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All reports</h3>
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
                                        <th>From</th>
                                        <th>Product</th>
                                        <th>Message</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($reports as $report)
                                        <tr id="row{{$report->id}}">
                                            <td>{{$report->created_at}}</td>
                                            <td><a  href="{{route('admin.users.edit', [$report->user->id])}}" >{{$report->user->username}}</a></td>
                                            <td><a  href="{{route('admin.products.edit', [$report->id])}}" >{{$report->product->title}}</a></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message_modal">
                                                  Message
                                                </button>
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{$report->user->username}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        {{$report->message}}
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$report->id}}">
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
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 
    });

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.reports.delete")}}',
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

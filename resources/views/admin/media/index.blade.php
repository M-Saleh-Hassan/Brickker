@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Media
            <!--<small>Optional description</small>-->
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Media</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!--------------------------
            | Your Page Content Here |
            -------------------------->
            {{-- <div id="ckfinder1"></div> --}}
            {{-- @include('ckfinder::setup') --}}
            <div class="row fileupload-buttonbar">
                <div class="col-lg-2">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button" style="display:block ; margin-bottom:10px">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files...</span>
                        <input type="file" id="fileupload" name="photos[]" data-url="{{route('admin.media.upload')}}" multiple="">
                    </span>
                    <style>
                        .fileinput-button input {
                            position: absolute;
                            top: 0;
                            left: 0;
                            margin: 0;
                            opacity: 0;
                            -ms-filter: 'alpha(opacity=0)';
                            cursor: pointer;
                        }
                        
                       #files_list p{
                            border-right: 1px solid #aaa;
                            padding: 0 10px;
                            display: inline-block;
                        }
                        .progress{
                            margin:10px 0;
                        }
                    </style>
                </div>
                <div class="col-lg-9">
                    <div id="progress" class="progress progress-sm active">
                        <div class="progress-bar progress-bar-success progress-bar-striped bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                    </div>
                    <style>
                        .bar {
                            height: 18px;
                            /* background: green; */
                        }
                    </style>    
                    <p id="loading"></p>
                </div>
                <div id="files_list"></div>
            </div>
            <div class="box">
                    <div class="overlay hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>

                {{-- <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
                </div> --}}
                <!-- /.box-header -->
                <div class="box-body">
                    {{-- <table id="example" class="table table-bordered table-hover" style="width:100%"> --}}
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>preview</th>
                                <th>name</th>
                                <th>size</th>
                                <th>extension</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_media as $media)
                                <tr id="row{{$media->id}}">
                                    <td>{{$counter}}</td>
                                    <td><a href="{{asset('')}}{{$media->link}}"><img src="{{asset('')}}{{$media->link}}" width="120px"  ></a></td>
                                    <td>{{$media->original_name}}</td>
                                    <td>{{$media->size}} KB</td>
                                    <td>{{$media->type}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete" data-content="{{$media->id}}">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                    </td>
                                </tr>   
                                @php $counter++; @endphp                             
                            @endforeach
                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
    
        </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection    

@section('js')  
<script>
    $(function () {
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 
        $('#fileupload').fileupload({
            disableValidation: true,
            dataType: 'json',
            add: function (e, data) {
                $('#loading').text('Uploading...');
                data.submit();
            },
            done: function (e, data) {
                // console.log(data.result);
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
                    if ($('#file_ids').val() != '') {
                        $('#file_ids').val($('#file_ids').val() + ',');
                    }
                    $('#file_ids').val($('#file_ids').val() + file.fileID);
                    var rowNode = t.row.add( [
                        {{$counter}},
                        '<a href="{{asset('')}}' + file.link +'"><img src="{{asset('')}}' + file.link +'" width="120px" "></a>',
                        file.name,
                        file.size + ' KB',
                        file.type,
                        '<button type="button" class="btn btn-danger delete" data-content="' + file.fileID + '"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>'
                        @php $counter++; @endphp 
                    ] ).draw().node();
                    $( rowNode )
                        .css( 'color', 'red' )
                        .attr('id', 'row'+ file.fileID );
                     });
                $('#loading').text('');

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .bar').css(
                    'width',
                  progress + '%'
                );
                $('#loading').text('uploading ' + progress + '%');
            }
        });
        // var overallProgress = $('#fileupload').fileupload('progress');
        // console.log(overallProgress);
    });

    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
        // $(".delete").click(function(){ // not working at page 2 see reason at https://www.gyrocode.com/articles/jquery-datatables-why-click-event-handler-does-not-work/
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    /* the route pointing to the post function */
                    url: '{{route("admin.media.delete")}}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    /* remind that 'data' is the response of the AjaxController */
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
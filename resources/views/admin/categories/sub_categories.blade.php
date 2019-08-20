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
                <!-- All Categories -->
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
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>order</th>
                                        <th>codes</th>
                                        <th>title</th>
                                        <th>sub</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($categories as $category)
                                        <tr id="row{{$category->id}}">
                                            <td>{{$category->order}}</td>
                                            <td>@foreach ($category->codes as $code){{$code->code}} @endforeach</td>
                                            <td>{{$category->title}}</td>
                                            <td>
                                                <a  href="{{route('admin.categories.sub_categories', [$category->id])}}" class="btn btn-info" data-content="{{$category->id}}">
                                                    <i class="fa fa-eye"></i>
                                                    <span>sub</span>
                                                </a>

                                            </td>
                                            <td>
                                                <a  href="{{route('admin.categories.edit', [$category->id])}}" class="btn btn-primary" data-content="{{$category->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$category->id}}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </td>
                                        </tr>   
                                        @php $counter++; @endphp                             
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
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 
    });
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
        // $(".delete").click(function(){ // not working at page 2 see reason at https://www.gyrocode.com/articles/jquery-datatables-why-click-event-handler-does-not-work/
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.categories.delete")}}',
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
<style>
li.custom-image
{
    width:20%;
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